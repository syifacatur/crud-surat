-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 04:42 AM
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
-- Table structure for table `cetak_spt`
--

CREATE TABLE `cetak_spt` (
  `id_cetak` int(11) NOT NULL,
  `cetak_undangan` varchar(255) DEFAULT NULL,
  `cetak_lokasi` varchar(255) DEFAULT NULL,
  `tgl_berangkat` varchar(255) DEFAULT NULL,
  `tgl_pulang` varchar(255) DEFAULT NULL,
  `tgl_spt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `anggaran` varchar(255) DEFAULT NULL,
  `nip_penandatangan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cetak_spt`
--

INSERT INTO `cetak_spt` (`id_cetak`, `cetak_undangan`, `cetak_lokasi`, `tgl_berangkat`, `tgl_pulang`, `tgl_spt`, `anggaran`, `nip_penandatangan`) VALUES
(2, 'Surat Sekretaris Daerah Provinsi Jawa Tengah Nomor 000.8.3/261 Tanggal 29 Mei 2024.Hal Desk Pengisian Aplikasi Metal', 'JL. Letjend Suprapto, Ungaran, Kab.Semarang	5 Juni ', '5 Juni 2024', '5 Juni 2024', '5 Juni 2024', '3', '197305011998011001');

-- --------------------------------------------------------

--
-- Table structure for table `cetak_surat`
--

CREATE TABLE `cetak_surat` (
  `id_surat` int(11) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cetak_surat`
--

INSERT INTO `cetak_surat` (`id_surat`, `deskripsi`) VALUES
(1, 'Peraturan Menteri Dalam Negeri Nomor 77 Tahun 2020 tentang Pedoman Teknis Pengelolaan Keuangan Daerah (Berita Negara Republik Indonesia Tahun 2020 Nomor 1781);'),
(3, 'Peraturan Menteri Dalam Negeri Nomor 15 Tahun 2023 tentang Pedoman Penyusunan Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2024(Berita Negara Republik Indonesia Tahun 2023 Nomor 799);'),
(4, 'Peraturan Daerah Provinsi Jawa Tengah Nomor 14 Tahun 2023 tentang Anggaran Pendapatan dan Belanja Daerah Tahun 2024,(Lembaran Daerah Provinsi Jawa Tengah Tahun 2023 Nomor 14);'),
(5, 'Peraturan Gubernur Jawa Tengah Nomor 62 Tahun 2023 tentang Penjabaran Anggaran Pendapatan dan Belanja Daerah Tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 62);'),
(6, 'Peraturan Gubernur Jawa Tengah Nomor 63 Tahun 2023 tentang Pedoman Pelaksanaan Anggaran Pendapatan dan Belanja Daerah tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 63);'),
(7, 'Dokumen Pelaksanaan Anggaran (DPA) BPSDMD Provinsi Jawa Tengah Tahun 2024 Nomor 01891/DPA/2024 APBD Tahun 2024 pada Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD;	'),
(8, 'Surat Sekretaris Daerah Provinsi Jawa Tengah Nomor 000.8.3/261 Tanggal 29 Mei 2024.Hal Desk Pengisian Aplikasi Metal       ');

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `kode_produk`, `nama_produk`) VALUES
(18, 'Peraturan Menteri Dalam Negeri Nomor 77 Tahun 2020 tentang Pedoman Teknis Pengelolaan Keuangan Daerah (Berita Negara Republik Indonesia Tahun 2020 Nomor 1781);', ''),
(19, 'Peraturan Menteri Dalam Negeri Nomor 15 Tahun 2023 tentang Pedoman Penyusunan Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2024(Berita Negara Republik Indonesia Tahun 2023 Nomor 799);', ''),
(21, 'Peraturan Daerah Provinsi Jawa Tengah Nomor 14 Tahun 2023 tentang Anggaran Pendapatan dan Belanja Daerah Tahun 2024,(Lembaran Daerah Provinsi Jawa Tengah Tahun 2023 Nomor 14);', ''),
(22, 'Peraturan Gubernur Jawa Tengah Nomor 62 Tahun 2023 tentang Penjabaran Anggaran Pendapatan dan Belanja Daerah Tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 62);', ''),
(23, 'Peraturan Gubernur Jawa Tengah Nomor 63 Tahun 2023 tentang Pedoman Pelaksanaan Anggaran Pendapatan dan Belanja Daerah tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 63);', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `user_role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `user_role`) VALUES
(1, 'admin', 'admin', 'Admin', 'admin'),
(13, 'syifa', 'catur', 'syifa catur', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cetak_spt`
--
ALTER TABLE `cetak_spt`
  ADD PRIMARY KEY (`id_cetak`);

--
-- Indexes for table `cetak_surat`
--
ALTER TABLE `cetak_surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `form_spt`
--
ALTER TABLE `form_spt`
  ADD PRIMARY KEY (`id_spt`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cetak_spt`
--
ALTER TABLE `cetak_spt`
  MODIFY `id_cetak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cetak_surat`
--
ALTER TABLE `cetak_surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `form_spt`
--
ALTER TABLE `form_spt`
  MODIFY `id_spt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
