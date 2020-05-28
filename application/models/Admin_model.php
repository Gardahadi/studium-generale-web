<?php
class Admin_model extends CI_Model {

  private $id_admin;
  private $username;
  private $pass;
  private $admin_role;

  public function __construct() {
    $this->load->database();
  }

  #Get Functions
  public function getByID($id) {
    $query = $this->db->get_where('Admin', array('id_admin' => $id));
    return $query->row();
  }

  public function getAdminUsername($id){
    $query = $this->db->query(`SELECT username FROM Admin where id_admin = $id`);
    return $query->result();
  }

  public function checkUsernameExist($username) {
    $query = $this->db->get_where('Admin', array('username' => $username));
    return $query->num_rows();
  }

  public function getAll() {
    $query = $this->db->get('Admin');
    return $query->result();
  }

  public function checkLogin($data) {
    $this->db->where($data);
    $query = $this->db->get('Admin');
    return $query->result();
  }


  #Delete Functions
  public function delete($id_kelas) {
    $this->load->model('admin_model');

    return $this->db->delete('Admin', array('id_admin' => $id_kelas));
  }

  public function insert($username, $pass, $adminRole, $startDate, $endDate) {

    $data = array('username' => $username,
                  'pass' => password_hash($pass, PASSWORD_DEFAULT),
                  'admin_role' => $adminRole,
                  'start_date' => $startDate,
                  'end_date' => $endDate);

    try {
        $this->db->insert('Admin', $data);
        return true;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  } 

  public function update($id, $username, $pass, $adminRole, $startDate, $endDate) {
    $this->db->where('id_admin', $id);

    $data = array('username' => $username,
                  'pass' => password_hash($pass, PASSWORD_DEFAULT),
                  'admin_role' => $adminRole,
                  'start_date' => $startDate,
                  'end_date' => $endDate);

    $this->db->update('Admin', $data);
  }
}
