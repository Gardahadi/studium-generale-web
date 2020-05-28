<?php

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'akun', 'alert'));
        $this->load->library(array('session'));
    }

    public function index() {
        $data = array();
        $data['alert'] = getAlertFromCookie();
        $this->load->view('admins/login', $data);
    }

	public function login()
	{
        $username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username
        );

        $cek = $this->admin_model->checkLogin($where);
        if (count($cek) == 1) {
            if ($cek[0]->admin_role == 'Superadmin' && password_verify($password, $cek[0]->pass)) {
                $data_session = array(
                    'id_admin' => $cek[0]->id_admin,
                    'username' => $username,
                    'role' => $cek[0]->admin_role
                );   
                $this->session->set_userdata($data_session);
                redirect('admin/kelas');
            } else if ($cek[0]->admin_role == 'Admin Penilai') {
                $data_session = array(
                    'id_admin' => $cek[0]->id_admin,
                    'username' => $username,
                    'role' => $cek[0]->admin_role
                );
                $this->session->set_userdata($data_session);
                redirect('admin/peserta/all');
            } else {
                setAlertCookie('fail', 'Username or pass wrong');
                redirect('admin/login');
            }
        } else {
            setAlertCookie('fail', 'Username or pass wrong');
            redirect('admin/login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
    }

}

?>