<?php
/**
 * npmawesome functions and definitions
 *
 * @package npmawesome
 */

add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes($existing_mimes = array()) {
  // add the file extension to the array
  $existing_mimes['svg'] = 'mime/type';

  // call the modified list of extensions
  return $existing_mimes;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 640; /* pixels */
}

if ( ! function_exists( 'npmawesome_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function npmawesome_setup() {
  require get_template_directory().'/shortcodes/index.php';

  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on npmawesome, use a find and replace
   * to change 'npmawesome' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'npmawesome', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  //add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'npmawesome' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );

  /*
   * Enable support for Post Formats.
   * See http://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link'
  ) );

  // Setup the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'npmawesome_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
}
endif; // npmawesome_setup
add_action( 'after_setup_theme', 'npmawesome_setup' );

function npmawesome_get_category_count($input = '') {
  global $wpdb;
  $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
  return $wpdb->get_var($SQL);
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function npmawesome_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'npmawesome' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
}
add_action( 'widgets_init', 'npmawesome_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function npmawesome_enqueue_script($filename) {
  $version = filemtime(get_stylesheet_directory().$filename);
  wp_enqueue_script("npmawesome-$filename", get_template_directory_uri().$filename, array(), $version, true);
}

function npmawesome_scripts() {
  wp_enqueue_style( 'npmawesome-style', get_stylesheet_uri().'?t='.filemtime(get_stylesheet_directory().'/style.css') );
  wp_enqueue_style( 'npmawesome-fonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,400italic' );
  wp_enqueue_script( 'npmawesome-jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js', array(), '2.0.3', true );

  npmawesome_enqueue_script('/bower_components/RRSSB/js/rrssb.js');
  npmawesome_enqueue_script('/js/navigation.js');
  npmawesome_enqueue_script('/js/skip-link-focus-fix.js');
  npmawesome_enqueue_script('/js/numeral.js');
  npmawesome_enqueue_script('/js/jquery.unveil.js');
  npmawesome_enqueue_script('/js/github-stars.js');
  npmawesome_enqueue_script('/js/main.js');
  npmawesome_enqueue_script('/js/syntaxhighlighter/shCore.js');
  npmawesome_enqueue_script('/js/syntaxhighlighter/shBrushBash.js');
  npmawesome_enqueue_script('/js/syntaxhighlighter/shBrushCss.js');
  npmawesome_enqueue_script('/js/syntaxhighlighter/shBrushJScript.js');
  npmawesome_enqueue_script('/js/syntaxhighlighter/shBrushSass.js');
  npmawesome_enqueue_script('/js/syntaxhighlighter/shBrushXml.js');

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'npmawesome_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
