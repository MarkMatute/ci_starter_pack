<?php

/**
 * Authentication Class
 */
class Authenticator {
  
  protected $CI;
  protected $table = 'Account';
  protected $roleMappingTable = 'RoleMapping';
  protected $session_name = 'auth_user';

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
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * Check ACL
   * TODO
   */
  public function check_role($allowed_roles) {
    
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
   * Sign Up
   */
  public function sign_up($data, $roles) {
    $data['password'] = $this->encrypt_password($data['password']);
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
