<?php
/**
 * This is a brief post/article preview on the index page.
 *
 * @package npmawesome
 */

$is_module      = in_category('npm') && !in_category('article');
$post_image_url = null;
$colors         = null;
$module_desc    = null;

$classes = array(
  'PostCard',
  $is_module ? 'PostCard--module' : 'PostCard--article'
);

if($is_module) {
  $post_image_url = npm_get_github_field('avatar_url');
  $colors         = npm_get_remote_image_color($post_image_url);
  $module_desc    = amt_get_post_meta_description(get_the_ID());
}

if(has_post_thumbnail()) {
  $post_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
  $post_image_url = $post_image_url[0];
  $colors         = npm_get_remote_image_color($post_image_url);
}

if(isset($colors)) { ?>
  <style>
  #PostCard-id-<?php the_ID(); ?> .u-colorsBackground {
    color: <?php echo $colors['text'] ?> !important;
    background-color: <?php echo $colors['background']; ?>
  }

  #PostCard-id-<?php the_ID(); ?> .u-colorsTitle {
    color: <?php echo $colors['header'] ?> !important;
  }
  </style>
<?php } ?>

<div id="PostCard-id-<?php the_ID(); ?>" <?php post_class($classes); ?>>
  <div class="PostCard-box u-colorsBackground">
    <?php if($post_image_url) echo "<div class=\"PostCard-image\" style=\"background-image: url($post_image_url)\"><img src=\"$post_image_url\"/></div>"; ?>
    <header class="PostCard-header">
      <h2 class="PostCard-title u-colorsTitle">
        <a href="<?php the_permalink(); ?>" class="PostCard-permalink"><?php the_title(); ?></a>
      </h2>
      <?php if(!empty($module_desc)) echo "<h3 class=\"PostCard-desc\">".esc_attr($module_desc)."</h3>"; ?>
      <?php if($is_module) echo npm_module_meta(); ?>
      <span class="PostCard-author">
        <?php
          if($is_module) {
            echo npm_get_author();
          } else {
            npmawesome_by_line();
          }
        ?>
      </span>
      <?php // the_tags('<span class="meta-tags">', ', ', '</span>'); ?>
    </header>
    <?php edit_post_link('Edit', '<span class="PostCard-edit">', '</span>'); ?>
  </div>
</div>
