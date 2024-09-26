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
$pdf->SetFont('helvetica', '', 13);
$pdf->Ln(2);
$pdf->Cell(190,5,"MEMERINTAHKAN:",0,1,'C');
$pdf->Ln(2);
$pdf->Cell(12,9,'Kepada   :   Terlampir dengan 0 pengikut',0,1,'L');
$pdf->Cell(12,3,'untuk      :    1. Melaksanakan tugas perjalanan dinas dengan ketentuan sebagai berikut:',0,1,'L');
$pdf->Cell(10,3,'                          a.  Maksud dan tujuan  :  Menghadiri Desk Pengisan Aplikasi Metal',0,1,'L');
$pdf->Cell(10,3,'                          b.  Tempat yang dituju  :  Gedung Monumen PKK',0,1,'L');
$pdf->Cell(10,3,'                                                                  JL. Letjend Suprapto,  Ungaran, Kab.Semarang',0,1,'L');
$pdf->Cell(10,5,'                          c.  Untuk selama           :  1 (satu) hari',0,1,'L');
$pdf->Cell(10,3,'                               Berangkat tanggal   :  5 Juni 2024',0,1,'L');
$pdf->Cell(10,3,'                               Pulang tanggal        :  5 Juni 2024',0,1,'L');
$pdf->Cell(12,5,'                    2. Tidak Menerima gratifikasi dalam bentuk apapun sesuai ketentuan.',0,1,'L');
$pdf->Ln(16);
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

//add page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 13);
$pdf->Cell(12,5,'                    3. Melaporkan kepada Pejabat setempat guna pelaksanaan tugas tersebut.',0,1,'L');
$pdf->Cell(12,5,'                    4. Melaporkan Hasil Pelaksanaan Tugas kepada Pejabat pemberi tugas.',0,1,'L');
$pdf->Cell(12,5,'                    3. Perintah ini dilaksanakan dengan penuh tanggung jawab.',0,1,'L');
$pdf->Cell(12,5,'                    3. Apabila terdapat kekeliruan dalam surat perintah ini akan diadakan.',0,1,'L');
$pdf->Cell(12,5,'                        perbaikan kembali sebagiamana mestinya.',0,1,'L');

$pdf->Ln(10);
$pdf->Cell(260,5,"Ditetapkan di : Semarang",0,1,'C');
$pdf->Cell(260,5,"   Pada tanggal  : 4 Juni 2024",0,1,'C');
$pdf->Ln(5);
$pdf->Cell(260,5,"Plh. KEPALA BADAN PENGEMBANGAN",0,1,'C');
$pdf->Cell(260,5,"SUMBER DAYA MANUSIA DAERAH PROVINSI",0,1,'C');
$pdf->Cell(260,5,"JAWA TENGAH",0,1,'C');
$pdf->Cell(260,5,"Kepala Bidang Pengembangan Kompetensi",0,1,'C');
$pdf->Ln(30);
$pdf->Cell(260,15,"Dr.Anon Priyantoro, S.Pd, M.Pd",0,1,'C');
$pdf->Cell(260,5,"Pembina Tingkat I",0,1,'C');
$pdf->Cell(260,5,"NIP. 197305011998011001",0,1,'C');
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
$pdf->Output('Lapora Surat SPT.pdf');
