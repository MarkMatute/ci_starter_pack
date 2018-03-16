<?php defined('BASEPATH') or exit('No direct scripts allowed.');

/**
 * Base Model
 */
class MY_Model extends CI_Model {

  /**
   * Database Table
   */
  protected $table = '';
  public $datatable_options = array();
  /**
   * Constructor
   */
	public function __construct() {
		parent::__construct();
	}

  /**
   * Get All Records
   */
	public function get_all(){
		$this->db->where('isActive', TRUE);
    return $this->db->get($this->table)->result();
	}

  /**
   * Get Record By ID
   */
	public function get($id){
		$id = $this->security->xss_clean($id);
		$this->db->where('id',$id);
		return $this->db->get($this->table)->row();
	}

  /**
   * Get Or Die By ID
   */
	public function getOrDie($id){
		$result = $this->get($id);
		if(count($result) <= 0){
			die('Record does not exists');
		}
		return $result;
	}

  /**
   * Persist/Save Data
   */
	public function save($data){
		$data = $this->insert_defaults($data, FALSE);
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

  /**
   * Update/Save Data By ID
   */
	public function update($id, $data){
		$id = $this->security->xss_clean($id);
		$data = $this->insert_defaults($data, TRUE);
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

  /**
   * Permanently Delete Data
   */
	public function delete($id){
		$id = $this->security->xss_clean($id);
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

  /**
   * Archive Data
   */
	public function archive($id) {
		$id = $this->security->xss_clean($id);
		$data = array("isActive" => FALSE);
		$data = $this->insert_defaults($data, TRUE);
		return $this->update($id, $data);
	}

  /**
   * Restore Archived Data
   */
	public function restore($id) {
		$id = $this->security->xss_clean($id);
		$data = array("isActive" => TRUE);
		$data = $this->insert_defaults($data, TRUE);
		return $this->update($id, $data);
	} 
	
	/**
	 * Inserts Default Data
	 * isActive = 1
	 * created = now
	 * updated = now
	 */
	public function insert_defaults($data, $for_update = FALSE) {
		$data['updated'] = date("Y-m-d H:i:s a");
		if ($for_update === FALSE) {
			$data['created'] = date("Y-m-d H:i:s a");
			$data['isActive'] = TRUE;
		}
		return $data;
	}

	/**
	 * Get All Count
	 */
	public function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	/**
	 * Generate Datatables Query
	 */
  public function _get_datatables_query() {
		// Check for Options for query
		if (count($this->datatable_options) > 0) {
			// Get Only Archived
			if (isset($this->datatable_options['archived']) && $this->datatable_options['archived'] === 'archived') {
				$this->db->where('isActive', FALSE);
			} else {
				$this->db->where('isActive', TRUE);
			}
		}
		$this->db->from($this->table);

		$i = 0;
		
		foreach ($this->column_search as $item) {
			if($_POST['search']['value']) {
				if($i === 0) {
          $this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) {
					$this->db->group_end();
        }
			}
			$i++;
		}
		
		if(isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	/**
	 * Execute Datatables Query
	 */
	public function get_datatables() {
		$this->_get_datatables_query();
		if($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Count Filtered Results
	 */
	public function count_filtered() {
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	
}
