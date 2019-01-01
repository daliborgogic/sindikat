<?php
  add_action('rest_api_init', 'cors', 15);
  function cors() {
    remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
    add_filter('rest_pre_serve_request', function ($value) {
      header('Access-Control-Allow-Origin: https://daliborgogic, http://localhost:3000');
      header('Access-Control-Allow-Methods: GET');
      header('Access-Control-Allow-Credentials: true');
      return $value;
    });
  }