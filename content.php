<?php
/**
 * This is a brief post/article preview on the index page.
 *
 * @package npmawesome
 */

$is_module = in_category('npm');

$classes = array(
  'card',
  $is_module ? 'npm' : 'article'
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
  <header>
    <?php
      $avatar_url = npm_get_github_field('avatar_url');

      if(!empty($avatar_url)): ?>
        <span class="npm author photo"><img src="<?php echo $avatar_url; ?>"/></span>
      <?php endif;
    ?>
    <h2>
      <a href="<?php the_permalink(); ?>" class="permalink"><?php the_title(); ?></a>
      <?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
    </h2>
    <?php echo npm_get_author(); ?>
    <?php // the_tags('<span class="meta-tags">', ', ', '</span>'); ?>
  </header>
</article>
