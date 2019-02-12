<?php
/*
Plugin Name: Weather Widget 4 Noble
Plugin URI: http://williamscottporter.com
Description: Custom Weather Widget using Open Weather Map API
Version: 1.0.0
Author: Will Porter
Author URI: http://williamscottporter.com
*/

// Exit if accessed directly
if(!defined('ABSPATH')){
  exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load Class file
require_once(plugin_dir_path(__FILE__).'/includes/weather-will-porter-class.php');


// Load Scripts file
require_once(plugin_dir_path(__FILE__).'/includes/weather-will-porter-scripts.php');


// Register Widget
function register_weather_will_porter(){
  register_widget('Weather_Will_Porter');
}

// Hook in function
add_action('widgets_init', 'register_weather_will_porter');
