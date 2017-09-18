<?php

  // The bootstrap process needs a certain amount of filesystem awareness
  $bootstrap_base_dir = dirname(__FILE__);
  $bootstrap_search_pats = array(
    "{$bootstrap_base_dir}/classes/class.%s.php",
    "{$bootstrap_base_dir}/modules/class.%s.php"
  );

  // Libraries that are inconvenient to autoload
  include "{$bootstrap_base_dir}/libs/smarty/Smarty.class.php";
  include "{$bootstrap_base_dir}/libs/twitteroauth/TwitterOAuth.php";

  // Support autoloading classes as they are needed
  spl_autoload_register(function($class_name) {
    global $bootstrap_search_pats;

    // Loop through directories until a suitable file is found
    foreach ($bootstrap_search_pats as $pattern) {
      $class_file = sprintf($pattern, $class_name);

      if (is_file($class_file)) {
        // File exists; load it and stop searching
        require_once $class_file;
        return TRUE;
      }
    }
    return FALSE;
  });

  if (isset($_SERVER['REQUEST_URI'])) {
    // Initialize and run the app
    $app = Application::singleton($bootstrap_base_dir, $_SERVER['REQUEST_URI']);
    $app->execute();

  } else {
    // Assume we're being called from a CLI script... Let it handle things.
  }

?>
