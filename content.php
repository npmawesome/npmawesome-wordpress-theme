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
    <h2>
      <a href="<?php the_permalink(); ?>" class="permalink"><?php the_title(); ?></a>
      <?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
    </h2>
    <?php the_tags('<span class="meta-tags">', ', ', '</span>'); ?>
  </header>
</article>
