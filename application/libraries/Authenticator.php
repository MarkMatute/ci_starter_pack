<?php

/**
 * Authentication Class
 */
class Authenticator {
  
  protected $CI;
  protected $table = 'Account';
  protected $roleMappingTable = 'RoleMapping';
  protected $roleTable = 'Role';
  protected $session_name = 'auth_user';
  protected $session_roles = 'auth_roles';
  /**
   * Constructor
   */
  public function __construct() {
      $this->CI = & get_instance();
  }

  /**
   * Login
   */
  public function sign_in($email, $password) {
    $params = array($email);
    $sql  = 'SELECT * FROM '.$this->table.' WHERE email = ? AND isActive = 1';
    $user = $this->CI->db->query($sql, $params)->row();
    if (!$user) return FALSE;
    if ($this->check_password($user->password, $password)) {
      $this->CI->session->set_userdata($this->session_name, $user);
      $roles = $this->getRolesForUser($user->id, 'role_name');
      $this->CI->session->set_userdata($this->session_roles, $roles);
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * Check ACL
   * TODO
   */
  public function check_acl($allowed_roles) {
    $auth_roles = $this->auth_roles();
    $is_allowed = TRUE;
    foreach($auth_roles as $auth_role) {
      if(!in_array($auth_role, $allowed_roles)){
        $is_allowed = FALSE;
        break;
      }
    }
    return $is_allowed;
  }

  /**
   * Logout
   */
  public function sign_out() {
    return $this->CI->session->sess_destroy();
  }

  /**
   * Get Authenticated User
   */
  public function auth_user() {
    return $this->CI->session->userdata($this->session_name);
  }

  /**
   * Authenticated Roles
   */
  public function auth_roles() {
    return $this->CI->session->userdata($this->session_roles);
  }

  /**
   * Get Roles for User
   */
  public function getRolesForUser($id = NULL, $roleName = FALSE) {
    $roles = array();
    if (!$roleName) {
      $this->CI->db->select('role_id');
      $this->CI->db->where('account_id', $id);
      foreach($this->CI->db->get('RoleMapping')->result() as $role) {
        $roles[] = $role->role_id;
      }
    } else {
      $query = "SELECT r.name FROM ".$this->roleTable.' as r ';
      $query .= "INNER JOIN ".$this->roleMappingTable.' as rm ON rm.role_id = r.id ';
      $query .= "WHERE rm.account_id = ?";
      $params = array($id);
      $roleNames = $this->CI->db->query($query, $params)->result();
      foreach($roleNames as $role) {
        $roles[] = $role->name;
      }
    }
    return $roles;
  }
  /**
   * Sign Up
   */
  public function sign_up($data, $roles) {
    $data['password'] = $this->encrypt_password($data['password']);
    $data['isActive'] = 1;
    $this->CI->db->insert($this->table, $data);
    $user_id = $this->CI->db->insert_id();
    return $this->saveRoleMapping($user_id, $roles);
  }
  
  /**
   * Save Role Mapping
   */
  public function saveRoleMapping($user_id, $roles) {
    $roleMappingData = array();
    foreach($roles as $role_id) {
      $roleMappingData[] = array(
        'account_id' => $user_id,
        'role_id' => $role_id
      );
    }
    return $this->CI->db->insert_batch($this->roleMappingTable, $roleMappingData);
  }

  /**
   * Update Password
   */
  public function update_password($id, $rawPassword) {
    $encryptedPassword = $this->encrypt_password($rawPassword);
    $this->CI->db->where('id', $id);
    return $this->CI->db->update($this->table, array(
      'password' => $encryptedPassword
    ));
  }

  /**
   * Update Account
   */
  public function update($id, $data, $roles) {
    // Update Account Data
    $this->CI->db->where('id', $id);
    $this->CI->db->update($this->table, $data);

    // Reset User Roles
    $this->CI->db->where('account_id', $id);
    $this->CI->db->delete($this->roleMappingTable);

    // Save Roles
    return $this->saveRoleMapping($id, $roles);
  }

  /**
   * Encrypt Password
   */
  public function encrypt_password($password) {
    $this->CI->load->library('encrypt');
    return $this->CI->encrypt->encode($password);
  }

  /**
   * Check Password
   */
  public function check_password($encryptedPassword, $rawPassword) {
    $this->CI->load->library('encrypt');
    return $this->CI->encrypt->decode($encryptedPassword) == $rawPassword;
  }

}
