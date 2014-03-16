<?php

  class Comics extends Database {
    public  $current  = FALSE;
    public  $previous = FALSE;
    public  $next     = FALSE;
    public  $oldest   = FALSE;
    public  $archives = FALSE;
    private $specific = FALSE;
  
    public function __construct() {
      try {
        // Connect to the DB
        parent::__construct();
        
      } catch (PDOException $e) {
        // If the connection fails, PDO barfs a password out. That ain't good.
        $base = Application::singleton()->config->app_uri;
        header("Location: {$base}/error/database");
        die('Error establishing a database connection.');
      }
    }
    
    public function load_newest() {
      // Find the "newest" published comic
      $this->db_query(
        "SELECT * FROM `posts`
        WHERE `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
        ORDER BY `date` DESC
        LIMIT 1"
      );

      $this->current  = $this->db_fetch();
      $this->specific = FALSE;
    }
    
    public function load_specific($string) {
      if (Comics::looks_like_date($string)) {
        // Find the comic published on the given (past) date
        $this->db_query(
          "SELECT * FROM `posts`
          WHERE
            `date` = :date
            AND `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
          LIMIT 1",
          array('date' => $string)
        );

      } else {
        // Find the published comic with the given name
        $this->db_query(
          "SELECT * FROM `posts`
          WHERE
            `permalink` LIKE :name
            AND `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
          LIMIT 1",
          array('name' => $string)
        );
      }

      $this->current  = $this->db_fetch();
      $this->specific = TRUE;
    }
    
    public function load_untweeted() {
      // Find the oldest comic that hasn't been sent to Twitter
      $this->db_query(
        "SELECT * FROM `posts`
        WHERE `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
        AND `tweeted` = 0
        ORDER BY `date` ASC
        LIMIT 1"
      );

      $this->current  = $this->db_fetch();
      $this->specific = FALSE;
    }

    public function load_archives($order = 'DESC', $limit = FALSE) {
      $lim = $limit ? 'LIMIT ' . intval($limit) : '';
      $this->db_query(
        "SELECT * FROM `posts`
        WHERE `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
        ORDER BY `date` $order $lim"
      );

      $this->archives = $this->db_fetch_all();
    }
    
    public function load_all() {
      $this->db_query("SELECT * FROM `posts` ORDER BY `date` ASC");
      $this->archives = $this->db_fetch_all();
    }
    
    public function load_adjacent() {
      if ($this->has_current()) {
        // Comic found, load the previous and next ones too
        $this->oldest   = $this->get_oldest();
        $this->previous = $this->get_previous();
        $this->next     = $this->is_specific() ? $this->get_next() : FALSE;

      } else {
        // Didn't find the current comic; can't find adjacent ones
        $this->oldest   = FALSE;
        $this->previous = FALSE;
        $this->next     = FALSE;
      }
    }
    
    public function published_count() {
      // How many "viewable" comics are in the DB
      $this->db_query(
        "SELECT COUNT(*) as `count` FROM `posts`
        WHERE `date` <= DATE_FORMAT(NOW(), '%Y%m%d')"
      );
      return $this->db_fetch()->count;
    }
    
    public function row_count() {
      // How many rows -- don't care about state -- are in the DB
      $this->db_query("SELECT COUNT(*) as `count` FROM `posts` WHERE 1");
      return $this->db_fetch()->count;
    }
    
    public function next_date() {
      // Find the date of the "youngest" comic in the DB
      $this->db_query("SELECT `date` FROM `posts`
                      ORDER BY `date` DESC LIMIT 1");
      $highest = $this->db_fetch()->date;

      // Find the next appropriate weekday for the date box
      $jumpmap = array(0, 1, 1, 1, 1, 3, 2, 1); //0=nothing, 1=mon, 7=sun
      $weekday = date('N', strtotime($highest));
      return date('Ymd', strtotime($highest . " +{$jumpmap[$weekday]} day"));
    }
    
    public function random_permalink() {
      if (!isset($_SESSION)) session_start();
      $shuffle_list = isset($_SESSION['shuffle_list']) ?
                      unserialize($_SESSION['shuffle_list']) : array();

      if (count($shuffle_list) < 1) {
        // Shuffle list is empty; create a new one
        $this->db_query(
          "SELECT `permalink` FROM `posts`
          WHERE `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
          ORDER BY RAND()"
        );

        $shuffle_list = array();
        while ($row = $this->db_fetch()) {
          $shuffle_list[] = $row->permalink;
        }
      }
      
      $next = array_shift($shuffle_list);
      $_SESSION['shuffle_list'] = serialize($shuffle_list);

      return $next;
    }
    
    public function format_date($style = 'long', $obj = NULL) {
      if ($obj === NULL) $obj =& $this->current;

      switch ($style) {
        case 'iso8601':
          $date = date('c', strtotime($obj->date));
          break;
          
        case 'rfc2822':
          $date = date('r', strtotime($obj->date));
          break;
          
        case 'monthyear':
          $date = date('F Y', strtotime($obj->date));
          break;
          
        case 'short':
          $date = date('n/j/Y', strtotime($obj->date));
          break;
          
        case 'long':
        default:
          $date = date('F j, Y', strtotime($obj->date));
          break;
      }
      
      return $date;
    }
    
    public function log_hit() {
      if (!$this->has_current()) return FALSE;

      $this->db_query(
        "UPDATE `posts`
        SET
          `viewcount_page`     = `viewcount_page`     + 1,
          `viewcount_premiere` = `viewcount_premiere` + :prem
        WHERE `date` = :date",
        array(
          'date' => $this->current->date,
          'prem' => ($this->is_premiere() ? 1 : 0)
        )
      );
    }
    
    public function mark_tweeted() {
      if (!$this->has_current()) return FALSE;

      $this->db_query(
        "UPDATE `posts`
        SET `tweeted` = 1
        WHERE `date` = :date",
        array('date' => $this->current->date)
      );
    }
    
    public function date_available($date) {
      // Is there any comic preventing us from using the given date?
      $this->db_query(
        "SELECT COUNT(*) as `count` FROM `posts`
        WHERE `date` = :date",
        array('date' => $date)
      );
      return ($this->db_fetch()->count == 0);
    }
    
    public function permalink_available($permalink) {
      // Is there any comic preventing us from using the given permalink?
      $this->db_query(
        "SELECT COUNT(*) as `count` FROM `posts`
        WHERE `permalink` LIKE :permalink",
        array('permalink' => $permalink)
      );
      return ($this->db_fetch()->count == 0);
    }
    
    public function insert_comic($args, $file) {
      // What we should call this image file, given its date and permalink
      $y = date('Y', strtotime($args['post_date']));
      $m = date('m', strtotime($args['post_date']));
      $d = date('d', strtotime($args['post_date']));
      $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $dir_root = Application::singleton()->config->upload_dir;
      $dir_name = "{$y}-{$m}";
      $file_name = "{$d}-{$args['post_permalink']}.{$ext}";
      
      // Move the uploaded file to its final location
      @mkdir("{$dir_root}/{$dir_name}");
      $success = move_uploaded_file($file['tmp_name'],
                 "{$dir_root}/{$dir_name}/{$file_name}");
                
      // If the move failed, don't even try to continue
      if (!$success) return FALSE;

      // Add this comic's row into the DB
      $success = $this->db_query(
        "INSERT INTO `posts` SET
        `date`       = :date,
        `local_img`  = :local_img,
        `post_title` = :post_title,
        `post_body`  = :post_body,
        `permalink`  = :permalink",
        array(
          'date'       => $args['post_date'],
          'local_img'  => "{$dir_name}/{$file_name}",
          'post_title' => $args['post_title'],
          'post_body'  => $args['post_body'],
          'permalink'  => $args['post_permalink']
        )
      );
      
      return ($success > 0);
    }
    
    public function has_current() {
      return ($this->current !== FALSE);
    }

    public function has_previous() {
      return ($this->previous !== FALSE);
    }

    public function has_next() {
      return ($this->next !== FALSE);
    }
    
    public function has_oldest() {
      return ($this->oldest !== FALSE);
    }
    
    public function is_specific() {
      return ($this->specific !== FALSE);
    }
    
    public function is_premiere() {
      return ($this->current->date == date('Ymd'));
    }
    
    public static function looks_like_date($string) {
      // General test for YYYYMMDD form, no real sanity checking
      return (preg_match('/^[0-9]{8}$/', $string) > 0);
    }
    
    public static function is_valid_permalink($string) {
      // Only allow lowercase a-z, 0-9, and hyphens
      return (preg_match('/^[a-z0-9-]+$/', $string) > 0);
    }
    
    private function get_previous() {
      // Find the comic published immediately before $current
      $this->db_query(
        "SELECT * FROM `posts`
        WHERE
          `date` < :date
          AND `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
        ORDER BY `date` DESC
        LIMIT 1",
        array('date' => $this->current->date)
      );
      return $this->db_fetch();
    }

    private function get_next() {
      // Find the comic published immediately after $current
      $this->db_query(
        "SELECT * FROM `posts`
        WHERE
          `date` > :date
          AND `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
        ORDER BY `date` ASC
        LIMIT 1",
        array('date' => $this->current->date)
      );
      return $this->db_fetch();
    }
    
    private function get_oldest() {
      // Find the "oldest" published comic (which never changes ::headdesk::)
      $this->db_query(
        "SELECT * FROM `posts`
        WHERE
          `date` < :date
          AND `date` <= DATE_FORMAT(NOW(), '%Y%m%d')
        ORDER BY `date` ASC
        LIMIT 1",
        array('date' => $this->current->date)
      );
      return $this->db_fetch();
    }
  }

?>