<?php
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

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

function angka_ke_kata($angka)
{
    $angka = abs($angka);
    $huruf = array("", " satu ", " dua ", " tiga ", " empat ", " lima ", " enam ", " tujuh ", " delapan ", " sembilan ", " sepuluh ", " sebelas ");

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
?>