-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 12:13 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inovindo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen_pegawai`
--

CREATE TABLE `absen_pegawai` (
  `id_absen_pegawai` int(11) NOT NULL,
  `tgl_absen` datetime NOT NULL,
  `ket` enum('Masuk','Tidak Masuk','Masuk-Pagi') NOT NULL,
  `lembur` enum('Ya','Tidak','Wait','Mulai') NOT NULL,
  `hasil` varchar(100) DEFAULT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen_pegawai`
--

INSERT INTO `absen_pegawai` (`id_absen_pegawai`, `tgl_absen`, `ket`, `lembur`, `hasil`, `nip`) VALUES
(10, '2021-05-06 16:13:46', 'Masuk', 'Tidak', NULL, '123456789102345678'),
(12, '2021-10-16 00:49:54', 'Masuk', 'Ya', '12.jpg', '123456789102345678');

-- --------------------------------------------------------

--
-- Table structure for table `absen_prakerin`
--

CREATE TABLE `absen_prakerin` (
  `id_absen_prakerin` int(11) NOT NULL,
  `tgl_absen` datetime NOT NULL,
  `keterangan` enum('Masuk','Tidak Masuk','Masuk-Pagi') NOT NULL,
  `type` enum('WFO','WFH') NOT NULL,
  `kegiatan` varchar(150) NOT NULL,
  `id_prakerin` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_prakerin`
--

CREATE TABLE `hasil_prakerin` (
  `id_hasil_prakerin` int(11) NOT NULL,
  `id_sertifikat` int(11) NOT NULL,
  `aspek` varchar(50) NOT NULL,
  `category` enum('Sikap','Pengetahuan','Keterampilan') NOT NULL,
  `nilai` int(3) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_prakerin` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_prakerin`
--

INSERT INTO `hasil_prakerin` (`id_hasil_prakerin`, `id_sertifikat`, `aspek`, `category`, `nilai`, `keterangan`, `id_prakerin`) VALUES
(82, 4, 'A', 'Sikap', 90, 'OK', '10118148'),
(83, 4, 'B', 'Pengetahuan', 90, 'JAGO', '10118148'),
(84, 4, 'C', 'Keterampilan', 90, 'PRO', '10118148');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `level` enum('Prakerin','Pegawai','','') NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `kegiatan` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `hari`, `level`, `mulai`, `selesai`, `kegiatan`) VALUES
(2, 'Selasa', 'Pegawai', '09:00:00', '09:30:00', 'Briefing Pagi'),
(14, 'Senin', 'Pegawai', '09:30:00', '12:00:00', 'Kerja'),
(15, 'Senin', 'Pegawai', '12:00:00', '13:00:00', 'Istirahat dan Sholat Dzuhur'),
(16, 'Senin', 'Pegawai', '13:00:00', '15:00:00', 'Kerja'),
(17, 'Senin', 'Pegawai', '15:00:00', '15:15:00', 'Istirahat dan Sholat Asar'),
(18, 'Senin', 'Pegawai', '15:15:00', '17:00:00', 'Kerja'),
(19, 'Senin', 'Pegawai', '17:00:00', '17:15:00', 'Briefing Sore'),
(21, 'Selasa', 'Prakerin', '09:00:00', '09:30:00', 'Briefing Pagi'),
(22, 'Rabu', 'Prakerin', '09:00:00', '09:30:00', 'Briefing Pagi'),
(24, 'Senin', 'Prakerin', '09:00:00', '09:30:00', 'Briefing Pagi'),
(25, 'Senin', 'Prakerin', '09:30:00', '12:00:00', 'Kerja'),
(26, 'Senin', 'Prakerin', '12:00:00', '13:00:00', 'Istirahat dan Shalat Dzuhur'),
(27, 'Senin', 'Prakerin', '13:00:00', '15:00:00', 'Kerja'),
(28, 'Senin', 'Prakerin', '15:00:00', '15:15:00', 'Istirahat dan Shalat Ashar'),
(29, 'Senin', 'Prakerin', '15:15:00', '17:00:00', 'Kerja'),
(30, 'Senin', 'Prakerin', '17:00:00', '17:15:00', 'Briefing Sore'),
(31, 'Selasa', 'Prakerin', '09:30:00', '12:00:00', 'Kerja'),
(32, 'Selasa', 'Prakerin', '12:00:00', '13:00:00', 'Istirahat dan Shalat Dzuhur'),
(33, 'Selasa', 'Prakerin', '13:00:00', '15:00:00', 'Kerja'),
(34, 'Selasa', 'Prakerin', '15:00:00', '15:15:00', 'Istirahat dan Shalat Ashar'),
(35, 'Selasa', 'Prakerin', '15:15:00', '17:00:00', 'Kerja'),
(36, 'Selasa', 'Prakerin', '17:00:00', '17:15:00', 'Briefing Sore'),
(37, 'Selasa', 'Pegawai', '09:30:00', '12:00:00', 'Kerja'),
(38, 'Selasa', 'Pegawai', '12:00:00', '13:00:00', 'Istirahat dan Shalat Dzuhur'),
(39, 'Selasa', 'Pegawai', '13:00:00', '15:00:00', 'Kerja'),
(40, 'Selasa', 'Pegawai', '15:00:00', '15:15:00', 'Istirahat dan Shalat Ashar'),
(41, 'Selasa', 'Pegawai', '15:15:00', '17:00:00', 'Kerja'),
(42, 'Selasa', 'Pegawai', '17:00:00', '17:15:00', 'Briefing Sore'),
(43, 'Rabu', 'Pegawai', '09:30:00', '12:00:00', 'Kerja'),
(44, 'Rabu', 'Pegawai', '12:00:00', '13:00:00', 'Istirahat dan Shalat Dzuhur'),
(45, 'Rabu', 'Pegawai', '13:00:00', '15:00:00', 'Kerja'),
(46, 'Rabu', 'Pegawai', '15:00:00', '15:15:00', 'Istirahat dan Shalat Ashar'),
(47, 'Rabu', 'Pegawai', '15:15:00', '17:00:00', 'Kerja'),
(48, 'Rabu', 'Pegawai', '17:00:00', '17:15:00', 'Briefing Sore'),
(49, 'Rabu', 'Prakerin', '09:30:00', '12:00:00', 'Kerja'),
(50, 'Rabu', 'Prakerin', '12:00:00', '13:00:00', 'Istirahat dan Shalat Dzuhur'),
(51, 'Rabu', 'Prakerin', '13:00:00', '15:00:00', 'Kerja'),
(52, 'Rabu', 'Prakerin', '15:00:00', '15:15:00', 'Istirahat dan Shalat Ashar'),
(53, 'Rabu', 'Prakerin', '15:15:00', '17:00:00', 'Kerja'),
(54, 'Rabu', 'Prakerin', '17:00:00', '17:15:00', 'Briefing Sore'),
(55, 'Kamis', 'Pegawai', '09:00:00', '09:30:00', 'Briefing Pagi'),
(56, 'Kamis', 'Pegawai', '09:30:00', '12:00:00', 'Kerja'),
(57, 'Kamis', 'Pegawai', '12:00:00', '13:00:00', 'Istirahat dan Sholat Dzuhur'),
(58, 'Kamis', 'Pegawai', '13:00:00', '15:00:00', 'Kerja'),
(59, 'Kamis', 'Pegawai', '15:00:00', '15:15:00', 'Istirahat dan Sholat Asar'),
(60, 'Kamis', 'Pegawai', '15:15:00', '17:00:00', 'Kerja'),
(61, 'Kamis', 'Pegawai', '17:00:00', '17:15:00', 'Briefing Sore'),
(62, 'Kamis', 'Prakerin', '09:00:00', '09:30:00', 'Briefing Pagi'),
(63, 'Kamis', 'Prakerin', '09:30:00', '12:00:00', 'Kerja'),
(64, 'Kamis', 'Prakerin', '12:00:00', '13:00:00', 'Istirahat dan Sholat Dzuhur'),
(65, 'Kamis', 'Prakerin', '13:00:00', '15:00:00', 'Kerja'),
(66, 'Kamis', 'Prakerin', '15:00:00', '15:15:00', 'Istirahat dan Sholat Asar'),
(67, 'Kamis', 'Prakerin', '15:15:00', '17:00:00', 'Kerja'),
(68, 'Kamis', 'Prakerin', '17:00:00', '17:15:00', 'Briefing Sore'),
(70, 'Senin', 'Pegawai', '09:00:00', '09:30:00', 'Briefing Pagi'),
(71, 'Rabu', 'Pegawai', '09:00:00', '09:30:00', 'Briefing Pagi'),
(72, 'Sabtu', 'Pegawai', '09:00:00', '09:30:00', 'Briefing Pagi'),
(73, 'Sabtu', 'Pegawai', '09:30:00', '12:00:00', 'Kerja'),
(74, 'Sabtu', 'Pegawai', '12:00:00', '13:00:00', 'Istirahat dan Sholat Dzuhur'),
(75, 'Sabtu', 'Pegawai', '13:00:00', '15:00:00', 'Kerja'),
(76, 'Sabtu', 'Pegawai', '15:00:00', '15:15:00', 'Istirahat dan Sholat Asar'),
(77, 'Sabtu', 'Pegawai', '15:15:00', '17:00:00', 'Kerja'),
(78, 'Sabtu', 'Pegawai', '17:00:00', '17:15:00', 'Briefing Sore'),
(79, 'Sabtu', 'Prakerin', '09:00:00', '09:30:00', 'Briefing Pagi'),
(80, 'Sabtu', 'Prakerin', '09:30:00', '12:00:00', 'Kerja'),
(81, 'Sabtu', 'Prakerin', '12:00:00', '13:00:00', 'Istirahat dan Sholat Dzuhur'),
(82, 'Sabtu', 'Prakerin', '13:00:00', '15:00:00', 'Kerja'),
(83, 'Sabtu', 'Prakerin', '15:00:00', '15:15:00', 'Istirahat dan Sholat Asar'),
(84, 'Sabtu', 'Prakerin', '15:15:00', '17:00:00', 'Kerja'),
(85, 'Sabtu', 'Prakerin', '17:00:00', '17:15:00', 'Briefing Sore'),
(86, 'Jumat', 'Pegawai', '09:00:00', '09:30:00', 'Briefing Pagi'),
(87, 'Jumat', 'Pegawai', '09:30:00', '11:30:00', 'Kerja'),
(88, 'Jumat', 'Pegawai', '11:30:00', '13:00:00', 'Istirahat dan Sholat Dzuhur'),
(89, 'Jumat', 'Pegawai', '13:00:00', '15:00:00', 'Kerja'),
(90, 'Jumat', 'Pegawai', '15:00:00', '15:15:00', 'Istirahat dan Sholat Asar'),
(91, 'Jumat', 'Pegawai', '15:15:00', '17:00:00', 'Kerja'),
(92, 'Jumat', 'Pegawai', '17:00:00', '17:15:00', 'Briefing Sore'),
(93, 'Jumat', 'Prakerin', '09:00:00', '09:30:00', 'Briefing Pagi'),
(94, 'Jumat', 'Prakerin', '09:30:00', '11:30:00', 'Kerja'),
(95, 'Jumat', 'Prakerin', '11:30:00', '13:00:00', 'Istirahat dan Sholat Dzuhur'),
(96, 'Jumat', 'Prakerin', '13:00:00', '15:00:00', 'Kerja'),
(97, 'Jumat', 'Prakerin', '15:00:00', '15:15:00', 'Istirahat dan Sholat Asar'),
(98, 'Jumat', 'Prakerin', '15:15:00', '17:00:00', 'Kerja'),
(99, 'Jumat', 'Prakerin', '17:00:00', '17:15:00', 'Briefing Sore');

-- --------------------------------------------------------

--
-- Table structure for table `libur`
--

CREATE TABLE `libur` (
  `id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `libur`
--

INSERT INTO `libur` (`id`, `tahun`, `content`) VALUES
(5, 2021, '{\"success\":1,\"data\":{\"type\":0,\"year\":2021,\"name\":\"masehi\",\"initial\":\"M\",\"holiday\":{\"1\":{\"count\":1,\"data\":[{\"week\":5,\"type\":\"christ_0001\",\"date\":\"2021-01-01\",\"day\":1,\"name\":\"Tahun Baru Masehi\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"}]},\"2\":{\"count\":1,\"data\":[{\"week\":5,\"type\":\"chinese_0001\",\"date\":\"2021-02-12\",\"day\":12,\"name\":\"Tahun Baru Imlek\",\"info\":\"2572 (Kerbau Logam)\",\"mode\":0,\"rel\":\"China\"}]},\"3\":{\"count\":2,\"data\":[{\"week\":4,\"type\":\"hijri_0004\",\"date\":\"2021-03-11\",\"day\":11,\"name\":\"Isra Miraj Nabi Muhammad SAW\",\"info\":\"1442 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"},{\"week\":0,\"type\":\"hindu_0001\",\"date\":\"2021-03-14\",\"day\":14,\"name\":\"Hari Raya Nyepi (Tahun Baru Saka)\",\"info\":\"1943 Saka\",\"mode\":0,\"rel\":\"Hindu\"}]},\"4\":{\"count\":1,\"data\":[{\"week\":5,\"type\":\"christ_0003\",\"date\":\"2021-04-02\",\"day\":2,\"name\":\"Wafat Yesus Kristus\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"}]},\"5\":{\"count\":5,\"data\":[{\"week\":6,\"type\":\"inter_0001\",\"date\":\"2021-05-01\",\"day\":1,\"name\":\"Hari Buruh Sedunia\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"},{\"week\":4,\"type\":\"christ_0006\",\"date\":\"2021-05-13\",\"day\":13,\"name\":\"Kenaikan Yesus Kristus\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"},{\"week\":4,\"type\":\"hijri_0009\",\"date\":\"2021-05-13\",\"day\":13,\"name\":\"Hari Raya Idul Fitri\",\"info\":\"1442 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"},{\"week\":5,\"type\":\"hijri_0009\",\"date\":\"2021-05-14\",\"day\":14,\"name\":\"Hari Raya Idul Fitri\",\"info\":\"1442 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"},{\"week\":3,\"type\":\"buddha_0001\",\"date\":\"2021-05-26\",\"day\":26,\"name\":\"Hari Raya Waisak\",\"info\":2565,\"mode\":0,\"rel\":\"Buddha\"}]},\"6\":{\"count\":1,\"data\":[{\"week\":2,\"type\":\"indo_0002\",\"date\":\"2021-06-01\",\"day\":1,\"name\":\"Hari Lahir Pancasila\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"}]},\"7\":{\"count\":1,\"data\":[{\"week\":2,\"type\":\"hijri_0012\",\"date\":\"2021-07-20\",\"day\":20,\"name\":\"Hari Raya Idul Adha\",\"info\":\"1442 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"}]},\"8\":{\"count\":2,\"data\":[{\"week\":3,\"type\":\"hijri_0001\",\"date\":\"2021-08-11\",\"day\":11,\"name\":\"Tahun Baru Hijriyah\",\"info\":\"1443 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"},{\"week\":2,\"type\":\"indo_0001\",\"date\":\"2021-08-17\",\"day\":17,\"name\":\"Hari Proklamasi Kemerdekaan RI\",\"info\":\" Ke-76\",\"mode\":0,\"rel\":\"Masehi\"}]},\"9\":{\"count\":0,\"data\":null},\"10\":{\"count\":1,\"data\":[{\"week\":3,\"type\":\"hijri_0003\",\"date\":\"2021-10-20\",\"day\":20,\"name\":\"Maulid Nabi Muhammad SAW\",\"info\":\"1443 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"}]},\"11\":{\"count\":0,\"data\":null},\"12\":{\"count\":1,\"data\":[{\"week\":6,\"type\":\"christ_0008\",\"date\":\"2021-12-25\",\"day\":25,\"name\":\"Hari Raya Natal\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"}]}},\"leave\":{\"1\":{\"count\":0,\"data\":null},\"2\":{\"count\":0,\"data\":null},\"3\":{\"count\":0,\"data\":null},\"4\":{\"count\":0,\"data\":null},\"5\":{\"count\":3,\"data\":[{\"week\":1,\"type\":\"hijri_0009b\",\"date\":\"2021-05-17\",\"day\":17,\"name\":\"Cuti Bersama Hari Raya Idul Fitri\",\"info\":\"1442 Hijriyah\",\"mode\":1,\"rel\":\"Hijriyah\"},{\"week\":2,\"type\":\"hijri_0009b\",\"date\":\"2021-05-18\",\"day\":18,\"name\":\"Cuti Bersama Hari Raya Idul Fitri\",\"info\":\"1442 Hijriyah\",\"mode\":1,\"rel\":\"Hijriyah\"},{\"week\":3,\"type\":\"hijri_0009b\",\"date\":\"2021-05-19\",\"day\":19,\"name\":\"Cuti Bersama Hari Raya Idul Fitri\",\"info\":\"1442 Hijriyah\",\"mode\":1,\"rel\":\"Hijriyah\"}]},\"6\":{\"count\":0,\"data\":null},\"7\":{\"count\":1,\"data\":[{\"week\":1,\"type\":\"hijri_0012a\",\"date\":\"2021-07-19\",\"day\":19,\"name\":\"Cuti Bersama Hari Raya Idul Adha\",\"info\":\"1442 Hijriyah\",\"mode\":1,\"rel\":\"Hijriyah\"}]},\"8\":{\"count\":0,\"data\":null},\"9\":{\"count\":0,\"data\":null},\"10\":{\"count\":0,\"data\":null},\"11\":{\"count\":0,\"data\":null},\"12\":{\"count\":0,\"data\":null}},\"islamic\":{\"1\":{\"count\":3,\"data\":[{\"week\":2,\"type\":\"hijri_0014\",\"date\":\"2021-01-26\",\"day\":26,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":3,\"type\":\"hijri_0014\",\"date\":\"2021-01-27\",\"day\":27,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":4,\"type\":\"hijri_0014\",\"date\":\"2021-01-28\",\"day\":28,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"2\":{\"count\":3,\"data\":[{\"week\":4,\"type\":\"hijri_0014\",\"date\":\"2021-02-25\",\"day\":25,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":5,\"type\":\"hijri_0014\",\"date\":\"2021-02-26\",\"day\":26,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":6,\"type\":\"hijri_0014\",\"date\":\"2021-02-27\",\"day\":27,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"3\":{\"count\":5,\"data\":[{\"week\":4,\"type\":\"hijri_0004\",\"date\":\"2021-03-11\",\"day\":11,\"name\":\"Isra Miraj Nabi Muhammad SAW\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":6,\"type\":\"hijri_0014\",\"date\":\"2021-03-27\",\"day\":27,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":0,\"type\":\"hijri_0014\",\"date\":\"2021-03-28\",\"day\":28,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":1,\"type\":\"hijri_0005\",\"date\":\"2021-03-29\",\"day\":29,\"name\":\"Nisfu Syaban\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":1,\"type\":\"hijri_0014\",\"date\":\"2021-03-29\",\"day\":29,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"4\":{\"count\":2,\"data\":[{\"week\":2,\"type\":\"hijri_0006\",\"date\":\"2021-04-13\",\"day\":13,\"name\":\"Awal Ramadhan\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":4,\"type\":\"hijri_0007\",\"date\":\"2021-04-29\",\"day\":29,\"name\":\"Nuzulul Quran\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"5\":{\"count\":9,\"data\":[{\"week\":1,\"type\":\"hijri_0008\",\"date\":\"2021-05-03\",\"day\":3,\"name\":\"Lailatul Qadr\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":3,\"type\":\"hijri_0008\",\"date\":\"2021-05-05\",\"day\":5,\"name\":\"Lailatul Qadr\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":5,\"type\":\"hijri_0008\",\"date\":\"2021-05-07\",\"day\":7,\"name\":\"Lailatul Qadr\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":0,\"type\":\"hijri_0008\",\"date\":\"2021-05-09\",\"day\":9,\"name\":\"Lailatul Qadr\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":2,\"type\":\"hijri_0008\",\"date\":\"2021-05-11\",\"day\":11,\"name\":\"Lailatul Qadr\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":4,\"type\":\"hijri_0009\",\"date\":\"2021-05-13\",\"day\":13,\"name\":\"Hari Raya Idul Fitri\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":2,\"type\":\"hijri_0014\",\"date\":\"2021-05-25\",\"day\":25,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":3,\"type\":\"hijri_0014\",\"date\":\"2021-05-26\",\"day\":26,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":4,\"type\":\"hijri_0014\",\"date\":\"2021-05-27\",\"day\":27,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"6\":{\"count\":3,\"data\":[{\"week\":4,\"type\":\"hijri_0014\",\"date\":\"2021-06-24\",\"day\":24,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":5,\"type\":\"hijri_0014\",\"date\":\"2021-06-25\",\"day\":25,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":6,\"type\":\"hijri_0014\",\"date\":\"2021-06-26\",\"day\":26,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"7\":{\"count\":8,\"data\":[{\"week\":0,\"type\":\"hijri_0010\",\"date\":\"2021-07-18\",\"day\":18,\"name\":\"Hari Tarwiyah\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":1,\"type\":\"hijri_0011\",\"date\":\"2021-07-19\",\"day\":19,\"name\":\"Hari Wukuf\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":2,\"type\":\"hijri_0012\",\"date\":\"2021-07-20\",\"day\":20,\"name\":\"Hari Raya Idul Adha\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":3,\"type\":\"hijri_0013\",\"date\":\"2021-07-21\",\"day\":21,\"name\":\"Hari Tasyriq\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":4,\"type\":\"hijri_0013\",\"date\":\"2021-07-22\",\"day\":22,\"name\":\"Hari Tasyriq\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":5,\"type\":\"hijri_0013\",\"date\":\"2021-07-23\",\"day\":23,\"name\":\"Hari Tasyriq\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":6,\"type\":\"hijri_0014\",\"date\":\"2021-07-24\",\"day\":24,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":0,\"type\":\"hijri_0014\",\"date\":\"2021-07-25\",\"day\":25,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1442 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"8\":{\"count\":5,\"data\":[{\"week\":2,\"type\":\"hijri_0001\",\"date\":\"2021-08-10\",\"day\":10,\"name\":\"Tahun Baru Hijriyah\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":4,\"type\":\"hijri_0002\",\"date\":\"2021-08-19\",\"day\":19,\"name\":\"Hari Asyura\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":0,\"type\":\"hijri_0014\",\"date\":\"2021-08-22\",\"day\":22,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":1,\"type\":\"hijri_0014\",\"date\":\"2021-08-23\",\"day\":23,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":2,\"type\":\"hijri_0014\",\"date\":\"2021-08-24\",\"day\":24,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"9\":{\"count\":3,\"data\":[{\"week\":1,\"type\":\"hijri_0014\",\"date\":\"2021-09-20\",\"day\":20,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":2,\"type\":\"hijri_0014\",\"date\":\"2021-09-21\",\"day\":21,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":3,\"type\":\"hijri_0014\",\"date\":\"2021-09-22\",\"day\":22,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"10\":{\"count\":4,\"data\":[{\"week\":2,\"type\":\"hijri_0003\",\"date\":\"2021-10-19\",\"day\":19,\"name\":\"Maulid Nabi Muhammad SAW\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":3,\"type\":\"hijri_0014\",\"date\":\"2021-10-20\",\"day\":20,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":4,\"type\":\"hijri_0014\",\"date\":\"2021-10-21\",\"day\":21,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":5,\"type\":\"hijri_0014\",\"date\":\"2021-10-22\",\"day\":22,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"11\":{\"count\":3,\"data\":[{\"week\":4,\"type\":\"hijri_0014\",\"date\":\"2021-11-18\",\"day\":18,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":5,\"type\":\"hijri_0014\",\"date\":\"2021-11-19\",\"day\":19,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":6,\"type\":\"hijri_0014\",\"date\":\"2021-11-20\",\"day\":20,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]},\"12\":{\"count\":3,\"data\":[{\"week\":6,\"type\":\"hijri_0014\",\"date\":\"2021-12-18\",\"day\":18,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":0,\"type\":\"hijri_0014\",\"date\":\"2021-12-19\",\"day\":19,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"},{\"week\":1,\"type\":\"hijri_0014\",\"date\":\"2021-12-20\",\"day\":20,\"name\":\"Puasa Ayyamul Baidl\",\"info\":\"1443 Hijriyah\",\"mode\":2,\"rel\":\"Hijriyah\"}]}},\"longWeekend\":{\"1\":{\"count\":1,\"data\":[{\"week\":5,\"type\":\"christ_0001\",\"date\":\"2021-01-01\",\"day\":1,\"name\":\"Tahun Baru Masehi\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"}]},\"2\":{\"count\":1,\"data\":[{\"week\":5,\"type\":\"chinese_0001\",\"date\":\"2021-02-12\",\"day\":12,\"name\":\"Tahun Baru Imlek\",\"info\":\"2572 (Kerbau Logam)\",\"mode\":0,\"rel\":\"China\"}]},\"3\":{\"count\":0,\"data\":null},\"4\":{\"count\":1,\"data\":[{\"week\":5,\"type\":\"christ_0003\",\"date\":\"2021-04-02\",\"day\":2,\"name\":\"Wafat Yesus Kristus\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"}]},\"5\":{\"count\":1,\"data\":[{\"week\":5,\"type\":\"hijri_0009\",\"date\":\"2021-05-14\",\"day\":14,\"name\":\"Hari Raya Idul Fitri\",\"info\":\"1442 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"}]},\"6\":{\"count\":0,\"data\":null},\"7\":{\"count\":0,\"data\":null},\"8\":{\"count\":0,\"data\":null},\"9\":{\"count\":0,\"data\":null},\"10\":{\"count\":0,\"data\":null},\"11\":{\"count\":0,\"data\":null},\"12\":{\"count\":0,\"data\":null}},\"harpitnas\":{\"1\":{\"count\":0,\"data\":null},\"2\":{\"count\":0,\"data\":null},\"3\":{\"count\":1,\"data\":[{\"week\":4,\"type\":\"hijri_0004\",\"date\":\"2021-03-11\",\"day\":11,\"name\":\"Isra Miraj Nabi Muhammad SAW\",\"info\":\"1442 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"}]},\"4\":{\"count\":0,\"data\":null},\"5\":{\"count\":2,\"data\":[{\"week\":4,\"type\":\"christ_0006\",\"date\":\"2021-05-13\",\"day\":13,\"name\":\"Kenaikan Yesus Kristus\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"},{\"week\":4,\"type\":\"hijri_0009\",\"date\":\"2021-05-13\",\"day\":13,\"name\":\"Hari Raya Idul Fitri\",\"info\":\"1442 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"}]},\"6\":{\"count\":1,\"data\":[{\"week\":2,\"type\":\"indo_0002\",\"date\":\"2021-06-01\",\"day\":1,\"name\":\"Hari Lahir Pancasila\",\"info\":2021,\"mode\":0,\"rel\":\"Masehi\"}]},\"7\":{\"count\":1,\"data\":[{\"week\":2,\"type\":\"hijri_0012\",\"date\":\"2021-07-20\",\"day\":20,\"name\":\"Hari Raya Idul Adha\",\"info\":\"1442 Hijriyah\",\"mode\":0,\"rel\":\"Hijriyah\"}]},\"8\":{\"count\":1,\"data\":[{\"week\":2,\"type\":\"indo_0001\",\"date\":\"2021-08-17\",\"day\":17,\"name\":\"Hari Proklamasi Kemerdekaan RI\",\"info\":\" Ke-76\",\"mode\":0,\"rel\":\"Masehi\"}]},\"9\":{\"count\":0,\"data\":null},\"10\":{\"count\":0,\"data\":null},\"11\":{\"count\":0,\"data\":null},\"12\":{\"count\":0,\"data\":null}}}}');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(18) NOT NULL,
  `nama_pgw` varchar(30) NOT NULL,
  `nik_pgw` varchar(16) DEFAULT NULL,
  `tgl_lahir_pgw` date DEFAULT NULL,
  `jk_pgw` enum('l','p') DEFAULT NULL,
  `telp_pgw` varchar(15) DEFAULT NULL,
  `email_pgw` varchar(30) DEFAULT NULL,
  `alamat_pgw` text DEFAULT NULL,
  `jabatan_pgw` enum('Direktur','General Manager','Project Manager','Admin','Finance','Marketing','Analyst System','Programmer','Designer','Quality Control') DEFAULT NULL,
  `status` enum('Menikah','Belum Menikah') DEFAULT NULL,
  `agama` enum('Islam','Protestan','Katolik','Hindu','Buddha','Khonghucu') DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `tempat_lahir_pgw` varchar(30) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama_pgw`, `nik_pgw`, `tgl_lahir_pgw`, `jk_pgw`, `telp_pgw`, `email_pgw`, `alamat_pgw`, `jabatan_pgw`, `status`, `agama`, `foto`, `tempat_lahir_pgw`, `id_user`) VALUES
('123456789', 'Abu', '123123123123', '2021-10-08', NULL, '123123123123', 'aryadila@gmail.com', '123123123123', 'Quality Control', 'Menikah', 'Protestan', '62.jpg', 'Kabupaten Aceh Timur', 62),
('123456789102345644', 'Arya Dila', '3210200607000079', '2000-04-13', 'p', '086554637364', 'aryadila@gmail.com', 'Cilegon', 'Direktur', 'Menikah', 'Islam', '37.jpg', 'Kabupaten Banyuwangi', 37),
('123456789102345678', 'Deyan Priatama Alpaz', '3210200607000022', '2000-07-06', 'l', '082119942054', 'deyanpriatama@gmail.com', 'Majalengka', 'Programmer', 'Menikah', 'Islam', '33.jpg', 'Kabupaten Majalengka', 33),
('123456789102345680', 'Mohamad Iksan', '3210200607000020', '2000-09-28', 'l', '089764537778', 'mohamadiksan@gmail.com', 'Kuningan', 'Finance', 'Menikah', 'Islam', '36.jpg', 'Kabupaten Kuningan', 36);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `tujuan` enum('Pegawai','Peserta') NOT NULL,
  `judul` varchar(150) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `waktu`, `tujuan`, `judul`, `isi`) VALUES
(1, '2021-10-01 18:26:13', 'Peserta', 'Foto Studio', 'Untuk Peserta Prakerin Yang Ingin Ikut Foto Studio Silahkan Datang Ke Jonas Dan Membayar 30 Ribu/Orang'),
(2, '2021-10-06 09:53:08', 'Pegawai', 'tes', 'tesssss'),
(3, '2021-10-06 09:53:08', 'Peserta', 'tes', 'tesssss');

-- --------------------------------------------------------

--
-- Table structure for table `prakerin`
--

CREATE TABLE `prakerin` (
  `id_prakerin` varchar(18) NOT NULL,
  `nama_prakerin` varchar(30) NOT NULL,
  `tanggal_lahir_prakerin` date DEFAULT NULL,
  `tempat_lahir_prakerin` varchar(30) DEFAULT NULL,
  `jk_prakerin` enum('l','p') DEFAULT NULL,
  `agama_prakerin` enum('Islam','Protestan','Katolik','Hindu','Buddha','Khonghucu') DEFAULT NULL,
  `telp_prakerin` varchar(15) DEFAULT NULL,
  `email_prakerin` varchar(30) DEFAULT NULL,
  `alamat_prakerin` varchar(50) DEFAULT NULL,
  `asal_sekolah` varchar(30) NOT NULL,
  `program_keahlian` varchar(100) NOT NULL,
  `nama_ayah` varchar(30) DEFAULT NULL,
  `telp_ayah` varchar(15) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `telp_ibu` varchar(15) DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `durasi_prakerin` int(2) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `no_sertifikat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prakerin`
--

INSERT INTO `prakerin` (`id_prakerin`, `nama_prakerin`, `tanggal_lahir_prakerin`, `tempat_lahir_prakerin`, `jk_prakerin`, `agama_prakerin`, `telp_prakerin`, `email_prakerin`, `alamat_prakerin`, `asal_sekolah`, `program_keahlian`, `nama_ayah`, `telp_ayah`, `nama_ibu`, `telp_ibu`, `tanggal_mulai`, `durasi_prakerin`, `foto`, `id_user`, `no_sertifikat`) VALUES
('10118140', 'David S. Holm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SMANDA', 'Teknik Informatika', NULL, NULL, NULL, NULL, '2021-10-01', 1, 'avatar.png', 71, 2),
('10118141', 'David S. Holm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UNIKOM', 'Teknik Informatika', NULL, NULL, NULL, NULL, '2021-10-28', 1, 'avatar.png', 73, 3),
('10118148', 'Arya Dila Citra Permata', '2000-04-13', 'Kabupaten Banyuwangi', 'l', 'Islam', '0826177653553', 'aryadila@gmail.com', 'Cilegon', 'UNIKOM', 'Teknik Informatika', 'Kasino', '081324934939', 'Kasina', '089765343552', '2021-09-13', 1, '50.jpg', 50, 0),
('10118161', 'Deyan Priatama Alpaz', '2000-07-06', 'Kabupaten Majalengka', 'l', 'Islam', '082119942054', 'deyanpriatama@gmail.com', 'Majalengka', 'UNIKOM', 'Teknik Informatika', 'Ukon', '081324934939', 'Eti', '089765343552', '2021-09-13', 3, '34.jpg', 34, 1),
('10118176', 'M. Iksan', '2000-09-29', 'Kabupaten Kuningan', 'l', 'Islam', '089647453661', 'iksanbad@gmail.com', 'Kuningan', 'UNIKOM', 'Teknik Informatika', 'Kasino', '081324934939', 'Kasina', '089765343552', '2021-09-13', 1, '52.jpg', 52, 0),
('123123', 'tes', '2021-10-01', 'Kabupaten Alor', 'l', 'Islam', '087808622734', 'aryadilas@gmail.com', 'Link Baru rt4/4 no.157,kec.pulomerak, cilegon bant', 'UNIKOM', 'Teknik Informatika', 'asd', '087808622734', 'asd', '087808622734', '2021-10-01', 2, '77.jpg', 77, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` int(11) NOT NULL,
  `no_sertifikat` varchar(50) NOT NULL,
  `sertifikat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id`, `no_sertifikat`, `sertifikat`) VALUES
