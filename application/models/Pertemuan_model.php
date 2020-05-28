<?php

class Pertemuan_model extends CI_Model {
    
    //asumsi nim sudah dapat dari cookies
    private $_table = "Pertemuan";
    
    public function __construct() {
        $this->load->database();
    }

    public function getAll() {
        return $this->db->order_by('waktu_mulai_pertemuan', 'ASC')->get($this->_table)->result();
    }

    public function getById($id) {
        $query = $this->db->where('id_pertemuan', $id)->get($this->_table); 
        return $query->result();
    }

    //mendapatkan semua pertemuan dengan kelas terdefinisi  
    public function getAllByKelas($id_kelas) {
        return $this->db->select('*')
        ->from('AttendingClass as ac')
        ->where('ac.id_kelas', $id_kelas)
        ->join('Pertemuan as p', 'p.id_pertemuan = ac.id_pertemuan', 'LEFT')
        ->order_by('p.waktu_mulai_pertemuan', 'ASC')
        ->get()
        ->result();
    }

    //mendapatkan semua peserta yang hadir di kelas tersebut
    public function getPresentByPertemuan($id_pertemuan){
        $query = $this->db->query("SELECT * FROM Absensi INNER JOIN Peserta ON Absensi.nim_peserta=Peserta.nim WHERE id_pertemuan=$id_pertemuan");
        return $query->result();
    }

    // params $params is dictionary conatins all keys in pertemuan table
    public function insert($params) {
        if (!array_diff(['pembicara','tempat',
                        'waktu_mulai_pertemuan','waktu_selesai_pertemuan',
                        'waktu_mulai_absen','waktu_selesai_absen',
                        'waktu_mulai_resume','waktu_selesai_resume',
                        'topik','tautan','daftar_kelas'], array_keys($params))) {
            // OK: all the keys are in $array

            $semester = $this->db->select('*')
                ->from('Semester as s')
                ->where('(s.start_date <= now())')
                ->where('(s.end_date >= now())')
                ->get()
                ->result();
            
            $data = array('pembicara' => $params['pembicara'],
                        'tempat' => $params['tempat'],
                        'waktu_mulai_pertemuan'=> $params['waktu_mulai_pertemuan'],
                        'waktu_selesai_pertemuan' => $params['waktu_selesai_pertemuan'],
                        'id_semester' => $semester[0]->id_semester,
                        'waktu_mulai_absen' => $params['waktu_mulai_absen'],
                        'waktu_selesai_absen' => $params['waktu_selesai_absen'],
                        'waktu_mulai_resume' => $params['waktu_mulai_resume'],
                        'waktu_selesai_resume' => $params['waktu_selesai_resume'],
                        'topik' => $params['topik'],
                        'tautan' => $params['tautan']);
            
            try {
                $this->db->insert('Pertemuan', $data);
                $id_pertemuan = $this->db->insert_id();
                $daftar_kelas = $params['daftar_kelas'];
                $this->insertAttendanceKelas($id_pertemuan,$daftar_kelas);
                return true;
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        } else {
           // FAIL: some keys are not
        }
        
      }  

      public function update($id_pertemuan,$params) {
        if (!array_diff(['pembicara','tempat',
                        'waktu_mulai_pertemuan','waktu_selesai_pertemuan',
                        'waktu_mulai_absen','waktu_selesai_absen',
                        'waktu_mulai_resume','waktu_selesai_resume',
                        'topik','tautan','daftar_kelas'], array_keys($params))) {
            // OK: all the keys are in $array

            $semester = $this->db->select('*')
                ->from('Semester as s')
                ->where('(s.start_date <= now())')
                ->where('(s.end_date >= now())')
                ->get()
                ->result();
            
            $data = array('pembicara' => $params['pembicara'],
                        'tempat' => $params['tempat'],
                        'waktu_mulai_pertemuan'=> $params['waktu_mulai_pertemuan'],
                        'waktu_selesai_pertemuan' => $params['waktu_selesai_pertemuan'],
                        'id_semester' => $semester[0]->id_semester,
                        'waktu_mulai_absen' => $params['waktu_mulai_absen'],
                        'waktu_selesai_absen' => $params['waktu_selesai_absen'],
                        'waktu_mulai_resume' => $params['waktu_mulai_resume'],
                        'waktu_selesai_resume' => $params['waktu_selesai_resume'],
                        'topik' => $params['topik'],
                        'tautan' => $params['tautan']);
            
            try {
                $this->db->where('id_pertemuan', $id_pertemuan);
                echo $id_pertemuan;
                $this->db->update('Pertemuan', $data); 
                $daftar_kelas = $params['daftar_kelas'];
                $this->deleteAttendanceKelas($id_pertemuan);
                $this->insertAttendanceKelas($id_pertemuan,$daftar_kelas);
                return true;
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        } else {
           // FAIL: some keys are not
        }
        
      }  

      public function delete($id_pertemuan) {
        $this->db->where('id_pertemuan',$id_pertemuan);
        $this->db->delete($this->_table);
      }

      public function insertAttendanceKelas($id_pertemuan,$daftar_kelas) {
        foreach ($daftar_kelas as $kelas) {
            echo $kelas;
            $data = array('id_pertemuan' => $id_pertemuan,
                          'id_kelas' => $kelas);
            $this->db->insert('AttendingClass', $data);
        }
      }

      public function deleteAttendanceKelas($id_pertemuan) {
        return $this->db->delete('AttendingClass', array('id_pertemuan' => $id_pertemuan));
      }

      public function getNoPertemuan($id_pertemuan,$id_kelas) {
        $query = $this->db->query(" SELECT COUNT(*) AS no_pertemuan 
                                    FROM AttendingClass AS ac INNER JOIN Pertemuan AS p 
                                    ON ac.id_pertemuan = p.id_pertemuan 
                                    WHERE ac.id_kelas = " . $id_kelas . 
                                    " AND 
                                    DATE(p.waktu_selesai_pertemuan) <= 
                                        (SELECT p.waktu_mulai_pertemuan AS waktu_mulai_pertemuan 
                                        FROM Pertemuan AS p WHERE id_pertemuan = ". $id_pertemuan ." ) 
                                    ORDER BY p.id_pertemuan;");
        return $query->result();
      }
}

?>