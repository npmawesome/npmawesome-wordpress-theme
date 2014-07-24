<?php
/**
 * This is a post/article view.
 *
 * @package npmawesome
 */

$is_module = in_category('npm');

$classes = array(
  $is_module ? 'npm' : 'article'
);

function the_social() {
  ?>
  <div class="social-box">
    <div class="yashare-auto-init" data-yashareLink="<?php the_permalink(); ?>" data-yashareL10n="en" data-yashareQuickServices="facebook,twitter,gplus" data-yashareTheme="counter" data-yasharetype-off="small"></div>
  </div>
  <?php
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
  <header>
    <h2>
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
      <?php
        if($is_module) {
          echo '<div class="github-stars" data-github-repo="'.get_field('module_github').'"></div>';
        }

        edit_post_link('Edit', '<span class="edit-link">', '</span>');
      ?>
    </h2>

    <div class="meta">
      <?php npmawesome_posted_on(); ?>

      <?php
        $category_list = get_the_category_list( ', ' );
        $tag_list = get_the_tag_list( '', ', ' );
        printf('This entry was tagged %2$s.', $tag_list);
      ?>
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

