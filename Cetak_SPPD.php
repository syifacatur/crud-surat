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


    //logo
    $pdf->Image('library/logo1.jpg', 15, 10, 25);
    //title
    $pdf->SetFont('Helvetica', 'B', 14);
    $pdf->Cell(190, 5, "PEMERINTAH PROVINSI JAWA TENGAH", 0, 1, 'C');
    $pdf->SetFont('Helvetica', 'B', 14);
    $pdf->Cell(190, 5, "BADAN PENGEMBANGAN ", 0, 1, 'C');
    $pdf->Cell(190, 5, "SUMBER DAYA MANUSIA DAERAH", 0, 1, 'C');
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(190, 3, "Jalan Setiabudi Nomor 201 A Semarang Kode Pos 50263", 0, 1, 'C');
    $pdf->Cell(190, 3, "Telp. 024-7473066 Faks. 024-7473701", 0, 1, 'C');
    $pdf->Cell(190, 3, "Website : www.bpsdmd.jatengprov.go.id Email : bpsdmd@jatengprov.go.id", 0, 1, 'C');

    // garis bawah double 
    $pdf->SetLineWidth(1);
    $pdf->Line(9, 43, 200, 43);
    $pdf->SetLineWidth(0);
    $pdf->Line(9, 43, 200, 43);
    $pdf->Ln(5);


    // ISI
    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(190, 5, "SURAT PERINTAH PERJALANAN DINAS", 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 12);

    $id = $_GET['id'];
    $query_isi = "SELECT * FROM form_spt where id_spt='$id'";
    $result_isi = $conn->query($query_isi);
    $row_isi = $result_isi->fetch_assoc();
    $pdf->MultiCell(190, 10, 'Nomor :' . $row_isi['no_spt'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3);
    

    $query = "SELECT * FROM daftar_nama ";
    $result = $conn->query($query);

    
    $pdf->SetFont('Helvetica', '', 11);
    $no = 1;

    if ($row = mysqli_fetch_assoc($result)) {

        $pdf->setCellPaddings(1, 1, 0, 0);
//BARIS 1
        
// Menghitung tinggi dinamis berdasarkan konten dari sel "Nama"
$tinggiNama = $pdf->getStringHeight(85, 'Pejabat yang memberi perintah');
$tinggiInstansi = $pdf->getStringHeight(100, 'Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah');
// Menentukan tinggi maksimum di antara sel "Nama" dan "Instansi"
$tinggiMaks = max($tinggiNama, $tinggiInstansi);

// Menyesuaikan tinggi sel "No" agar sesuai dengan sel lainnya
$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);
// Menyesuaikan tinggi sel "Nama"
$pdf->MultiCell(85, $tinggiMaks, 'Pejabat yang memberi perintah', 1, 'L', 0, 0, '', '', true);
// Menyesuaikan tinggi sel "Instansi"
$pdf->MultiCell(100, $tinggiMaks, 'Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah', 1, 'L', 0, 1, '', '', true);

//BARIS 2


// Menghitung tinggi dinamis berdasarkan konten deskripsi panjang
$tinggiNama = $pdf->getStringHeight(80, "Nama Gubernur/Wakil Gubernur/Pimpinan dan Anggota DPRD/Pegawai ASN dan NIP/CPNS dan NIP/ Pegawai Non ASN/Bukan Pegawai yang melaksanakan perjalanan Dinas");
// Reset padding setelah selesai jika ingin kembali ke default
$tinggiInstansi = $pdf->getStringHeight(100,$row['nama']."\n\n\nNIP. ".$row['NIP']);
$tinggiMaks = max($tinggiNama, $tinggiInstansi)-3;

// Kolom nomor
$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);

// Kolom deskripsi (pastikan newline pada teks)
$pdf->MultiCell(85, $tinggiMaks, "Nama Gubernur/Wakil Gubernur/Pimpinan dan Anggota DPRD/Pegawai ASN dan NIP/CPNS dan NIP/ Pegawai Non ASN/Bukan Pegawai yang melaksanakan perjalanan Dinas", 1, 'L', 0, 0, '', '', true);

