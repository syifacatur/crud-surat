<?php
//include library
include('library/TCPDF-main/tcpdf.php');

// Definisikan variabel koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wma_baru";

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
    $pdf->Cell(190, 5, "SURAT TUGAS", 0, 1, 'C');
    $pdf->Cell(190, 5, "NOMOR : 000.1.2.3.664", 0, 1, 'C');
    $pdf->Ln(10); // Spasi



    // Isi Surat
    // $pdf->MultiCell(0, 10, $no++ . '. ', 0, 'L');
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, $no . '. ' .$row['kode_produk'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $no++;
    }
    // $pdf->MultiCell(0, 10, $row['kode_produk'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')

    $pdf->Ln(10); // Spasi

    // Output PDF ke browser
    $pdf->Output('surat_dari_database.pdf', 'I');

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$conn->close();
?>