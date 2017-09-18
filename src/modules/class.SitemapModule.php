<?php

  class SitemapModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      $comics   = new Comics();
      $template = new Template();

      $comics->load_archives();

      header('Content-Type: text/xml; charset=UTF-8');
      $template->assign('comics',   $comics);
      $template->assign('rightnow', date('c'));
      $template->display('sitemap.tpl');
    }
  }

?>
