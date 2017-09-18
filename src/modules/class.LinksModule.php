<?php

  class LinksModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      $template = new Template();
      $template->display('links.tpl');
    }
  }

?>
