<?php
/**
 * This is a brief post/article preview on the index page.
 *
 * @package npmawesome
 */

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

      <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
        <span class="comments-link"><?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?></span>
      <?php endif; ?>

      <?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
    </div>
  </header>

  <div class="content">
    <?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
    <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'npmawesome' ),
        'after'  => '</div>',
      ) );
    ?>
  </div>
</article>
