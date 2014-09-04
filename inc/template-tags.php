<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package npmawesome
 */

if ( ! function_exists( 'npmawesome_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function npmawesome_paging_nav() {
  global $wp_query;
  $big = 999999999; // need an unlikely integer
  $pages = paginate_links(array(
    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages,
    'prev_next' => false,
    'type' => 'array',
    'prev_next' => TRUE,
    'prev_text' => '«',
    'next_text' => '»',
  ));

  if(is_array($pages)) {
    $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
    echo '<ul class="pagination">';
    foreach($pages as $page) {
      echo "<li>$page</li>";
    }
    echo '</ul>';
  }
}
endif;

if ( ! function_exists( 'npmawesome_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function npmawesome_post_nav() {
  // Don't print empty markup if there's nowhere to navigate.
  $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
  $next     = get_adjacent_post( false, '', false );

  if ( ! $next && ! $previous ) {
    return;
  }
  ?>
  <nav class="navigation post-navigation" role="navigation">
    <div class="nav-links">
      <?php
        previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'npmawesome' ) );
        next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'npmawesome' ) );
      ?>
    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}
endif;

if ( ! function_exists( 'npmawesome_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function npmawesome_posted_on() {
  $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
  // if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
  //  $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
  // }

  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
    // esc_attr( get_the_modified_date( 'c' ) ),
    // esc_html( get_the_modified_date() )
  );

  $posted_on = sprintf(
    _x( 'on %s', 'post date', 'npmawesome' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );

  if(function_exists('coauthors_posts_links')) {
    $authors = get_coauthors();
    $author = $authors[0];
  }

  if(empty($author)) {
    global $authordata;
    $author = $authordata;
  }

  $byline =
    '<span class="author vcard">'.
      '<img src="http://www.gravatar.com/avatar/'.md5($author->user_email).'"/>'.
      '<a class="url fn n" href="'.esc_url(get_author_posts_url($author->ID, $author->user_nicename)).'">'.esc_html($author->display_name).'</a>'.
    '</span>'
    ;

  echo '<span class="byline">' . $byline . '</span> <span class="posted-on">' . $posted_on . '</span>';
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function npmawesome_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'npmawesome_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      'hide_empty' => 1,

      // We only need to know if there is more than one category.
      'number'     => 2,
    ) );

    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'npmawesome_categories', $all_the_cool_cats );
  }

  if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so npmawesome_categorized_blog should return true.
    return true;
  } else {
    // This blog has only 1 category so npmawesome_categorized_blog should return false.
    return false;
  }
}

/**
 * Flush out the transients used in npmawesome_categorized_blog.
 */
function npmawesome_category_transient_flusher() {
  // Like, beat it. Dig?
  delete_transient( 'npmawesome_categories' );
}
add_action( 'edit_category', 'npmawesome_category_transient_flusher' );
add_action( 'save_post',     'npmawesome_category_transient_flusher' );
