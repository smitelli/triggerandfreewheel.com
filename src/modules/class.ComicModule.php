<?php

  class ComicModule {
    private $use_specific = FALSE;

    public function __construct($args) {
      if (isset($args[0])) {
        // There is something specific that the user wants
        $this->use_specific = $args[0];
      }
    }

    public function execute() {
      $comics   = new Comics();
      $template = new Template();

      if ($this->use_specific !== FALSE) {
        $comics->load_specific($this->use_specific);
      } else {
        $comics->load_newest();
      }

      if ($comics->has_current()) {
        $comics->load_adjacent();
        $template->assign('comics', $comics);
        $template->display('comic.tpl');
        $comics->log_hit();

      } else {
        // You asked for it, we don't have it
        $template->send_404();
      }
    }
  }

?>
