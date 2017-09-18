<?php

  class Application {
    public  $config      = NULL;
    public  $self_uri    = '';
    private $module      = NULL;
    private $module_name = '';
    private $module_args = '';
    private static $_me;

    public static function singleton($base = '', $request = '') {
      if (!isset(self::$_me)) self::$_me = new Application($base, $request);
      return self::$_me;
    }

    private function __construct($base_dir, $request_uri) {
      $this->config = new Config($base_dir);

      // Strip the parent directories out of the request URI, if it has them
      $base = parse_url($this->config->app_uri, PHP_URL_PATH);
      $request = parse_url($request_uri, PHP_URL_PATH);
      if (stripos($request, $base) === 0) {
        $request = substr($request, strlen($base));
      }
      $this->self_uri = $this->config->app_uri . $request;

      // Split the request URI into an array
      $request = trim($request, '/');
      $request_parts = explode('/', $request);

      // If the URI is missing the module name portion, use the default
      if (!isset($request_parts[0]) || empty($request_parts[0])) {
        $request_parts = $this->config->default_request;
      }

      // Save the name of the requested module, alond with its
      $this->module_name = array_shift($request_parts);
      $this->module_args = $request_parts;
    }

    public function __clone() {
      trigger_error('Stop doing that.', E_USER_ERROR);
    }

    public function execute() {
      // Converts URIs like '/foo' into 'FooModule'
      $modname = ucfirst(strtolower($this->module_name)) . 'Module';

      if (class_exists($modname)) {
        // We're reasonably sure the specified module can load/run
        $this->module = new $modname($this->module_args);
        $this->module->execute();

      } else {
        // Module is missing; trying to load it will cause a fatal error
        $template = new Template();
        $template->send_404();
      }
    }

    public function module_is($module) {
      return ($this->module_name == $module);
    }
  }

?>
