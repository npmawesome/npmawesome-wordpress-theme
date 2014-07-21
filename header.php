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
        <h1 id="logo">
          <a href="/">
            <span class="name"><?php bloginfo('name'); ?></span>
            <span class="posts-counter"><?php echo wp_count_posts() ?></span>
          </a>
        </h1>

        <div id="sub-title">
          <a href="http://npmjs.org">npm</a> picks, old and new.
          <a href="https://github.com/alexgorbatchev/npm-awesome-site">Fork on GitHub to contribute</a>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="main col">
        <a name="content"></a>

