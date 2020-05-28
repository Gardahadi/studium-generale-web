<?php

class Tugasakhir_model extends CI_Model {
    
    //asumsi nim sudah dapat dari cookies
    private $_table = 'TugasAkhir';
    
    public function __construct() {
        $this->load->database();
    }

    public function getAll() {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id) {
        $query = $this->db->where('id_pertemuan', $id)->get($this->_table); 
        return $query->result();
    }

    //TODO : GET BY SEMESTER NOW
    public function getBySemesterSekarang() {
        $date_now = date('Y-m-d H:i:s');
        return $this->db->select('topik_tugas_akhir,deadline_tugas_akhir')
            ->from('Semester as s')
            ->where('(s.start_date <= now())')
            ->where('(s.end_date >= now())')
            ->get()
            ->result();
    }
    
    public function getByNIM($nim) {
        return $this->db->select('*')
            ->from($this->_table)
            ->where('nim_peserta',$nim)
            ->get()
            ->result();
    }

    public function insert($data) {
        return $this->db->insert($this->_table,$data);
    }

    public function updateByNIM($nim,$data) {
        return $this->db->where('nim_peserta',$nim)
                        ->update($this->_table, $data);

    } 

    public function getByKelas($id_kelas) {
        return $this->db->select('*')
            ->from('Peserta as p')
            ->where('p.kelas', $id_kelas)
            ->join('TugasAkhir as ta', 'p.nim = ta.nim_peserta', 'LEFT')
            ->get()
            ->result();
    }
}

?>