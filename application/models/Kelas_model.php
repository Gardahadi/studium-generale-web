<?php
class Kelas_model extends CI_Model {

  private $_table = "Kelas";

  public function __construct() {
    $this->load->database();
  }

  #Get Functions
  public function getById($id) {
    $query = $this->db->get_where($this->_table, array('id_kelas' => $id));
    return $query->row();
  }

  public function getAll() {
    $query = $this->db->get($_table);
    return $query->result();
  }

  public function getByIdSemester($id_semester){
    $query = $this->db->get_where($this->_table, array('id_semester' => $id_semester));
    return $query->result();
  }

  public function getByIdSemesterAndTipe($id_semester, $tipe) {
    $condition = ['id_semester' => $id_semester, 'tipe_kelas' => $tipe];
    $this->db->where($condition);
    $this->db->order_by("no_kelas", "asc");
    $query = $this->db->get($this->_table); 
    return $query->result();
  }

  public function getJumlahByIdSemesterAndTipe($id_semester, $tipe) {
    $condition = ['id_semester' => $id_semester, 'tipe_kelas' => $tipe];
    $this->db->where($condition);
    $this->db->order_by("no_kelas", "asc");
    $query = $this->db->get($this->_table); 
    return $query->num_rows();
  }

  #Delete Functions
  public function delete($id_kelas) {
    $this->load->model('peserta_model');

    $daftar_peserta = $this->peserta_model->getByKelas($id_kelas);
    if (count($daftar_peserta) > 0){
      return 'Tidak dapat menghapus kelas yang masih memiliki peserta terdaftar';
    }

    $this->load->model('pertemuan_model');

    $list_pertemuan = $this->pertemuan_model->getAllByKelas($id_kelas);
    if (count($list_pertemuan)>0) {
      return 'Tidak dapat menghapus kelas yang sudah memiliki pertemuan';
    }

    if ($this->db->delete('Kelas', array('id_kelas' => $id_kelas))){;
      return 'success';
    }
  }

  public function insert($nomor, $nama_dosen, $id_semester, $tipe_kelas) {

    $data = array('no_kelas' => $nomor,
                  'nama_dosen' => $nama_dosen,
                  'id_semester' => $id_semester,
                  'tipe_kelas' => $tipe_kelas);

    try {
        $this->db->insert('Kelas', $data);
        return true;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  } 

  public function update($id, $nomor, $nama_dosen, $id_semester, $tipe_kelas) {
    $this->db->where('id_kelas', $id);

    $data = array('no_kelas' => $nomor,
                  'nama_dosen' => $nama_dosen,
                  'id_semester' => $id_semester,
                  'tipe_kelas' => $tipe_kelas);

    $this->db->update($this->_table, $data);
  }

  public function getJumlahMahasiswa($id_kelas) {
    $this->load->model('peserta_model');

    $jumlah_mahasiswa = $this->peserta_model->getBanyakMahasiswa($id_kelas);
    
    return $jumlah_mahasiswa;
  }

  public function getBySemesterSekarang() {
    $date_now = date('Y-m-d H:i:s');
    return $this->db->select('*')
        ->from('Kelas as k')
        ->join('Semester as s', 's.id_semester = k.id_semester')
        ->where('(s.start_date <= now())')
        ->where('(s.end_date >= now())')
        ->get()
        ->result();
  }

  public function getByPertemuanId($id_pertemuan) {
    return $this->db->select('*')
        ->from('Kelas as k')
        ->join('AttendingClass as ac', 'k.id_kelas = ac.id_kelas')
        ->where('ac.id_pertemuan',$id_pertemuan)
        ->get()
        ->result();
  }
}
