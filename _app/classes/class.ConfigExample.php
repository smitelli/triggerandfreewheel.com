<?php

  class Config {
    // Nothing here should *ever* have a trailing slash
    public $app_uri    = 'http://www.triggerandfreewheel.com';
    public $static_uri = 'http://www.triggerandfreewheel.com/static';

    // Database stuff
    public $database_host = '__FILL ME IN__';
    public $database_user = '__FILL ME IN__';
    public $database_pass = '__FILL ME IN__';
    public $database_name = '__FILL ME IN__';

    // Some strings that appear in a lot of places
    public $site_title       = 'Trigger and Freewheel';
    public $site_subtitle    = "It's a webcomic.";
    public $site_description = 'A webcomic which pokes fun at technology, society, and the absurdities of modern life.';

    // The default URI parts to use when visiting the root directory
    public $default_request = array('comic');

    // List of "static"-ish pages to include in the sitemap
    public $page_list = array('/', '/about', '/archive', '/comic', '/links');

    // List of users who are allowed into the admin panel
    public $user_list = array(
      '__FILL IN USER NAME__' => '__FILL IN MD5 PASSWORD HASH__',
      '__FILL IN USER NAME__' => '__FILL IN MD5 PASSWORD HASH__',
      '__FILL IN USER NAME__' => '__FILL IN MD5 PASSWORD HASH__'
    );

    // Read/write credentials for a Twitter account
    public $consumer_key        = '__FILL ME IN__';
    public $consumer_secret     = '__FILL ME IN__';
    public $access_token        = '__FILL ME IN__';
    public $access_token_secret = '__FILL ME IN__';

    // These get modified later, in constructor
    public $base_dir     = '';
    public $compile_dir  = '/cache';
    public $template_dir = '/templates';
    public $upload_dir   = '/uploads';

    public function __construct($base_dir) {
      // Determine the app's real root during instantiation
      $this->base_dir     = $base_dir;
      $this->compile_dir  = $base_dir . $this->compile_dir;
      $this->template_dir = $base_dir . $this->template_dir;
      $this->upload_dir   = $base_dir . $this->upload_dir;

      date_default_timezone_set('America/New_York');
    }
  }

?>
