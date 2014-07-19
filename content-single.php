<?php
/**
 * This is a post/article view.
 *
 * @package npmawesome
 */
?>

<?php
function the_social() {
  ?>
  <div class="social-box">
    <div class="yashare-auto-init" data-yashareLink="<?php the_permalink(); ?>" data-yashareL10n="en" data-yashareQuickServices="facebook,twitter,gplus" data-yashareTheme="counter" data-yasharetype-off="small"></div>
  </div>
  <?php
}

$is_module = in_category('npm');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header>
    <h2 class="<?php echo $is_module ? 'npm' : 'article' ?>">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>

    <div class="meta">
      <?php npmawesome_posted_on(); ?>

      <?php if($is_module): ?>
        <div class="github-stars" data-github-repo="<?php the_field('module_github'); ?>"></div>
      <?php endif; ?>

      <?php
      $category_list = get_the_category_list( ', ' );
      $tag_list = get_the_tag_list( '', ', ' );
      printf('This entry was tagged %2$s.', $tag_list);
      ?>

      <?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
    </div>

    <?php the_social(); ?>
  </header>

  <div class="content">
    <?php the_content(); ?>
    <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'npmawesome' ),
        'after'  => '</div>',
      ) );
    ?>
  </div>

  <?php the_social(); ?>
</article>

