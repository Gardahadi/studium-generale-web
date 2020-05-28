<?php

class Pertemuan extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form', 'url', 'cookie','alert','akun'));
    $this->load->library('form_validation');
  }

  public function all() {
    $nim_peserta = getPesertaLogin();
    if($nim_peserta != null) {
        //TODO : DAPETIN 
        $peserta = $this->peserta_model->getByNIM($nim_peserta)[0];
        $list_pertemuan = $this->pertemuan_model->getAllByKelas($peserta->kelas);
        $is_absensi = array();
        foreach($list_pertemuan as $pertemuan) {
            $is_absensi[$pertemuan->id_pertemuan] = false;
        }
        $list_absensi = $this->absensi_model->getByNIM($nim_peserta);
        foreach($list_absensi as $absensi) {
            $is_absensi[$absensi->id_pertemuan] = true;
        }
        $data = array();
        $data = array('list_pertemuan' => $list_pertemuan,
                      'is_absensi' => $is_absensi);

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('peserta/pertemuan/list',$data);
        $this->load->view('partials/footer');
    } else {
        $this->load->view('errors/cli/error_not_login');
    }
  }

}
?>