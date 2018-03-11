<?php

  class TwitterWrapper extends TwitterOAuth {
    public $tries = 0;

    public function __construct() {
      $config = Application::singleton()->config;
      parent::__construct($config->consumer_key, $config->consumer_secret,
                          $config->access_token, $config->access_token_secret);
    }

    public function tweet($message) {
      // Try to send this tweet
      $response = $this->post(
        'https://api.twitter.com/1.1/statuses/update.json',
        array('status' => $message)
      );

      // If it worked, send the 'created_at' date as a confirmation
      return (isset($response->created_at) ? $response->created_at : FALSE);
    }

    public function reliable_tweet($message) {
      $this->tries = 0;

      while ($this->tries < 20) {
        $this->tries++;
        $success = $this->tweet($message);
        if ($success !== FALSE) return $success;
        sleep(2);
      }

      return FALSE;
    }
  }

?>
