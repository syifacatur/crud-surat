<?php

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "crud-surat";

$conn = new mysqli($host, $user, $pass, $db);

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari parameter GET
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Periksa ID
if ($id == 0) {
    die("ID tidak valid.");
}

// Query database
$query_isi = "SELECT * FROM form_spt WHERE id_spt = '$id'";
$result_isi = $conn->query($query_isi);

// Periksa apakah query berhasil
if (!$result_isi) {
    die("Query error: " . $conn->error);
}

// Ambil data jika ditemukan
if ($result_isi->num_rows > 0) {
    $row_isi = $result_isi->fetch_assoc();
} else {
    die("Data tidak ditemukan.");
}

// Fungsi tgl_indo
if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

// Fungsi angka_ke_kata
if (!function_exists('angka_ke_kata')) {
    function angka_ke_kata($angka)
    {
        $angka = abs($angka);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

        if ($angka < 12) {
            return $huruf[$angka];
        } elseif ($angka < 20) {
            return angka_ke_kata($angka - 10) . " belas";
        } elseif ($angka < 100) {
            return angka_ke_kata(floor($angka / 10)) . " puluh " . angka_ke_kata($angka % 10);
        } elseif ($angka < 200) {
            return "seratus " . angka_ke_kata($angka - 100);
        } elseif ($angka < 1000) {
            return angka_ke_kata(floor($angka / 100)) . " ratus " . angka_ke_kata($angka % 100);
        } elseif ($angka < 2000) {
            return "seribu " . angka_ke_kata($angka - 1000);
        } elseif ($angka < 1000000) {
            return angka_ke_kata(floor($angka / 1000)) . " ribu " . angka_ke_kata($angka % 1000);
        } elseif ($angka < 1000000000) {
            return angka_ke_kata(floor($angka / 1000000)) . " juta " . angka_ke_kata($angka % 1000000);
        }
    }
}

// Hitung selisih tanggal
$date_awal = new DateTime($row_isi['tgl_kegiatan']);
$date_akhir = new DateTime($row_isi['tgl_pulang']);
$selisih = $date_awal->diff($date_akhir);

// Ambil jumlah hari dari hasil perhitungan
$jumlah_hari = $selisih->days;
$jumlah_hari = ($jumlah_hari == 0) ? 1 : $jumlah_hari + 1;

// Ubah angka ke kata
$kata_hari = angka_ke_kata($jumlah_hari);

// Format jumlah hari
$teks_hari = $jumlah_hari . ' (' . $kata_hari . ') ';

//konversi angka ke kata jumlah peserta 

if (!function_exists('angka_ke_kata')) {
    function angka_ke_kata($angka)
    {
        $angka = abs($angka);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

        if ($angka < 12) {
            return '(' . $huruf[$angka] . ')';
        } elseif ($angka < 20) {
            return '(' . angka_ke_kata($angka - 10) . " belas" . ')';
        } elseif ($angka < 100) {
            return '(' . angka_ke_kata(floor($angka / 10)) . " puluh " . angka_ke_kata($angka % 10) . ')';
        } 
    }
}

// Output hasil (contoh)

?>
