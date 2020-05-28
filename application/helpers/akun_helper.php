<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function getAdminLogin() {
        $CI = get_instance();
        $CI->load->library('session');
        $admin = array( 'id_admin' => $CI->session->userdata('id_admin'),
                        'username' => $CI->session->userdata('username'),
                        'role' => $CI->session->userdata('role'));
        return $admin;
    }

    function getPesertaLogin() {
        $CI = get_instance();
        $CI->load->library('session');
        return $CI->session->userdata('peserta');
    }
?>