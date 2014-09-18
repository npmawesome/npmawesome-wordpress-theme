<?php
/**
 * This is a brief post/article preview on the index page.
 *
 * @package npmawesome
 */

$is_module  = in_category('npm') && !in_category('article');
$post_image = null;
$colors     = null;
$avatar_url = null;

$classes = array(
  'article-card',
  $is_module ? 'npm' : 'article'
);


if(has_post_thumbnail()) {
  $post_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
  $post_image_url = $post_image_url[0];
  $post_image     = "<div class='post-image' style='background-image: url($post_image_url);'><img src='$post_image_url'/></div>";
  $colors         = npm_get_remote_image_color($post_image_url);

  array_push($classes, 'with-post-image');
}

if($is_module) {
  $avatar_url = npm_get_github_field('avatar_url');
  $colors = npm_get_remote_image_color($avatar_url);
}

if(isset($colors)) {
  ?>
  <style>
  #post-card-<?php the_ID(); ?> {
    color: <?php echo $colors['text'] ?>;
    background-color: <?php echo $colors['background']; ?>
  }

  #post-card-<?php the_ID(); ?> h2 {
    color: <?php echo $colors['title'] ?>;
  }

  #post-card-<?php the_ID(); ?> a {
    color: <?php echo $colors['text'] ?>;
  }
  </style>
  <?php
}
?>

<div id="post-card-<?php the_ID(); ?>" <?php post_class($classes); ?>>
  <div class="box">
    <header>
      <?php if($is_module) echo "<span class=\"npm author photo\"><img src=\"$avatar_url\"/></span>"; ?>
      <h2>
        <a href="<?php the_permalink(); ?>" class="permalink"><?php the_title(); ?></a>
      </h2>
      <?php if($is_module) echo npm_get_author(); ?>
      <?php // the_tags('<span class="meta-tags">', ', ', '</span>'); ?>
    </header>
    <?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
    <?php echo $post_image; ?>
  </div>
</div>
