<?php
/**
 * @package npmawesome
 */

function npm_slugify($text) {
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  $text = trim($text, '-');
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = strtolower($text);
  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function npm_get_remote_image_color($url) {
  require_once get_template_directory().'/vendor/cover-colors/index.php';

  $colors = npm_get_cached_json($url);

  if(isset($colors)) {
    return $colors;
  }

  $temp = tempnam('/tmp', 'npmawesome-remote-image-color-');
  file_put_contents($temp, fopen($url, 'r'));

  try {
    $analyzeImage = \Image\Image::createFromFile($temp);
    $analyzer = new Analyzer($analyzeImage);
    $result = $analyzer->getResult();

    $colors = array(
      'background' => $result->background->getHexString(),
      'header'     => $result->title->getHexString(),
      'text'       => $result->songs->getHexString(),
    );
  } catch (Exception $e) {
    echo $e->getMessage();
  }

  unlink($temp);
  return npm_set_cached_json($url, $colors);
}

// replace the default posts feed with feedburner
function npmawesome_custom_rss_feed($output, $feed) {
  if(strpos($output, 'comments'))
    return $output;

  return esc_url('http://feeds.feedburner.com/npmawesome');
}

add_action('feed_link', 'npmawesome_custom_rss_feed', 10, 2);

function npm_curl($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_REFERER, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent: npmawesome.com"));
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

function npm_get_cached_json($url) {
  $file = get_template_directory().'/cache/'.npm_slugify($url);

  if(file_exists($file)) {
    return json_decode(file_get_contents($file), true);
  }
}

function npm_set_cached_json($url, $value) {
  $file = get_template_directory().'/cache/'.npm_slugify($url);
  file_put_contents($file, json_encode($value));
  return $value;
}

function npm_curl_json($url) {
  $json = npm_get_cached_json($url);

  if(isset($json)) {
    return $json;
  }

  $json = json_decode(npm_curl($url), true);
  return npm_set_cached_json($url, $json);
}

function npm_github_link_html($link) {
  return "<a href='https://github.com/$link'>$link</a>";
}

function npm_get_github_info($post_id) {
  $post_id = $post_id ?: get_the_ID();
  $cache_key = "npm_github_info_$post_id";
  $github_info = wp_cache_get($cache_key);

  if($github_info !== FALSE) {
    return $github_info;
  }

  $github = get_field('module_author', $post_id);

  if(empty($github)) {
    $github = get_field('module_github', $post_id);
    $github = substr($github, 0, strpos($github, '/'));

    if(empty($github)) {
      return null;
    }
  }

  $github_info = npm_curl_json("https://api.github.com/users/$github");

  wp_cache_set($cache_key, $github_info);

  return $github_info;
}

function npm_get_github_field($field_name, $post_id) {
  $github_info = npm_get_github_info($post_id);
  return $github_info[$field_name];
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function npmawesome_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

add_filter( 'wp_page_menu_args', 'npmawesome_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function npmawesome_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'npmawesome_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function npmawesome_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'npmawesome' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'npmawesome_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function npmawesome_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'npmawesome_setup_author' );
