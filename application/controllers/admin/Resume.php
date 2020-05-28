<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resume extends CI_Controller {

	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/dashboard');
		$this->load->view('partials/footer');
	}

	public function download(){
		$id_resume = $this->input->get('id');
		$nim = $this->input->get('nim');
		$this->load->model('detail_pertemuan_model');
		$data = array ('resume' => $this->resume_model->getById($id_resume),
					   'nim' => $nim);
		if(sizeof($data['resume']) > 0) {
			$this->load->view('admins/resume/download',$data);
		}
		//redirect('admin/Resume/detailPertemuan');
	}

	public function delete(){
		$id_resume = $this->input->get('id');
		$this->load->model('detail_pertemuan_model');
		$this->detail_pertemuan_model->delete_data($id_resume);
		redirect('admin/Resume/detailPertemuan');
	}

	public function edit(){
		$id_resume = $this->input->get('id');
		$this->load->model('detail_pertemuan_model');
		$data_detail_resume = $this->detail_pertemuan_model->edit_data($id_resume);

        $data = array();
        $data['resume_details'] = array();
    	foreach ($data_detail_resume as $detail_resume) {

    		$dr = array();
    		$dr['id_resume'] = $detail_resume->id_resume;
    		$dr['id_absensi'] = $detail_resume->id_absensi;
 			$dr['konten'] = $detail_resume->konten;
 			$dr['nilai'] = $detail_resume->nilai;	
 			$dr['timestamp_submit'] = $detail_resume->timestamp_submit;
            $dr['timestamp_nilai'] = $detail_resume->timestamp_nilai;
            $dr['dinilai_oleh'] = $detail_resume->dinilai_oleh;

 			array_push($data['resume_details'],$dr);	
		}

		$this->load->view('partials/header');
		$this->load->view('partials/sidebar');
		$this->load->view('admins/v_edit',$data);
		$this->load->view('partials/footer');
		
	}

	public function update(){
		$postData = $this->input->post();

		$id_resume = $postData['idResume'];
		$new_nilai = $postData['nilai'];

		$this->load->model('detail_pertemuan_model');
		$this->detail_pertemuan_model->update_data($id_resume, $new_nilai);
		redirect('admin/Resume/detailPertemuan');
	}

	public function detailPertemuan()
	{
		//Get Database untuk Detail Pertemuan
        $this->load->model('detail_pertemuan_model');

        //HARDCODE ID
        $x = 1;
        $data_detail_pertemuan = $this->detail_pertemuan_model->getByID($x);

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
            //$pertemuan['tahun_ajaran'] = $detail_pertemuan->tahun_ajaran; 

 			array_push($data['meeting_details'],$pertemuan);	
		}

		//Get Database untuk List Resume Peserta
		$this->load->model('list_resume_model');

		$data_list_resume = $this->resume_model->getAllWithIdAbsensi();

		// $data2 = array();
        $data['resume_lists'] = array();
    	foreach ($data_list_resume as $list_resume) {

    		$resume = array();
    		$resume['id_resume'] = $list_resume->id_resume;
			$resume['id_absensi'] = $list_resume->id_absensi;
			$resume['nim_peserta'] = $list_resume->nim_peserta;
 			$resume['konten'] = $list_resume->konten;
 			$resume['nilai'] = $list_resume->nilai;	
 			$resume['timestamp_submit'] = $list_resume->timestamp_submit;
            $resume['timestamp_nilai'] = $list_resume->timestamp_nilai;
            $resume['dinilai_oleh'] = $list_resume->dinilai_oleh;
            
 			array_push($data['resume_lists'],$resume);	
		}

		$this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/detail_pertemuan', $data);
		$this->load->view('partials/footer');
    }
	
	public function downloads() {
		$this->load->view('admins/resume/download');
	}
}