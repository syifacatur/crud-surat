<?php
//include library
include('library/TCPDF-main/tcpdf.php');

// Definisikan variabel koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_surat";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel surat

$query = "SELECT * FROM tb_produk ";
$result = $conn->query($query);

// Periksa apakah data ditemukan
if ($result->num_rows > 0) {
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
    $pdf->Image('library/logo1.jpg', 10, 10, 17);
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
    $pdf->Ln(4);

    
    // ISI
    $pdf->SetFont('Helvetica', '', 13);
    $pdf->Cell(180, 5, "SURAT TUGAS", 0, 1, 'C');
    
    $pdf->SetFont('helvetica', '', 13);
    $query = "SELECT * FROM form_spt ";
    $result = $conn->query($query);
    if ($row = $result->fetch_assoc()) {
    

  $pdf->MultiCell(180, 10,  'Nomor :' .$row['no_spt'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi

    }
    $pdf->SetFont('helvetica', '', 13);
    $query = "SELECT * FROM tb_produk ";
    $result = $conn->query($query);

    // Isi Surat
    // $pdf->MultiCell(0, 10, $no++ . '. ', 0, 'L');
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, $no . '. ' .$row['kode_produk'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $no++;
        $pdf->Ln(2); // Spasi

    }
    // $pdf->MultiCell(0, 10, $row['kode_produk'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')

    $pdf->SetFont('helvetica', '', 13);
    $query = "SELECT * FROM form_spt ";
    $result = $conn->query($query);

    $no = 6;
    while ($row = $result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, $no . '. ' .$row['dasar_undangan'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $pdf->MultiCell(0, 10, '' .$row['anggaran'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $no++;$pdf->Ln(2); // Spasi

       


    }

$pdf->SetFont('helvetica', '', 13);
$pdf->Ln(2);
$pdf->Cell(180,5,"MEMERINTAHKAN:",0,1,'C');
$pdf->Ln(2);
$pdf->Cell(12,9,'Kepada   :   Terlampir dengan 0 pengikut',0,1,'L');
$pdf->Cell(12,9,'Untuk      : 1. Melaksanakan tugas perjalanan dinas dengan ketentuan sebagai berikut:');
$pdf->Ln(10);

$pdf->SetFont('helvetica', '', 12);
$query = "SELECT * FROM form_spt ";
    $result = $conn->query($query);
    if ($row = $result->fetch_assoc()) {

    
    $pdf->SetX(38);
    $pdf->MultiCell(55, 40, 'a. Maksud dan Tujuan', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(10, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(85, 40, $row['maksud_tujuan'], 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
        // $pdf->MultiCell(120, 10, 'a. Maksud dan Tujuan      :' . $row['maksud_tujuan'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $pdf->Ln(3); // Spasi

    }
    $pdf->Ln(11);
    //$pdf->SetFont('helvetica', '', 8);
    //$pdf->Cell(0, 3, 'Dokumen ini telah ditandatangani secara elektronik yang diterbitkan oleh balai sertifikasi Elektronik (BSrE),BSSN', 0, 1, 'C');
// Mengatur ketebalan garis
//$pdf->SetLineWidth(0.2); // Garis dengan ketebalan 0.5 mm

// Menggambar garis horizontal di bagian bawah halaman
//$startX = 15; // Posisi X awal dari garis (kiri)
//$endX = 195; // Posisi X akhir dari garis (kanan)
//$y = $pdf->GetY(); // Posisi Y dari garis (sesuai dengan SetY yang diatur)

//$pdf->Line($startX, $y, $endX, $y); // Menggambar garis dari posisi X awal ke X akhir

$pdf->SetFont('helvetica', '', 12);
    $pdf->Ln(15);
    $query = "SELECT * FROM form_spt ";
    $result = $conn->query($query);
    if ($row = $result->fetch_assoc()) {
    
        $pdf->SetX(38);
        $pdf->MultiCell(55, 40, 'b. Tempat yang dituju', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(10, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(85, 40, $row['lokasi'], 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        // $pdf->MultiCell(120, 10, 'a. Tempat yang dituju      :' . $row['lokasi'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $pdf->Ln(3); // Spasi

    }

    $pdf->Ln(10);
    $pdf->SetX(38);
    $pdf->Cell(12, 30, 'c. Untuk selama                          :  1(satu)hari', 0, 1, 'L');

$query = "SELECT * FROM form_spt ";
    $result = $conn->query($query);
    if ($row = $result->fetch_assoc()) {
    
  $pdf->SetX(43);
        $pdf->MultiCell(55, 20, 'Berangkat tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->MultiCell(10, 20, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->MultiCell(85, 20, $row['tgl_kegiatan'], 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
        // $pdf->MultiCell(120, 10, 'a. berangkat tanggal      :' . $row['tgl_berangkat'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $pdf->Ln(3); // Spasi

    }

$query = "SELECT * FROM form_spt ";
$result = $conn->query($query);
if ($row = $result->fetch_assoc()) {
    $pdf->Ln(3);
    $pdf->SetX(43);
    $pdf->MultiCell(55, 40, 'Pulang Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(10, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(85, 40, $row['tgl_pulang'], 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    // $pdf->MultiCell(120, 10, 'a. berangkat tanggal      :' . $row['tgl_berangkat'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi
    }

    $pdf->Ln(3);
    $pdf->SetX(32);
    $pdf->Cell(12,5,'2. Tidak Menerima gratifikasi dalam bentuk apapun sesuai ketentuan.',0,1,'L');
    $pdf->SetX(32);
    $pdf->Cell(12,5,'3. Melaporkan kepada Pejabat setempat guna pelaksanaan tugas tersebut.',0,1,'L');
    $pdf->SetX(32);
    $pdf->Cell(12,5,'4. Melaporkan Hasil Pelaksanaan Tugas kepada Pejabat pemberi tugas.',0,1,'L');
    $pdf->SetX(32);
    $pdf->Cell(12,5,'5. Perintah ini dilaksanakan dengan penuh tanggung jawab.',0,1,'L');
    $pdf->SetX(32);
    $pdf->Cell(12,5,'6. Apabila terdapat kekeliruan dalam surat perintah ini akan diadakan perbaikan.',0,1,'L');
    $pdf->SetX(37);
    $pdf->Cell(12,5,'kembali sebagiamana mestinya.',0,1,'L');
    $pdf->Ln(10);

    $pdf->Cell(260,5,"Ditetapkan di : Semarang",0,1,'C');

    $query = "SELECT * FROM form_spt ";
$result = $conn->query($query);
if ($row = $result->fetch_assoc()) {
    

  $pdf->MultiCell(260, 5,  'Pada Tanggal :' .$row['tgl_spt'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi

    }
$pdf->Ln(3); 
$pdf->Cell(260,5,"Kepala Bidang Pengembangan Kompetensi",0,1,'C');
$pdf->Ln(30);
$pdf->Cell(260,5,"Dr.Anon Priyantoro, S.Pd, M.Pd",0,1,'C');
$pdf->Cell(260,5,"Pembina Tingkat I",0,1,'C');

$query = "SELECT * FROM form_spt ";
$result = $conn->query($query);
if ($row = $result->fetch_assoc()) {
    

  $pdf->MultiCell(260, 5,  'NIP. ' .$row['NIP_penandatangan'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi

    }
//$pdf->SetY(-30); // Set posisi Y ke 30 mm dari bawah
//pdf->SetFont('helvetica', '', 8);
//$pdf->Cell(0, 3, 'Dokumen ini telah ditandatangani secara elektronik yang diterbitkan oleh balai sertifikasi Elektronik (BSrE),BSSN', 0, 1, 'C');
//$pdf->Ln(5);

// Mengatur ketebalan garis
//$pdf->SetLineWidth(0.2); // Garis dengan ketebalan 0.5 mm

// Menggambar garis horizontal di bagian bawah halaman
//$startX = 15; // Posisi X awal dari garis (kiri)
//$endX = 195; // Posisi X akhir dari garis (kanan)
//$y = $pdf->GetY(); // Posisi Y dari garis (sesuai dengan SetY yang diatur)

//$pdf->Line($startX, $y, $endX, $y); // Menggambar garis dari posisi X awal ke X akhir

       

    // Output PDF ke browser
    $pdf->Output('surat_dari_database.pdf', 'I');

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$conn->close();
?>