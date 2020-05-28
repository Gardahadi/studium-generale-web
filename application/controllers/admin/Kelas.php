<?php

class Kelas extends CI_Controller {

    public function index() {
		$this->semesterlist();  
    }
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'cookie','alert', 'akun', 'download'));
    }

    public function add() { 
      $admin = getAdminLogin();
      echo $admin;
      if ($admin['role'] == 'Superadmin') {
        //add to table semester
        $semester = $this->input->post('semester');
        $tahunAjaran = $this->input->post('tahunAjaran');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $topikTugasAkhir = $this->input->post('topikTugasAkhir');
        $deadlineTanggalTugasAkhir = $this->input->post('deadlineTanggalTugasAkhir');
        $deadlineJamTugasAkhir = $this->input->post('deadlineJamTugasAkhir');

        $this->load->model("semester_model");
        if ($endDate > $startDate) {
            $idSemester = $this->semester_model->insert($tahunAjaran, $semester, $startDate, $endDate, $topikTugasAkhir,  $deadlineTanggalTugasAkhir. ' '. $deadlineJamTugasAkhir);
            setAlertCookie('success', 'Semester dan kelas berhasil dibuat');
        } else {
            setAlertCookie('fail', 'Waktu akhir semester harus lebih akhir dari waktu awal semester');
            redirect('admin/kelas/semesterlist');
        }
        

        $jlhKelasReguler = (int) $this->input->post('jlhKelasReguler');
        $jlhKelasSeatin = (int) $this->input->post('jlhKelasSeatin');

        //add kelas reguler
        for ($i = 1; $i <= $jlhKelasReguler; $i++) {
            $this->addKelas($i, $idSemester, 'Reguler');
        }

        //add kelas seat in
        for ($i = 1; $i <= $jlhKelasSeatin; $i++) {
            $this->addKelas($jlhKelasReguler + $i, $idSemester, 'Seatin');
        }

        redirect('admin/kelas/semesterlist');
      } else {
          redirect('admin/login');
      }
    }

    private function addKelas($noKelas, $idSemester, $tipeKelas) {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $namaDosen = '';
        $this->load->model("kelas_model");
        $this->kelas_model->insert($noKelas, $namaDosen, $idSemester, $tipeKelas);
      } else {
        redirect('admin/login');
      }
    }

    public function edit() {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $idKelas = (int) $this->input->post('idKelas');
        $idSemester = (int) $this->input->post('idSemester');
        $noKelas = (int) $this->input->post('noKelas');
        $namaDosen = $this->input->post('namaDosen');
        $tipeKelas = $this->input->post('tipeKelas');

        //update kelas
        $this->load->model("kelas_model");
        $this->kelas_model->update($idKelas, $noKelas, $namaDosen, $idSemester, $tipeKelas);

        //add peserta
        $config['upload_path']          = './upload/peserta';
        $config['allowed_types']        = 'xlsx';
        $config['file_name'] = $idKelas . '-' . $idSemester;

        $this->load->library('upload', $config);
        $path = realpath(__DIR__ . '/../../..') . "/upload/peserta/" . $config['file_name'] . ".xlsx";

        if (file_exists($path)){
            unlink($path);
        }

        echo 'Current PHP version: ' . phpversion();
        if ( ! $this->upload->do_upload('daftarPeserta')) {
            echo $this->upload->display_errors();
        } else {
            echo($path.'   ');
            $daftarMahasiswa = $this->_read_file($path);

            $this->_add_mahasiswa_to_kelas($idKelas, $daftarMahasiswa);
        }

        redirect('/admin/kelas/all/'.$idSemester);
      } else {
        redirect('admin/login');
      }
    }

    public function delete() {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $id_kelas = $this->input->post('id-kelas');
        $id_semester = $this->input->post('id-semester');
        $this->load->model('kelas_model');
        $this->kelas_model->delete($id_kelas);

        redirect('/admin/kelas/all/  '.$id_semester);
      } else {
        redirect('admin/login');
      }
    }  

    public function semesterlist() {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $this->load->model('semester_model');

    	$data_semester= $this->semester_model->getAll();

        $data = array();
        $data['semesters'] = array();
        $data['alert'] = getAlertFromCookie();
        
        foreach ($data_semester as $detail_semester) {

            $semester = array();
            $semester['id_semester'] = $detail_semester->id_semester;
            $semester['tahun_ajaran'] = $detail_semester->tahun_ajaran;
            $semester['semester'] = $detail_semester->no_semester;
            $semester['start_date'] = $this->trimTime($detail_semester->start_date);	
            $semester['end_date'] = $this->trimTime($detail_semester->end_date);
            $semester['topik_tugas_akhir'] = $detail_semester->topik_tugas_akhir;
            $semester['deadline_tugas_akhir'] = $detail_semester->deadline_tugas_akhir;

            array_push($data['semesters'], $semester);	
        }
        
        $this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/kelas/semester_list', $data);
        $this->load->view('partials/footer');
      } else {
        redirect('admin/login');
      }
    }

    public function all($id_semester=0){
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
		$this->load->model('kelas_model');
		$this->load->model('semester_model');

		$data_kelas = $this->kelas_model->getByIdSemester($id_semester);

      	$data = array();
		$data['classes'] = array();
        $data['semester'] = array();
        $data['alert'] = getAlertFromCookie();
		
		foreach ($data_kelas as $detail_kelas) {
			$kelas = array();
			$kelas['id_kelas'] = $detail_kelas->id_kelas;
			$kelas['no_kelas'] = $detail_kelas->no_kelas;
			$kelas['nama_dosen'] = $detail_kelas->nama_dosen;
			$kelas['tipe_kelas'] = $detail_kelas->tipe_kelas;
			$kelas['jumlah_mahasiswa'] = $this->kelas_model->getJumlahMahasiswa($detail_kelas->id_kelas);

			array_push($data['classes'], $kelas);	
        }
        
        $data_semester = $this->semester_model->getById($id_semester);
        $semester = array();
        $semester['id_semester'] = $data_semester->id_semester;
        $semester['tahun_ajaran'] = $data_semester->tahun_ajaran;
        $semester['semester'] = $data_semester->no_semester;

		array_push($data['semester'], $semester);	
       
    	$this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/kelas/class_list', $data);
        $this->load->view('partials/footer');
      } else {
        redirect('admin/login');
      }
    }

	public function form($id = 0) {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $data = array();
        $data['method'] = 'create';

        if ($id > 0) {
            $this->load->model('semester_model');
            $this->load->model('kelas_model');

            $data_semester= $this->semester_model->getById($id);
    
            $data['method'] = 'edit';
            $data['semester'] = array();
            
            $semester = array();
            $semester['id_semester'] = $data_semester->id_semester;
            $semester['tahun_ajaran'] = $data_semester->tahun_ajaran;
            $semester['semester'] = $data_semester->no_semester;
            $semester['start_date'] = $this->trimTime($data_semester->start_date);	
            $semester['end_date'] = $this->trimTime($data_semester->end_date);
            $semester['topik_tugas_akhir'] = $data_semester->topik_tugas_akhir;
            $semester['deadline_tanggal_tugas_akhir'] = $this->trimTime($data_semester->deadline_tugas_akhir);
            $semester['deadline_jam_tugas_akhir'] = $this->trimDate($data_semester->deadline_tugas_akhir);
            $semester['kelas_reguler'] = $this->kelas_model->getJumlahByIdSemesterAndTipe((int) $id, "Reguler");
            $semester['kelas_seatin'] = $this->kelas_model->getJumlahByIdSemesterAndTipe((int) $id, "Seatin");


            array_push($data['semester'], $semester);

        }
		$this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/kelas/semester_form', $data);
        $this->load->view('partials/footer');
      } else {
        redirect('admin/login');
      }
    }

    public function editform($id_kelas = 0) {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $this->load->model('kelas_model');
        $data_kelas = $this->kelas_model->getById($id_kelas);

        $data = array();
        $data['kelas'] = array();
        
        //convert stdclass to array
        array_push($data['kelas'], json_decode(json_encode($data_kelas), true));

        $this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/kelas/class_edit', $data);
        $this->load->view('partials/footer');
      } else {
        redirect('admin/login');
      }
    }

    public function editsemester() {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $idSemester = $this->input->post('id');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $topikTugasAkhir = $this->input->post('topikTugasAkhir');
        $deadlineTanggalTugasAkhir = $this->input->post('deadlineTanggalTugasAkhir');
        $deadlineJamTugasAkhir = $this->input->post('deadlineJamTugasAkhir');

        $this->load->model("semester_model");

        if ($endDate > $startDate) {
            $this->semester_model->update($idSemester, $startDate, $endDate, $topikTugasAkhir, $deadlineTanggalTugasAkhir. ' '. $deadlineJamTugasAkhir);
            setAlertCookie('success', 'Semester dan kelas berhasil dibuat');
        } else {
            setAlertCookie('fail', 'Waktu akhir semester harus lebih akhir dari waktu awal semester');
            redirect('admin/kelas/semesterlist');
        }
        
        redirect('admin/kelas/semesterlist');
      } else {
        redirect('admin/login');
      }

    }

    public function seatin($id_semester=0) {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $this->load->model('kelas_model');
        $this->load->model('peserta_model');
        $data_kelas_reguler = $this->kelas_model->getByIdSemesterAndTipe((int) $id_semester, "Reguler");
        $data_kelas_seatin = $this->kelas_model->getByIdSemesterAndTipe((int) $id_semester, "Seatin");

        $arr_kelas_reguler = array();
        foreach ($data_kelas_reguler as $kelas_reguler) {
            $id_kelas = (int) $kelas_reguler->id_kelas;
            $arr_kelas_reguler[$id_kelas] =  $this->kelas_model->getJumlahMahasiswa($id_kelas);
        }

        $data_peserta = array();
        foreach ($data_kelas_seatin as $kelas_seatin) {
            $id_kelas = (int) $kelas_seatin->id_kelas;
            $peserta = $this->peserta_model->getByKelas($id_kelas);
            $data_peserta = array_merge($data_peserta, $peserta);
        }

        foreach($data_peserta as $peserta) {
            $id_kelas_min = array_search(min($arr_kelas_reguler), $arr_kelas_reguler);
            $data = array('kelas' => $id_kelas_min);
            $this->peserta_model->update($peserta->nim, $data);
            $arr_kelas_reguler[$id_kelas_min]++;
        }

        setAlertCookie('success', 'Peserta seat in berhasil dipindahkan ke kelas reguler');
        $this->all($id_semester);
      } else {
        redirect('admin/login');
      }
    }

    public function view($id_kelas=0) {
      $admin = getAdminLogin();
      if ($admin['role'] == 'Superadmin') {
        $this->load->model('kelas_model');
        $this->load->model('peserta_model');

        $data = array();
        $data['kelas'] = array();
        $data['peserta'] = array();

        $data_kelas = $this->kelas_model->getById($id_kelas);

        //convert stdclass to array
        array_push($data['kelas'], json_decode(json_encode($data_kelas), true));

        $data_peserta = $this->peserta_model->getByKelas($id_kelas);
        foreach ($data_peserta as $detail_peserta) {
			array_push($data['peserta'], json_decode(json_encode($detail_peserta), true));	//convert stdclass to array
        }

        $this->load->view('partials/header');
		$this->load->view('partials/sidebaradmin');
		$this->load->view('admins/kelas/class_view', $data);
        $this->load->view('partials/footer');
      } else {
        redirect('admin/login');
      }
    }

    public function downloadSampleExcel(){
      $filepath = realpath(__DIR__ . '/../../..') . "/upload/sample/excelsample.xlsx";
      force_download($filepath, NULL);
    }

    private function processDate($date) {
        $arr = explode("/", $date);
        $date = $arr[2].'-'.$arr[0].'-'.$arr[1];
        return $date;
    }

    private function trimTime($date) {
        $arr = explode(" ", $date);
        return $arr[0];
    }
    
    private function trimDate($date) {
        $arr = explode(" ", $date);
        return $arr[1];
    }

    private function _read_file($path) {
        $this->load->library("SimpleXLSX");
        if ( $xlsx = $this->simplexlsx->parse($path) ) {
            $excel_content = $xlsx->rows();
            $daftar_mahasiswa = array();
            foreach($excel_content as $num_row => $row){
                if($num_row != 0) {
                    $mahasiswa['nim'] = $row[0];
                    $mahasiswa['nama'] = $row[1];
                    array_push($daftar_mahasiswa, $mahasiswa);
                }
            }
            return $daftar_mahasiswa;
        } else {
            echo SimpleXLSX::parseError();
        }
    }

    private function _add_mahasiswa_to_kelas($idKelas, $daftarMahasiswa) {
        $this->load->model('peserta_model');

        $success = 0;
        foreach ($daftarMahasiswa as $mahasiswa) {

            echo $this->peserta_model->isNimExist($mahasiswa['nim']);
            if ($this->peserta_model->isNimExist($mahasiswa['nim']) == 0) {
                $this->peserta_model->insert($mahasiswa['nim'], $idKelas, $mahasiswa['nama']);
            } else {
                $success = $mahasiswa['nim'];
                break;
            }
        }

        if ($success == 0) {
            setAlertCookie('success', 'Perubahan kelas berhasil disimpan');
        } else {
            setAlertCookie('fail', 'Peserta dengan NIM'. $success .' sudah terdaftar');
        }
    }

}
?>