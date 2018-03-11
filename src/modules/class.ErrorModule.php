<?php

  class ErrorModule {
    private $code = FALSE;

    public function __construct($args) {
      if (isset($args[0])) {
        // We're dealing with a specific error condition here
        $this->code = $args[0];
      }
    }

    public function execute() {
      $template = new Template();
      $template->assign('code', $this->code);
      $template->display('error.tpl');
    }
  }

?>
