<?php
/**
 * [author] -> will print author name
 * [author photo] will display author github profile photo
 */

function npm_get_author($post_id) {
  $html_url = npm_get_github_field('html_url', $post_id);
  $name = npm_get_github_field('name', $post_id);

  if(empty($html_url) || empty($name)) {
    return '';
  }

  $to_markdown = is_npmawesome_preview();

  return $to_markdown
    ? "[$name]($html_url)"
    : "<span class='NpmAuthor-name'><a href='$html_url'>$name</a></span>";
}

function npm_get_author_photo($post_id, $attrs) {
  $avatar_url = npm_get_github_field('avatar_url', $post_id);

  if(empty($avatar_url)) {
    return '';
  }

  $to_markdown = is_npmawesome_preview();
  $result = "<img src=\"$avatar_url\" $attrs/>";

  return $to_markdown
    ? $result
    : "<span class=\"NpmAuthor-photo\">$result</span>";
}

function npm_author_shortcode($atts) {
  if(!is_array($atts)) {
    $atts = [];
  }

  if(array_search('photo', $atts) !== FALSE) {
    return npm_get_author_photo(null, 'width="200" align="right" vspace="10" hspace="10"');
  } else {
    return npm_get_author();
  }
}

add_shortcode('author', 'npm_author_shortcode');
