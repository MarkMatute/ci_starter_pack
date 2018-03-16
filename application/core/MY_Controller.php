<?php defined('BASEPATH') or exit('No direct scripts allowed');

/**
 * BASE Controller
 */
class MY_Controller extends CI_Controller {

  /**
   * Variablesq
   */
  public $response = array();
  public $data = array(
    'has_side_nav' => TRUE
  );

  /**
   * Constructor
   */
  public function __constuct() {
    parent::__constuct();
   
  }

  /**
   * View Loader
   */
  public function load_view($subview) {
    $master_template = 'templates/master';
    $this->data['subview'] = $subview;
    $this->data['sidebar_class'] = $this->data['has_side_nav'] == TRUE? '': 'wrapper-no-sidebar';
    $this->data['auth_user'] = $this->authenticator->auth_user();
    $this->load->view($master_template, $this->data);
  }

  /**
   * Return JSON
   */
  public function return_json($status_header = 200) {
    $this->output
        ->set_content_type('application/json')
        ->set_status_header($status_header)
        ->set_output(json_encode($this->response));
  }

  /**
   * Check if access is authenticated
   */
  public function for_authenticated($acl = array()) {
    if (count($acl) > 0) {
      // TODO
    } else {
      if(!$this->authenticator->auth_user()) {
        show_401();
      }
    }
  }

  /**
   * Redirect to 401 Page
   */
  public function show_401() {
    $this->response = array(
      'message' => 'Unathorized Access'
    );
    $this->return_json(401);
    die();
  }

  /**
   * Redirect To Custom 404 Page
   */
  public function return_404() {
    redirect('pages/page_not_found');
  }

  /**
   * Redirect To Custom 500 Page
   */
  public function return_500() {
    redirect('pages/server_error');
  }

}