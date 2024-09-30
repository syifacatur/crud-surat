-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 09:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_spt`
--

CREATE TABLE `form_spt` (
  `id_spt` int(11) NOT NULL,
  `no_spt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dasar_undangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_kegiatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_pulang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_spt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `anggaran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `maksud_tujuan` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIP_penandatangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_spt`
--

INSERT INTO `form_spt` (`id_spt`, `no_spt`, `dasar_undangan`, `lokasi`, `tgl_kegiatan`, `tgl_pulang`, `tgl_spt`, `anggaran`, `maksud_tujuan`, `NIP_penandatangan`, `opsi`) VALUES
(6, '000.1.2.3/355', 'Dokumen Pelaksanaan Anggaran (DPA) BPSDMD Provinsi Jawa Tengah Tahun 2024 Nomor 01891/DPA/2024 APBD Tahun 2024 pada', 'JL. Letjend Suprapto, Ungaran, Kab.Semarang', '5 Juni 2024', '5 Juni 2024', '4 Juni 202', 'Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Menghadiri Desk Revidu Penyusunan Arsitektur SPBE Pemerintah Provinsi Jawa Tengah', '197305011998011001', ''),
(7, '000.1.2.3/355', 'Surat Kepala Dinas Komunikasi dan Informatika Provinsi Jawa Tengah Nomor 005/201 Tanggal 19 April 2024 Hal Undangan Desk Penyusunan Arsitektur SPBE Pemerintah Provinsi Jawa Tengah', 'JL. Letjend Suprapto, Ungaran, Kab.Semarang', '10 Juni 2024', '5 Juni 2024', '4 Juni 2024', '', 'Menghadiri Desk Revidu Penyusunan Arsitektur SPBE Pemerintah Provinsi Jawa Tengah	1', '197305011998011001', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_spt`
--
ALTER TABLE `form_spt`
  ADD PRIMARY KEY (`id_spt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_spt`
--
ALTER TABLE `form_spt`
  MODIFY `id_spt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
