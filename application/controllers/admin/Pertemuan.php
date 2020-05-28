<?php

class Pertemuan extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form', 'url', 'cookie','alert', 'akun'));
    $this->load->library('form_validation');
  }

  public function all() {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $this->load->model('pertemuan_model');
    $data = array();
    $data = array('list_pertemuan' => $this->pertemuan_model->getAll(),
                  'alert' => getAlertFromCookie());

    $this->load->view('partials/header');
    $this->load->view('partials/sidebaradmin');
    $this->load->view('admins/pertemuan/list',$data);
    $this->load->view('partials/footer');
    } else {
      redirect('admin/login');
    }

  }

  public function add() {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $this->load->model('kelas_model');
    $data = array();
    // TODO : MAKE SEMESTER GET FROM THIS CURRENT TIME
    $data = array('classes' => $this->kelas_model->getBySemesterSekarang(),
                  'alert' => getAlertFromCookie());

    $this->load->view('partials/header');
    $this->load->view('partials/sidebaradmin');
    $this->load->view('admins/pertemuan/add',$data);
    $this->load->view('partials/footer');
    } else {
      redirect('admin/login');
    }
  }

  public function edit($id) {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $this->load->model('kelas_model');
    $data = array();
    $daftar_pertemuan = $this->pertemuan_model->getById($id);

    if(sizeof($daftar_pertemuan) > 0){
      $pertemuan = $daftar_pertemuan[0];
      $data['pertemuan'] = array();
      $data['pertemuan']['id_pertemuan'] = $pertemuan->id_pertemuan;
      $data['pertemuan']['topik'] = $pertemuan->topik;
      $data['pertemuan']['pembicara'] = $pertemuan->pembicara;
      $data['pertemuan']['tempat'] = $pertemuan->tempat;
      $data['pertemuan']['tanggal_mulai'] = $this->getDate($pertemuan->waktu_mulai_pertemuan);
      $data['pertemuan']['jam_mulai'] = $this->getTime($pertemuan->waktu_mulai_pertemuan);
      $data['pertemuan']['tanggal_selesai'] = $this->getDate($pertemuan->waktu_selesai_pertemuan);
      $data['pertemuan']['jam_selesai'] = $this->getTime($pertemuan->waktu_selesai_pertemuan);
      $data['pertemuan']['waktu_mulai_absen'] = $this->getTime($pertemuan->waktu_mulai_absen);
      $data['pertemuan']['waktu_selesai_absen'] = $this->getTime($pertemuan->waktu_selesai_absen);
      $data['pertemuan']['tanggal_mulai_resume'] = $this->getDate($pertemuan->waktu_mulai_resume);
      $data['pertemuan']['jam_mulai_resume'] = $this->getTime($pertemuan->waktu_mulai_resume);
      $data['pertemuan']['tanggal_selesai_resume'] = $this->getDate($pertemuan->waktu_selesai_resume);
      $data['pertemuan']['jam_selesai_resume'] = $this->getTime($pertemuan->waktu_selesai_resume);
      $data['pertemuan']['tautan'] = $pertemuan->tautan;
      
      $data['classes'] = $this->kelas_model->getBySemesterSekarang();
      $class_attendance = $this->kelas_model->getByPertemuanId($id);

      $data["is_class_x_attendance"] = array();
      foreach($data['classes'] as $class) {
        $data["is_class_x_attendance"][$class->id_kelas] = false;
      }
      foreach($class_attendance as $class) {
        $data["is_class_x_attendance"][$class->id_kelas] = true;
      }
      $data['alert'] = getAlertFromCookie();
      $this->load->view('partials/header');
      $this->load->view('partials/sidebaradmin');
      $this->load->view('admins/pertemuan/edit',$data);
      $this->load->view('partials/footer');
    } else {
      $data = array('heading' => '404 Not Found',
                    'message' => 'Pertemuan tidak ditemukan');
      $this->load->view('partials/header');
      $this->load->view('partials/sidebaradmin');
      $this->load->view('errors/cli/error_404',$data);
      $this->load->view('partials/footer');
    }
    } else {
      redirect('admin/login');
    }
  }

  public function adddatabase() {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $this->addFormValidationRule();
    if ($this->form_validation->run() == FALSE)
		{
      setAlertCookie('fail',validation_errors());
      redirect('admin/pertemuan/add');
		}
		else
		{
      $tanggal_pertemuan = $this->input->post('tanggalMulai');
      $waktu_mulai_absensi = $tanggal_pertemuan . ' ' . $this->input->post('waktuMulaiAbsensi');
      $waktu_selesai_absensi = $tanggal_pertemuan . ' ' . $this->input->post('waktuSelesaiAbsensi');
			$data = array('no_pertemuan' => $this->input->post('noPertemuan'),
                        'pembicara' => $this->input->post('pembicara'),
                        'tempat' => $this->input->post('tempat'),
                        'waktu_mulai_pertemuan' => $this->input->post('tanggalMulai') . ' ' . $this->input->post('jamMulai'),
                        'waktu_selesai_pertemuan'=> $this->input->post('tanggalSelesai') . ' ' . $this->input->post('jamSelesai'),
                        'waktu_mulai_absen' => $waktu_mulai_absensi,
                        'waktu_selesai_absen' => $waktu_selesai_absensi,
                        'waktu_mulai_resume' => $this->input->post('tanggalMulaiResume') . ' ' . $this->input->post('jamMulaiResume'),
                        'waktu_selesai_resume' => $this->input->post('tanggalMulaiResume') . ' ' . $this->input->post('jamMulaiResume'),
                        'topik' => $this->input->post('topik'),
                        'tautan' => $this->input->post('tautan'),
                        'daftar_kelas' => $this->input->post('daftarKelas'));

      $this->load->model('pertemuan_model');

      $this->pertemuan_model->insert($data);
      setAlertCookie('success','Pertemuan berhasil disimpan');
      redirect('/admin/pertemuan/all');
    }
    } else {
      redirect('admin/login');
    }
  }

  public function updateDatabase() {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $this->addFormValidationRule();
    if ($this->form_validation->run() == false)
		{
      setAlertCookie('fail',validation_errors());
      redirect('admin/pertemuan/edit/'.$this->input->post('idPertemuan'));
		}
		else
		{
      $tanggal_pertemuan = $this->input->post('tanggalMulai');
      $id_pertemuan = $this->input->post('idPertemuan');
      $waktu_mulai_absensi = $tanggal_pertemuan . ' ' . $this->input->post('waktuMulaiAbsensi');
      $waktu_selesai_absensi = $tanggal_pertemuan . ' ' . $this->input->post('waktuSelesaiAbsensi');
			$data = array('no_pertemuan' => $this->input->post('noPertemuan'),
                        'pembicara' => $this->input->post('pembicara'),
                        'tempat' => $this->input->post('tempat'),
                        'waktu_mulai_pertemuan' => $this->input->post('tanggalMulai') . ' ' . $this->input->post('jamMulai'),
                        'waktu_selesai_pertemuan'=> $this->input->post('tanggalSelesai') . ' ' . $this->input->post('jamSelesai'),
                        'waktu_mulai_absen' => $waktu_mulai_absensi,
                        'waktu_selesai_absen' => $waktu_selesai_absensi,
                        'waktu_mulai_resume' => $this->input->post('tanggalMulaiResume') . ' ' . $this->input->post('jamMulaiResume'),
                        'waktu_selesai_resume' => $this->input->post('tanggalSelesaiResume') . ' ' . $this->input->post('jamSelesaiResume'),
                        'topik' => $this->input->post('topik'),
                        'tautan' => $this->input->post('tautan'),
                        'daftar_kelas' => $this->input->post('daftarKelas'));

      $this->load->model('pertemuan_model');

      $this->pertemuan_model->update($id_pertemuan,$data);
      setAlertCookie('success','Pertemuan berhasil disimpan');
      redirect('/admin/pertemuan/all');
    }
    } else {
      redirect('admin/login');
    }
  }

  public function delete() {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $id_pertemuan = $this->input->post('idPertemuan');

    $this->load->model('pertemuan_model');
    $absensi = $this->absensi_model->getByIdPertemuan($id_pertemuan);
    if(!$this->isHaveAbsensi($absensi)) {
      $this->pertemuan_model->deleteAttendanceKelas($id_pertemuan);
      $this->pertemuan_model->delete($id_pertemuan);

      setAlertCookie('success','Pertemuan berhasil dihapus');
    } else {
      setAlertCookie('fail','Pertemuan tidak bisa dihapus, sudah ada mahasiswa yang absen');
    }
    redirect('/admin/pertemuan/all');
    } else {
      redirect('admin/login');
    }
  }

  private function isHaveAbsensi($absensi) {
    return sizeof($absensi) > 0;
  }

  public function checkWaktuMulaiAbsensi($time) {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $waktu_selesai = $this->input->post('jamSelesai');

    if($time <= $waktu_selesai) {
      return true;
    } else {
      $this->form_validation->set_message('checkWaktuMulaiAbsensi','Waktu Mulai Absensi harus sebelum waktu selesai pertemuan');
      return false;
    }
    } else {
      redirect('admin/login');
    }
  }

  public function checkWaktuSelesaiAbsensi($time) {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $waktu_selesai = $this->input->post('jamSelesai');

    $waktu_mulai_absen = $this->input->post('waktuMulaiAbsensi');
    if($time >= $waktu_mulai_absen && $time <= $waktu_selesai) {
      return true;
    } else {
      $this->form_validation->set_message('checkWaktuSelesaiAbsensi','Waktu Selesai Absensi harus sebelum waktu selesai pertemuan dan setelah waktu mulai pertemuan');
      return false;
    }
    } else {
      redirect('admin/login');
    }
  }

  public function checkWaktuMulaiResume($tanggal_mulai_resume) {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $waktu_mulai = $this->input->post('tanggalMulai') . ' ' . $this->input->post('jamMulai');
    $waktu_mulai_resume = $tanggal_mulai_resume . ' ' . $this->input->post('jamMulaiResume');
    if($waktu_mulai_resume >= $waktu_mulai) {
      return true;
    } else {
      $this->form_validation->set_message('checkWaktuMulaiResume','Waktu Mulai Resume harus setelah waktu mulai pertemuan');
      return false;
    }
    } else {
      redirect('admin/login');
    }
  }

  public function checkWaktuSelesaiResume($tanggal_selesai_resume) {
    $admin = getAdminLogin();
    if ($admin['role'] == 'Superadmin') {
    $waktu_mulai_resume = $this->input->post('tanggalMulaiResume') . ' ' . $this->input->post('jamMulaiResume');
    $waktu_selesai_resume = $tanggal_selesai_resume . ' ' . $this->input->post('jamSelesaiResume');
    if($waktu_selesai_resume >= $waktu_mulai_resume) {
      return true;
    } else {
      $this->form_validation->set_message('checkWaktuSelesaiResume','Waktu Selesai resume harus setelah waktu mulai resume');
      return false;
    }
    } else {
      redirect('admin/login');
    }
  }

  private function addFormValidationRule() {
    $this->form_validation->set_rules('waktuMulaiAbsensi', '', 'callback_checkWaktuMulaiAbsensi');
    $this->form_validation->set_rules('waktuSelesaiAbsensi', '', 'callback_checkWaktuSelesaiAbsensi');
    $this->form_validation->set_rules('tanggalMulaiResume', '', 'callback_checkWaktuMulaiResume');
    $this->form_validation->set_rules('tanggalSelesaiResume', '', 'callback_checkWaktuSelesaiResume');
  }

  private function getDate($date) {
    $arr = explode(" ", $date);
    return $arr[0];
  }

  private function getTime($date) {
      $arr = explode(" ", $date);
      return $arr[1];
  }
}
?>