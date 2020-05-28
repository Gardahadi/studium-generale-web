<?php

class Nilai extends CI_Controller {
    public function __construct() {
        parent::__construct();
         $this->load->helper(array('cookie','alert','akun'));
    }

  public function index()
	{
        $id_admin = getAdminLogin();
        if($id_admin != null) {
            $kelas = $this->input->get('kelas');
            
            $data = ($kelas != null) ? $this->getRekapNilaiPerKelas($kelas) 
                                    : array('kelas' => null);
    

            $data['alert'] = getAlertFromCookie();
    
            $data['daftar_kelas'] = $this->kelas_model->getBySemesterSekarang();
            $this->load->view('partials/header');
            $this->load->view('partials/sidebaradmin');
            $this->load->view('admins/nilai/rekap',$data);
            $this->load->view('partials/footer');
        } else {
            $this->load->view('errors/cli/error_not_login');
        }
    } 
    public function kelasEdit() {
        $kelas = $this->input->get('kelas');
        // TODO : GET SEMUA PESERTA DARI KELAS TERSEBUT
        $admin = getAdminLogin();
        if($admin != null) {
            $data = array();
            $data['kelas'] = $kelas;
            if($kelas != null) {
                $list_peserta = $this->peserta_model->getByKelas($kelas);
                $list_pertemuan = $this->pertemuan_model->getAllByKelas($kelas);
                // GET NILAI DARI SETIAP PESERTA PADA PERTEMUAN TERSEBUT
                $list_resume = array();
                $absensi = array();
                foreach ($list_peserta as $peserta) {
                    $list_resume[$peserta->nim] = array();
                    $absensi[$peserta->nim] = array();
                    foreach ($list_pertemuan as $pertemuan) {
                        $resume = $this->resume_model->getByIdPertemuanAndNIM(
                                            $pertemuan->id_pertemuan,$peserta->nim);
                        if(sizeof($resume) > 0) {
                            $new_nilai = $this->input->post($resume[0]->id_resume . 'new');
                            $old_nilai = $this->input->post($resume[0]->id_resume . 'old');
                            if($new_nilai != $old_nilai) {
                                $nilai_resume = array('nilai' => $new_nilai,
                                                'timestamp_nilai' => date('Y-m-d h:i:s'),
                                                'dinilai_oleh' => $admin->id_admin);
                                $this->resume_model->updateByIDResume($resume[0]->id_resume,$nilai_resume);
                            }
                        } else {

                        }
                    }
                    $tugas_akhir = $this->tugasakhir_model->getByNIM($peserta->nim);
                    if(sizeof($tugas_akhir) > 0) {
                        $nilai_tugasakhir = array('nilai' => $this->input->post('tugasakhir-'.$peserta->nim),
                                                'timestamp_nilai' => date('Y-m-d h:i:s'),
                                                'dinilai_oleh' => $admin['id_admin']
                                                );
                        $this->tugasakhir_model->updateByNIM($peserta->nim,$nilai_tugasakhir);

                    } else {

                    }
                    $this->peserta_model->updateNilaiAkhir($peserta->nim);
                }
            }

            setAlertCookie('success','Perubahan berhasil disimpan');
            redirect('/admin/nilai?kelas=' . $kelas);
        } else {
            $this->load->view('errors/cli/error_not_login');
        }
    }

    public function excelphp7() {
        $kelas = $this->input->get('kelas');
        // TODO : GET SEMUA PESERTA DARI KELAS TERSEBUT
        $data = $this->getRekapNilaiPerKelas($kelas);

        $this->load->view('admins/nilai/rekap_excel',$data);
    }

