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
$pdf->MultiCell(90, 3, "Berangkat dari      " . "        :  "."Semarang", 'TR', 'L', 0, 1, '', '', true);


    $pdf->SetX(102);
    // MultiCell untuk "b." di sebelah kode anggaran
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);

    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "(Tempat Kedudukan)", 'R', 'L', 0, 1, '', '', true);

    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Ke"."                                 :", 'R', 'L', 0, 1, '', '', true);
    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Pada Tanggal"."               :  ". tgl_indo($row_isi['tgl_kegiatan']), 'R', 'L', 0, 1, '', '', true);

     $pdf->SetX(102);
    // MultiCell untuk "b." di sebelah kode anggaran
    $pdf->MultiCell(6, 5, "", 0, 'C', 0, 0, '', '', true);

    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 5, "\nPENGGUNA ANGGARAN", 'R', 'C', 0, 1, '', '', true);

    $pdf->SetX(102);
    // MultiCell untuk "b." di sebelah kode anggaran
    $pdf->MultiCell(6, 10, "", 0, 'C', 0, 0, '', '', true);
    

    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 0, "\n\nDr. SADIMIN, S.Pd, M.Eng", 'R', 'C', 0, 1, '', '', true);
    $pdf->SetLineWidth(0.2);

    $pdf->Line($x + 120, $y + 49, $x + 65 + $line_length, $y + 49);
    $pdf->SetLineWidth(0.3);

    $pdf->SetX(102);
    // MultiCell untuk "b." di sebelah kode anggaran
    $pdf->MultiCell(6, 0, "", 0, 'C', 0, 0, '', '', true);

    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 0, "NIP. 197212061994121001", 'R', 'C', 0, 1, '', '', true);


//BARIS 2


