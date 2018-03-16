<?php defined('BASEPATH') or exit('No direct scripts allowed.');

class Pages extends MY_Controller {
  
  public function __construct() {
    parent::__construct();
  }

  public function page_not_found() {
    echo 'Page Not Found.';
  }

  public function server_error() {
    echo 'Server Error.';
  }

}