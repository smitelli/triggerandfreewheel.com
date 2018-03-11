<?php

  class ImageModule {
    private $use_specific = FALSE;

    public function __construct($args) {
      if (isset($args[0])) {
        // There is something specific that the user wants
        $this->use_specific = $args[0];
      }
    }

    public function execute() {
      $images = new ComicImages();

      if ($this->use_specific !== FALSE) {
        $images->load_specific($this->use_specific);
      } else {
        $images->load_newest();
      }

      if ($images->has_current()) {
        $images->send_current();
        $images->log_hit();

      } else {
        // You asked for it, we don't have it
        $template = new Template();
        $template->send_404();
      }
    }
  }

?>
