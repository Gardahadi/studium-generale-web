<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url','download','cookie','alert','akun'));
    }

    public function index() {
        $tugas_akhir = $this->tugasakhir_model->getBySemesterSekarang()[0];
        //TODO : STILL HARDCODE NIM
        $nim = getPesertaLogin();
        $submit_tugas_akhir = $this->tugasakhir_model->getByNIM($nim);

        $data = array('tugas_akhir' => $tugas_akhir,
                    'submit_tugas_akhir' => $submit_tugas_akhir,
                    'alert' => getAlertFromCookie());

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('peserta/tugasakhir/index',$data);
        $this->load->view('partials/footer');
    }

    public function submit() {
        //TODO : HARDCODE NIM
        $nim = '13517120';
        $tugas_akhir = $this->tugasakhir_model->getBySemesterSekarang()[0];
        $date_now = date('Y-m-d H:i:s');
        if($date_now < $tugas_akhir->deadline_tugas_akhir) {
            $config['upload_path']          = './upload/tugasakhir';
            $config['allowed_types']        = '*';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('fileSubmit')) {
                $this->setAlertCookie('fail',$this->upload->display_errors());
            } else {
                $submit_tugas_akhir = $this->tugasakhir_model->getByNIM($nim);
                if(sizeof($submit_tugas_akhir) > 0) {
                    //HAPUS FILE
                    $path = './upload/tugasakhir/'.$submit_tugas_akhir[0]->nama_file;
                    $this->deleteFile($path);
                    $file_name = $this->upload->data()['file_name'];
                    $data = array('nim_peserta' => $nim,
                                'nama_file' => $file_name,
                                'timestamp_submit' => $date_now);
                    $this->tugasakhir_model->updateByNIM($nim,$data);
                } else {
                    $file_name = $this->upload->data()['file_name'];
                    $data = array('nim_peserta' => $nim,
                                'nama_file' => $file_name,
                                'timestamp_submit' => $date_now);
                    $this->tugasakhir_model->insert($data);
                }
                $this->setAlertCookie('success','Tugas Akhir Berhasil disubmit');
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