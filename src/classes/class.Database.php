<?php

  class Database {
    private $dbh     = NULL;
    private $sth     = NULL;
    private $q_count = 0;
    private $q_timer = 0;

    public function __construct() {
      // Save a reference to the app's configuration
      $config = Application::singleton()->config;

      // Open up the database
      $this->db_connect(
        $config->database_host,
        $config->database_sock,
        $config->database_user,
        $config->database_pass,
        $config->database_name
      );
    }

    public function db_connect($host, $sock, $user, $pass, $db) {
      $this->q_count = 0;
      $this->q_timer = 0;

      if ($sock) {
        // Connecting with a Unix socket
        $this->dbh = new PDO("mysql:unix_socket={$sock};dbname={$db};charset=utf8mb4", $user, $pass);
      } else {
        // Connecting with TCP/IP on the default port
        $this->dbh = new PDO("mysql:host={$host};dbname={$db};charset=utf8mb4", $user, $pass);
      }
    }

    public function db_disconnect() {
      $this->dbh = NULL;
      $this->sth = NULL;
    }

    public function db_exec_single($sql) {
      $start_time = microtime(TRUE);

      $affected_rows = $this->dbh->exec($sql);

      $this->q_timer += (microtime(TRUE) - $start_time);
      $this->q_count++;

      return $affected_rows;
    }

    public function db_query($sql, $params = FALSE) {
      $start_time = microtime(TRUE);

      if ($params === FALSE) {
        $this->sth = $this->dbh->query($sql);

      } else if (is_array($params)) {
        $this->sth = $this->dbh->prepare($sql);
        $this->sth->execute($params);
      }

      $this->sth->setFetchMode(PDO::FETCH_OBJ);

      $this->q_timer += (microtime(TRUE) - $start_time);
      $this->q_count++;

      return $this->sth->rowCount();
    }

    public function db_fetch() {
      return $this->sth->fetch();
    }

    public function db_fetch_all() {
      return $this->sth->fetchAll();
    }

    public function last_insert_id() {
      return $this->dbh->lastInsertId();
    }

    public function get_query_count() {
      return $this->q_count;
    }

    public function get_query_timer() {
      return round($this->q_timer * 1000, 2);  //convert usec to msec
    }
  }

?>
