<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resume extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie','alert','akun'));
    }
	public function edit($id)
	{
        # TODO : HARDCODE ID PESERTA
        $nim_peserta = getPesertaLogin();
        if($nim_peserta != null) {
            $absensi_result = $this->absensi_model->getByIdPertemuanAndIdPeserta($id,$nim_peserta);

            $data = array();
            $pertemuan_result = $this->pertemuan_model->getById($id);
            if(sizeof($absensi_result) > 0 && sizeof($pertemuan_result) > 0) {
                $data['pertemuan'] = $pertemuan_result[0];
                $data['absensi'] = $absensi_result[0];
                $resume_result = $this->resume_model->getByIdAbsensi($data['absensi']->id_absensi);
                if(sizeof($resume_result) > 0) {
                    $data['resume'] = $resume_result[0];
                } else {
                    $data['resume'] = null;
                }
                $date_now = date('Y-m-d H:i:s');
                if($date_now >= $data['pertemuan']->waktu_mulai_resume && $date_now <= $data['pertemuan']->waktu_selesai_resume) {
                    $data['can_submit'] = true;
                } else {
                    $data['can_submit'] = false;
                }
                $peserta = $this->peserta_model->getByNIM($nim_peserta)[0];
                $data['no_pertemuan'] = $this->pertemuan_model->getNoPertemuan($data["pertemuan"]->id_pertemuan,$peserta->kelas)[0]->no_pertemuan;
                $data['valid'] = true;
            } else {
                $data['valid'] = false;
            } 

            $data['alert'] = getAlertFromCookie();
            $this->load->view('partials/header');
            $this->load->view('partials/sidebar');
            $this->load->view('peserta/resume/form',$data);
            $this->load->view('partials/footer');
        } else {
            $this->load->view('errors/cli/error_not_login.php');
        }
    }
    
    public function submit() {
        $this->load->model('pertemuan_model');
        $this->load->model('resume_model');

        $id_pertemuan = $this->input->post('idPertemuan');
        $resume_konten = $this->input->post('resume');
        // Check this day is valid
        # TODO : HARDCODE ID PESERTA
        $nim_peserta = getPesertaLogin();
        $absensi_result = $this->absensi_model->getByIdPertemuanAndIdPeserta($id_pertemuan,$nim_peserta);

        if(sizeof($absensi_result) > 0) {
            echo 'sss';
            $absensi = $absensi_result[0];
            $pertemuan = $this->pertemuan_model->getById($id_pertemuan)[0];
            $date_now = date('Y-m-d H:i:s');
            if($date_now >= $pertemuan->waktu_mulai_resume && $date_now <= $pertemuan->waktu_selesai_resume) {
                $this->resume_model->addOrEditResume($resume_konten,$absensi->id_absensi,$date_now);
            } else {
                setAlertCookie('fail','Pengumpulan resume dilakukan di luar jadwal');
            }
            setAlertCookie('success','Resume Berhasil Disimpan');
        } else {
            setAlertCookie('fail','Anda belum melakukan absensi pada pertemuan ini');
        }
        redirect('/peserta/resume/edit/'.$id_pertemuan);
    }
}
