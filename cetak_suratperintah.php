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
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(190,5,"PEMERINTAH PROVINSI JAWA TENGAH",0,1,'C');
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(190,5,"BADAN PENGEMBANGAN ",0,1,'C');
$pdf->Cell(190,5,"SUMBER DAYA MANUSIA DAERAH",0,1,'C');
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(190,3,"Jalan Setiabudi Nomor 201 A Semarang Kode Pos 50263",0,1,'C');
$pdf->Cell(190,3,"Telp. 024-7473066 Faks. 024-7473701",0,1,'C');
$pdf->Cell(190,3,"Website : www.bpsdmd.jatengprov.go.id Email : bpsdmd@jatengprov.go.id",0,1,'C');

// garis bawah double 
$pdf->SetLineWidth(1);
$pdf->Line(9,43,200,43);
$pdf->SetLineWidth(0);
$pdf->Line(9,43,200,43);
$pdf->Ln(4);
// ISI
$pdf->SetFont('Helvetica','',13);
$pdf->Cell(190,5,"SURAT TUGAS",0,1,'C');
$pdf->Cell(190,5,"NOMOR : 000.1.2.3.664",0,1,'C');

$pdf->SetFont('Helvetica','',13);
$pdf->Ln(6); // Tambah spasi

// Atur font untuk daftar isi
$pdf->SetFont('helvetica', '', 13);

// Data Undang-Undang (array)
$undang_undang = [
    "Peraturan Menteri Dalam Negeri Nomor 77 Tahun 2020 tentang Pedoman Teknis                  Pengelolaan Keuangan Daerah (Berita Negara Republik Indonesia Tahun 2020 Nomor          1781);",
    "Peraturan Menteri Dalam Negeri Nomor 15 Tahun 2023 tentang Pedoman Penyusunan         Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2024(Berita Negara                   Republik Indonesia Tahun 2023 Nomor 799);",
    "Peraturan Daerah Provinsi Jawa Tengah Nomor 14 Tahun 2023 tentang Anggaran                Pendapatan dan Belanja Daerah Tahun 2024,(Lembaran Daerah Provinsi Jawa Tengah        Tahun 2023 Nomor 14);",
    "Peraturan Gubernur Jawa Tengah Nomor 62 Tahun 2023 tentang Penjabaran Anggaran       Pendapatan dan Belanja Daerah Tahun 2024 (Berita Daerah Provinsi Jawa Tengah               Nomor 62);",
    "Peraturan Gubernur Jawa Tengah Nomor 63 Tahun 2023 tentang Pedoman Pelaksanaan     Anggaran Pendapatan dan Belanja Daerah tahun 2024 (Berita Daerah Provinsi Jawa             Tengah Nomor 63);",
    "Dokumen Pelaksanaan Anggaran (DPA) BPSDMD Provinsi Jawa Tengah Tahun 2024          Nomor 01891/DPA/2024 APBD Tahun 2024 pada Kegiatan Administrasi Umum                     Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis       Elektronik pada SKPD;",
    "Surat Sekretaris Daerah Provinsi Jawa Tengah Nomor 000.8.3/261 Tanggal 29 Mei               2024.Hal Desk Pengisian Aplikasi Metal",
];

// Loop untuk mencetak daftar Undang-Undang
$no = 1; // Variabel untuk nomor urut
foreach ($undang_undang as $uu) {
    // Tampilkan nomor urut dan teks Undang-Undang
    $pdf->MultiCell(0, 10, $no . '. ' . $uu, 0, 'L');
    $no++; // Tambahkan nomor urut
    $pdf->Ln(1); // Spasi kecil antar item
}
$pdf->SetY(-30); // Set posisi Y ke 30 mm dari bawah
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 3, 'Dokumen ini telah ditandatangani secara elektronik yang diterbitkan oleh balai sertifikasi Elektronik (BSrE),BSSN', 0, 1, 'C');
$pdf->Ln(5);

// Mengatur ketebalan garis
$pdf->SetLineWidth(0.2); // Garis dengan ketebalan 0.5 mm

// Menggambar garis horizontal di bagian bawah halaman
$startX = 15; // Posisi X awal dari garis (kiri)
$endX = 195; // Posisi X akhir dari garis (kanan)
$y = $pdf->GetY(); // Posisi Y dari garis (sesuai dengan SetY yang diatur)

$pdf->Line($startX, $y, $endX, $y); // Menggambar garis dari posisi X awal ke X akhir
//output
$pdf->Output('Surat Tugas.pdf');
