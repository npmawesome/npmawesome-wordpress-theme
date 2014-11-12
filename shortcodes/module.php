<?php
/*
[module] -> will print browsenpm link
[module full] -> will print browsenpm link, github and license
[module name="gulp-print" github="alexgorbatchev/gulp-print" license="boo"]
[module name="gulp-print" github="alexgorbatchev/gulp-print" license="boo" full]
*/

function npm_module_meta($attrs, $before, $after) {
  $to_markdown = is_npmawesome_preview();
  $github = $attrs['github'] ?: get_field('module_github');
  $license = $attrs['license'] ?: get_field('module_license');

  if(!is_null($github)) {
    $info = "GitHub: ".($to_markdown
      ? "[$github](https://github.com/$github)"
      : npm_github_link_html($github)
    );
  }

  if(!is_null($license)) $info = "$info, License: $license";

  return $to_markdown
    ? $before.$info.$after
    : "<span class='NpmModule-meta'>{$before}{$info}{$after}</span>";
}

function npm_module_shortcode($atts) {
  if(!is_array($atts)) {
    $atts = [];
  }

  $to_markdown = is_npmawesome_preview();
  $name = $github = $license = $displayName = '';

  $a = shortcode_atts(compact('name', 'github', 'license', 'displayName'), $atts);
  $name = $a['name'] ?: get_field('module_name');
  $displayName = $a['displayName'] ?: $a['name'] ?: get_field('module_display_name') ?: $name;

  if(array_search('install', $atts) !== FALSE) {
    $result = $to_markdown
      ? "npm install $name"
      : "<span class=\"NpmModule-install\">npm install $name</span>";
  }
  else {
    $result = $to_markdown
      ? "[$displayName](http://browsenpm.org/package/$name)"
      : "<a class=\"NpmModule-packageLink\" href='http://browsenpm.org/package/$name'>$displayName</a>";
  }

  if(array_search('full', $atts) !== FALSE) {
    $result .= ' '.npm_module_meta($a, '(', ')');
  }

  return $to_markdown
    ? $result
    : "<span class='NpmModule'>$result</span>";
}

add_shortcode('module', 'npm_module_shortcode');
?>
