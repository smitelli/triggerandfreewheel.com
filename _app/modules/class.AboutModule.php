<?php

  class AboutModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      $comics   = new Comics();
      $template = new Template();

      $template->assign('comics', $comics);
      $template->assign('age', number_format((time() -
        strtotime('March 1, 1986 16:18 EST')) / (365.25 * 86400), 3, '.', ''));

      $template->display('about.tpl');
    }
  }

?>