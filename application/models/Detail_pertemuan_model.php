<?php
// //copyleaks dependencies 
// include_once( __DIR__.'/vendor/copyleaks/php-plagiarism-checker/autoload.php');
// use Copyleaks\CopyleaksCloud;
// use Copyleaks\CopyleaksProcess;
// use Copyleaks\Products;

// /* CREATE CONFIG INSTANCE */
// $config = new \ReflectionClass('Copyleaks\Config');
// $clConst = $config->getConstants();

// $email = 'kintansekaradinda@gmail.com';
// $apiKey = '4D2890F9-58A9-47A6-AF30-F14C7D17D98F';

// // Login to Copyleaks Cloud
// try{
// 	$clCloud = new CopyleaksCloud($email, $apiKey, Products::Education);
// }catch(Exception $e){
// 	echo "<Br/>Failed to connect to Copyleaks Cloud with exception: ". $e->getMessage();
// 	die();
// }

//validate login token
// if(!isset($clCloud->loginToken) || !$clCloud->loginToken->validate()){
// 	echo "<Br/><strong>Bad login credentials</strong>";
// 	die();
// }

// echo "<Br/><strong>Logged in successfully</strong><Br/>";

// try{
// 	$additionalHeaders = array($clConst['COMPARE_ONLY']);


// 	// Create process using one of the following option.
// 	$process  = $clCloud->createByFiles("https://www.copyleaks.com", $additionalHeaders);
	
// 	echo "<BR/><strong>Process created!</strong> (PID = '" . $process->processId . "') - You will get notified with a callback soon";

// }catch(Exception $e){

// 	echo "<br/>Failed with exception: ". $e->getMessage();
// }

class Detail_pertemuan_model extends CI_Model {

  private $id_pertemuan;
  private $no_pertemuan;
  private $pembicara;
  private $tempat;
  private $waktu_mulai;
  private $waktu_selesai;
  private $semester;
  private $tahun_ajaran;

  public function __construct() {
    $this->load->database();
  }

  #Get Functions
  public function getByID($id) {
    $query = $this->db->query("SELECT * from Pertemuan where id_pertemuan =".$id );
    return $query->result();
  }

  public function getByNomor($nomor) {
    $query = $this->db->query(`SELECT * from Pertemuan where no_pertemuan = $nomor` );
    return $query->result();
  }

  public function getAll() {
    $query = $this->db->get('Pertemuan');
    return $query->result();
  }

  public function getByTahunSemester($tahun, $semester){
    $query = $this->db->query(`SELECT * from Pertemuan where tahun_ajaran = $tahun AND semester=$semester;` );
    return $query->result();
  }

  public function getByNomorTahunSemester($nomor, $tahun, $semester){
    $query = $this->db->query('SELECT * from Pertemuan where no_pertemuan = ' . $nomor . ' AND tahun_ajaran = "'. $tahun . '" AND semester=' . $semester . ';');
    return $query->result();
  }

  public function edit_data($id_resume){		
    $query = $this->db->query("SELECT * FROM Resume WHERE id_resume=".$id_resume);
    return $query->result();
  }

  public function delete_data($id_resume){
    $query = $this->db->query("DELETE FROM Resume WHERE id_resume=".$id_resume);
  }

  public function update_data($id_resume, $new_nilai){ //masih hardcode updatenya
    $query = $this->db->query("UPDATE Resume SET nilai=".$new_nilai." WHERE id_resume=".$id_resume);
		// $this->db->where($where);
		// $this->db->update($table,$data);
  }	
  
  public function download_resume($id_resume){
    $nim = $this->db->query("SELECT id_absensi FROM Resume WHERE id_resume=".$id_resume);
    $nimresult = $nim->result();
    $nimtitle = $nimresult[0]->id_absensi;
    $filename = "resume_" . (string)$id_resume ."_" . (string)$nimtitle . ".txt";
    $query = $this->db->query("SELECT konten INTO OUTFILE '/Users/Kintan/Downloads/".$filename."' FROM resume WHERE id_resume=".$id_resume);
  }

  #Delete Functions
//   public function delete($id_kelas) {
//     $this->load->model('peserta_model');

//     $daftar_peserta = $this->peserta_model->getByKelas($id_kelas);
//     foreach ($daftar_peserta as $peserta) {
//       $this->peserta_model->delete($peserta->nim);
//     }

//     return $this->db->delete('Kelas', array('id_kelas' => $id_kelas));
//   }

  public function insert($nomor, $pembicara, $tempat, $waktu_mulai, $waktu_selesai, $semester, $tahun_ajaran) {

    $data = array('no_pertemuan' => $nomor,
                  'pembicara' => $pembicara,
                  'tempat' => $tempat,
                  'waktu_mulai' => $waktu_mulai,
                  'waktu_selesai' => $waktu_mulai,
                  'semester' => $semester,
                  'tahun_ajaran' => $tahun_ajaran);

    try {
        $this->db->insert('Pertemuan', $data);
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
