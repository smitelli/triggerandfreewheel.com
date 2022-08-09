<?php

  class Template extends Smarty {
    private $bb_search = array(
      '/\[b\](.*?)\[\/b\]/is',                 //bold tag
      '/\[i\](.*?)\[\/i\]/is',                 //italic tag
      '/\[u\](.*?)\[\/u\]/is',                 //underline tag
      '/\[s\](.*?)\[\/s\]/is',                 //strikethrough tag
      '/\[code\](.*?)\[\/code\]/is',           //code tag
      '/\[quote\](.*?)\[\/quote\]/is',         //quote tag
      '/\[quote\=(.*?)\](.*?)\[\/quote\]/is',  //quote tag with name
      '/\[img\](.*?)\[\/img\]/is',             //image tag
      '/\[url\](.*?)\[\/url\]/is',             //hyperlink tag
      '/\[url\=(.*?)\](.*?)\[\/url\]/is',      //hyperlink tag with text
      '/\[email\](.*?)\[\/email\]/is',         //email tag
      '/\[email\=(.*?)\](.*?)\[\/email\]/is',  //email tag with text
      '/\[color\=(.*?)\](.*?)\[\/color\]/is',  //font color tag
      '/\[size\=(.*?)\](.*?)\[\/size\]/is'     //font size tag
    );
    private $bb_replace = array(               //see descriptions above
      '<strong>$1</strong>',
      '<em>$1</em>',
      '<span style="text-decoration: underline;">$1</span>',
      '<span style="text-decoration: line-through;">$1</span>',
      '<code>$1</code>',
      '<blockquote><div><b>Quote:</b><br>$1</div></blockquote>',
      '<blockquote><div><b>$1 said:</b><br>$2</div></blockquote>',
      '<img src="$1" alt="$1">',
      '<a href="$1" rel="external">$1</a>',
      '<a href="$1" rel="external">$2</a>',
      '<a href="mailto:$1">$1</a>',
      '<a href="mailto:$1">$2</a>',
      '<span style="color: $1;">$2</span>',
      '<span style="font-size: $1px;">$2</span>'
    );
    private $bb_stripped = array(              //don't even ask...
      '$1', '$1', '$1', '$1', ' $1 ', ' $1 ', ' $2 ', '', '$1', '$2',
      '$1', '$2', '$2', '$2'
    );

    public function __construct() {
      parent::__construct();

      $app = Application::singleton();
      $this->template_dir = $app->config->template_dir;
      $this->compile_dir  = $app->config->compile_dir;
      $this->assign('app', $app);
      $this->assign('tpl', $this);
    }

    public function display($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL) {
      header('X-Mitch-Hedberg: My fake plants died because I did not pretend ' .
             'to water them.');
      parent::display($template, $cache_id, $compile_id, $parent);
    }

    public function send_404() {
      header('HTTP/1.1 404 Not Found');
      header('Status: 404 Not Found');
      $this->assign('code', 404);
      $this->display('error.tpl');
    }

    public function send_redirect($url) {
      header("Location: $url");
      die();
    }

    public function bb_render($string, $strip = FALSE) {
      $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
      $string = str_replace("\r\n", "\n", $string);
      $string = str_replace("\n\r", "\n", $string);
      $string = str_replace("\r",   "\n", $string);
      $string = nl2br($string);
      $string = str_replace("\n",   '',   $string);

      if ($strip) {
        $string = preg_replace($this->bb_search, $this->bb_stripped, $string);
      } else {
        $string = preg_replace($this->bb_search, $this->bb_replace, $string);
      }

      return $string;
    }

    public function excerpt_render($string, $length) {
      $string = $this->bb_render($string, TRUE);
      if (strlen($string) <= $length) return $string;

      $string = substr($string, 0, $length);
      $string = substr($string, 0, strrpos($string, ' '));

      return $string . '...';
    }
  }

?>
