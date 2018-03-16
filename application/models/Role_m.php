<?php defined('BASEPATH') or exit('No direct scripts allowed.');

/**
 * Role Model
 */
class Role_m extends MY_Model {
  
  protected $column_order = array('id', 'name');
	protected $column_search = array('id', 'name');
	protected $order = array('id' => 'asc');
  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->table = 'Role';
  }
  
}
