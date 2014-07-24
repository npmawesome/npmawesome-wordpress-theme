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
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    // http://drawingablank.me/blog/fix-your-bounce-rate.html
    // https://news.ycombinator.com/item?id=5766883
    setTimeout(function() { ga('send', 'event', 'read', 'auto generated'); }, 5000);

    ga('create', 'UA-46164085-1', 'npmawesome.com');
    ga('send', 'pageview');
  </script>

  <script async src="//platform.twitter.com/widgets.js"></script>
  <script async src="//yandex.st/share/share.js"></script>

  <?php wp_footer(); ?>
</body>
</html>
