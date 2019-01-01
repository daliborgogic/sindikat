
<?php
  function register_menu() {
    register_nav_menu('nav-menu', __( 'Navigation Menu' ));
  }
  add_action('init', 'register_menu');