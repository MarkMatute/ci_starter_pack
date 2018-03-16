<?php defined('BASEPATH') or exit('No direct scripts allowed.');

/**
 * Role Controller
 */
class Roles extends MY_Controller {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->for_authenticated();
    $this->load->model('Role_m');
  }

  /**
   * Roles List
   */
  public function listing($archived = FALSE) {
    $this->data['archived'] = $archived;
    $this->load_view('role/listing');
  }

  /**
   * Edit
   */
  public function edit($id = NULL) {
    $role = $this->Role_m->get($id);
    if (!$role) redirect('pages/page_not_found');
    $this->data['role'] = $role;
    $this->data['action'] = base_url('roles/update/'.$id);
    $this->load_view('role/edit');
  }
   
  /**
    * Create
    */
  public function create() {
    $this->data['action'] = base_url('roles/save');
    $this->load_view('role/create');
  }

  /**
   * AJAX Api List
   */
  public function ajax_list($archived = FALSE) {
    $this->Role_m->datatable_options['archived'] = $archived;
    $list = $this->Role_m->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $role) {
			$no++;
			$row = array();
			$row[] = $role->id;
      $row[] = $role->name;
			$data[] = $row;
		}
		$this->response = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Role_m->count_all(),
						"recordsFiltered" => $this->Role_m->count_filtered(),
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
        'name' => $this->input->post('name'),
      );
      $this->response['status'] = $this->Role_m->save($data);
    }
    $this->return_json();
  } 

  /**
   * Update
   */
  public function update($id) {
    if (!$id) show_401();
    if ($this->validateForm() === FALSE) {
      $this->response['status'] = FALSE;
			$this->response['errors'] = $this->form_validation->error_array();
    } else {
      $data = array(
        'name' => $this->input->post('name'),
      );
      $this->response['status'] = $this->Role_m->update($id, $data);
    }
    $this->return_json();
  }

  /**
   * Archive
   */
  public function archive($id) {
    if (!$id) $this->return_404();
    $user = $this->Role_m->get($id);
    if (!$user) $this->return_404();
    if ($this->Role_m->archive($id)) {
      redirect('roles/listing/archived');
    } else {
      $this->return_500();
    }
  }

  /**
   * Restore
   */
  public function restore($id) {
    if (!$id) $this->return_404();
    $user = $this->Role_m->get($id);
    if (!$user) $this->return_404();
    if ($this->Role_m->restore($id)) {
      redirect('roles/listing');
    } else {
      $this->return_500();
    }
  }

  /**
    * Delete
    */
  public function delete($id) {
    if (!$id) $this->return_404();
    $user = $this->Role_m->get($id);
    if (!$user) $this->return_404();
    if ($this->Role_m->delete($id)) {
      redirect('roles/listing/archived');
    } else {
      $this->return_500();
    }
  }

  /**
   * Validate Role
   */
  private function validateForm() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules("name","Name", "required");
    return $this->form_validation->run();
  }

}