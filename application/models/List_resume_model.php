<?php
class List_resume_model extends CI_Model {

  private $id_resume;
  private $id_absensi;
  private $konten;
  private $nilai;
  private $timestamp_submit;
  private $timestamp_nilai;
  private $dinilai_oleh;

  public function __construct() {
    $this->load->database();
  }

  #Get Functions
  public function getByIDResume($id) {
    $query = $this->db->query("SELECT * from Resume where id_resume =".$id );
    return $query->result();
  }

  public function getByIDAbsensi($id) {
    $query = $this->db->query("SELECT * from Resume where id_absensi =".$id );
    return $query->result();
  }

  public function getAll() {
    $query = $this->db->get('Resume');
    return $query->result();
  }

//   public function getByTahunSemester($tahun, $semester){
//     $query = $this->db->query(`SELECT * from Resume where tahun_ajaran = $tahun AND semester=$semester;` );
//     return $query->result();
//   }

//   public function getByNomorTahunSemester($nomor, $tahun, $semester){
//     $query = $this->db->query('SELECT * from Resume where no_pertemuan = ' . $nomor . ' AND tahun_ajaran = "'. $tahun . '" AND semester=' . $semester . ';');
//     return $query->result();
//   }


  #Delete Functions
//   public function delete($id_kelas) {
//     $this->load->model('peserta_model');

//     $daftar_peserta = $this->peserta_model->getByKelas($id_kelas);
//     foreach ($daftar_peserta as $peserta) {
//       $this->peserta_model->delete($peserta->nim);
//     }

//     return $this->db->delete('Kelas', array('id_kelas' => $id_kelas));
//   }

  public function insert($id_resume, $id_absensi, $konten, $nilai, $timestamp_submit, $timestamp_nilai, $dinilai_oleh) {

    $data = array('id_resume' => $id_resume,
                  'id_absensi' => $id_absensi,
                  'konten' => $konten,
                  'nilai' => $nilai,
                  'timestamp_submit' => $timestamp_submit,
                  'timestamp_nilai' => $timestamp_nilai,
                  'dinilai_oleh' => $dinilai_oleh);

    try {
        $this->db->insert('Resume', $data);
        return true;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  } 

//   public function getJumlahMahasiswa($id_kelas) {
//     $this->load->model('peserta_model');

//     $jumlah_mahasiswa = $this->peserta_model->getBanyakMahasiswa($id_kelas);
    
//     return $jumlah_mahasiswa;
//   }
}
