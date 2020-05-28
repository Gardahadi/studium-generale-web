-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: studiumgenerale
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Absensi`
--

DROP TABLE IF EXISTS `Absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Absensi` (
  `id_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `nim_peserta` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `timestamp_absensi` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_absensi`),
  KEY `nim_peserta` (`nim_peserta`),
  KEY `Absensi_FK` (`id_pertemuan`),
  CONSTRAINT `Absensi_FK` FOREIGN KEY (`id_pertemuan`) REFERENCES `Pertemuan` (`id_pertemuan`),
  CONSTRAINT `Absensi_ibfk_1` FOREIGN KEY (`nim_peserta`) REFERENCES `Peserta` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Absensi`
--

LOCK TABLES `Absensi` WRITE;
/*!40000 ALTER TABLE `Absensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `Absensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Admin`
--

DROP TABLE IF EXISTS `Admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `admin_role` varchar(20) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Admin`
--

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AttendingClass`
--

DROP TABLE IF EXISTS `AttendingClass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AttendingClass` (
  `id_pertemuan` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  KEY `id_kelas` (`id_kelas`),
  KEY `AttendingClass_FK` (`id_pertemuan`),
  CONSTRAINT `AttendingClass_FK` FOREIGN KEY (`id_pertemuan`) REFERENCES `Pertemuan` (`id_pertemuan`),
  CONSTRAINT `AttendingClass_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `Kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AttendingClass`
--

LOCK TABLES `AttendingClass` WRITE;
/*!40000 ALTER TABLE `AttendingClass` DISABLE KEYS */;
/*!40000 ALTER TABLE `AttendingClass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Kelas`
--

DROP TABLE IF EXISTS `Kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `no_kelas` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `nama_dosen` varchar(256) NOT NULL,
  `tipe_kelas` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_semester` (`id_semester`),
  CONSTRAINT `Kelas_ibfk_1` FOREIGN KEY (`id_semester`) REFERENCES `Semester` (`id_semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Kelas`
--

LOCK TABLES `Kelas` WRITE;
/*!40000 ALTER TABLE `Kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `Kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pertemuan`
--

DROP TABLE IF EXISTS `Pertemuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pertemuan` (
  `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT,
  `no_pertemuan` int(11) NOT NULL,
  `pembicara` varchar(256) NOT NULL,
  `tempat` varchar(256) NOT NULL,
  `waktu_mulai_pertemuan` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `waktu_selesai_pertemuan` timestamp NOT NULL DEFAULT '1970-01-02 17:00:01',
  `id_semester` int(11) NOT NULL,
  `waktu_mulai_absen` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `waktu_selesai_absen` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `waktu_mulai_resume` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `waktu_selesai_resume` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `topik` varchar(256) NOT NULL,
  `tautan` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_pertemuan`),
  KEY `id_semester` (`id_semester`),
  CONSTRAINT `Pertemuan_ibfk_1` FOREIGN KEY (`id_semester`) REFERENCES `Semester` (`id_semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pertemuan`
--

LOCK TABLES `Pertemuan` WRITE;
/*!40000 ALTER TABLE `Pertemuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pertemuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Peserta`
--

DROP TABLE IF EXISTS `Peserta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Peserta` (
  `nim` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `nilai_akhir` int(11) DEFAULT NULL,
  PRIMARY KEY (`nim`),
  KEY `kelas` (`kelas`),
  CONSTRAINT `Peserta_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `Kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Peserta`
--

LOCK TABLES `Peserta` WRITE;
/*!40000 ALTER TABLE `Peserta` DISABLE KEYS */;
/*!40000 ALTER TABLE `Peserta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Resume`
--

DROP TABLE IF EXISTS `Resume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Resume` (
  `id_resume` int(11) NOT NULL AUTO_INCREMENT,
  `id_absensi` int(11) NOT NULL,
  `konten` text NOT NULL,
  `nilai` float DEFAULT NULL,
  `timestamp_submit` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `timestamp_nilai` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `dinilai_oleh` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_resume`),
  KEY `id_absensi` (`id_absensi`),
  KEY `dinilai_oleh` (`dinilai_oleh`),
  CONSTRAINT `Resume_ibfk_1` FOREIGN KEY (`id_absensi`) REFERENCES `Absensi` (`id_absensi`),
  CONSTRAINT `Resume_ibfk_2` FOREIGN KEY (`dinilai_oleh`) REFERENCES `Admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Resume`
--

LOCK TABLES `Resume` WRITE;
/*!40000 ALTER TABLE `Resume` DISABLE KEYS */;
/*!40000 ALTER TABLE `Resume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Semester`
--

DROP TABLE IF EXISTS `Semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Semester` (
  `id_semester` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(10) NOT NULL,
  `no_semester` int(6) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `topik_tugas_akhir` varchar(256) DEFAULT NULL,
  `deadline_tugas_akhir` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Semester`
--

LOCK TABLES `Semester` WRITE;
/*!40000 ALTER TABLE `Semester` DISABLE KEYS */;
/*!40000 ALTER TABLE `Semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TugasAkhir`
--

DROP TABLE IF EXISTS `TugasAkhir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TugasAkhir` (
  `id_tugasakhir` int(11) NOT NULL AUTO_INCREMENT,
  `nim_peserta` int(11) NOT NULL,
  `nama_file` varchar(20) NOT NULL,
  `nilai` float DEFAULT NULL,
  `timestamp_submit` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `timestamp_nilai` timestamp NOT NULL DEFAULT '1970-01-01 17:00:01',
  `dinilai_oleh` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tugasakhir`),
  KEY `dinilai_oleh` (`dinilai_oleh`),
  KEY `id_peserta` (`nim_peserta`),
  CONSTRAINT `TugasAkhir_ibfk_1` FOREIGN KEY (`dinilai_oleh`) REFERENCES `Admin` (`id_admin`),
  CONSTRAINT `TugasAkhir_ibfk_2` FOREIGN KEY (`nim_peserta`) REFERENCES `Peserta` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TugasAkhir`
--

LOCK TABLES `TugasAkhir` WRITE;
/*!40000 ALTER TABLE `TugasAkhir` DISABLE KEYS */;
/*!40000 ALTER TABLE `TugasAkhir` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-07  0:05:28

CREATE TABLE `keys` (

 `id` int(11) NOT NULL,

 `key` varchar(40) NOT NULL,

 `level` int(2) NOT NULL,

 `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',

 `is_private_key` tinyint(1) NOT NULL DEFAULT '0',

 `ip_addresses` text,

 `date_created` int(11) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `logs` (

 `id` int(11) NOT NULL,

 `uri` varchar(255) NOT NULL,

 `method` varchar(6) NOT NULL,

 `params` text,

 `api_key` varchar(40) NOT NULL,

 `ip_address` varchar(45) NOT NULL,

 `time` int(11) NOT NULL,

 `rtime` float DEFAULT NULL,

 `authorized` varchar(1) NOT NULL,

 `response_code` smallint(3) DEFAULT '0'

) ENGINE=InnoDB DEFAULT CHARSET=utf8;
