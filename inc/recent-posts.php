<?php
$r = new WP_Query(apply_filters('widget_posts_args', array(
  'posts_per_page'      => 10,
  'no_found_rows'       => true,
  'post_status'         => 'publish',
  'ignore_sticky_posts' => true
)));

if ($r->have_posts()) { ?>
  <div class="RecentPosts">
    <?php
    while ($r->have_posts()) {
      $r->the_post();
      require get_template_directory().'/inc/post-card.php';
    }

    wp_reset_postdata(); // Reset the global $the_post as this query will have stomped on it
    ?>
  </div>
<?php }
