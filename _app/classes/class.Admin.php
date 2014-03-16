<?php

  class Admin extends Comics {
    public  $messages     = array();
    public  $stat_list    = array();
    private $current_user = FALSE;

    public function __construct() {
      if (!isset($_SESSION)) session_start();
      parent::__construct();

      if (isset($_SESSION['admin_messages'])) {
        $this->messages = $_SESSION['admin_messages'];
      }
      
      if (isset($_SESSION['user_name']) && isset($_SESSION['user_pass'])) {
        $this->login($_SESSION['user_name'], $_SESSION['user_pass']);
      }
    }
    
    public function sub_logout($args) {
      $this->logout();
    }
    
    public function sub_stat($args) {
      if (!$this->is_logged_in()) return FALSE;

      $this->load_all();
    }

    public function sub_post($args) {
      if (!$this->is_logged_in()) return FALSE;
      
      // Don't do anything if the upload form is not being submitted
      if (!isset($_POST['post_submit'])) return FALSE;
      
      $this->clear_messages();
      
      // Was everything physically on the form?
      if (!isset($_POST['post_date'])  || !isset($_POST['post_permalink']) ||
          !isset($_POST['post_title']) || !isset($_POST['post_body']) ||
          !isset($_FILES['post_image'])) {
        $this->queue_message("A required form element was omitted!");
      }
      
      // Make sure the user is not being stupid
      if (!Comics::looks_like_date($_POST['post_date']))
        $this->queue_message("Date is not in YYYYMMDD format!");
      else if (!$this->date_available($_POST['post_date']))
        $this->queue_message("Date is already in use!");
        
      if (!$_POST['post_title'])
        $this->queue_message("Post title cannot be blank!");
        
      if (!$_POST['post_body'])
        $this->queue_message("Post body cannot be blank!");
        
      if (!Comics::is_valid_permalink($_POST['post_permalink']))
        $this->queue_message("Permalink is not valid! (a-z, 0-9, hyphen)");
      else if (!$this->permalink_available($_POST['post_permalink']))
        $this->queue_message("Permalink is already in use!");
        
      if (!is_uploaded_file($_FILES['post_image']['tmp_name']))
        $this->queue_message("The image file is missing!");
        
      // Don't continue if something above generated a message
      if ($this->has_messages()) return FALSE;
      
      if (!$this->insert_comic($_POST, $_FILES['post_image']))
        $this->queue_message("insert_comic() failed for some reason!");
      else
        $_POST = array();  //never want to see this again
    }
    
    public function login($user_name, $user_pass) {
      $this->logout();
      $user_list = Application::singleton()->config->user_list;
      
      if (isset($user_list[$user_name])) {
        // User name exists in the list...
        if ($user_list[$user_name] == md5($user_pass)) {
          // Password matched as well
          $this->current_user    = $user_name;
          $_SESSION['user_name'] = $user_name;
          $_SESSION['user_pass'] = $user_pass;
        }
      }
      
      return $this->is_logged_in();
    }
    
    public function logout() {
      $this->current_user = FALSE;
      unset($_SESSION['user_name']);
      unset($_SESSION['user_pass']);
    }
    
    public function is_logged_in() {
      return ($this->current_user !== FALSE);
    }
    
    public function queue_message($message) {
      $this->messages[] = $message;
      $_SESSION['admin_messages'] = $this->messages;
    }
    
    public function has_messages() {
      return count($this->messages) > 0;
    }

    public function clear_messages() {
      $this->messages = array();
      unset($_SESSION['admin_messages']);
    }
  }

?>