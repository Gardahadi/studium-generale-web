<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','alert', 'akun'));
      }
	public function all() {
      $admin = getAdminLogin();
      if ($admin != null ) {
		$this->load->model('peserta_model');
		//Query
		// $params = array(); 
		$params["search"] = $this->input->get('q', TRUE);
		// $params["semester"] = $this->input->get("semester",TRUE);
		$params["kelas"] = $this->input->get("kelas",TRUE);
		// $params["tahun_ajaran"] = $this->input->get("tahun_ajaran",TRUE);
		$data = array();
		$data['daftar_peserta'] = $this->peserta_model->getByParams($params);
        
        $data['daftar_kelas'] = $this->kelas_model->getBySemesterSekarang();
		
        $data['params'] = array('q' => $params['search'], 'kelas' => $params['kelas']);
        $data['alert'] = getAlertFromCookie();

        $this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/peserta/list', $data);
        $this->load->view('partials/footer');
      } else {
        redirect('admin/login');
      }
    }
    
    public function changestatus() {
      $admin = getAdminLogin();
      if ($admin != null ) {
        $nim = $this->input->post('nim');
        $status = $this->input->post('status');
        $page = $this->input->post('page');
        $data = array('status' => $status);
        $this->peserta_model->update($nim, $data);
        setAlertCookie('success','Status Peserta Berhasil Diganti');

        if ($page == 'peserta') {
            redirect('/admin/peserta/all');
        } else {
            redirect('/admin/kelas/all/'.$page);
        }
      } else {
        redirect('admin/login');
      }
        
    }

}