<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_init_database extends CI_Migration {
    public function up() {
        $this->down();
        $this->create_table_admin();
        $this->create_table_kelas();
        $this->create_table_peserta();
        $this->create_table_pertemuan();
        $this->create_table_absensi();
        $this->add_constraint_foreign_key();
        

    }
    public function down() {
        $this->dbforge->drop_table('absensi',TRUE);
        $this->dbforge->drop_table('peserta',TRUE);
        $this->dbforge->drop_table('pertemuan',TRUE);
        $this->dbforge->drop_table('kelas',TRUE);
        $this->dbforge->drop_table('admin',TRUE);
    }

    public function create_table_admin() {
        $this->dbforge->add_field(array(
            'id_admin' => array(
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => TRUE 
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'pass' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'admin_role' => array(
                'type' => 'VARCHAR',
                'constraint' => '20'
            )
        ));
        $this->dbforge->add_key('id_admin',TRUE);
        $this->dbforge->create_table('admin');
    }
    public function create_table_peserta() {
       $this->dbforge->add_field(array(
            'nim' => array(
                'type' => 'VARCHAR',
                'constraint' => '9',
            ),
            'kelas' => array(
                'type' => 'INT',
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
            )
        ));
        $this->dbforge->add_key('nim',TRUE);
        $this->dbforge->create_table('peserta');

    }
    public function create_table_kelas() {
        $this->dbforge->add_field(array(
            'id_kelas' => array(
                'type' => 'INT',
                'auto_increment' => TRUE 
            ),
            'no_kelas' => array(
                'type' => 'INT',
                'constraint' => 100,
            ),
            'semester' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
            'tahun_ajaran' => array(
                'type' => 'int'
            )
        ));
        $this->dbforge->add_key('id_kelas',TRUE);
        $this->dbforge->create_table('kelas');
    }
    public function create_table_pertemuan() {
        $this->dbforge->add_field(array(
            'id_pertemuan' => array(
                'type' => 'INT',
                'constraint' => 100,
                'auto_increment' => TRUE 
            ),
            'no_pertemuan' => array(
                'type' => 'INT',
                'constraint' => 100,
            ),
            'tanggal' => array(
                'type' => 'TIMESTAMP'
            ),
            'pembicara' => array(
                'type' => 'VARCHAR',
                'constraint' => 128
            ),
            'semester' => array(
                'type' => 'INT'
            ),
            'tahun_ajaran' => array(
                'type' => 'INT'
            )
        ));
        $this->dbforge->add_key('id_pertemuan',TRUE);
        $this->dbforge->create_table('pertemuan');
    }
    public function create_table_absensi() {
        $this->dbforge->add_field(array(
            'id_absensi' => array(
                'type' => 'INT',
                'auto_increment' => TRUE 
            ),
            'nim_peserta' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'timestamp_absensi' => array(
                'type' => 'TIMESTAMP'
            ),
            'timestamp_resume' => array(
                'type' => 'TIMESTAMP',
                'default' => '2020-01-01 00:00:01'
            ),
            'id_pertemuan' => array(
                'type' => 'INT'
            ),
            'resume' => array(
                'type' => 'LONGTEXT'
            )
        ));
        $this->dbforge->add_key('id',TRUE);
        $this->dbforge->create_table('absensi');
    }
    public function create_table_attending_class() {
        $this->dbforge->add_field(array(
            'id_pertemuan' => array(
                'type' => 'INT',
                'auto_increment' => TRUE 
            ),
            'id_kelas' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            )
        ));
        $this->dbforge->add_key('id_pertemuan',TRUE);
        $this->dbforge->create_table('attendng_class');
    }
    public function add_constraint_foreign_key() {
        $this->db->query('ALTER TABLE `peserta` ADD CONSTRAINT `constraint_kelas` FOREIGN KEY(`kelas`) REFERENCES kelas(`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `absensi` ADD CONSTRAINT `constraint_nim_mahasiswa` FOREIGN KEY(`nim_peserta`) REFERENCES peserta(`nim`) ON DELETE CASCADE ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE `absensi` ADD CONSTRAINT `constraint_id_pertemuan` FOREIGN KEY(`id_pertemuan`) REFERENCES pertemuan(`id_pertemuan`) ON DELETE CASCADE ON UPDATE CASCADE;');
    }
}