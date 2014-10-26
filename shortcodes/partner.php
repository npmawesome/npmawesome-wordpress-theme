<?php
/*
[partner name]
*/
function npm_partner_shortcode($atts) {
  if(!is_array($atts)) {
    $atts = [];
  }

  $partner = $atts[0];

  if(empty($partner)) {
    return "";
  }

  ob_start();
  eval(file_get_contents(join(DIRECTORY_SEPARATOR, array(NPM_SHORTCODES_DIR, "partners", "$partner.html"))));
  $html = ob_get_clean();

  return "<div class=\"Partner Partner-$partner\">$html</div>";
}

add_shortcode('partner', 'npm_partner_shortcode');
