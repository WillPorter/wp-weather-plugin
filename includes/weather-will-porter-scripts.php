<?php

  //adds my custom css   //main plugin js is mounted via plugin class
  function weather_add_scripts(){
    wp_enqueue_style('weather-main-style', plugins_url(). '/weather-will-porter/css/style.css');
  }

  add_action('wp_enqueue_scripts', 'weather_add_scripts');
