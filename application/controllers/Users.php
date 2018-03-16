<?php defined('BASEPATH') or exit('No direct scripts allowed.');

/**
 * User Controller
 */
class Users extends MY_Controller {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->for_authenticated();
    $this->load->model('User_m');
  }

  /**
   * Dashboard View
   */
  public function dashboard() {
    $this->load_view('user/dashboard');
  }

  /**
   * Users List
   */
  public function listing($archived = FALSE) {
    $this->data['archived'] = $archived;
    $this->load_view('user/listing');
  }

  /**
   * Edit
   */
  public function edit($id = NULL) {
    $user = $this->User_m->get($id);
    if (!$user) redirect('pages/page_not_found');
    $this->load->model('Role_m');
    $this->data['user'] = $user;
    $this->data['roles'] = $this->Role_m->get_all();
    $this->data['action'] = base_url('users/update/'.$id);
    $this->load_view('user/edit');
  }
   
  /**
    * Create
    */
  public function create() {
    $this->load->model('Role_m');
    $this->data['action'] = base_url('users/save');
    $this->data['roles'] = $this->Role_m->get_all();
    $this->load_view('user/create');
  }

  /**
   * AJAX Api List
   */
  public function ajax_list($archived = FALSE) {
    $this->User_m->datatable_options['archived'] = $archived;
    $list = $this->User_m->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $user->id;
      $row[] = $user->email;
			$data[] = $row;
		}
		$this->response = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->User_m->count_all(),
						"recordsFiltered" => $this->User_m->count_filtered(),
						"data" => $data,
				);
		$this->return_json();
  }

  /**
   * Save
   */
  public function save() {
    if ($this->validateForm() === FALSE) {
      $this->response['status'] = FALSE;
			$this->response['errors'] = $this->form_validation->error_array();
    } else {
      $data = array(
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password'),
      );
      $roles = $this->input->post('role');
      $this->response['status'] = $this->authenticator->sign_up($data, $roles);
    }
    $this->return_json();
  } 

  /**
   * Update
   */
  public function update($id) {
    if (!$id) show_401();
    if ($this->validateForm('update') === FALSE) {
      $this->response['status'] = FALSE;
			$this->response['errors'] = $this->form_validation->error_array();
    } else {
      $data = array(
        'email' => $this->input->post('email'),
      );
      $this->response['status'] = $this->User_m->update($id, $data);
    }
    $this->return_json();
  }

  /**
   * Archive
   */
  public function archive($id) {
    if (!$id) $this->return_404();
    $user = $this->User_m->get($id);
    if (!$user) $this->return_404();
    if ($this->User_m->archive($id)) {
      redirect('users/listing/archived');
    } else {
      $this->return_500();
    }
  }

  /**
   * Restore
   */
  public function restore($id) {
    if (!$id) $this->return_404();
    $user = $this->User_m->get($id);
    if (!$user) $this->return_404();
    if ($this->User_m->restore($id)) {
      redirect('users/listing');
    } else {
      $this->return_500();
    }
  }

  /**
    * Delete
    */
  public function delete($id) {
    if (!$id) $this->return_404();
    $user = $this->User_m->get($id);
    if (!$user) $this->return_404();
    if ($this->User_m->delete($id)) {
      redirect('users/listing/archived');
    } else {
      $this->return_500();
    }
  }

  /**
   * Update Password
   */
  public function updatePassword($id) {
    if (!$id) show_404();
		if($this->validatePasswordForm() === FALSE){
			$this->response['status'] = FALSE;
			$this->response['errors'] = $this->form_validation->error_array();
		} else {
			$password = $this->input->post('newPassword');
			if ($this->authenticator->update_password($id, $password)) {
				$this->response['status'] = TRUE;
			} else {
				$this->response['status'] = FALSE;
				$this->response['errors'] = array('username' => 'Error Occurred. Please Contact Administrator.');
			}
		}
		$this->return_json();
	}

  /**
   * Validate Users
   */
  private function validateForm($action = 'save') {
    $this->load->library('form_validation');
    $this->form_validation->set_rules("email","E-mail", "required|valid_email");
    if ($action === 'save') {
      $this->form_validation->set_rules("password","Password", "required");
      $this->form_validation->set_rules("cpassword","Confirm Password", "required|matches[password]");
    }
    return $this->form_validation->run();
  }

  /**
   * Update Password Validation
   */
  private function validatePasswordForm() {
    $this->load->library('form_validation');
		$this->form_validation->set_rules("newPassword","New Password", "required");
    $this->form_validation->set_rules("cNewPassword","Confirm Password", "required");
    return $this->form_validation->run();
  }

}