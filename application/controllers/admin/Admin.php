<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'cookie','alert', 'akun'));
    }

    public function index() {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $this->load->model('admin_model');
    	$data_admin = $this->admin_model->getAll();

        $data = array();
        $data['admins'] = array();
        $data['alert'] = getAlertFromCookie();

        foreach ($data_admin as $admin_item) {
            $admin = array();
            $admin['id_admin'] = $admin_item->id_admin;
            $admin['username'] = $admin_item->username;
            $admin['admin_role'] = $admin_item->admin_role;
            $admin['start_date'] = ($admin_item->start_date);
            $admin['end_date'] = ($admin_item->end_date);

            array_push($data['admins'],$admin);	
    	}
        $this->load->view('partials/header');
        $this->load->view('partials/sidebaradmin');
        $this->load->view('admins/admin/admin_list', $data);
        $this->load->view('partials/footer');
      } else {
        redirect('admin/login');
      }
    }

    public function add() {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $admin_role = $this->input->post('adminRole');
        $username = NULL;
        $password = NULL;
        $startDate = NULL;
        $endDate = NULL;

        if ($admin_role == "Superadmin") {
            $username = $this->input->post('usernameAdmin');
            $password = password_hash($this->input->post('password'));
        } else if ($admin_role == "Admin Penilai") {
            $username = $this->input->post('usernamePenilai');
            $startDate = $this->processDate($this->input->post('startDate'));
            $endDate = $this->processDate($this->input->post('endDate'));
        }
        
        if ($this->validateUsername($username)) {
          $this->load->model("admin_model");
          $this->admin_model->insert($username, $password, $admin_role, $startDate, $endDate);
          setAlertCookie('success', 'Admin berhasil dibuat');
        } else {
          setAlertCookie('fail', 'Username sudah ada sebelumnya');
        }

        redirect('/admin/admin');
      } else {
        redirect('admin/login');
      }
    }

    public function delete() {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $id_admin = $this->input->post('id_admin');

        $this->load->model('admin_model');
        $this->admin_model->delete((int) $id_admin);

        redirect('/admin/admin');
      } else {
        redirect('admin/login');
      }
    }

    public function edit() {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $idAdmin = (int) $this->input->post('id');
        $admin_role = $this->input->post('adminRole');
        $username = NULL;
        $password = NULL;
        $startDate = NULL;
        $endDate = NULL;

        if ($admin_role == "Superadmin") {
            $username = $this->input->post('usernameAdmin');
            $password = $this->input->post('password');
        } else if ($admin_role == "Admin Penilai") {
            $username = $this->input->post('usernamePenilai');
            $startDate = $this->processDate($this->input->post('startDate'));
            $endDate = $this->processDate($this->input->post('endDate'));
        }

        if ($this->validateUsername($username)) {
          $this->load->model("admin_model");
          $this->admin_model->insert($username, $password, $admin_role, $startDate, $endDate);
          setAlertCookie('success', 'Data admin berhasil diperbarui');
        } else {
          setAlertCookie('fail', 'Username sudah ada sebelumnya');
        }

        redirect('/admin/admin');
      } else {
        redirect('admin/login');
      }
    }
	
    public function form($id = 0) {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $data['method'] = 'create';
        if ((int) $id > 0){
            $this->load->model('admin_model');
            $data['admin'] = $this->admin_model->getById((int) $id);
            if ($data['admin']->admin_role == "Admin Penilai") {
                $data['admin']->start_date = $this->processDateDb($data['admin']->start_date);
                $data['admin']->end_date = $this->processDateDb($data['admin']->end_date);
            }
            $data['method'] = 'edit';
        }
        
		$this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/admin/admin_form', $data);
        $this->load->view('partials/footer');
      } else {
        redirect('admin/login');
      }
    }

    private function validateUsername($username) {
      $this->load->model('admin_model');
      if ($this->admin_model->checkUsernameExist($username)==1) {
        return false;
      } else {
        return true;
      }
    }

    private function processDate($date) {
        $arr = explode("/", $date);
        $date = $arr[2].'-'.$arr[0].'-'.$arr[1];
        return $date;
    }

    private function processDateDb($date) {
        $date = explode(" ", $date);
        $arr = explode("-", $date[0]);
        $date = $arr[1].'/'.$arr[2].'/'.$arr[0];
        return $date;
    }
}