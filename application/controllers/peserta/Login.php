<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'akun'));
        $this->load->library(array('session'));
    }

    public function index() {
        $data = array();
        $data['alert'] = getAlertFromCookie();
        $this->load->view('peserta/login', $data);
    }

    public function login()
	{
        $nim = $this->input->post('username');
        $peserta = $this->peserta_model->getByNIM($nim);
        if(sizeof($peserta) > 0) {
            $this->session->set_userdata('peserta', $nim);
            redirect('peserta/pertemuan/all');
        } else {
            setAlertCookie('fail', 'Username wrong');
            redirect('peserta/login');
        }
    }
}