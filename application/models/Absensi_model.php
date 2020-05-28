<?php

class Absensi_model extends CI_Model {
    
    //asumsi nim sudah dapat dari cookies
    private $_table = "Absensi";
    
    public function __construct() {
        $this->load->database();
    }

    public function insert($data){
        // $this->id_absensi = $data['id_absensi'];
        $this->nim_peserta = $data["nim_peserta"];
        $this->id_pertemuan = $data["id_pertemuan"];
        $this->timestamp_absensi = $data["timestamp_absensi"];
        if($this->db->insert('Absensi',$this))

        {    
 
            return 'Data is inserted successfully';
 
        }
 
          else
 
        {
 
            return "Error has occured";
 
        }
    }
    public function getAll() {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id) {
        $query = $this->db->where('id_pertemuan', $id)->get($this->_table); 
        return $query->result();
    }

    //mendapatkan semua pertemuan dengan kelas terdefinisi  
    public function getAllByKelas($id_kelas) {
        return $this->db->select('*')
        ->from('attendingclass as ac')
        ->where('ac.id_kelas', $id_kelas)
        ->join('pertemuan as p', 'p.id_pertemuan = ac.id_pertemuan', 'LEFT')
        ->get()
        ->result();
    }

    public function getByIdPertemuanAndIdPeserta($id,$nim_peserta) {
        $query = $this->db->where('id_pertemuan', $id)
                        ->where('nim_peserta',$nim_peserta)
                        ->get($this->_table); 
        return $query->result();
    }

    public function getByIdPertemuan($id_pertemuan) {
        $query = $this->db->where('id_pertemuan', $id_pertemuan)
                        ->get($this->_table); 
        return $query->result();
    }

    public function getByNIM($nim) {
        $query = $this->db->where('nim_peserta', $nim)
                        ->get($this->_table); 
        return $query->result();
    }

}

?>