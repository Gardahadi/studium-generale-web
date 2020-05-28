<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi_Pertemuan extends CI_Controller {

	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/dashboard');
		$this->load->view('partials/footer');
	}

	public function presensiPertemuan()
	{
        $id_pertemuan = $this->input->get('id');

        $this->load->model('pertemuan_model');

        $data_detail_pertemuan = $this->pertemuan_model->getById($id_pertemuan);

        $data = array();
        $data['meeting_details'] = array();
    	foreach ($data_detail_pertemuan as $detail_pertemuan) {

    		$pertemuan = array();
    		$pertemuan['id_pertemuan'] = $detail_pertemuan->id_pertemuan;
    		$pertemuan['no_pertemuan'] = $detail_pertemuan->no_pertemuan;
 			$pertemuan['pembicara'] = $detail_pertemuan->pembicara;
 			$pertemuan['tempat'] = $detail_pertemuan->tempat;	
 			$pertemuan['waktu_mulai'] = $detail_pertemuan->waktu_mulai_pertemuan;
            $pertemuan['waktu_selesai'] = $detail_pertemuan->waktu_selesai_pertemuan;
            $pertemuan['id_semester'] = $detail_pertemuan->id_semester;	//belum diubah jadi no_semester
            $pertemuan['topik'] = $detail_pertemuan->topik; 

 			array_push($data['meeting_details'],$pertemuan);	
		}

        $data_list_presensi = $this->pertemuan_model->getPresentByPertemuan($id_pertemuan);

        $data['presensi_lists'] = array();
    	foreach ($data_list_presensi as $list_presensi) {

    		$presensi = array();
    		$presensi['nim'] = $list_presensi->nim;
    		$presensi['nama'] = $list_presensi->nama;
 			$presensi['kelas'] = $list_presensi->kelas;
 			$presensi['status'] = $list_presensi->status;	
            
 			array_push($data['presensi_lists'],$presensi);	
		}

		$this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/pertemuan/presensi', $data);
		$this->load->view('partials/footer');
    }
    
}