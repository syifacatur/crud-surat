-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Sep 2024 pada 05.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wma_baru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `bulan` int(2) NOT NULL DEFAULT 0,
  `tahun` int(2) NOT NULL DEFAULT 0,
  `jumlah` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Trigger `tb_penjualan`
--
DELIMITER $$
CREATE TRIGGER `delete_peramalan_after_delete` AFTER DELETE ON `tb_penjualan` FOR EACH ROW BEGIN
    DELETE FROM tb_peramalan WHERE id_produk = OLD.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_peramalan_after_insert` AFTER INSERT ON `tb_penjualan` FOR EACH ROW BEGIN
    DELETE FROM tb_peramalan WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peramalan`
--

CREATE TABLE `tb_peramalan` (
  `id_peramalan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `bulan` int(2) NOT NULL DEFAULT 0,
  `tahun` int(2) NOT NULL DEFAULT 0,
  `bobot` int(11) NOT NULL DEFAULT 0,
  `hasil` varchar(10) NOT NULL DEFAULT '?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `kode_produk`, `nama_produk`) VALUES
(8, 'Peraturan Menteri Dalam Negeri Nomor 15 Tahun 2023 tentang Pedoman Penyusunan Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2024 (Berita Negara Republik Indonesia Tahun  2023 Nomor 799);', ''),
(9, 'Peraturan Daerah Provinsi Jawa Tengah Nomor 14 Tahun 2023 tentang Anggaran Pendapatan dan Belanja Daerah Tahun 2024,(Lembaran Daerah Provinsi Jawa Tengah Tahun 2023 Nomor 14);', ''),
(10, 'Peraturan Gubernur Jawa Tengah Nomor 62 Tahun 2023 tentang Penjabaran Anggaran Pendapatan dan Belanja Daerah Tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 62);', ''),
(11, 'Peraturan Gubernur Jawa Tengah Nomor 63 Tahun 2023 tentang Pedoman Pelaksanaan Anggaran Pendapatan dan Belanja Daerah tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 63);', ''),
(12, 'Dokumen Pelaksanaan Anggaran (DPA) BPSDMD Provinsi Jawa Tengah Tahun 2024 Nomor 01891/DPA/2024 APBD Tahun 2024 pada Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD;', ''),
(13, 'Surat Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah No 892.1/11721 Hal Penyelenggaraan Orientasi bagi Anggota DPRD Kab/Kota di Jawa Tengah Tahun 2024 ', ''),
(14, 'Peraturan Menteri Dalam Negeri Nomor 77 Tahun 2020 tentang Pedoman Teknis Pengelolaan Keuangan Daerah (Berita Negara Republik Indonesia Tahun 2020 Nomor 1781);', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_uji`
--

CREATE TABLE `tb_uji` (
  `id_uji` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kehamilan` int(11) NOT NULL DEFAULT 0,
  `glukosa` int(11) NOT NULL DEFAULT 0,
  `tensi` int(11) NOT NULL DEFAULT 0,
  `kulit` int(11) NOT NULL DEFAULT 0,
  `insulin` int(11) NOT NULL DEFAULT 0,
  `bmi` float NOT NULL DEFAULT 0,
  `silsilah` float NOT NULL DEFAULT 0,
  `usia` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT '?'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_uji`
--

INSERT INTO `tb_uji` (`id_uji`, `nama`, `kehamilan`, `glukosa`, `tensi`, `kulit`, `insulin`, `bmi`, `silsilah`, `usia`, `status`) VALUES
(15, 'Fadhilah Maysarah', 3, 145, 94, 33, 26, 42.7, 0.145, 26, '0'),
(16, 'Elisabeth', 3, 100, 66, 20, 90, 33, 0.85, 28, '0'),
(25, 'ibnu', 0, 195, 122, 1, 300, 30.5, 0.158, 54, '1'),
(26, 'lisa', 1, 1, 1, 1, 1, 1, 1, 1, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `user_role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `user_role`) VALUES
(1, 'admin', 'admin', 'Admin', 'admin'),
(13, 'syifa', 'catur', 'syifa catur', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `tb_penjualan_ibfk_1` (`id_produk`);

--
-- Indeks untuk tabel `tb_peramalan`
--
ALTER TABLE `tb_peramalan`
  ADD PRIMARY KEY (`id_peramalan`),
  ADD KEY `tb_peramalan_ibfk_1` (`id_produk`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_uji`
--
ALTER TABLE `tb_uji`
  ADD PRIMARY KEY (`id_uji`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=688;

--
-- AUTO_INCREMENT untuk tabel `tb_peramalan`
--
ALTER TABLE `tb_peramalan`
  MODIFY `id_peramalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_uji`
--
ALTER TABLE `tb_uji`
  MODIFY `id_uji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_peramalan`
--
ALTER TABLE `tb_peramalan`
  ADD CONSTRAINT `tb_peramalan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
