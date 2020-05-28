<?php

class Semester_model extends CI_Model {
    
    //asumsi nim sudah dapat dari cookies
    private $_table = "Semester";
    
    public function __construct() {
        $this->load->database();
    }

    public function getAll() {
        $this->db->order_by("id_semester", "desc");
        return $this->db->get($this->_table)->result();
    }

    public function getById($id) {
        $query = $this->db->get_where($this->_table, array('id_semester' => $id));
        return $query->row();
    }

    // params $params is dictionary conatins all keys in semestesr table
    public function insert($tahunAjaran, $semester, $start_date, $end_date, $topik_tugas_akhir, $deadline_tugas_akhir) {
        $data = array('tahun_ajaran' => $tahunAjaran,
                    'no_semester' => $semester,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'topik_tugas_akhir' => $topik_tugas_akhir,
                    'deadline_tugas_akhir' => $deadline_tugas_akhir);

        try {
            $this->db->insert('Semester', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }  

    public function update($id_semester, $start_date, $end_date, $topik_tugas_akhir, $deadline_tugas_akhir) {
        $this->db->where('id_semester', $id_semester);

        $data = array('start_date' => $start_date,
                    'end_date' => $end_date,
                    'topik_tugas_akhir' => $topik_tugas_akhir,
                    'deadline_tugas_akhir' => $deadline_tugas_akhir);

        $this->db->update($this->_table, $data);
    }

    public function delete($id_semester) {
        $this->load->model('kelas_model');
    
        $daftar_kelas = $this->kelas_model->getByIdSemester($id_semester);
        foreach ($daftar_kelas as $kelas) {
            $this->kelas_model->delete($kelas->id_kelas);
        }
    
        return $this->db->delete($this->_table, array('id_semester' => $id_semester));
    }
}

?>