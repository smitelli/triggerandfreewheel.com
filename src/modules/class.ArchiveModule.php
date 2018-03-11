<?php

  class ArchiveModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      $comics   = new Comics();
      $template = new Template();

      $comics->load_archives();
      $template->assign('comics', $comics);
      $template->display('archive.tpl');
    }
  }

?>
