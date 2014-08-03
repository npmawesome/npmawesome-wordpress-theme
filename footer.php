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
      <?php if(is_home()): ?>
        <a class="twitter-timeline" href="https://twitter.com/search?q=-jobs+AND+-employer+AND+%28javascript+OR+npm+OR+angularjs+OR+coffeescript+OR+nodejs%29" data-widget-id="496005807700324354">Tweets about "-jobs AND -employer AND (javascript OR npm OR angularjs OR coffeescript OR nodejs)"</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      <?php endif; ?>

      <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
      <?php get_sidebar(); ?>
    </div>
  </div>

  <script tyle="text/javascript">
    // http://drawingablank.me/blog/fix-your-bounce-rate.html
    // https://news.ycombinator.com/item?id=5766883
    if (window.ga) {
      setTimeout(function() { ga('send', 'event', 'read', 'auto generated'); }, 5000);
    }
  </script>

  <script async src="//platform.twitter.com/widgets.js"></script>
  <script async src="//yandex.st/share/share.js"></script>

  <?php wp_footer(); ?>
</body>
</html>