    public function excel() {
        include APPPATH.'libraries/PHPExcel/PHPExcel.php';

        $idKelas = $this->input->get('kelas');
        $data = $this->getRekapNilaiPerKelas($idKelas);
        
        $excel = new PHPExcel();

        $excel->getProperties()->setCreator('My Notes Code')
                    ->setLastModifiedBy('My Notes Code')
                    ->setTitle("Data Siswa")
                    ->setSubject("Siswa")
                    ->setDescription("Laporan Semua Data Siswa")
                    ->setKeywords("Data Siswa");
          $num_pertemuan = sizeof($data['list_pertemuan']);
        

          $excel->setActiveSheetIndex(0)->setCellValue('A1', "No"); 
          $excel->getActiveSheet()->mergeCells('A1:A2');
          $excel->setActiveSheetIndex(0)->setCellValue('B1', "NIM");
          $excel->getActiveSheet()->mergeCells('B1:B2');
          $excel->setActiveSheetIndex(0)->setCellValue('C1', "Nama");
          $excel->getActiveSheet()->mergeCells('C1:C2');
          $excel->setActiveSheetIndex(0)->setCellValue('D1', "Pertemuan"); 
          $last_cell = chr(ord('D') + $num_pertemuan -1);
          $excel->getActiveSheet()->mergeCells('D1:' . $last_cell . '1');
          $tugas_akhir_cell = chr(ord($last_cell) + 1);
          $excel->setActiveSheetIndex(0)->setCellValue($tugas_akhir_cell . '1', "Tugas Akhir");
          $excel->getActiveSheet()->mergeCells($tugas_akhir_cell . '1:' . $tugas_akhir_cell . '2');
          $nilai_akhir_cell = chr(ord($last_cell) + 2);
          $excel->setActiveSheetIndex(0)->setCellValue($nilai_akhir_cell . '1', "Nilai Akhir"); // Se$tugas_akhir_cell = chr(ord($last_cell) + 1);t kolom E3 dengan tulisan "ALAMAT"
          $excel->getActiveSheet()->mergeCells($nilai_akhir_cell . '1:' . $nilai_akhir_cell . '2');
          for($i = 1;$i <= $num_pertemuan;$i++) {
            $cell = chr(ord('D') + $i - 1);
            $excel->setActiveSheetIndex(0)->setCellValue($cell .'2', $i);
          }
          $no = 1; 
          $numrow = 3;
          foreach($data['list_peserta'] as $peserta){ 
            $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $peserta->nim);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $peserta->nama);
            $cell = 'D';
            foreach ($data['list_pertemuan'] as $pertemuan){
                if($data['absensi'][$peserta->nim][$pertemuan->id_pertemuan]) {
                    $excel->setActiveSheetIndex(0)->setCellValue($cell.$numrow, $data['list_resume'][$peserta->nim]
                                    [$pertemuan->id_pertemuan]->nilai);
                } else {
                    $excel->setActiveSheetIndex(0)->setCellValue($cell.$numrow, 0);
                }
                $cell = chr(ord($cell) + 1);
            }

            if($data['daftar_tugas_akhir'][$peserta->nim] != null) { 
                $excel->setActiveSheetIndex(0)->setCellValue($cell.$numrow, 
                    $data['daftar_tugas_akhir'][$peserta->nim]->nilai);
            } else { 
                $excel->setActiveSheetIndex(0)->setCellValue($cell.$numrow, 0);
            }
            $cell = chr(ord($cell) + 1);
            $excel->setActiveSheetIndex(0)->setCellValue($cell.$numrow, $peserta->nilai_akhir);
            
