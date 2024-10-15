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
    $pdf->Image('library/logo1.jpg', 10, 10, 20);
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
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(190, 5, "SURAT TUGAS", 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 12);

    $id = $_GET['id'];
    $query_isi = "SELECT * FROM form_spt where id_spt='$id'";
    $result_isi = $conn->query($query_isi);
    $row_isi = $result_isi->fetch_assoc();
    $pdf->MultiCell(190, 10, 'Nomor :' . $row_isi['no_spt'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3);
    $query_dasar = "SELECT * FROM tb_produk ";
    $result_dasar = $conn->query($query_dasar);


   
    $no = 1;
    $pdf->Cell(30, 0, 'Dasar   :  ', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->Ln(0);
    
    while ($row = $result_dasar->fetch_assoc()) {
        // Menentukan lebar kolom angka urut yang lebih besar, misalnya 15mm
        $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Cell(10, 0, $no . '. ', 0, 0, 'L');  // Angka urut dengan Cell
        $pdf->MultiCell(0, 5, $row['kode_produk']."\n", 0, 'J', 0, 1);  // Isi teks menggunakan MultiCell
        $no++;
        $pdf->Ln(2);  // Spasi antar baris
    }
    
    
    // $pdf->MultiCell(0, 10, $row['kode_produk'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')

    $no = 6;
    
    // MultiCell untuk teks utama dengan Cell terpisah untuk nomor urut
    $pdf->MultiCell(25, 7, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->Cell(10, 5, $no . '. ', 0, 0, 'L');  // Kolom untuk nomor urut tanpa nol di depan
    $pdf->MultiCell(0, 10, 'Dokumen Pelaksanaan Anggaran (DPA) BPSDMD Provinsi Jawa Tengah Tahun 2024 Nomor 01891/DPA/2024 APBD Tahun 2024 pada ' . $row_isi['anggaran']."\n", 0, 'J', 0, 1);
    $pdf->Ln(1);
    $no++;  // Increment nomor urut
    
    // MultiCell berikutnya untuk dasar undangan
    $pdf->MultiCell(25, 7, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->Cell(10, 5, $no . '. ', 0, 0, 'L');  // Kolom untuk nomor urut tanpa nol di depan
    $pdf->MultiCell(0, 10, $row_isi['dasar_undangan']. "\n", 0, 'J', 0, 1); // Kolom untuk isi teks
    $no++;
    
    $pdf->Ln(2);


   

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Ln(2);
    $pdf->Cell(190, 5, "MEMERINTAHKAN:", 0, 1, 'C');
    $pdf->Ln(4);
//$pdf->Cell(12, 9, 'Kepada   :   Terlampir dengan 0 pengikut', 0, 1, 'L');
    $query = "SELECT * FROM daftar_nama ";
    $result = $conn->query($query);

    
    // Menghitung jumlah baris data
    $jumlah_orang = mysqli_num_rows($result);
    
    //Jika jumlah orang kurang dari 5, tampilkan teks
    if ($jumlah_orang < 5) {
    //$pdf->Cell(12, 9, 'Kepada   :', 0, 1, 'L');
    //$no = 1;
    $pdf->MultiCell(50, 40, 'Kepada   :  ', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $no = 1;
   
        while ($row = mysqli_fetch_assoc($result)) {
    
            //$pdf->Ln(3);
            //$pdf->SetX(36);
            //$pdf->Cell(0, 0,  $no. '. '.'Nama' . $row['nama'], 0, 1);
            //$no++;
            //$pdf->SetX(43);
            //$pdf->Cell(0, 0, 'NIP                                :' . $row['NIP'], 0, 1);
            //$pdf->SetX(43);
            //$pdf->Cell(0, 0, 'Pangkat/Gol. Ruang      :' . $row['pangkat'], 0, 1);
            //$pdf->SetX(43);
            //$pdf->Cell(0, 0, 'Jabatan                          :' . $row['jabatan'], 0, 1);
           
            $pdf->SetX(36);
            $pdf->MultiCell(55, 20, $no++.'. '.'  Nama', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
            $pdf->SetX(62);
            $pdf->MultiCell(21, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
            $pdf->MultiCell(150, 0, $row['nama'], 0, 'J'."\n", 0, 0, '73', '', true, 0, false, true, 40, 'T');
            $pdf->Ln(7);
            
            $pdf->SetX(41);
            $pdf->MultiCell(58, 20,'  NIP', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
            $pdf->SetX(70);
            $pdf->MultiCell(0, 20, ': ', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
            $pdf->MultiCell(75, 0, $row['NIP'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
            $pdf->Ln(7);
            
            $pdf->SetX(41);
            $pdf->MultiCell(55, 20,'  Pangkat/Gol', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
            $pdf->SetX(65,5);
            $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
            $pdf->MultiCell(75, 0, $row['pangkat'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
            $pdf->Ln(7);
            
            $pdf->SetX(41);
            $pdf->MultiCell(55, 20,'  Jabatan', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
            $pdf->SetX(65,5);
            $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
            $pdf->MultiCell(75, 0, $row['jabatan'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
            $pdf->Ln(7);

        }
    } else {
        
        if ($jumlah_orang > 4) {
            $pdf->Cell(12, 9, 'Kepada   :   Terlampir dengan 0 pengikut', 0, 1, 'L');
        }
    }
          
                

    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(12, 20, 'Untuk      : 1. Melaksanakan tugas perjalanan dinas dengan ketentuan sebagai berikut:');
    $pdf->Ln(30);
    $pdf->SetX(38);
    $pdf->MultiCell(55, 40, 'a. Maksud dan Tujuan', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(10, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(85, 40, $row_isi['maksud_tujuan'] ."\n", 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
    // $pdf->MultiCell(120, 10, 'a. Maksud dan Tujuan      :' . $row['maksud_tujuan'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi
    $pdf->Ln(3);
    //$pdf->SetFont('helvetica', '', 8);
    //$pdf->Cell(0, 3, 'Dokumen ini telah ditandatangani secara elektronik yang diterbitkan oleh balai sertifikasi Elektronik (BSrE),BSSN', 0, 1, 'C');
// Mengatur ketebalan garis
//$pdf->SetLineWidth(0.2); // Garis dengan ketebalan 0.5 mm

    // Menggambar garis horizontal di bagian bawah halaman
//$startX = 15; // Posisi X awal dari garis (kiri)
//$endX = 195; // Posisi X akhir dari garis (kanan)
//$y = $pdf->GetY(); // Posisi Y dari garis (sesuai dengan SetY yang diatur)

    //$pdf->Line($startX, $y, $endX, $y); // Menggambar garis dari posisi X awal ke X akhir

    $pdf->Ln(10);
    $pdf->SetX(38);
    $pdf->MultiCell(55, 0, 'b. Tempat yang dituju', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(10, 0, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(75, 0, $row_isi['lokasi'], 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    // $pdf->MultiCell(120, 10, 'a. Tempat yang dituju      :' . $row['lokasi'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi
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
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        
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
$teks_hari = $jumlah_hari . '(' . $kata_hari . ') ';
//$pdf->AddPage();
    // Tampilkan tanggal dan hasil perhitungan selisih hari di PDF
    $pdf->Ln(10);
    $pdf->SetX(38);
    $pdf->MultiCell(55, 20, 'c. Untuk Selama', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->MultiCell(10, 20, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->MultiCell(0, 0, '' .  $teks_hari . 'hari', 0, 1);
    $pdf->Ln(1);
    $pdf->SetX(42.5);
    $pdf->MultiCell(50.5, 0, 'Berangkat tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->MultiCell(10, 0, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->MultiCell(85, 0, tgl_indo($row_isi['tgl_kegiatan']), 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
    // $pdf->MultiCell(120, 10, 'a. berangkat tanggal      :' . $row['tgl_berangkat'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi


    $pdf->Ln(3);
    $pdf->SetX(42.5);
    $pdf->MultiCell(50.5, 40, 'Pulang Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(10, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(85, 40, tgl_indo($row_isi['tgl_pulang']), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    // $pdf->MultiCell(120, 10, 'a. berangkat tanggal      :' . $row['tgl_berangkat'], 0, 'L', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi

    $pdf->Ln(3);
    $pdf->SetX(32);
    $pdf->Cell(12, 5, '2. Tidak Menerima gratifikasi dalam bentuk apapun sesuai ketentuan.', 0, 1, 'L');
    $pdf->SetX(32);
    $pdf->Cell(12, 5, '3. Melaporkan kepada Pejabat setempat guna pelaksanaan tugas tersebut.', 0, 1, 'L');
    $pdf->SetX(32);
    $pdf->Cell(12, 5, '4. Melaporkan Hasil Pelaksanaan Tugas kepada Pejabat pemberi tugas.', 0, 1, 'L');
    $pdf->SetX(32);
    $pdf->Cell(12, 5, '5. Perintah ini dilaksanakan dengan penuh tanggung jawab.', 0, 1, 'L');
    $pdf->SetX(32);
    $pdf->Cell(12, 5, '6. Apabila terdapat kekeliruan dalam surat perintah ini akan diadakan perbaikan.', 0, 1, 'L');
    $pdf->SetX(37);
    $pdf->Cell(12, 5, 'kembali sebagiamana mestinya.', 0, 1, 'L');
    $pdf->Ln(10);

    $pdf->SetX(108);
    $pdf->MultiCell(34.5, 40, 'Ditetapkan di', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(5, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->SetX(149);
    $pdf->MultiCell(97, 40, 'Semarang', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->Ln(5);
    //$pdf->Cell(260,5,"Ditetapkan di : Semarang",0,1,'C');
    $pdf->SetX(108);
    $pdf->MultiCell(32, 40, 'Pada Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(9.5, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(80, 40, tgl_indo($row_isi['tgl_spt']), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

    //$pdf->MultiCell(260, 5, 'Pada Tanggal :'.$row['tgl_spt'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi
    $pdf->Ln(3);
    $pdf->Cell(260, 5, "Kepala Bidang Pengembangan Kompetensi", 0, 1, 'C');
    $pdf->Ln(30);
    $pdf->Cell(260, 5, "Dr.Anon Priyantoro, S.Pd, M.Pd", 0, 1, 'C');
    $pdf->Cell(260, 5, "Pembina Tingkat I", 0, 1, 'C');
    $pdf->MultiCell(260, 5, 'NIP. ' . $row_isi['NIP_penandatangan'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
    $pdf->Ln(3); // Spasi
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

    

    if ($jumlah_orang > 4) {

    $pdf->AddPage('L');
    
    $pdf->SetFont('helvetica', '', 12);

    // Header kolom
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(75, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(45, 10, 'NIP', 1, 0, 'C');
$pdf->Cell(55, 10, 'Pangkat', 1, 0, 'C');
$pdf->Cell(100, 10, 'Jabatan', 1, 1, 'C');


 
     // Isi tabel
    
     
     //while ($row = $result->fetch_assoc()) {
         //$no = 1;
         //$pdf->MultiCell(10, 10, $row['id_nama'], 1, 0, 'C');
         //$no++;
         //$pdf->MultiCell(70, 10, $row['nama'], 1, 'L', 0, 0);
         //$pdf->MultiCell(50, 10, $row['NIP'], 1, 'L', 0, 0);
         //$pdf->MultiCell(50, 10, $row['pangkat'], 1, 'L', 0, 0);
         //$pdf->MultiCell(110, 10, $row['jabatan'], 1, 'L', 0, 0);

         $no = 1;
            while ($row = $result->fetch_assoc()) {
                $pdf->Cell(10, 10, $no, 1, 0, 'C');
                $no++;
                $pdf->Cell(75, 10, $row['nama'], 1, 0, 'L');
                $pdf->Cell(45, 10, $row['NIP'], 1, 0, 'C');
                $pdf->Cell(55, 10, $row['pangkat'], 1, 0, 'C');
                $pdf->Cell(100, 10, $row['jabatan'], 1, 1, 'L');
                


         
     }
     
 }



    
   
    // Output PDF ke browser
    $pdf->Output('surat_dari_database.pdf', 'I');

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$conn->close();
?>