// Gabungkan nama dan NIP dalam satu MultiCell (dengan penambahan jarak vertikal sebelum nama)
$kontenNamaNIP = $row['nama']."\n\n\nNIP. ".$row['NIP'];
$pdf->MultiCell(100, $tinggiMaks, $kontenNamaNIP, 1, 'L', 0, 1, '', '', true);



//BARIS 3


$tinggiNama = $pdf->getStringHeight(85, 'a. Pangkat dan Golongan'.'b. Jabatan/Instansi');
$tinggiInstansi = $pdf->getStringHeight(100, $row['pangkat']."\n ".$row['jabatan']);
$tinggiMaks = max($tinggiNama, $tinggiInstansi) + 3;

$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);

$pdf->MultiCell(85, $tinggiMaks, 'a. Pangkat dan Golongan'."\nb. Jabatan/Instansi", 1, 'L', 0, 0, '', '', true);
$kontenPangkatJabatan =  'a. '.$row['pangkat']."\nb. ".$row['jabatan'];
$pdf->MultiCell(100, $tinggiMaks, $kontenPangkatJabatan, 1, 'L', 0, 1, '', '', true);


//BARIS 4

$tinggiNama = $pdf->getStringHeight(85, 'Maksud Mengadakan Perjalanan');
$tinggiInstansi = $pdf->getStringHeight(100, $row_isi['maksud_tujuan']);
$tinggiMaks = max($tinggiNama, $tinggiInstansi)+ 3;

$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(85, $tinggiMaks, 'Maksud Mengadakan Perjalanan', 1, 'L', 0, 0, '', '', true);
$kontenmaksudtujuan =  $row_isi['maksud_tujuan'];
$pdf->MultiCell(100, $tinggiMaks, $kontenmaksudtujuan, 1, 'L', 0, 1, '', '', true);

//BARIS 5


$tinggiNama = $pdf->getStringHeight(85, 'Alat Angkut yang Dipergunakan');
$tinggiInstansi = $pdf->getStringHeight(100, 'Kendaraan Dinas');
$tinggiMaks = max($tinggiNama, $tinggiInstansi)+0.5;

$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);

$pdf->MultiCell(85, $tinggiMaks, 'Alat Angkut yang Dipergunakan', 1, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, $tinggiMaks, 'Kendaraan Dinas', 1, 'L', 0, 1, '', '', true);

//Baris 6

$tinggiNama = $pdf->getStringHeight(85, 'a. Tempat Berangkat'.'b. Tempat Tujuan');
$tinggiInstansi = $pdf->getStringHeight(100, 'Semarang'."\n ".$row_isi['lokasi']);
$tinggiMaks = max($tinggiNama, $tinggiInstansi)+ 4;

$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);

$pdf->MultiCell(85, $tinggiMaks, 'a. Tempat Berangkat'."\nb. Tempat Tujuan", 1, 'L', 0, 0, '', '', true);
$kontenBerangkatTujuan =  'a. Semarang'."\nb. ".$row_isi['lokasi'];
$pdf->MultiCell(100, $tinggiMaks, $kontenBerangkatTujuan, 1, 'L', 0, 1, '', '', true);

//baris 7

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

