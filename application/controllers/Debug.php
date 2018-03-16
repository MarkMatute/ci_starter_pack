<?php defined('BASEPATH') or exit('No Direct Scripts Allowed'); 

class Debug extends MY_Controller {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->load->model('User_m');
  }

  public function index() {
    $this->authenticator->sign_up(array(
      'email' => 'mark@mark.com',
      'password' => 'password'
    ),array(
      '1'
    ));
    echo 'User Created';
  }

}