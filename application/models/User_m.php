<?php defined('BASEPATH') or exit('No direct scripts allowed.');

/**
 * User Model
 */
class User_m extends MY_Model {
  
  protected $column_order = array('id', 'email');
	protected $column_search = array('id', 'email');
	protected $order = array('id' => 'asc');
  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->table = 'Account';
  }

  /**
   * Get Account Roles
   */
  public function getUserRoles($id) {
    
  }

}