            $no++; 
            $numrow++;
          }

          $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
          $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); 

          $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

          $excel->getActiveSheet(0)->setTitle("Laporan Nilai Siswa");
          $excel->setActiveSheetIndex(0);
          
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          $filename = 'Nilai Kelas ' . $data['kelas']->no_kelas . '.xlsx';
          header('Content-Disposition: attachment; filename="'. $filename .'"'); 
          header('Cache-Control: max-age=0');
          $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
          $write->save('php://output');
    }

    public function getRekapNilaiPerKelas($kelas) {
        $data = array();
        if($kelas != null) {
            $data['kelas'] = $this->kelas_model->getById($kelas);
            $list_peserta = $this->peserta_model->getByKelas($kelas);
            $list_pertemuan = $this->pertemuan_model->getAllByKelas($kelas);
            // GET NILAI DARI SETIAP PESERTA PADA PERTEMUAN TERSEBUT
            $list_resume = array();
            $absensi = array();
            $daftar_tugas_akhir = array();
            foreach ($list_peserta as $peserta) {
                $list_resume[$peserta->nim] = array();
                $absensi[$peserta->nim] = array();
                foreach ($list_pertemuan as $pertemuan) {
                    $resume = $this->resume_model->getByIdPertemuanAndNIM(
                                        $pertemuan->id_pertemuan,$peserta->nim);
                    if(sizeof($resume) > 0) {
                        $absensi[$peserta->nim]
                            [$pertemuan->id_pertemuan] = true;
                        $list_resume[$peserta->nim]
                            [$pertemuan->id_pertemuan] = $resume[0];
                    } else {
                        $absensi[$peserta->nim]
                            [$pertemuan->id_pertemuan] = false;
                    }
                }
                // TODO : GET NILAI TUGAS AKHIR

                $tugasakhir = $this->tugasakhir_model->getByNIM($peserta->nim);
                if(sizeof($tugasakhir) > 0) {
                    $daftar_tugas_akhir[$peserta->nim] = $tugasakhir[0];
                } else {
                    $daftar_tugas_akhir[$peserta->nim] = null;
                }
            }
            
            $data['list_peserta'] = $list_peserta;
            $data['list_pertemuan'] = $list_pertemuan;
            $data['list_resume'] = $list_resume;
            $data['absensi'] = $absensi;
            $data['daftar_tugas_akhir'] = $daftar_tugas_akhir;
        }
        return $data;
    }

    public function importnilai() {
        $admin = getAdminLogin();
        if ($admin['role'] == 'Admin Penilai' || $admin['role'] == 'Superadmin') {
          $idKelas = $this->input->post('Kelas');
          //add peserta
          $config['upload_path']          = './upload/nilai';
          $config['allowed_types']        = '*';
          $config['file_name'] = 'nilai' . $idKelas;
  
          $this->load->library('upload', $config);
          $path = realpath(__DIR__ . '/../../..') . "/upload/nilai/" . $config['file_name'] . ".xlsx";
  
          if (file_exists($path)){
              unlink($path);
          }
  
          echo "LAH";
          if ( ! $this->upload->do_upload('rekapNilai')) {
              echo $this->upload->display_errors();
          } else {
              echo($path.'   ');
              $daftarMahasiswa = $this->_read_file($path);
              echo "MASUK SINI";
              $this->inputDatabase($daftarMahasiswa);
              print_r($daftarMahasiswa);
          }
  
        //   redirect('/admin/kelas/list/'.$idSemester);
        } else {
        //   redirect('admin/login');
        }
      }  

    private function _read_file($path) {
        $this->load->library("SimpleXLSX");
        if ( $xlsx = $this->simplexlsx->parse($path) ) {
            $idKelas = $this->input->post('Kelas');
            $excel_content = $xlsx->rows();
            $daftar_mahasiswa = array();
            $list_pertemuan = $this->pertemuan_model->getAllByKelas($idKelas);
            foreach($excel_content as $num_row => $row){
                if($num_row != 0) {
                    $mahasiswa['nim'] = $row[1];
                    $mahasiswa['nilai_pertemuan'] = array();
                    for($index = 0;$index < sizeof($list_pertemuan);$index++) {
                        $mahasiswa['nilai_pertemuan'][$list_pertemuan[$index]->id_pertemuan] = $row[3 + $index];
                    }
                    $mahasiswa['nilai_tugasakhir'] = $row[3 + sizeof($list_pertemuan)];
                    array_push($daftar_mahasiswa, $mahasiswa);
                } else {

                }
            }
            return $daftar_mahasiswa;
        } else {
            echo SimpleXLSX::parseError();
        }
    }

    public function inputDatabase($daftarMahasiswa) {
        $kelas = $this->input->post('Kelas');
        // TODO : GET SEMUA PESERTA DARI KELAS TERSEBUT
        $admin = getAdminLogin();
        print_r($admin);
        if($admin != null) {
            $data = array();
            $data['kelas'] = $kelas;
            if($kelas != null) {
                echo "kelas tidak null";
                $list_pertemuan = $this->pertemuan_model->getAllByKelas($kelas);
                // GET NILAI DARI SETIAP PESERTA PADA PERTEMUAN TERSEBUT
                $list_resume = array();
                $absensi = array();
                foreach ($daftarMahasiswa as $mahasiswa) {
                    foreach ($list_pertemuan as $pertemuan) {
                        $resume = $this->resume_model->getByIdPertemuanAndNIM(
                                            $pertemuan->id_pertemuan,$mahasiswa['nim']);
                        if(sizeof($resume) > 0) {
                            $new_nilai = $mahasiswa['nilai_pertemuan'][$pertemuan->id_pertemuan];
                            $nilai_resume = array('nilai' => $new_nilai,
                                            'timestamp_nilai' => date('Y-m-d h:i:s'),
                                            'dinilai_oleh' => $admin['id_admin']);
                            print_r($nilai_resume);
                            $this->resume_model->updateByIDResume($resume[0]->id_resume,$nilai_resume);
                        } else {

                        }
                    }
                    $tugas_akhir = $this->tugasakhir_model->getByNIM($mahasiswa['nim']);
                    echo "MASUK";
                    if(sizeof($tugas_akhir) > 0) {
                        $nilai_tugasakhir = array('nilai' => $mahasiswa['nilai_tugasakhir'],
                                                'timestamp_nilai' => date('Y-m-d h:i:s'),
                                                'dinilai_oleh' => $admin['id_admin']
                                                );
                        $this->tugasakhir_model->updateByNIM($mahasiswa['nim'],$nilai_tugasakhir);
                    } else {

                    }
                }
            }

            setAlertCookie('success','Perubahan berhasil disimpan');
            redirect('/admin/nilai?kelas=' . $kelas);
        } else {
            $this->load->view('errors/cli/error_not_login');
        }
    }
}
?>