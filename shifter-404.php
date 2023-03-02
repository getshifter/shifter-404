<?php
/*
Plugin Name: Shifter Error 404
Plugin URI: https://github.com/getshifter/
Description: Hotfix for Shifter 404s. This plugin generates a 404.php for WordPress FSE enabled sites.
Author: Shifter
Version: 0.1.0
Author URI: https://www.getshifter.io
*/

function create_404()
{
  $file = get_template_directory() . '/404.php';
  $url = get_home_url() . '/404/';
  $ch = curl_init($url);
  $fp = fopen($file, "w");

  curl_setopt($ch, CURLOPT_FILE, $fp);
  curl_setopt($ch, CURLOPT_HEADER, 0);

  curl_exec($ch);
  if (curl_error($ch)) {
    fwrite($fp, curl_error($ch));
  }

  curl_close($ch);
  fclose($fp);
}

add_action( 'save_post_wp_template', 'create_404');