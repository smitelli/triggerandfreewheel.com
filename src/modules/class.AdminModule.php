<?php

  class AdminModule {
    private $subsection = FALSE;
    private $sub_args   = FALSE;
    private $login_name = FALSE;
    private $login_pass = FALSE;

    public function __construct($args) {
      if (isset($args[0])) {
        // There is something specific that the user wants
        $this->subsection = $args[0];

        if (isset($args[1])) {
          // There are further args for the subsection
          $tmp_args = $args;
          array_shift($tmp_args);
          $this->sub_args = $tmp_args;
        }
      }

      if (isset($_POST['login_name']) && isset($_POST['login_pass'])) {
        // User is submitting the login form
        $this->login_name = $_POST['login_name'];
        $this->login_pass = $_POST['login_pass'];
      }
    }

    public function execute() {
      $admin    = new Admin();
      $template = new Template();

      if (!$admin->is_logged_in()) {
        // User is not logged in..

        if ($this->login_name !== FALSE && $this->login_pass !== FALSE) {
          // ...but they're trying
          $success = $admin->login($this->login_name, $this->login_pass);

          if ($success) {
            $template->send_redirect(Application::singleton()->self_uri);

          } else {
            $admin->queue_message("Username/password incorrect.");
          }
        }

        $this->subsection = 'login';

      } else {
        // User is logged in...
        $submethod = 'sub_' . $this->subsection;

        // What subsection is being accessed?
        if ($this->subsection === FALSE) {
          // Nothing specified, show default
          $this->subsection = 'default';

        } else if (method_exists($admin, $submethod)) {
          // User specified a valid admin method
          $admin->$submethod($this->sub_args);

        } else {
          // You asked for it, we don't have it
          $template->send_404();
          die();
        }
      }

      $template->assign('admin',  $admin);
      $template->assign('subtpl', 'admin_' . $this->subsection . '.tpl');
      $template->display('admin.tpl');
      $admin->clear_messages();
    }
  }

?>
