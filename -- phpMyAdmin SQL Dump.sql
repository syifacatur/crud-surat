-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2024 pada 05.02
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
-- Database: `crud-surat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cetak_laporan`
--

CREATE TABLE `cetak_laporan` (
  `id_laporan` int(11) NOT NULL,
  `nama_spt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nip_spt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pangkat_spt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jabatan_spt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cetak_spt`
--

CREATE TABLE `cetak_spt` (
  `id_cetak` int(11) NOT NULL,
  `cetak_undangan` varchar(255) DEFAULT NULL,
  `cetak_lokasi` varchar(255) DEFAULT NULL,
  `tgl_berangkat` varchar(255) DEFAULT NULL,
  `tgl_pulang` varchar(255) DEFAULT NULL,
  `tgl_spt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `anggaran` varchar(255) DEFAULT NULL,
  `nip_penandatangan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pangkat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cetak_spt`
--

INSERT INTO `cetak_spt` (`id_cetak`, `cetak_undangan`, `cetak_lokasi`, `tgl_berangkat`, `tgl_pulang`, `tgl_spt`, `anggaran`, `nip_penandatangan`, `nama`, `NIP`, `pangkat`, `jabatan`) VALUES
(2, 'Surat Sekretaris Daerah Provinsi Jawa Tengah Nomor 000.8.3/261 Tanggal 29 Mei 2024.Hal Desk Pengisian Aplikasi Metal', 'JL. Letjend Suprapto, Ungaran, Kab.Semarang	5 Juni ', '5 Juni 2024', '5 Juni 2024', '5 Juni 2024', '3', '197305011998011001', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cetak_surat`
--

CREATE TABLE `cetak_surat` (
  `id_surat` int(11) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cetak_surat`
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
-- Struktur dari tabel `daftar_nama`
--

CREATE TABLE `daftar_nama` (
  `id_nama` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pangkat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar_nama`
--

INSERT INTO `daftar_nama` (`id_nama`, `nama`, `NIP`, `pangkat`, `jabatan`) VALUES
(87, 'Ir. YATNO ISWORO, MP', '196410101999031002', 'Pembina Utama (IV/E)', '  WIDYAISWARA AHLI UTAMA   '),
(88, 'Dr.Ir. KRISTIYO SUMARWONO, M.Sc.', '196001111986031010', 'Pembina Utama Madya (IV/D)', '  WIDYAISWARA AHLI UTAMA   '),
(89, 'Ir. WARDI ASTUTI, M.Pd.', '196608181992032015', 'Pembina Utama (IV/E)', '  WIDYAISWARA AHLI UTAMA   '),
(91, 'Drs. SISWANTA JAKA PURNAMA, Apt.,M.Kes.', '196310281989111001', 'Pembina Utama (IV/E)', '  WIDYAISWARA AHLI UTAMA   '),
(92, 'Dr. Ir. SUPRIYANTO, M.Si.', '196205171991031004', 'Pembina Utama Madya (IV/D)', '  WIDYAISWARA AHLI UTAMA   '),
(93, 'GIGUS NURYATNO, A.Pi.,M.A.P.', '196708221991031011', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(94, 'WAHJU WIDIARSIH, ST.,M.Pi.', '196706071998032001', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MUDA'),
(95, 'DWI TITI SUNDARI, SKM.,M.Kes.', '196512131988032004', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MADYA'),
(96, 'HARINI SETIJOWATI, SKM., M.HSc.', '196811091993032005', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(97, 'Dra. SITI AMINAH ZURIAH, MM.', '196701181993032003', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MUDA'),
(98, 'SODIKIN, SS., M.Si.', '196803241998031002', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(99, 'Drs. SUMARNO, M.SI.', '196807041988031003', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(100, 'DIYAH MUBAROKAH AKHADIYATI, S.Pi.,M.Pi.', '196901091997032002', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(101, 'SRIYATUN, S.Kep.,MM. ', '196901121989032005', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(102, 'ARIF EFENDY, SH.,MM. ', '196911021990031003', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MUDA'),
(103, 'Drs. HERU GUNAWAN, M.M', '196911091990031006', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(104, 'AGUS ANDRIYANTO, S.Sos.,MM.', '197008241995031002', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(105, 'KRISTIANA WIDIAWATI, S.Pi.,MT.', '197112041999032007', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(106, 'Drs. PAMUNGKAS TUNGGUL WASANA, M.Si', '197301101992031001', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(107, 'IKBAL KHAFID, S.IP.,M.Si', '196705041986031002', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(108, 'MUHAMMAD ALAZIZ, S.E.,M.M', '197003142005011008', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(109, 'AGUS PUJIANTO, SH.MM', '197008101994031004', 'Penata Tingkat I (III/D)', 'WIDYAISWARA AHLI PERTAMA'),
(110, 'TRI MARDIYANTI RATNASARI, SE.,Macc.', '197103171997032005', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MUDA'),
(111, 'Dra. NILA AGUSTINA, M.P.A', '197608171999032005', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(113, 'MUCHAMAD RIZAL, ST.,M.Sc.,M.Eng.', '198008272005011010', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MUDA'),
(114, 'Dr. ERNI IRAWATI, S.E.,M.Pd.', '197308292009012002', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(115, 'EDI WINARNO A S, S.T.,M.Kom.', '197502022005011004', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MUDA'),
(116, 'ANDIS TRIYANTO, S.KM.,M.Kes.', '197505041999031006', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MADYA'),
(117, 'YUNI INDARTI, S.Sos., M.M', '197906202009012003', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MUDA'),
(118, 'ABDUL MANAN, S.Pd.,MM.', '197906202009012003', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MUDA'),
(119, 'NUNI PURWATI', '197312102007012010', 'Pengatur Muda (II/A)', 'Pramu Bakti'),
(120, 'LILIK BUDI IRWANTO, S.Sos.,M.P.A', '197707222010011014', 'Penata Tingkat I (III/D)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(121, 'ISMU PANDOYO, S.I.Kom.', '197410142008011005', 'Penata (III/C)', 'Analis Program Diklat '),
(122, 'KURNIAWAN SETYADHI', '198305062009011006', 'Pengatur Tingkat I (II/D)', 'Pengadministrasi Umum '),
(124, 'IMAROH YUNIANA, S.Mn.,MM.', '196906161994032006', 'Pembina(IV/A)', 'Analis Program Diklat '),
(125, 'YUNI INDARTI, S.Sos., M.M', '197506021994032001', 'Penata Tingkat I (III/D)', 'Pengolah Data Anggaran dan Perbendaharaan  '),
(126, 'Rr. ASTUTI EKAWATI, SE.', '198112112010012029', 'Penata Tingkat I (III/D)', 'Pengolah Data Anggaran dan Perbendaharaan  '),
(128, 'MUHLISIN', '198011082007011004', 'Penata Muda (III/A)', 'Pengelola Penyelenggaraan Diklat '),
(129, 'NATALIA HERIANY, S.Psi.', '197910012005012014', 'Penata Tingkat I (III/D)', 'Analis Jabatan '),
(130, 'EKA WATININGSIH, S.Pd.', '197811182008012012', 'Penata Tingkat I (III/D)', 'Bendahara '),
(131, 'RATEH ARIYANI, SH.', '197309072008012005', 'Penata Tingkat I (III/D)', 'Pustakawan Ahli Muda  '),
(132, 'SRI MOERDJIJATOEN', '196802112007012020', 'Penata Muda (III/A)', 'Pengadministrasi Pelatihan '),
(133, 'ADJI SURYA PRATAMA, SH', '198201102014061003', 'Penata Muda Tingkat I (III/B)', 'Pengelola Layanan Kehumasan'),
(134, 'BAYU CANDRA PERKASA, S.STP.,M.Sc.', '199302062015071001', 'Penata (III/C)', 'Analis Kompetensi '),
(135, 'SUPARNO, SH.', '197504152007011013', 'Penata Muda (III/A)', 'Pengelola Penyelenggaraan Diklat '),
(137, 'PURWANTO, SH.', '197708092007011009', 'Penata Muda Tingkat I (III/B)', 'Analis Program Diklat '),
(138, 'RONY HERYANTO', '197810152007011027', 'Pengatur Tingkat I (II/D)', 'Pengadministrasi Pelatihan '),
(139, 'SUROSO, SH.', '197405302006041013', 'Penata Muda (III/A)', 'Pengelola Kepegawaian '),
(140, 'LASTIYO', '197305112008011008', 'Penata Muda (III/A)', 'Pengadministrasi Umum '),
(141, 'JAUHARI', '196901012010011003', 'Pengatur Tingkat I (II/D)', 'Penjaga Asrama '),
(142, 'NURHADI', '196807222007011004', 'Pengatur (II/C)', 'Penjaga Asrama '),
(143, 'ANWAR', '197004042010011003', 'Pengatur Tingkat I (II/D)', 'Pengadministrasi Umum '),
(144, 'LULUS', '198302012010011001', 'Pengatur Tingkat I (II/D)', 'Pengadministrasi Umum '),
(145, 'SUTARMO', '196907092007011015', 'Pengatur Muda Tingkat I (II/B)', 'Teknisi Listrik  '),
(146, 'KANDAR', '197104232010011002', 'Juru Tingkat I (I/D)', 'Pramu Kebersihan   '),
(147, 'PARIDI', '197607162009011008', 'Pengatur Muda (II/A)', 'Pengadministrasi Pelatihan '),
(148, 'ITA KARTIKA, S.Kom', '197812182002122004', 'Penata Tingkat I (III/D)', 'Pengolah Data Anggaran dan Perbendaharaan  '),
(149, 'MARINI HASID, S.STP., M.M.', '198304282003122001', 'Pembina(IV/A)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(150, 'YULIUS SAPTA SETIAJI, SH', '196705281992101001', 'Penata Tingkat I (III/D)', 'Pengelola Penyelenggaraan Diklat '),
(151, 'MUNTOHA', '196807272007011022', 'Pengatur Muda Tingkat I (II/B)', 'Pengadministrasi Umum '),
(152, 'MOCHAMAD SAID, S.H.', '196712031987031003', 'Penata Tingkat I (III/D)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(153, 'EKA YUNITA DESARI, S.S., M.Si', '197104191995032002', 'Pembina(IV/A)', 'Analis Program Diklat '),
(154, 'SARTONO', '196804102009011006', 'Pengatur Tingkat I (II/D)', 'Pengadministrasi Pelatihan '),
(155, 'HENDRIYANI MUKHTAR, SE, M.Si', '196901311996012001', 'Pembina(IV/A)', 'Analisis Pengembangan Kompetensi'),
(156, 'ATTHATHUR MASSALENA AM, SE, MM', '197607162010011003', 'Penata Tingkat I (III/D)', ' Kepala Sub Bagian Umum dan Kepegawaian    '),
(157, 'JAKA MUJIHANA, S.Pd., M.M.', '197305192002121002', 'Penata (III/C)', 'Analis Jabatan '),
(158, 'DINAR KURNIAWAN , S.STP', '198603112004121001', 'Penata (III/C)', 'Pengadministrasi Pelatihan '),
(159, 'Dra. HERAWATI WIDYARINI, MM', '196908171996032004', 'Pembina(IV/A)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(160, 'SUDIBYO BUDI SETYAWAN, S.E.', '197901062010011005', 'Penata Muda Tingkat I (III/B)', '  Pengelola Barang Milik Negara   '),
(161, 'V. WINARTI AGUSTININGTYAS, SH, M.Si', '197008171995032006', 'Pembina(IV/A)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(162, 'GIGIH HARYONO, SH', '197306011994031010', 'Penata Tingkat I (III/D)', 'Analis Kompetensi '),
(163, 'HARI WIDADA', '197003272008011004', 'Penata Muda (III/A)', 'Pengadministrasi Pelatihan '),
(164, 'MOH SAMSUDIN', '197003252008011005', 'Pengatur Tingkat I (II/D)', 'Pengadministrasi Pelatihan '),
(165, 'MUSTARI, SH, MH.', '197510272005011005', 'Pembina(IV/A)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(166, 'DIAN AL RIZKY AGUSTIN, A.Md.', '198301072009121002', 'Penata Tingkat I (III/D)', 'Analis Program Diklat '),
(167, 'SUKARDI', '197103272007011007', 'Pengatur (II/C)', 'Penjaga Asrama '),
(168, 'ROHMY IRMA ASTUTI, SE', '197504202006042018', 'Penata Tingkat I (III/D)', 'Pengolah Data Anggaran dan Perbendaharaan  '),
(169, 'Dr. ENDANG RIAGUSTRIANINGSIH N, S.IP, M.Pd', '198208162010012020', 'Pembina(IV/A)', 'WIDYAISWARA AHLI MADYA'),
(170, 'ANDI SURYANTO, S.STP., M.Si.', '197804101997031005', 'Pembina Tingkat I (IV/B)', '  Sekretaris   '),
(171, 'ANDI SETIAWAN, SH, MH.', '197205091991031005', 'Pembina(IV/A)', '  Penyusun Program Anggaran dan Pelaporan    '),
(172, 'AMANDA SORAYA, S.Psi', '198007262010012010', 'Penata Tingkat I (III/D)', 'Bendahara '),
(173, 'ARI DHAMAYANTI, M.Psi', '197811192010012008', 'Pembina(IV/A)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(174, 'HASTIN ARFIANI, SH', '196910011994012001', 'Penata Tingkat I (III/D)', 'Pengelola Penyelenggaraan Diklat '),
(175, 'SUHARTO, SE, M.Si', '196806101998031006', 'Pembina(IV/A)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(176, 'JUMADI', '196808182007011023', 'Pengatur Tingkat I (II/D)', 'Pengadministrasi Pelatihan '),
(177, 'ANDIKA HIDAYAT ADI, S.Kom.', '199406172019021008', 'Penata Muda (III/A)', '  Pengelola Barang Milik Negara   '),
(178, 'RIDWAN NUGRAHA PASA, S.STP.', '199203192014061002', 'Penata Muda (III/A)', 'Pengadministrasi Umum '),
(179, 'ARIS GUNAWAN', '196912171992121001', 'Penata Muda Tingkat I (III/B)', 'Pengadministrasi Pelatihan '),
(180, 'SUDIRMAN MUSTAFA, S.H., M.Hum.', '196209161995011001', 'Pembina Utama (IV/E)', '  WIDYAISWARA AHLI UTAMA   '),
(181, 'SUTARDI, A.Pi., M.M.A.', '196005311985031005', 'Pembina Utama (IV/E)', '  WIDYAISWARA AHLI UTAMA   '),
(182, 'ARIF RACHMAN, SP, MPP,M.Ec.Dev', '197506252000031002', 'Pembina(IV/A)', '  Pengembang Teknologi Pembelajaran Ahli Muda    '),
(183, 'NUNUNG NURJANAH, SE,M.Si', '197410161994032002', 'Pembina(IV/A)', 'Analis Program Diklat '),
(184, 'SRI MARYUNI, S.Pd, MM', '197306081993032003', 'Penata Tingkat I (III/D)', 'Analisis Pengembangan Kompetensi ASN Ahli Muda '),
(185, 'SAGUNG ISTIONO, SE.Ak,M.Si', '198006212010011022', 'Penata Tingkat I (III/D)', '  KASUBBAG KEUANGAN    '),
(186, 'Drs. SUDARYANTO, M.Si.', '196005121989031012', 'Pembina Utama Madya (IV/D)', '  WIDYAISWARA AHLI UTAMA   '),
(187, 'MARIA SUSIAWATI, S.Sos.,MPA', '196505221986032013', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(188, 'H. SANTOSA, S.KEP,MM', '197212101992031004', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(189, 'SENNA VIRGIAWAN, S.STP', '199306202016091001', 'Penata (III/C)', '  Penyusun Program Anggaran dan Pelaporan    '),
(190, 'ANI YULIYATI, A.Md.', '198707132020122004', 'Pengatur (II/C)', 'Pengelola Kepegawaian '),
(191, 'PRIMA MAHARDIKA PUTRA, S.A.P', '199608162020121002', 'Penata Muda (III/A)', 'Analis Program Diklat '),
(192, 'ZAROH LAILATUL CHANIFAH, S.Pd.', '199312092020122013', 'Penata Muda (III/A)', '  Analisis Kurikulum dan Pembelajaran    '),
(193, 'CHINTIA PRAHESTI YUGATPUTRI, A.Md.', '199804282020122002', 'Pengatur (II/C)', '  Verifaktor Data Laporan Keuangan   '),
(194, 'FERZI EDI WARDOYO, A.Md', '199307172020121004', 'Pengatur (II/C)', '   Pengelola Sarana dan Prasarana Kantor   '),
(195, 'ERMIN KARTI ANDARI, A.Md', '198509042020122003', 'Pengatur (II/C)', 'Pengelola Penyelenggaraan Diklat '),
(196, 'EKA WIDIYANI, S.Pd.', '199507232020122005', 'Penata Muda (III/A)', '  Analis Mutu Pendidikan   '),
(197, 'DIAN AL RIZKY AGUSTIN, A.Md.', '199608222020121007', 'Pengatur (II/C)', 'Pengelola Penyelenggaraan Diklat '),
(198, 'RUDI SANTOSO ADI, S.IP.', '198712092020121006', 'Penata Muda (III/A)', '   Analis Kerjasama Diklat   '),
(199, 'Dra. MUKAROMAH SYAKOER, M.M', '196102171985032008', 'Pembina Utama Madya (IV/D)', '  WIDYAISWARA AHLI UTAMA   '),
(200, 'Dr. SUDALMA, S.Si., M.Si.', '197003021998031009', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(201, 'AGUS SUPRIYANTO, S.E., M.M.', '197608052005011008', 'Penata (III/C)', 'Analis Program Diklat '),
(202, 'Ir. H. YOYON INDRAYANA, MT', '196607221993011001', 'Pembina Utama Muda (IV/C)', 'WIDYAISWARA AHLI MADYA'),
(203, 'MELATI KRISTANTI, A.Md.', '199211222020122009', 'Pengatur (II/C)', 'Pengelola Penyelenggaraan Diklat '),
(204, 'SUMARHENDRO, S.Sos', '196709221998031006', 'Pembina Tingkat I (IV/B)', '  KEPALA BIDANG PENGEMBANGAN KOMPETENSI TEKNIS   '),
(205, 'ADITYA IIP WISUDAWAN NUGROHO, S.STP, M.Si', '198710052006021003', 'Penata Tingkat I (III/D)', '   KEPALA SUB BAGIAN PROGRAM    '),
(206, 'HENDRI SANTOSA, SE, Ak, M.Si. CA', '196112261983031001', 'Pembina Utama Madya (IV/D)', '  WIDYAISWARA AHLI UTAMA   '),
(207, 'SRI SULISTIYATI, SE, M.Kom', '197001121992032006', 'Pembina Tingkat I (IV/B)', '  KEPALA BIDANG SERTIFIKASI KOMPETENSI DAN PENJAMINAN MUTU   '),
(208, 'RINI KUSWARDANI, S.E', '198908192022032003', 'Penata Muda (III/A)', '  Penyusun Program Anggaran dan Pelaporan    '),
(209, 'ASA BANI CHITARA, A.Md.Kb.N.', '199901222022012001', 'Pengatur (II/C)', 'Pengelola Penyelenggaraan Diklat '),
(210, 'AZKY ILAHI RATU CONSINA, A.Md.Ak.', '200002252022012002', 'Pengatur (II/C)', '  Pengelola Barang Milik Negara   '),
(211, 'NOPRI PRIANTO, S.Pd.', '199811052022031003', 'Penata Muda (III/A)', '  Analis Mutu Pendidikan   '),
(212, 'NUR SAFIRAH ADLINA, S.Hum', '199703252022032009', 'Penata Muda (III/A)', '  Ahli Pertama - Arsiparis   '),
(213, 'ILHAM HABIBULLAH AKBAR, S.KOM', '199607192022031008', 'Penata Muda (III/A)', '  Ahli Pertama - Pranata Komputer    '),
(214, 'Drs. HARI KUNTJORO, S.Sos, M.Si', '197012141991011001', 'Pembina Utama Muda (IV/C)', '  Analis Mutu Pendidikan   '),
(215, 'Drs. EKO SUPRAYITNO, MM', '196709251993031004', 'Pembina Tingkat I (IV/B)', 'WIDYAISWARA AHLI MADYA'),
(216, 'INDRA ADI NUGROHO, S.ST.', '198704192008121001', 'Penata (III/C)', 'Pengelola Penyelenggaraan Diklat '),
(217, 'Dr. SADIMIN, S.Pd., M.Eng.', '197212061994121001', 'Pembina Utama Madya (IV/D)', '  KEPALA BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH   '),
(218, 'Dr. ANON PRIYANTORO, S.Pd., M.Pd.', '197305011998011001', 'Pembina Tingkat I (IV/B)', '  KABID PENGEMBANGAN KOMPETENSI JABATAN FUNGSIONAL    '),
(220, 'FREIDA TRIASTUTI RATNA JATI, S.E.', '199008232024212004', 'Golongan IX', '  ANALISIS PENGEMBANGAN KOMPETENSI ASN   '),
(221, 'VITA DWI IRMAWATI, S.Sos.', '199505202024212010', 'Golongan IX', '  ANALISIS PENGEMBANGAN KOMPETENSI ASN   '),
(222, 'SYLVI PANAMASARI, S.Psi', '198901272024212005', 'Golongan IX', '  ANALISIS PENGEMBANGAN KOMPETENSI ASN   '),
(223, 'HENDRA SUGIARTO, S.E.', '198405252024211003', 'Golongan IX', '  ANALISIS PENGEMBANGAN KOMPETENSI ASN   '),
(224, 'DHARU PUNJUNG WIJAYA, SAP, M.Si', '198605082009121003', 'Penata (III/C)', '  Analisis Kurikulum dan Pembelajaran    ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_nama`
--

CREATE TABLE `form_nama` (
  `id_nama` int(11) NOT NULL,
  `id_spt` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `pangkat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_spt`
--

CREATE TABLE `form_spt` (
  `id_spt` int(11) NOT NULL,
  `no_spt` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dasar_undangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kab_kota` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `tgl_pulang` date NOT NULL,
  `tgl_spt` date NOT NULL,
  `anggaran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `maksud_tujuan` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NIP_penandatangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `form_spt`
--

INSERT INTO `form_spt` (`id_spt`, `no_spt`, `dasar_undangan`, `lokasi`, `kab_kota`, `tgl_kegiatan`, `tgl_pulang`, `tgl_spt`, `anggaran`, `maksud_tujuan`, `NIP_penandatangan`, `opsi`) VALUES
(6, '000.1.2.3/355', 'Dokumen Pelaksanaan Anggaran (DPA) BPSDMD Provinsi Jawa Tengah Tahun 2024 Nomor 01891/DPA/2024 APBD Tahun 2024 pada ', 'JL. Letjend Suprapto,Ungaran', 'Bandung', '2024-04-24', '2024-04-26', '2024-04-24', 'Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Menghadiri Desk Revidu Penyusunan Arsitektur SPBE Pemerintah Provinsi Jawa Tengah ', 'KEPALA BADAN PENGEMBANGAN SUMBER DAYA \r\nMANUSIA DAERAH PROVINSI JAWA TENGAH\r\n\r\n\r\n\r\n\r\n\r\n\r\nDr. SADIMIN, S.Pd., M.Eng\r\nPembina Utama Madya\r\nNIP. 197212061994121001\r\n\r\n\r\n', ''),
(7, '000.1.2.3/355', 'Surat Kepala Dinas Komunikasi dan Informatika Provinsi Jawa Tengah Nomor 005/201 Tanggal 19 April 2024 Hal Undangan Desk Penyusunan Arsitektur SPBE Pemerintah Provinsi Jawa Tengah', 'JL. Letjend Suprapto, Ungaran', 'Bandung', '2024-04-28', '2024-04-29', '2024-10-02', 'Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 'Menghadiri Desk Revidu Penyusunan Arsitektur SPBE Pemerintah Provinsi Jawa Tengah	1', 'Kabid Pengembangan Kompetensi \r\nJabatan Fungsional\r\n\r\n\r\n\r\n\r\n\r\n\r\nDr. Anon Priyantoro, S.Pd., M.Pd\r\nPembina Tingkat I\r\nNIP. 197305011998011001\r\n\r\n\r\n', '');

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
(18, 'Peraturan Menteri Dalam Negeri Nomor 77 Tahun 2020 tentang Pedoman Teknis Pengelolaan Keuangan Daerah (Berita Negara Republik Indonesia Tahun 2020 Nomor 1781); Peraturan Menteri Dalam Negeri Nomor 77 Tahun 2020 tentang Pedoman Teknis Pengelolaan Keuangan ', ''),
(19, 'Peraturan Menteri Dalam Negeri Nomor 15 Tahun 2023 tentang Pedoman Penyusunan Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2024(Berita Negara Republik Indonesia Tahun 2023 Nomor 799);', ''),
(21, 'Peraturan Daerah Provinsi Jawa Tengah Nomor 14 Tahun 2023 tentang Anggaran Pendapatan dan Belanja Daerah Tahun 2024,(Lembaran Daerah Provinsi Jawa Tengah Tahun 2023 Nomor 14);', ''),
(22, 'Peraturan Gubernur Jawa Tengah Nomor 62 Tahun 2023 tentang Penjabaran Anggaran Pendapatan dan Belanja Daerah Tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 62);', ''),
(23, 'Peraturan Gubernur Jawa Tengah Nomor 63 Tahun 2023 tentang Pedoman Pelaksanaan Anggaran Pendapatan dan Belanja Daerah tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 63);', '');

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
-- Indeks untuk tabel `cetak_laporan`
--
ALTER TABLE `cetak_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `cetak_spt`
--
ALTER TABLE `cetak_spt`
  ADD PRIMARY KEY (`id_cetak`);

--
-- Indeks untuk tabel `cetak_surat`
--
ALTER TABLE `cetak_surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `daftar_nama`
--
ALTER TABLE `daftar_nama`
  ADD PRIMARY KEY (`id_nama`);

--
-- Indeks untuk tabel `form_nama`
--
ALTER TABLE `form_nama`
  ADD PRIMARY KEY (`id_nama`);

--
-- Indeks untuk tabel `form_spt`
--
ALTER TABLE `form_spt`
  ADD PRIMARY KEY (`id_spt`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cetak_laporan`
--
ALTER TABLE `cetak_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `cetak_spt`
--
ALTER TABLE `cetak_spt`
  MODIFY `id_cetak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cetak_surat`
--
ALTER TABLE `cetak_surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `daftar_nama`
--
ALTER TABLE `daftar_nama`
  MODIFY `id_nama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT untuk tabel `form_nama`
--
ALTER TABLE `form_nama`
  MODIFY `id_nama` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `form_spt`
--
ALTER TABLE `form_spt`
  MODIFY `id_spt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
