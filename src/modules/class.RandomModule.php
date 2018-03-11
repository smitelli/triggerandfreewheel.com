<?php

  class RandomModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      $comics   = new Comics();
      $template = new Template();

      // Pick any ol' random permalink
      $next = $comics->random_permalink();

      if ($next) {
        $base = Application::singleton()->config->app_uri;
        $template->send_redirect("{$base}/comic/{$next}");

      } else {
        // You asked for it, we don't have it
        $template->send_404();
      }
    }
  }

?>
