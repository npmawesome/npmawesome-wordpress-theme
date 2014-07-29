<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package npmawesome
 */
?>
    </div>

    <div id="side-nav">
      <div class="feedburner">
        <a href="http://feeds.feedburner.com/npmawesome"><img src="<?php echo get_template_directory_uri(); ?>/images/feed.gif"/></a>
      </div>

      <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
      <?php get_sidebar(); ?>
    </div>
  </div>

  <a class="hide-on-mobile" id="fork-me" href="https://github.com/npmawesome">Fork Me</a>

  <script tyle="text/javascript">
    // http://drawingablank.me/blog/fix-your-bounce-rate.html
    // https://news.ycombinator.com/item?id=5766883
    setTimeout(function() { ga('send', 'event', 'read', 'auto generated'); }, 5000);
  </script>

  <script async src="//platform.twitter.com/widgets.js"></script>
  <script async src="//yandex.st/share/share.js"></script>

  <?php wp_footer(); ?>
</body>
</html>
