<?php

  class ComicImages extends Comics {
    public function __construct() {
      parent::__construct();
    }

    public function send_current() {
      $file = $this->get_current_filename();
      $name = preg_replace('/^[0-9]{2}-/', '', basename($file));
      header('Expires: Tue, 01 Apr 2008 04:00:00 GMT');
      header('Cache-Control: no-cache, must-revalidate');
      header('Pragma: no-cache');
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s T'));
      header('Content-Disposition: inline; filename="' . $name . '"');
      header('Content-Type: ' . ComicImages::get_mime_type($file));
      header('Content-Length: '. filesize($file));
      header('X-Henny-Youngman: My best friend ran away with my wife, '.
             'and let me tell you, I miss him.');
      readfile($file);
    }

    public function log_hit() {
      if (!$this->has_current()) return FALSE;

      $this->db_query(
        "UPDATE `posts`
        SET
          `viewcount_img` = `viewcount_img` + 1,
          `byte_count`    = `byte_count`    + :bytes
        WHERE `date` = :date",
        array(
          'date'  => $this->current->date,
          'bytes' => filesize($this->get_current_filename())
        )
      );
    }

    public function get_current_filename() {
      if (!$this->has_current()) return FALSE;

      return Application::singleton()->config->upload_dir . '/' .
             $this->current->local_img;
    }

    public static function get_mime_type($file) {
      switch (strtolower(pathinfo($file, PATHINFO_EXTENSION))) {
        case 'jpg':
        case 'jpeg':
          $mime = 'image/jpeg';
          break;

        case 'png':
          $mime = 'image/png';
          break;

        case 'gif':
          $mime = 'image/gif';
          break;

        default:
          $mime = 'image/unknown';
          break;
      }

      return $mime;
    }
  }

?>
