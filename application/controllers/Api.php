<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/Format.php');
require(APPPATH.'libraries/REST_Controller.php');
class Api extends REST_Controller
{

    public function __construct() {
            parent::__construct();
            $this->load->model('Absensi_model');
            $this->load->model('Pertemuan_model');
            $this->load->model('Admin_model');

    }    

    // Get Pertemuan
    public function pertemuan_get(){
        $id = $this->get('id');

        if ($id == NULL){
            $r = $this->Pertemuan_model->getAll();
            $this->response($r); 
        }
        else{
            $r = $this->Pertemuan_model->getById($id);
            $this->response($r); 
        }
    }

    // Validasi Super Admin
    public function login_post()
	{
        $username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username
        );

        $cek = $this->admin_model->checkLogin($where);
        if (count($cek) == 1) {
            if ($cek[0]->admin_role == 'Superadmin' && password_verify($password, $cek[0]->pass)) {
                 // Set the response and exit
                 $this->response( [
                    'status' => true,
                    'message' => 'Users'
                ], 200 );
            } 
            else {
                 // Set the response and exit
                 $this->response( [
                    'status' => false,
                    'message' => 'No User was found'
                ], 404 );
            }
        } 
        else {
             // Set the response and exit
             $this->response( [
                'status' => false,
                'username' => $username,
                'password' => $password,
                'message' => 'No User was found'
            ], 404 );
        }
    }

    public function absen_get(){
        $r = $this->Pertemuan_model->getAll();
        //    $r = $this->Absensi_model->read();
        $this->response($r); 
    }

    //    public function user_put(){
    //        $id = $this->uri->segment(3);

    //        $data = array('name' => $this->input->get('name'),
    //        'pass' => $this->input->get('pass'),
    //        'type' => $this->input->get('type')
    //        );

    //         $r = $this->user_model->update($id,$data);
    //            $this->response($r); 
    //    }

    
    public function absen_post(){
          
        $data = array(
            'nim_peserta' => $this->input->post('nim_peserta'),
            'id_pertemuan' => $this->input->post('id_pertemuan'),
            'timestamp_absensi' => date('Y-m-d H:i:s')
        );            
        
        // Check apakah NIM yang sama telah absen
        $absensi = $this->Absensi_model->getByIdPertemuanAndIdPeserta(
            $data["id_pertemuan"], $data["nim_peserta"]);
        
        // TO-DO validasi Waktu absen

        if ($absensi == NULL) {
            # code...
            $r = $this->Absensi_model->insert($data);
            $this->response($r); 
        }
        else {
            $this->response("Absen Sudah Ada");
        }
       
    }

    public function validasi_timestamp($date){
        return True;
    }
   
}