<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugasakhir extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url','download','cookie','alert','akun'));
    }

    public function index() {
        $tugas_akhir = $this->tugasakhir_model->getBySemesterSekarang()[0];
        //TODO : STILL HARDCODE NIM
        $nim = getPesertaLogin();
        if($nim != null) {
            $submit_tugas_akhir = $this->tugasakhir_model->getByNIM($nim);

            $data = array('tugas_akhir' => $tugas_akhir,
                        'submit_tugas_akhir' => $submit_tugas_akhir,
                        'alert' => getAlertFromCookie(),
                        'nimPeserta' => $nim);

            $this->load->view('partials/header');
            $this->load->view('partials/sidebar');
            $this->load->view('peserta/tugasakhir/index',$data);
            $this->load->view('partials/footer');
        } else {
            $this->load->view('errors/cli/error_not_login');
        }
    }

    public function submit() {
        //TODO : HARDCODE NIM
        $nim = getPesertaLogin();
        $tugas_akhir = $this->tugasakhir_model->getBySemesterSekarang()[0];
        $date_now = date('Y-m-d H:i:s');
        if($date_now < $tugas_akhir->deadline_tugas_akhir) {
        
            $mahasiswaPengumpul = array();
            $jumlahmahasiswa = 0;
            while($this->input->post('mahasiswa' . ($jumlahmahasiswa + 1)) != null) {
                $jumlahmahasiswa = $jumlahmahasiswa + 1;
                array_push($mahasiswaPengumpul,$this->input->post('mahasiswa' . $jumlahmahasiswa));
            }

            $semuaMahasiswaValid = true;
            foreach($mahasiswaPengumpul as $mahasiswa) {
                $mahasiswaResult = $this->peserta_model->getByNIMandPesertaSemesterSekarang($mahasiswa);
                if(sizeof($mahasiswaResult) == 0) {
                    $semuaMahasiswaValid = false;
                }
            }
            
            if($semuaMahasiswaValid) {
                
                foreach($mahasiswaPengumpul as $mahasiswa) {
                    $submit_tugas_akhir = $this->tugasakhir_model->getByNIM($mahasiswa);

                    if(sizeof($submit_tugas_akhir) > 0) {
                        $path = realpath(__DIR__ . '/../../..') . "/upload/tugasakhir/" . $submit_tugas_akhir[0]->nama_file;

                        if (file_exists($path)){
                            unlink($path);
                        }
                    }
                }

                $config['upload_path']          = './upload/tugasakhir';
                $config['allowed_types']        = '*';
                $config['file_name'] = '';

                for($i = 0;$i < sizeof($mahasiswaPengumpul);$i++) {
                    if($i != 0) {
                        $config['file_name'] .= '-';
                    }
                    $config['file_name'] .= $mahasiswaPengumpul[$i];
                }

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('fileSubmit')) {
                    $this->setAlertCookie('fail',$this->upload->display_errors());
                } else {
                    foreach($mahasiswaPengumpul as $mahasiswa) {
                        $submit_tugas_akhir = $this->tugasakhir_model->getByNIM($mahasiswa);
                        if(sizeof($submit_tugas_akhir) > 0) {
                            //HAPUS FILE
                            $file_name = $this->upload->data()['file_name'];
                            $data = array('nim_peserta' => $mahasiswa,
                                        'nama_file' => $file_name,
                                        'timestamp_submit' => $date_now);
                            $this->tugasakhir_model->updateByNIM($mahasiswa,$data);
                        } else {
                            $file_name = $this->upload->data()['file_name'];
                            $data = array('nim_peserta' => $mahasiswa,
                                        'nama_file' => $file_name,
                                        'timestamp_submit' => $date_now);
                            $this->tugasakhir_model->insert($data);
                        }
                    }
                    $this->setAlertCookie('success','Tugas Akhir Berhasil disubmit');
                }
            } else {
                $this->setAlertCookie('fail','Terdapat nim yang tidak valid silakan coba lagi');
            }
        } else {

        }
        redirect('peserta/tugasakhir');
    }

    public function download($nama_file) {
        force_download('upload/tugasakhir/' . $nama_file, NULL);
        redirect('peserta/tugasakhir');
    }

    private function deleteFile($path) {
        if(is_file($path)) {
            unlink($path);
            echo "MASUK SINI";
        }  
    }

    private function setAlertCookie($status,$message) {
        $alert_message_cookie = array('name' => 'alert_message',
                                'value' => $message,
                                'expire' => '20'
                            );

        $alert_status_cookie = array('name' => 'alert_status',
                            'value' => $status,
                            'expire' => '20'
                        );

        $this->input->set_cookie($alert_message_cookie);
        $this->input->set_cookie($alert_status_cookie);
    }

}