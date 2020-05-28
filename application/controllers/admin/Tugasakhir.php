<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugasakhir extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url','download','cookie','alert','akun'));
    }

    public function index() {
        // TODO : MENDAPATKAN SISWA DI KELAS BERSANGKUTAN
        $id_admin = getAdminLogin();
        if($id_admin != null) {
            $kelas = $this->input->get('kelas');
            $daftar_tugas_akhir = $this->tugasakhir_model->getByKelas($kelas);
            $daftar_kelas = $this->kelas_model->getBySemesterSekarang();
            $data = array('daftar_tugas_akhir' => $daftar_tugas_akhir,
                        'alert' => getAlertFromCookie(),
                        'daftar_kelas' => $daftar_kelas,
                        'kelas_now' => $kelas);
            $this->load->view('partials/header');
            $this->load->view('partials/sidebaradmin');
            $this->load->view('admins/tugasakhir/list',$data);
            $this->load->view('partials/footer');
        } else {
            $this->load->view('errors/cli/error_not_login');
        }
    }

    public function submitnilai() {
        $admin = getAdminLogin();
        if($admin != null) {
            $nim = $this->input->post('nim');
            $nilai = $this->input->post('tugasakhir-' . $nim);
            $kelas = $this->input->post('kelas');
            $nilai_tugas_akhir = array('nilai' => $nilai,
                                    'timestamp_nilai' => date('Y-m-d h:i:s'),
                                    'dinilai_oleh' => $admin->id_admin);
            $this->tugasakhir_model->updateByNIM($nim,$nilai_tugas_akhir);
            $this->peserta_model->updateNilaiAkhir($nim);
            setAlertCookie('success','Perubahan Nilai untuk NIM ' . $nim . ' berhasil disimpan');
            redirect('admin/tugasakhir?kelas='.$kelas);
        } else {
            $this->load->view('errors/cli/error_not_login');
        }
    }
}