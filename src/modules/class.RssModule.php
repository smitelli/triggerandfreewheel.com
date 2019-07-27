<?php

  class RssModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      $comics   = new Comics();
      $template = new Template();

      $comics->load_archives('DESC', 20);

      header('Content-Type: text/xml');
      $template->assign('comics', $comics);
      $template->display('rss.tpl');
    }
  }

?>
