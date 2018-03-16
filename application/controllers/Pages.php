<?php defined('BASEPATH') or exit('No direct scripts allowed.');

/**
 * Pages Controller
 */
class Pages extends MY_Controller {
  
  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Page Not Found
   */
  public function page_not_found() {
    echo 'Page Not Found.';
  }

  /**
   * Internal Server Error
   */
  public function server_error() {
    echo 'Server Error.';
  }

}