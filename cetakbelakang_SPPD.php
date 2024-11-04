<?php
//include library
include('library/TCPDF-main/tcpdf.php');

// Definisikan variabel koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud-surat";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel surat

$query_dasar = "SELECT * FROM tb_produk ";
$result_dasar = $conn->query($query_dasar);

// Periksa apakah data ditemukan
if ($result_dasar->num_rows > 0) {
    // Mengambil data dari query
    // $row = $result->fetch_assoc();


    // Membuat objek PDF
    $pdf = new TCPDF('P', 'mm', 'Legal');

    

    //remove default header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);


    // Menambahkan halaman
    $pdf->AddPage();


    

    $pdf->SetFont('helvetica', '', 12);

    $id = $_GET['id'];
    $query_isi = "SELECT * FROM form_spt where id_spt='$id'";
    $result_isi = $conn->query($query_isi);
    $row_isi = $result_isi->fetch_assoc();
    
    

    $query = "SELECT * FROM daftar_nama ";
    $result = $conn->query($query);

    
    $pdf->SetFont('Helvetica', '', 11);
    $no = 1;

    if ($row = mysqli_fetch_assoc($result)) {

        $pdf->SetLineWidth(0.3);

        $pdf->setCellPaddings(1, 1, 0, 0);

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
    
            $date_awal = new DateTime($row_isi['tgl_kegiatan']);
            $date_akhir = new DateTime($row_isi['tgl_pulang']);
    
    
            $selisih = $date_awal->diff($date_akhir);
    
            // Ambil jumlah hari dari hasil perhitungan
            $jumlah_hari = $selisih->days;
    
    
            if ($jumlah_hari == 0) {
                $jumlah_hari = 1;
            } else {
                $jumlah_hari = $jumlah_hari + 1;
            }
    
            // Ubah angka ke kata
            $kata_hari = angka_ke_kata($jumlah_hari);
    
            // Format  hari"
            $teks_hari = $jumlah_hari . ' (' . $kata_hari . ') ';
    
        }
//BARIS 1

$x = $pdf->GetX();
$y = $pdf->GetY();
$line_length = 100; // Panjang garis 
        
$tinggiNama = $pdf->getStringHeight(92, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
$tinggiInstansi = $pdf->getStringHeight(95, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.4.1 ");
$tinggiMaks = max($tinggiNama, $tinggiInstansi)+20.5;

$pdf->MultiCell(92, $tinggiMaks, "", 1, 'L', 0, 0, '', '', true);


$pdf->SetX(102);
// MultiCell untuk "a." di bagian atas
$pdf->MultiCell(6, 3, "I.", 'LT', 'C', 0, 0, '', '', true);

// MultiCell untuk teks panjang setelah "a."
$pdf->MultiCell(89, 3, "Berangkat dari      " . "        :  "."Semarang", 'TR', 'L', 0, 1, '', '', true);


    $pdf->SetX(102);
    // MultiCell untuk "b." di sebelah kode anggaran
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);

    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 3, "(Tempat Kedudukan)", 'R', 'L', 0, 1, '', '', true);

    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 3, "Ke"."                                 :", 'R', 'L', 0, 1, '', '', true);
    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 3, "Pada Tanggal"."               :  ". tgl_indo($row_isi['tgl_kegiatan']), 'R', 'L', 0, 1, '', '', true);

     $pdf->SetX(102);
    // MultiCell untuk "b." di sebelah kode anggaran
    $pdf->MultiCell(6, 5, "", 0, 'C', 0, 0, '', '', true);

    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 5, "\nPENGGUNA ANGGARAN", 'R', 'C', 0, 1, '', '', true);

    $pdf->SetX(102);
    // MultiCell untuk "b." di sebelah kode anggaran
    $pdf->MultiCell(6, 10, "", 0, 'C', 0, 0, '', '', true);

    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 0, "\n\nDr. SADIMIN, S.Pd, M.Eng", 'R', 'C', 0, 1, '', '', true);
    $pdf->Line($x + 120, $y + 50, $x + 65 + $line_length, $y + 50);

    $pdf->SetX(102);
    // MultiCell untuk "b." di sebelah kode anggaran
    $pdf->MultiCell(6, 0, "", 0, 'C', 0, 0, '', '', true);

    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 0, "NIP. 197212061994121001", 'R', 'C', 0, 1, '', '', true);


//BARIS 2


$tinggiNama = $pdf->getStringHeight(92, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
$tinggiInstansi = $pdf->getStringHeight(95, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.4.1 ");
$tinggiMaks = max($tinggiNama, $tinggiInstansi)-1.7;


$pdf->MultiCell(92, $tinggiMaks, "  II.  Tiba di                   :"."\n"."       Pada Tanggal"."       :", 1, 'L', 0, 0, '', '', true);

$pdf->SetX(102);
// MultiCell untuk "a." di bagian atas
$pdf->MultiCell(6, 3, "", 'T', 'C', 0, 0, '', '', true);

// MultiCell untuk teks panjang setelah "a."
$pdf->MultiCell(89, 3, "Berangkat dari      " . "        :  ", 'TR', 'L', 0, 1, '', '', true);



    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 3, "Ke      " . "                           :  "."Semarang", 'R', 'L', 0, 1, '', '', true);
    $pdf->SetX(102);
    $pdf->MultiCell(6, 21.5, "", 'BL', 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 3, "Pada Tanggal"."               :  ", 'R', 'L', 0, 1, '', '', true);

    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(89, 3, "\n\n\n", 'BR', 'L', 0, 1, '', '', true);












       
            }

    
            
    // Output PDF ke browser
    $pdf->Output('Surat Perintah Perjalanan Dinas.pdf', 'I');

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$conn->close();
?>