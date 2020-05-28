<?php
class Peserta_model extends CI_Model {

  private $nim;
  private $kelas;
  private $nama;
  private $_table = 'Peserta';
  
  public function __construct() {
    $this->load->database();
  }

  public function getAll() {
    $query = $this->db->get('Peserta');
    return $query->result();
  }
  
  public function get($nim) {
    $this->nim = $nim;

    $query = $this->db->get($this->_table,$this->nim);
    return $query->result();
  }

  public function isNimExist($nim) {
    $query = $this->db->get_where($this->_table, array('nim' => $nim));
    return $query->num_rows();
  }

  public function getByNIM($nim) {
    $query = $this->db->where('nim', $nim)->get($this->_table); 
    return $query->result();
  }
  public function getByParams($params) {

    $search = strtolower($params["search"]);
    $kelas = $params["kelas"];

    $this->db->select("*");
    $this->db->from("Peserta");
    $this->db->join("Kelas","Peserta.kelas = Kelas.id_kelas");
    if($search != null) $this->db->where("LOWER(nama) LIKE '%" . $search . "%' or nim LIKE '%" . $search ."%'");
    // if($semester != null) $this->db->where("semester",$semester);
    if($kelas != null) $this->db->where("Peserta.kelas",$kelas);
    // if($tahun_ajaran != null) $this->db->where("tahun_ajaran",$tahun_ajaran);
    return $this->db->get()->result();
  }

  public function getByKelas($id_kelas) {
    $query = $this->db->query('SELECT * from Peserta where kelas = ' . $id_kelas . ';' );
    return $query->result();
  }

  public function getBanyakMahasiswa($id_kelas) {
    $query = $this->db->query('SELECT * from Peserta where kelas = ' . $id_kelas . ';' );
    return $query->num_rows();
  }  

  public function delete($nim) {
    $this->nim = $nim;

    return $this->db->delete($this->_table, array('nim' => $this->nim));
  }

  public function insert($nim,$kelas,$nama) {
    $this->nim = $nim;
    $this->kelas = $kelas;
    $this->nama = $nama;

    $data = array('nim' => $this->nim,
                  'kelas' => $this->kelas,
                  'nama' => $this->nama);

    try {
        $this->db->insert('Peserta', $data);
        return true;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  }  

  public function update($nim, $data) {
    $this->db->where('nim',$nim)
             ->update($this->_table,$data);
  }

  public function getByNIMandPesertaSemesterSekarang($nim) {
    $date_now = date('Y-m-d H:i:s');
    return $this->db->select('*')
        ->from('Kelas as k')
        ->join('Semester as s', 's.id_semester = k.id_semester')
        ->join('Peserta as p', 'k.id_kelas = p.kelas')
        ->where('(s.start_date <= now())')
        ->where('(s.end_date >= now())')
        ->where('(p.nim = '. $nim . ')')
        ->get()
        ->result();
  }
        
  public function updateNilaiAkhir($nim) {
    $nilai_akhir = $this->countNilaiAkhir($nim)[0]->nilai_akhir;
    return $this->update($nim, array('nilai_akhir' => $nilai_akhir));
  }
  
  public function countNilaiAkhir($nim) {
    $sql = "SELECT (r.avg_resume*0.8 + ta.nilai*0.2) as nilai_akhir 
            FROM (
            SELECT p.nim as nim, COALESCE(nilai,0) as nilai 
            FROM Peserta as p LEFT JOIN TugasAkhir ON p.nim = TugasAkhir.nim_peserta 
            WHERE nim = ". $nim . " ) as ta JOIN (
            SELECT tr.p as nim, COALESCE(tr.total_resume / jp.total_pertemuan,0) as avg_resume 
            FROM (SELECT COUNT(*) as total_pertemuan, id_kelas 
            FROM AttendingClass WHERE id_kelas = 1) as jp 
            JOIN (SELECT p.nim as p, p.kelas as kelas, COALESCE(SUM(r.nilai)) as total_resume 
            FROM Peserta as p LEFT JOIN Absensi as a ON p.nim = a.nim_peserta LEFT JOIN Resume as r 
            ON r.id_absensi = a.id_absensi WHERE nim = ". $nim 
            . " GROUP BY p.nim) as tr ON jp.id_kelas = tr.kelas) 
            as r ON r.nim = ta.nim;";
    echo $sql;
    $query = $this->db->query($sql);
    return $query->result();
  }
}