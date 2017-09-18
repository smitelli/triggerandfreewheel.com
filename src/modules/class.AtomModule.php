<?php

  class AtomModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      $comics   = new Comics();
      $template = new Template();

      $comics->load_archives('DESC', 20);

      header('Content-Type: application/atom+xml; charset=UTF-8');
      $template->assign('comics', $comics);
      $template->display('atom.tpl');
    }
  }

?>
