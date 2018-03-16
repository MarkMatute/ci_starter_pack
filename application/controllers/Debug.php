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
    $this->authenticator->update_password(6, 'Password');
  }
  
  public function insert_users() {
    $this->load->model('User_m');
    for ($i =0; $i < 15; $i++) {
      $this->User_m->save(array(
        'email' => $i.'@gmail.com',
        'password' => 'Password'
      ));
    }
  }

}