<?php

  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  define('DOING_CRON', TRUE);

  // Initialize the app, and force it to run the cron module
  require dirname(__FILE__) . '/bootstrap.php';
  $app = Application::singleton($bootstrap_base_dir, '/cron');
  $app->execute();

?>