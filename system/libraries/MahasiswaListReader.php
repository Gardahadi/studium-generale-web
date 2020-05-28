<?php
require('vendor/autoload.php');

class MahasiswaListReader {
  private $list_mahasiswa = array();
  private $CI;

  public function __construct() {
    $this->CI =& get_instance();
    $this->CI->load->database();
  }

  public function read_file($path) {
    if ( $xlsx = SimpleXLSX::parse($path) ) {
		  $excel_content = $xlsx->rows();
      foreach($excel_content as $num_row => $row){
        if($num_row != 0) {
          $mahasiswa['nim'] = $row[0];
          $mahasiswa['nama'] = $row[1];
          array_push($this->list_mahasiswa, $mahasiswa);
        }
      }
		} else {
			echo SimpleXLSX::parseError();
		}
  }  

  public function add_to_database($kelas) {
    foreach($this->list_mahasiswa as $mahasiswa) {
      $peserta = array(
        'nim' => $mahasiswa["nim"],
        'nama' => $mahasiswa["nama"],
        'kelas' => $kelas
      );

      $this->CI->db->insert('peserta', $peserta);
    }
  }
}