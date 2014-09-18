<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package npmawesome
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <a class="screen-reader-text" style="display: none" href="#content"><?php _e( 'Skip to content', 'npmawesome' ); ?></a>

  <header id="page-header">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h1 id="logo">
            <a href="<?php echo site_url(); ?>" class="name"><?php bloginfo('name'); ?></a>
          </h1>

          <div id="sub-title">
            <span class="posts-counter">
              <?php echo npmawesome_get_category_count('npm'); ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <a name="content"></a>
  <div class="container">
    <div class="row">
      <div id="main-content" class="col-md-8">