function angka_ke_kata($angka) {
    $angka = abs($angka);
    $huruf = array ("", " satu ", " dua ", " tiga ", " empat ", " lima ", " enam ", " tujuh ", " delapan ", " sembilan ", " sepuluh ", " sebelas ");
    
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
$kata_hari = angka_ke_kata ($jumlah_hari);

// Format  hari"
$teks_hari = $jumlah_hari . ' (' . $kata_hari . ') ';




$tinggiNama = $pdf->getStringHeight(85, 'a. Lamanya Perjalanan Dinas'."\nb. Tanggal Berangkat"."\nc. Tanggal Harus Kembali/Tiba Di Tempat Baru");
$tinggiInstansi = $pdf->getStringHeight(100,'a.' .$teks_hari. 'hari'."\nb. ".tgl_indo($row_isi['tgl_kegiatan'])."\nc. ".tgl_indo($row_isi['tgl_pulang']));
$tinggiMaks = max($tinggiNama, $tinggiInstansi)+1;

$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(85, $tinggiMaks, 'a. Lamanya Perjalanan Dinas'."\nb. Tanggal Berangkat"."\nc. Tanggal Harus Kembali/Tiba Di Tempat Baru", 1, 'J', 0, 0, '', '', true);
$kontentanggal = 'a. '. $teks_hari. 'hari'."\nb. ".tgl_indo($row_isi['tgl_kegiatan'])."\nc. ".tgl_indo($row_isi['tgl_pulang']);
$pdf->MultiCell(100, $tinggiMaks, $kontentanggal, 1, 'L', 0, 1, '', '', true);

//baris 8

$tinggiNama = $pdf->getStringHeight(85, 'pengikut');
$tinggiInstansi = $pdf->getStringHeight(100, '')+0.5;
$tinggiMaks = max($tinggiNama, $tinggiInstansi);

$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(85, $tinggiMaks, 'pengikut', 1, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, $tinggiMaks, '', 1, 'L', 0, 1, '', '', true);

//baris 9

$tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran'."\na. Instansi"."\n\n\nb. Mata Anggaran");
$tinggiInstansi = $pdf->getStringHeight(100,"\n".'a. APBD Tahun 2023 Anggaran ' .$row_isi['anggaran']."\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.4.1 ");
$tinggiMaks = max($tinggiNama, $tinggiInstansi)+ 2;


$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran'."\na. Instansi"."\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);
$kontenAnggaran = "\n".'a.'.' APBD Tahun 2023 Anggaran ' .$row_isi['anggaran']."\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.4.1)";
$pdf->MultiCell(100, $tinggiMaks, $kontenAnggaran, 1, 'L', 0, 1, '', '', true);

//baris 10

$tinggiNama = $pdf->getStringHeight(85, 'Keterangan Lain-lain');
$tinggiInstansi = $pdf->getStringHeight(100, '');
$tinggiMaks = max($tinggiNama, $tinggiInstansi)+0.5;

$pdf->MultiCell(11, $tinggiMaks, $no++ .'. ', 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell(85, $tinggiMaks, 'Keterangan Lain-lain', 1, 'L', 0, 0, '', '', true);
$pdf->MultiCell(100, $tinggiMaks, '', 1, 'L', 0, 1, '', '', true);

$x = $pdf->GetX();


$y = $pdf->GetY();
$line_length = 100; // Panjang garis dalam satuan TCPDF

$pdf->Ln(3);
$pdf->Cell(260,5,"Dikeluarkan di : Semarang",0,1,'C');
$pdf->Cell(260,5,"       Pada Tanggal  :   Agustus 2024",0,1,'C');
$pdf->Ln(1);
$pdf->Cell(270,5,"Ditetapkan di : Semarang",0,1,'C');
$pdf->Cell(270,5,"Tanggal  :   Agustus 2024",0,1,'C');
$pdf->Ln(3);
$pdf->Cell(260,5,"PENGGUNA ANGGARAN",0,1,'C');
$pdf->Ln(20);
$pdf->Cell(260,5,"Dr.SADIMIN,S.Pd, M.Eng",0,1,'C');
// Menggambar garis di bawah nama
$pdf->Line($x + 107, $y + 57, $x + 53 + $line_length, $y + 57); 

$pdf->Cell(260,5,"NIP. 197212061994121001",0,1,'C');









       
            }

    
    // Output PDF ke browser
    $pdf->Output('Surat Perintah Perjalanan Dinas.pdf', 'I');

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$conn->close();
?>