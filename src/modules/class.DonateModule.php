<?php

  class DonateModule {
    public function __construct($args) {
      // Nothin'.
    }

    public function execute() {
      $template = new Template();

      // This probably shouldn't be here.
      $template->send_redirect(
        "https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=" .
        "AJB58YEF24BKQ&lc=US&item_name=Trigger%20and%20Freewheel&currency_" .
        "code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted");
    }
  }

?>
