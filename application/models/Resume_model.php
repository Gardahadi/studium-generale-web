<?php

class Resume_model extends CI_Model {
    
    //asumsi nim sudah dapat dari cookies
    private $_table = "Resume";
    
    public function __construct() {
        $this->load->database();
    }


    public function getAll() {
        return $this->db->get($this->_table)->result();
    }

    public function getAllWithIdAbsensi() {
        return $this->db->select('*')
                        ->from($this->_table . ' as r')
                        ->join('Absensi as a', 'r.id_absensi = a.id_absensi')
                        ->get()
                        ->result();
    }

    public function getById($id) {
        $query = $this->db->where('id_resume', $id)->get($this->_table); 
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

    public function getByIdAbsensi($id_absensi) {
        $query = $this->db->where('id_absensi', $id_absensi)
                        ->get($this->_table); 
        return $query->result();
    }

    public function addOrEditResume($resume,$id_absensi,$date) {
        $this->db->where('id_absensi',$id_absensi);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0){
            # EDIT
            $this->db->where('id_absensi', $id_absensi);
            $this->db->update($this->_table, array('konten' => $resume,'timestamp_submit' => $date));
        }
        else{
            # ADD
            $data = array('id_absensi' => $id_absensi,
                  'konten' => $resume,
                  'timestamp_submit' => $date);
            $this->db->insert($this->_table, $data);
        }
    }

    public function getByIdPertemuanAndNIM($id_pertemuan,$nim) {
        return $this->db->select('*')
            ->from('Absensi as ab')
            ->where('ab.id_pertemuan', $id_pertemuan)
            ->where('ab.nim_peserta',$nim)
            ->join('Resume as r', 'ab.id_absensi = r.id_absensi')
            ->get()
            ->result();
    }

    public function editNilai($id_resume,$nilai) {
        $data = [
            'nilai' => $nilai,
            'timestamp_nilai' => date("Y-m-d H:i:s")
        ];
        $this->db->where('id_resume', $id_resume)->update($this->_table, $data);
    }

    public function updateByIDResume($id_resume,$data) {
        return $this->db->where('id_resume',$id_resume)
                        ->update($this->_table, $data);

    } 
}

?>