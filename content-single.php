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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header>
    <h2 class="<?php echo in_category('npm') ? 'npm' : 'article' ?>">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>

    <div class="meta">
      <?php npmawesome_posted_on(); ?>

      <?php if(in_category('npm')): ?>
        <div class="github-stars" data-github-repo="<?php the_field('module_github'); ?>"></div>
      <?php endif; ?>

      <?php
      /* translators: used between list items, there is a space after the comma */
      $category_list = get_the_category_list( __( ', ', 'npmawesome' ) );

      /* translators: used between list items, there is a space after the comma */
      $tag_list = get_the_tag_list( '', __( ', ', 'npmawesome' ) );

      if ( ! npmawesome_categorized_blog() ) {
        // This blog only has 1 category so we just need to worry about tags in the meta text
        if ( '' != $tag_list ) {
          $meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'npmawesome' );
        } else {
          $meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'npmawesome' );
        }

      } else {
        // But this blog has loads of categories so we should probably display them here
        if ( '' != $tag_list ) {
          $meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'npmawesome' );
        } else {
          $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'npmawesome' );
        }

      } // end check for categories on this blog

      printf(
        $meta_text,
        $category_list,
        $tag_list,
        get_permalink()
      );
      ?>

    <?php edit_post_link( __( 'Edit', 'npmawesome' ), '<span class="edit-link">', '</span>' ); ?>

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

