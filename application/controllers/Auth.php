<?php defined('BASEPATH') or exit('No direct scripts allowed.');

/**
 * Authentication Controller
 */
class Auth extends MY_Controller {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Login View
   */
  public function login() {
    $this->data['has_side_nav'] = FALSE;
    $this->load_view('auth/login');
  }

  /**
   * Login API
   */
  public function api_login() {
    if($this->validateLogin() === FALSE){
			$this->response['status'] = FALSE;
			$this->response['errors'] = $this->form_validation->error_array();
		} else {
      $this->response['status'] = $this->authenticator->sign_in(
        $this->input->post('email'),
        $this->input->post('password')
      );
      if (!$this->response['status']) {
        $this->response['errors'] = array('email' => 'Login Failed.');
      }
    }
    $this->return_json();
  }

  /**
   * Logout
   */
  public function logout() {
    $this->authenticator->sign_out();
    redirect('auth/login');
  }

  /**
   * Login Validation
   */
  private function validateLogin() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules("email","E-mail", "required");
    $this->form_validation->set_rules("password","Password", "required");
    return $this->form_validation->run();
  }

}