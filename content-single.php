<?php
/**
 * This is a post/article view.
 *
 * @package npmawesome
 */

function the_social($is_module) {
  include(get_template_directory().'/inc/social-buttons.php');
}

$is_module = in_category('npm');

$classes = array(
  'Post',
  $is_module ? 'Post-module' : 'Post-article'
);

if($is_module) {
  $post_image_url = npm_get_github_field('avatar_url');
  $colors         = npm_get_remote_image_color($post_image_url);
}

if(has_post_thumbnail()) {
  $post_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
  $post_image_url = $post_image_url[0];
  $colors         = npm_get_remote_image_color($post_image_url);
}

if(isset($colors)) { ?>
  <style>
  #Post-id-<?php the_ID(); ?> .Post-moduleHeader {
    color: <?php echo $colors['text'] ?>;
    background-color: <?php echo $colors['background']; ?>
  }

  #Post-id-<?php the_ID(); ?> .Post-moduleHeader .Post-title {
    color: <?php echo $colors['header'] ?>;
  }

  #Post-id-<?php the_ID(); ?> .Post-moduleHeader .GitHub-stars {
    color: <?php echo $colors['background'] ?>;
    background-color: <?php echo $colors['header'] ?>;
  }
  </style>
<?php } ?>

<div id="Post-id-<?php the_ID(); ?>" <?php post_class($classes); ?>>
  <header class="Post-header">
    <?php if($is_module) { ?>
      <div class="Post-moduleHeader">
        <?php echo npm_get_author_photo() ?>
        <h2 class="Post-title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <div class="GitHub-stars" data-github-repo="<?php echo get_field('module_github') ?>"></div>
        </h2>
        <?php echo npm_get_author() ?>
      </div>
    <?php } else { ?>
      <h2 class="Post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php } ?>
  </header>

  <?php the_social($is_module); ?>

  <div class="Post-meta">
    <?php npmawesome_posted_on(); ?>
  </div>

  <div class="Post-content">
    <?php the_content(); ?>

    <?php wp_link_pages(array(
      'before' => '<div class="page-links">'.__('Pages:', 'npmawesome'),
      'after'  => '</div>',
    )); ?>
  </div>

  <?php the_social($is_module); ?>
</div>
