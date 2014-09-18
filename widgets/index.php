<?php
define('NPM_WIDGETS_DIR', dirname(__FILE__));

require_once(NPM_WIDGETS_DIR.'/github-author/index.php');
require_once(NPM_WIDGETS_DIR.'/recent-posts/index.php');

add_action('widgets_init', function() {
  register_widget('NA_Widget_Recent_Posts');
  register_widget('NA_Widget_Github_Author');
});
