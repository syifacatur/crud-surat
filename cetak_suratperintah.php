<?php
//include library
include('library/TCPDF-main/tcpdf.php');


//make TCPDF object
$pdf = new TCPDF('P','mm','Legal');

//remove default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//add page
$pdf->AddPage();

//add content (Laporan SPT)
//logo
$pdf->Image('library/logo1.jpg',10,10,17);
//title
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(190,5,"PEMERINTAH PROVINSI JAWA TENGAH",0,1,'C');
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(190,5,"BADAN PENGEMBANGAN ",0,1,'C');
$pdf->Cell(190,5,"SUMBER DAYA MANUSIA DAERAH",0,1,'C');
$pdf->SetFont('Helvetica','',7);
$pdf->Cell(190,3,"Jalan Setiabudi Nomor 201 A Semarang Kode Pos 50263",0,1,'C');
$pdf->Cell(190,3,"Telp. 024-7473066 Faks. 024-7473701",0,1,'C');
$pdf->Cell(190,3,"Website : www.bpsdmd.jatengprov.go.id Email : bpsdmd@jatengprov.go.id",0,1,'C');

// garis bawah double 
$pdf->SetLineWidth(1);
$pdf->Line(9,35,200,35);
$pdf->SetLineWidth(0);
$pdf->Line(9,35,200,35);
// ISI
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(190,5,"",0,1,'C');
$pdf->Cell(190,5,"",0,1,'C');
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(190,5,"SURAT TUGAS",0,1,'C');
$pdf->Cell(190,5,"NOMOR : 000.1.2.3.664",0,1,'C');

$pdf->SetFont('Helvetica','',9);
$pdf->Cell(12,9,'Dasar   :',0,1,'C');
$pdf->Ln(10); // Tambah spasi

// Atur font untuk daftar isi
$pdf->SetFont('helvetica', '', 9);

// Data Undang-Undang (array)
$undang_undang = [
    "Peraturan Menteri Dalam Negeri Nomor 77 Tahun 2020 tentang Pedoman Teknis Pengelolaan Keuangan Daerah (Berita Negara Republik Indonesia Tahun 2020 Nomor 1781);",
    "Peraturan Menteri Dalam Negeri Nomor 15 Tahun 2023 tentang Pedoman Penyusunan Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2024(Berita Negara Republik Indonesia Tahun 2023 Nomor 799);",
    "Peraturan Daerah Provinsi Jawa Tengah Nomor 14 Tahun 2023 tentang Anggaran Pendapatan dan Belanja Daerah Tahun 2024,(Lembaran Daerah Provinsi Jawa Tengah Tahun 2023 Nomor 14);",
    "Peraturan Gubernur Jawa Tengah Nomor 62 Tahun 2023 tentang Penjabaran Anggaran Pendapatan dan Belanja Daerah Tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 62);",
    "Peraturan Gubernur Jawa Tengah Nomor 63 Tahun 2023 tentang Pedoman Pelaksanaan Anggaran Pendapatan dan Belanja Daerah tahun 2024 (Berita Daerah Provinsi Jawa Tengah Nomor 63);",
    "Dokumen Pelaksanaan Anggaran (DPA) BPSDMD Provinsi Jawa Tengah Tahun 2024 Nomor 01891/DPA/2024 APBD Tahun 2024 pada Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD;",
    "Surat Sekretaris Daerah Provinsi Jawa Tengah Nomor 000.8.3/261 Tanggal 29 Mei 2024.Hal Desk Pengisian Aplikasi Metal",
];

// Loop untuk mencetak daftar Undang-Undang
$no = 1; // Variabel untuk nomor urut
foreach ($undang_undang as $uu) {
    // Tampilkan nomor urut dan teks Undang-Undang
    $pdf->MultiCell(0, 10, $no . '. ' . $uu, 0, 'L');
    $no++; // Tambahkan nomor urut
    $pdf->Ln(2); // Spasi kecil antar item
}
//output
$pdf->Output();
