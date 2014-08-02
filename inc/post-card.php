<?php
/**
 * This is a brief post/article preview on the index page.
 *
 * @package npmawesome
 */

$is_module = in_category('npm');

$classes = array(
  'article-card',
  $is_module ? 'npm' : 'article'
);

if(has_post_thumbnail()) {
  $post_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
  $post_image_url = $post_image_url[0];
  $post_image = "<div class='post-image' style='background-image: url($post_image_url);'><img src='$post_image_url'/></div>";
  array_push($classes, 'with-post-image');
}
?>

<div id="post-card-<?php the_ID(); ?>" <?php post_class($classes); ?>>
  <div class="box">
    <header>
      <?php
        if($is_module) {
          $avatar_url = npm_get_github_field('avatar_url');
          echo "<span class='npm author photo'><img src='$avatar_url'/></span>";
        }
      ?>
      <h2>
        <a href="<?php the_permalink(); ?>" class="permalink"><?php the_title(); ?></a>
      </h2>
      <?php echo npm_get_author(); ?>
      <?php // the_tags('<span class="meta-tags">', ', ', '</span>'); ?>
    </header>
    <?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
    <?php echo $post_image; ?>
  </div>
</div>
