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

    
    $pdf->SetFont('Helvetica', '', 12);
    $no = 1;

    if ($row = mysqli_fetch_assoc($result)) {

    
// Menghitung tinggi dinamis berdasarkan konten dari sel "Nama"
$tinggiNama = $pdf->getStringHeight(80, 'Pejabat yang memberi perintah');
$tinggiInstansi = $pdf->getStringHeight(100, 'Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah');

// Menentukan tinggi maksimum di antara sel "Nama" dan "Instansi"
$tinggiMaks = max($tinggiNama, $tinggiInstansi);

// Menyesuaikan tinggi sel "No" agar sesuai dengan sel lainnya
$pdf->MultiCell(11, $tinggiMaks, $no++, 1, 'L', 0, 0, '', '', true);

// Menyesuaikan tinggi sel "Nama"
$pdf->MultiCell(80, $tinggiMaks, 'Pejabat yang memberi perintah', 1, 'L', 0, 0, '', '', true);

// Menyesuaikan tinggi sel "Instansi"
$pdf->MultiCell(100, $tinggiMaks, 'Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah', 1, 'L', 0, 1, '', '', true);

//BARIS 2


// Menghitung tinggi dinamis berdasarkan konten deskripsi panjang
$tinggiNama = $pdf->getStringHeight(80, 'Nama Gubernur/Wakil Gubernur/Pimpinan dan Anggota DPRD/Pegawai ASN dan NIP/CPNS dan NIP/ Pegawai Non ASN/Bukan Pegawai yang melaksanakan perjalanan Dinas');
$tinggiInstansi = $pdf->getStringHeight(100, $row['nama']."\n\nNIP. ".$row['NIP']);

// Menentukan tinggi maksimum antara kedua sel
$tinggiMaks = max($tinggiNama, $tinggiInstansi);

// Kolom nomor
$pdf->MultiCell(11, $tinggiMaks, $no++, 1, 'L', 0, 0, '', '', true);

// Kolom deskripsi
$pdf->MultiCell(80, $tinggiMaks, 'Nama Gubernur/Wakil Gubernur/Pimpinan dan Anggota DPRD/Pegawai ASN dan NIP/CPNS dan NIP/ Pegawai Non ASN/Bukan Pegawai yang melaksanakan perjalanan Dinas', 1, 'L', 0, 0, '', '', true);

// Gabungkan nama dan NIP dalam satu MultiCell
$kontenNamaNIP =  $row['nama']."\n\n\nNIP. ".$row['NIP'];
$pdf->MultiCell(100, $tinggiMaks, $kontenNamaNIP, 1, 'L', 0, 1, '', '', true);


//BARIS 3


// Menghitung tinggi dinamis berdasarkan konten deskripsi panjang
$tinggiNama = $pdf->getStringHeight(80, 'a. Pangkat dan Golongan'.'b. Jabatan/Instansi');

$tinggiInstansi = $pdf->getStringHeight(100, $row['pangkat']."\n ".$row['jabatan']);

// Menentukan tinggi maksimum antara kedua sel
$tinggiMaks = max($tinggiNama, $tinggiInstansi);

// Kolom nomor
$pdf->MultiCell(11, $tinggiMaks, $no++, 1, 'L', 0, 0, '', '', true);

// Kolom deskripsi
$pdf->MultiCell(80, $tinggiMaks, 'a. Pangkat dan Golongan'."\nb. Jabatan/Instansi", 1, 'L', 0, 0, '', '', true);

// Gabungkan nama dan NIP dalam satu MultiCell
$kontenNamaNIP =  'a. '.$row['pangkat']."\nb. ".$row['jabatan'];
$pdf->MultiCell(100, $tinggiMaks, $kontenNamaNIP, 1, 'L', 0, 1, '', '', true);


//BARIS 4

// Menghitung tinggi dinamis berdasarkan konten deskripsi panjang
$tinggiNama = $pdf->getStringHeight(80, 'Maksud Mengadakan Perjalanan');

$tinggiInstansi = $pdf->getStringHeight(100, $row_isi['maksud_tujuan']);

// Menentukan tinggi maksimum antara kedua sel
$tinggiMaks = max($tinggiNama, $tinggiInstansi);

// Kolom nomor
$pdf->MultiCell(11, $tinggiMaks, $no++, 1, 'L', 0, 0, '', '', true);

// Kolom deskripsi
$pdf->MultiCell(80, $tinggiMaks, 'Maksud Mengadakan Perjalanan', 1, 'L', 0, 0, '', '', true);

// Gabungkan nama dan NIP dalam satu MultiCell
$kontenNamaNIP =  $row_isi['maksud_tujuan'];
$pdf->MultiCell(100, $tinggiMaks, $kontenNamaNIP, 1, 'L', 0, 1, '', '', true);



        $pdf->Ln();
        
       
        
        $pdf->Ln();
        
        // Pangkat/Gol
       
        $pdf->Ln();
        
        // Jabatan
       
        $pdf->Ln();
            }

    
    // Output PDF ke browser
    $pdf->Output('Surat Perintah Perjalanan Dinas.pdf', 'I');

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$conn->close();
?>