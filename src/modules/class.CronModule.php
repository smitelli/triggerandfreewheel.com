<?php

  class CronModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      // Don't let this module run unless the app was started via cron.php
      if (!defined('DOING_CRON')) {
        $template = new Template();
        $template->send_404();
        die();
      }

      $config = Application::singleton()->config;
      $comics = new Comics();

      // See if any comic needs to be tweeted
      if ($config->enable_twitter) {
        $comics->load_untweeted();
        if ($comics->has_current()) {
          // There is a comic that should be sent to Twitter
          $base    = $config->app_uri . '/comic';
          $message = "[comic] {$base}/{$comics->current->permalink} - " .
                     $comics->current->post_title;
          $twitter = new TwitterWrapper();
          $result = $twitter->reliable_tweet($message);
          if ($result !== FALSE) $comics->mark_tweeted();
        }
      }

      // See if we need to update the daily summary table
      $comics->db_query(
        "SELECT COUNT(*) as `count` FROM `viewcount_trending`
        WHERE `date` = DATE_FORMAT(NOW(), '%Y%m%d')"
      );

      if ($comics->db_fetch()->count == 0) {
        // Yes, today is a day we haven't seen before
        $comics->db_query(
          "INSERT INTO `viewcount_trending` SET
          `date`           = DATE_FORMAT(NOW(), '%Y%m%d'),
          `img_total`      = (SELECT SUM(`viewcount_img`)      FROM `posts`),
          `page_total`     = (SELECT SUM(`viewcount_page`)     FROM `posts`),
          `premiere_total` = (SELECT SUM(`viewcount_premiere`) FROM `posts`),
          `bytes_total`    = (SELECT SUM(`byte_count`)         FROM `posts`)"
        );
      }
    }
  }

?>
