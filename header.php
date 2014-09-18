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

  <header class="PageHeader <?php if(is_home()) echo "PageHeader--home"; ?>">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="PageHeader-logo">
            <a href="<?php echo site_url(); ?>" class="PageHeader-name"><?php bloginfo('name'); ?></a>
          </h1>

          <div class="PageHeader-subTitle">
            Best of Node.js and NPM.
            <?php echo npmawesome_get_category_count('npm'); ?> modules mentioned!
          </div>
        </div>
      </div>
    </div>
  </header>

  <a name="content"></a>
  <div class="container">
    <div class="row">
      <div id="main-content" class="col-md-12">