(3, 'ai/idm/sertifikat/bulanromawi/tahun', '10118148.pdf'),
(4, '1/IDM/SERTIFIKAT/VIII/2021', '10118148.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(2, 'admin', '$2y$10$F3m.1NwlpZYFcgijda6qjOyQOAfZY.5iljthSQBWGJ7DDJ/9QZKA.', '1'),
(33, '123456789102345678', '$2y$10$K3TU9PHP3vIlpbJK3jfEuuEhciWLePO7KohL/PD9IxLXmz1Msjq4a', '2'),
(34, '10118161', '$2y$10$Va7Y9DGUw6l5J97w6D5LoOkxef6I76CCqaySCaOjT4.XiUS5h0B0G', '3'),
(36, '123456789102345680', '$2y$10$LFmw0hc0j3Mw5eyGJSWQee9GLaj1YOmHsL0cXI.CTuI9WsiCmkX3m', '2'),
(37, '123456789102345644', '$2y$10$d6NhTT1xHQDCej2IcStH7.WVX7ngyiuXgeeURN6c0SX350HM24M/e', '2'),
(50, '10118148', '$2y$10$ZPY2W4cgenYnvS18BOvVL.Wc0x9nlX9KyIWNdI4WpFmjFwBOSgoMO', '3'),
(52, '10118176', '$2y$10$ZfQp.dmJUvjMJI3qJmbOV.ock7jo0ZjuJYVih45QZUU.lhOVjHRlK', '3'),
(62, '123456789', '$2y$10$qsqZ1Gdy9jyjx6ez7zSrneIIqOCyWTefnU4MIIKpyc5zxbm44.4te', '2'),
(71, '10118140', '$2y$10$Fo1d/j8roHx15G03tXMDgunOL3dX4h1122H3AGMrdVc69a43zCxT6', '3'),
(73, '10118141', '$2y$10$pwhzk90n6azsbXV4abw61uZZKZxkBACkV/IbWyxwOUvhiAe4S91M2', '3'),
(77, '123123', '$2y$10$mOBYlJTEwFatsvsF2pMIRusPIGEaYQj9FxVH7waLcKtK6QEnIy.i6', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_pegawai`
--
ALTER TABLE `absen_pegawai`
  ADD PRIMARY KEY (`id_absen_pegawai`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `absen_prakerin`
--
ALTER TABLE `absen_prakerin`
  ADD PRIMARY KEY (`id_absen_prakerin`),
  ADD KEY `id_prakerin` (`id_prakerin`);

--
-- Indexes for table `hasil_prakerin`
--
ALTER TABLE `hasil_prakerin`
  ADD PRIMARY KEY (`id_hasil_prakerin`),
  ADD KEY `id_prakerin` (`id_prakerin`),
  ADD KEY `id_sertifikat` (`id_sertifikat`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libur`
--
ALTER TABLE `libur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prakerin`
--
ALTER TABLE `prakerin`
  ADD PRIMARY KEY (`id_prakerin`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen_pegawai`
--
ALTER TABLE `absen_pegawai`
  MODIFY `id_absen_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `absen_prakerin`
--
ALTER TABLE `absen_prakerin`
  MODIFY `id_absen_prakerin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hasil_prakerin`
--
ALTER TABLE `hasil_prakerin`
  MODIFY `id_hasil_prakerin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `libur`
--
ALTER TABLE `libur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen_pegawai`
--
ALTER TABLE `absen_pegawai`
  ADD CONSTRAINT `absen_pegawai_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `absen_prakerin`
--
ALTER TABLE `absen_prakerin`
  ADD CONSTRAINT `absen_prakerin_ibfk_1` FOREIGN KEY (`id_prakerin`) REFERENCES `prakerin` (`id_prakerin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_prakerin`
--
ALTER TABLE `hasil_prakerin`
  ADD CONSTRAINT `hasil_prakerin_ibfk_1` FOREIGN KEY (`id_prakerin`) REFERENCES `prakerin` (`id_prakerin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_prakerin_ibfk_2` FOREIGN KEY (`id_sertifikat`) REFERENCES `sertifikat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prakerin`
--
ALTER TABLE `prakerin`
  ADD CONSTRAINT `prakerin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
