<?php
  function setup() {
    add_theme_support('post-thumbnails');
  }
  add_action('after_setup_theme', 'setup');