$tinggiNama = $pdf->getStringHeight(92, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
$tinggiInstansi = $pdf->getStringHeight(95, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.4.1 ");
$tinggiMaks = max($tinggiNama, $tinggiInstansi)-1.7;


$pdf->MultiCell(92, $tinggiMaks, "  II.  Tiba di                   :"."\n"."       Pada Tanggal"."       :", 1, 'L', 0, 0, '', '', true);

$pdf->SetX(102);
// MultiCell untuk "a." di bagian atas
$pdf->MultiCell(6, 3, "", 'T', 'C', 0, 0, '', '', true);

// MultiCell untuk teks panjang setelah "a."
$pdf->MultiCell(90, 3, "Berangkat dari      " . "        :  ", 'TR', 'L', 0, 1, '', '', true);



    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Ke      " . "                           :  "."Semarang", 'R', 'L', 0, 1, '', '', true);
    $pdf->SetX(102);
    $pdf->MultiCell(6, 21.5, "", 'BL', 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Pada Tanggal"."               :  ", 'R', 'L', 0, 1, '', '', true);

    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "\n\n\n", 'BR', 'L', 0, 1, '', '', true);

    //BARIS 3


$tinggiNama = $pdf->getStringHeight(92, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
$tinggiInstansi = $pdf->getStringHeight(95, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.4.1 ");
$tinggiMaks = max($tinggiNama, $tinggiInstansi)-1.7;


$pdf->MultiCell(92, $tinggiMaks, "  III. Tiba di                   :"."\n"."       Pada Tanggal"."       :", 1, 'L', 0, 0, '', '', true);

$pdf->SetX(102);
// MultiCell untuk "a." di bagian atas
$pdf->MultiCell(6, 3, "", 'T', 'C', 0, 0, '', '', true);

// MultiCell untuk teks panjang setelah "a."
$pdf->MultiCell(90, 3, "Berangkat dari      " . "        :  ", 'TR', 'L', 0, 1, '', '', true);



    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Ke      " . "                           :  ", 'R', 'L', 0, 1, '', '', true);
    $pdf->SetX(102);
    $pdf->MultiCell(6, 21.5, "", 'BL', 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Pada Tanggal"."               :  ", 'R', 'L', 0, 1, '', '', true);

    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "\n\n\n", 'BR', 'L', 0, 1, '', '', true);

     //BARIS 4


$tinggiNama = $pdf->getStringHeight(92, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
$tinggiInstansi = $pdf->getStringHeight(95, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.4.1 ");
$tinggiMaks = max($tinggiNama, $tinggiInstansi)-1.7;


$pdf->MultiCell(92, $tinggiMaks, "  IV. Tiba di                   :"."\n"."        Pada Tanggal"."       :", 1, 'L', 0, 0, '', '', true);
$pdf->SetX(102);
// MultiCell untuk "a." di bagian atas
$pdf->MultiCell(6, 3, "", 'T', 'C', 0, 0, '', '', true);

// MultiCell untuk teks panjang setelah "a."
$pdf->MultiCell(90, 3, "Berangkat dari      " . "        :  ", 'TR', 'L', 0, 1, '', '', true);



    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Ke      " . "                           :  ", 'R', 'L', 0, 1, '', '', true);
    $pdf->SetX(102);
    $pdf->MultiCell(6, 21.5, "", 'BL', 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Pada Tanggal"."               :  ", 'R', 'L', 0, 1, '', '', true);

    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "\n\n\n", 'BR', 'L', 0, 1, '', '', true);

     //BARIS 5


$tinggiNama = $pdf->getStringHeight(92, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
$tinggiInstansi = $pdf->getStringHeight(95, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.4.1 ");
$tinggiMaks = max($tinggiNama, $tinggiInstansi)-1.7;


$pdf->MultiCell(92, $tinggiMaks, "  V. Tiba di                   :"."\n"."       Pada Tanggal"."       :", 1, 'L', 0, 0, '', '', true);

$pdf->SetX(102);
// MultiCell untuk "a." di bagian atas
$pdf->MultiCell(6, 3, "", 'T', 'C', 0, 0, '', '', true);

// MultiCell untuk teks panjang setelah "a."
$pdf->MultiCell(90, 3, "Berangkat dari      " . "        :  ", 'TR', 'L', 0, 1, '', '', true);



    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Ke      " . "                           :  ", 'R', 'L', 0, 1, '', '', true);
    $pdf->SetX(102);
    $pdf->MultiCell(6, 21.5, "", 'BL', 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "Pada Tanggal"."               :  ", 'R', 'L', 0, 1, '', '', true);

    $pdf->SetX(102);
    $pdf->MultiCell(6, 3, "", 0, 'C', 0, 0, '', '', true);
    // MultiCell untuk kode anggaran
    $pdf->MultiCell(90, 3, "\n\n\n", 'BR', 'L', 0, 1, '', '', true);

    //BARIS 6

$x = $pdf->GetX();
$y = $pdf->GetY();
$line_length = 50; // Panjang garis 

// Simpan posisi awal X dan Y untuk referensi
$x_initial = $pdf->GetX();
$y_initial = $pdf->GetY();

// Mengatur lebar kolom kiri dan kanan
$width_left = 92;
$width_right = 89;

// Mengatur tinggi standar baris
$height_row = 5;

// --------- Bagian Kolom Kiri ---------
// Set posisi awal untuk kolom kiri
$pdf->SetXY($x_initial, $y_initial);

// Bagian Judul "VI."
$pdf->MultiCell(8, $height_row, "  VI.", 'L', 'C', 0, 0, '', '', true);

// Bagian Konten Kolom Kiri
$pdf->MultiCell($width_left - 8, $height_row, "Tiba di"."                            :  "."Semarang", 'TR', 'L', 0, 1, '', '', true);
$pdf->SetX($x_initial);
$pdf->MultiCell(8, $height_row, "", 'L', 'C', 0, 0, '', '', true);
$pdf->MultiCell($width_left - 8, $height_row, "(Tempat Kedudukan)", 'R', 'L', 0, 1, '', '', true);
$pdf->SetX($x_initial);
$pdf->MultiCell(8, $height_row, "", 'L', 'C', 0, 0, '', '', true);
$pdf->MultiCell($width_left - 8, $height_row, "Pada Tanggal                :  " .tgl_indo($row_isi['tgl_kegiatan']), 'R', 'L', 0, 1, '', '', true);
$pdf->SetX($x_initial);
$pdf->MultiCell(8, $height_row * 2.1, "",'L', 'C', 0, 0, '', '', true);
$pdf->MultiCell($width_left - 8, $height_row * 2, "\nPENGGUNA ANGGARAN", 'R', 'C', 0, 1, '', '', true);
$pdf->SetX($x_initial);
$pdf->MultiCell(8, $height_row * 4.7, "", 'L', 'C', 0, 0, '', '', true);
$pdf->MultiCell($width_left - 8, $height_row * 4.7, "\n\nDr. SADIMIN, S.Pd, M.Eng\nNIP. 197212061994121001", 'BR', 'C', 0, 1, '', '', true);
$pdf->SetLineWidth(0.2);
$pdf->Line($x + 27, $y + 43.5, $x + 23 + $line_length, $y + 43.5);
$pdf->SetLineWidth(0.3);




// --------- Bagian Kolom Kanan ---------
// Set posisi X dan Y ke kolom kanan
$pdf->SetXY($x_initial + $width_left, $y_initial);

$x = $pdf->GetX();
$y = $pdf->GetY();
$line_length = 50; // Panjang garis

// Bagian Judul "I."
$pdf->MultiCell(7, $height_row, "", 'LT', 'C', 0, 0, '', '', true);

// Bagian Konten Kolom Kanan
$pdf->MultiCell($width_right , $height_row, "Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintah pejabat yang berwenang dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.", 'TR', 'J'."\n", 0, 1, '', '', true);
$pdf->SetX($x_initial + $width_left);
$pdf->MultiCell(7, $height_row * 2, "", 'L', 'C', 0, 0, '', '', true);
$pdf->MultiCell($width_right , $height_row * 2, "\nPENGGUNA ANGGARAN", 'R', 'C', 0, 1, '', '', true);
$pdf->SetX($x_initial + $width_left);
$pdf->MultiCell(7, $height_row * 4.1, "", 'L', 'C', 0, 0, '', '', true);
$pdf->MultiCell($width_right , $height_row * 3, "\n\nDr. SADIMIN, S.Pd, M.Eng\nNIP. 197212061994121001", 'RB', 'C', 0, 1, '', '', true);
$pdf->SetLineWidth(0.2);
$pdf->Line($x + 27, $y + 46, $x + 23 + $line_length, $y + 46);
$pdf->SetLineWidth(0.3);

//baris 7

$tinggiNama = $pdf->getStringHeight(100, "VII.  Catatan Lain-lain");
$tinggiInstansi = $pdf->getStringHeight(95, "VII.  Catatan Lain-lain");
$tinggiMaks = max($tinggiNama, $tinggiInstansi);


$pdf->MultiCell(188, $tinggiMaks, "VII.  Catatan Lain-lain", 1, 'L', 0, 0, '', '', true);

//baris 8
$pdf->SetMargins(10, 10, 10); // Margin kiri, atas, kanan
$pdf->SetAutoPageBreak(true, 5); // Atur agar halaman otomatis berganti dengan jarak margin bawah kecil (misalnya 5)

// Posisi awal kolom di bawah untuk "VII. Catatan Lain-lain"
$pdf->SetXY($x_initial, $y_initial + 58); // Sesuaikan nilai 60 agar lebih ke bawah

// Menambahkan Baris untuk "VII. Catatan Lain-lain"
$pdf->MultiCell(9, $height_row, "VIII.", 'L', 'C', 0, 0, '', '', true);
$pdf->MultiCell($width_left + $width_right - 2, $height_row, "PERHATIAN             :", 'R', 'L', 0, 1, '', '', true);
$pdf->MultiCell(9, 2, "\n\n\n\n\n", 'LB', 'L', 0, 0, '', '', true);

$pdf->MultiCell($width_left + $width_right -2, $height_row, "Pengguna Anggaran/Kuasa Pengguna Anggaran yang menerbitkan SPPD, Gubernur/Wakil Gubernur,Pimpinan dan Anggota DPRD,Peagawai ASN,CPNS,dan Pegawain Non PNS yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan Daerah apabila daerah menderita rugi akibat kesalahan,kelalaian dan kealpaanya.", 'RB', 'L', 0, 1, '', '', true);



    
    


    














       
            }

    
            
    // Output PDF ke browser
    $pdf->Output('Surat Perintah Perjalanan Dinas.pdf', 'I');

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$conn->close();
?>