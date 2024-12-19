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
    $pdf = new TCPDF('P', 'mm', array(215.9, 330.2), true, 'UTF-8', false);



    //remove default header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);


    // Menambahkan halaman
    $pdf->AddPage();


    //logo
    $pdf->Image('library/logo1.jpg', 15, 10, 20);
    //title
    $pdf->SetFont('Helvetica', 'B', 14);
    $pdf->Cell(195, 5, "PEMERINTAH PROVINSI JAWA TENGAH", 0, 1, 'C');
    $pdf->SetFont('Helvetica', 'B', 14);
    $pdf->Cell(195, 5, "BADAN PENGEMBANGAN ", 0, 1, 'C');
    $pdf->Cell(195, 5, "SUMBER DAYA MANUSIA DAERAH", 0, 1, 'C');
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(195, 3, "Jalan Setiabudi Nomor 201 A Semarang Kode Pos 50263", 0, 1, 'C');
    $pdf->Cell(195, 3, "Telp. 024-7473066 Faks. 024-7473701", 0, 1, 'C');
    $pdf->Cell(195, 3, "Website : www.bpsdmd.jatengprov.go.id Email : bpsdmd@jatengprov.go.id", 0, 1, 'C');

    // garis bawah double 
    $pdf->SetLineWidth(1);
    $pdf->Line(9, 43, 200, 43);
    $pdf->SetLineWidth(0);
    $pdf->Line(9, 43, 200, 43);
    $pdf->Ln(4);


    // ISI
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(195, 5, "SURAT TUGAS", 0, 1, 'C');

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

    // Gabungkan "Dasar :" dan nomor pertama pada baris yang sama
    $pdf->Cell(30, 0, 'Dasar : ', 0, 0, 'L'); // Cell untuk "Dasar :"
    if ($row = $result_dasar->fetch_assoc()) {
        // Tampilkan nomor pertama setelah "Dasar :"
        $pdf->Cell(10, 0, $no . '. ', 0, 0, 'L');  // Nomor urut
        $pdf->MultiCell(0, 5, $row['kode_produk'] . "\n", 0, 'j', 0, 1);  // Teks
        $no++; // Increment nomor
        $pdf->Ln(0); // Spasi antar baris untuk keterbacaan
    }

    // Lanjutkan menampilkan baris berikutnya untuk nomor urut 2 dan seterusnya
    while ($row = $result_dasar->fetch_assoc()) {
        $pdf->Cell(30, 0, '', 0, 0, 'L'); // Kosongkan Cell di sebelah kiri untuk menyesuaikan "Dasar :"
        $pdf->Cell(10, 0, $no . '. ', 0, 0, 'L');  // Nomor urut
        $pdf->MultiCell(0, 5, $row['kode_produk'] . "\n", 0, 'j', 0, 1);  // Teks
        $no++; // Increment nomor
        $pdf->Ln(0); // Spasi antar baris untuk keterbacaan
    }



    $no = 6;

    // Cek apakah data pada kolom `anggaran` ada sebelum mencetak
    if (!empty($row_isi['anggaran'])) {
        $pdf->Cell(30, 0, '', 0, 0, 'L'); // Kosongkan Cell di sebelah kiri untuk menyesuaikan "Dasar :"
        $pdf->Cell(10, 0, $no . '. ', 0, 0, 'L');  // Nomor urut
        $pdf->MultiCell(0, 5, 'Dokumen Pelaksanaan Anggaran (DPA) BPSDMD Provinsi Jawa Tengah Tahun 2024 Nomor 01891/DPA/2024 APBD Tahun 2024 pada ' . $row_isi['anggaran'] . "\n", 0, 'J', 0, 1);
        $pdf->Ln(0);
        $no++; // Increment nomor urut jika data ada
    }
    
    // Cek apakah data pada kolom `dasar_undangan` ada sebelum mencetak
    if (!empty($row_isi['dasar_undangan'])) {
        $pdf->Cell(30, 0, '', 0, 0, 'L'); // Kosongkan Cell di sebelah kiri untuk menyesuaikan "Dasar :"
        $pdf->Cell(10, 0, $no . '. ', 0, 0, 'L');  // Nomor urut
        $pdf->MultiCell(0, 5, $row_isi['dasar_undangan'] . "\n", 0, 'J', 0, 1);
        $pdf->Ln(0);
        $no++; // Increment nomor urut jika data ada
    }
    

    $pdf->Ln(2);




    $pdf->SetFont('helvetica', '', 12);
    $pdf->Ln(0);
    $pdf->Cell(190, 9, "MEMERINTAHKAN:", 0, 1, 'C');
    $pdf->Ln(0);
    $query = "SELECT * FROM cetak_laporan WHERE id_spt = $id";
    $result = $conn->query($query);

    // Menghitung jumlah baris data
    $jumlah_orang = mysqli_num_rows($result);

    //Jika jumlah orang kurang dari 5, tampilkan teks
    if ($jumlah_orang < 5) {
        //$pdf->Cell(12, 9, 'Kepada   :', 0, 1, 'L');
        //$no = 1;
        $pdf->Ln(5);
        $pdf->MultiCell(50, 40, 'Kepada   :  ', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $no = 1;

        if ($row = mysqli_fetch_assoc($result)) {
            $id_nama = $row['id_nama'];
            $querynama = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
            while ($row = mysqli_fetch_assoc($querynama)) {


                $pdf->SetX(36);
                $pdf->MultiCell(55, 20, $no++ . '. ' . '  Nama', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                $pdf->SetX(61.3);
                $pdf->MultiCell(21, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                $pdf->MultiCell(150, 0, $row['nama'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                $pdf->Ln(6);

                if (!empty($row['NIP'])) {
                    $pdf->SetX(41);
                    $pdf->MultiCell(58, 20, '  NIP', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->SetX(69.5);
                    $pdf->MultiCell(0, 20, ': ', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->MultiCell(150, 0, $row['NIP'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                    $pdf->Ln(6);
                }
                if (!empty($row['pangkat'])) {
                    $pdf->SetX(41);
                    $pdf->MultiCell(55, 20, '  Pangkat/Gol', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->SetX(65, 5);
                    $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->MultiCell(150, 0, $row['pangkat'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                    $pdf->Ln(6);
                }

                $pdf->SetX(41);
                $pdf->MultiCell(55, 20, '  Jabatan', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                $pdf->SetX(65, 5);
                $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                $pdf->MultiCell(150, 0, $row['jabatan'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                $pdf->Ln(6);

                $no = 2;
            }
            if ($row = mysqli_fetch_assoc($result)) {
                $id_nama = $row['id_nama'];
                $querynama = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
                while ($row = mysqli_fetch_assoc($querynama)) {

                    $pdf->SetX(36);
                    $pdf->MultiCell(55, 20, $no++ . '. ' . '  Nama', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->SetX(61.3);
                    $pdf->MultiCell(21, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->MultiCell(150, 0, $row['nama'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                    $pdf->Ln(6);

                    if (!empty($row['NIP'])) {
                        $pdf->SetX(41);
                        $pdf->MultiCell(58, 20, '  NIP', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->SetX(69.5);
                        $pdf->MultiCell(0, 20, ': ', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->MultiCell(150, 0, $row['NIP'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                        $pdf->Ln(6);
                    }
                    if (!empty($row['pangkat'])) {
                        $pdf->SetX(41);
                        $pdf->MultiCell(55, 20, '  Pangkat/Gol', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->SetX(65, 5);
                        $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->MultiCell(150, 0, $row['pangkat'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                        $pdf->Ln(6);
                    }

                    $pdf->SetX(41);
                    $pdf->MultiCell(55, 20, '  Jabatan', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->SetX(65, 5);
                    $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->MultiCell(150, 0, $row['jabatan'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                    $pdf->Ln(6);
                }
                $no = 3;
            }
            if ($row = mysqli_fetch_assoc($result)) {
                $id_nama = $row['id_nama'];
                $querynama = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
                while ($row = mysqli_fetch_assoc($querynama)) {

                    $pdf->SetX(36);
                    $pdf->MultiCell(55, 20, $no++ . '. ' . '  Nama', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->SetX(61.3);
                    $pdf->MultiCell(21, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->MultiCell(150, 0, $row['nama'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                    $pdf->Ln(6);

                    if (!empty($row['NIP'])) {
                        $pdf->SetX(41);
                        $pdf->MultiCell(58, 20, '  NIP', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->SetX(69.5);
                        $pdf->MultiCell(0, 20, ': ', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->MultiCell(150, 0, $row['NIP'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                        $pdf->Ln(6);
                    }
                    if (!empty($row['pangkat'])) {
                        $pdf->SetX(41);
                        $pdf->MultiCell(55, 20, '  Pangkat/Gol', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->SetX(65, 5);
                        $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->MultiCell(150, 0, $row['pangkat'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                        $pdf->Ln(6);
                    }

                    $pdf->SetX(41);
                    $pdf->MultiCell(55, 20, '  Jabatan', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->SetX(65, 5);
                    $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                    $pdf->MultiCell(150, 0, $row['jabatan'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                    $pdf->Ln(6);

                    $no = 4;

                    if ($row = mysqli_fetch_assoc($result)) {
                        $id_nama = $row['id_nama'];
                        $querynama = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
                        while ($row = mysqli_fetch_assoc($querynama)) {
            
                        $pdf->SetX(36);
                        $pdf->MultiCell(55, 20, $no++ . '. ' . '  Nama', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->SetX(61.3);
                        $pdf->MultiCell(21, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->MultiCell(150, 0, $row['nama'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                        $pdf->Ln(6);
            
                        if (!empty($row['NIP'])) {
                            $pdf->SetX(41);
                            $pdf->MultiCell(58, 20, '  NIP', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                            $pdf->SetX(69.5);
                            $pdf->MultiCell(0, 20, ': ', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                            $pdf->MultiCell(150, 0, $row['NIP'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                            $pdf->Ln(6);
                        }
                        if (!empty($row['pangkat'])) {
                            $pdf->SetX(41);
                            $pdf->MultiCell(55, 20, '  Pangkat/Gol', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                            $pdf->SetX(65, 5);
                            $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                            $pdf->MultiCell(150, 0, $row['pangkat'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                            $pdf->Ln(6);
                        }
            
                        $pdf->SetX(41);
                        $pdf->MultiCell(55, 20, '  Jabatan', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->SetX(65, 5);
                        $pdf->MultiCell(13, 20, ': ', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
                        $pdf->MultiCell(130, 10, $row['jabatan'], 0, 'L', 0, 0, '73', '', true, 0, false, true, 40, 'T');
                        $pdf->Ln(10);
                    }}
                }
            }
        }
    } else {

        if ($jumlah_orang > 4) {
            $pdf->Cell(12, 0, 'Kepada   :   Terlampir dengan 0 pengikut', 0, 1, 'L');
        }
    }


    //$pdf->AddPage();            
    if ($jumlah_orang < 5) {
        $pdf->AddPage();
      
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(12, 0, 'Untuk      :     1. Melaksanakan tugas perjalanan dinas dengan ketentuan sebagai berikut:');
        $pdf->Ln(5);
    } else {

        if ($jumlah_orang > 4) {
            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(12, 0, 'Untuk      :    1. Melaksanakan tugas perjalanan dinas dengan ketentuan sebagai berikut:');
            $pdf->Ln(5);

        }
    }


    $pdf->SetX(38);
    $pdf->MultiCell(55, 10, ' a. Maksud dan Tujuan', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(10, 10, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(100, 15, $row_isi['maksud_tujuan'] . "\n", 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
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
    $pdf->MultiCell(55, 0, ' b. Tempat yang dituju', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(10, 0, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(100, 10, $row_isi['lokasi'], 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
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

    // Tampilkan tanggal dan hasil perhitungan selisih hari di PDF
    $pdf->Ln(8);
    $pdf->SetX(38);
    $pdf->MultiCell(55, 20, ' c. Untuk Selama', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->MultiCell(10, 20, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->MultiCell(0, 0, '' . $teks_hari . 'hari', 0, 1);
    $pdf->Ln(1);
    $pdf->SetX(42.5);
    $pdf->MultiCell(50.5, 0, ' Berangkat tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->MultiCell(10, 0, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->MultiCell(85, 0, tgl_indo($row_isi['tgl_kegiatan']), 0, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
    $pdf->Ln(3); // Spasi


    $pdf->Ln(3);
    $pdf->SetX(42.5);
    $pdf->MultiCell(50.5, 40, ' Pulang Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(10, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(85, 40, tgl_indo($row_isi['tgl_pulang']), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->Ln(4); // Spasi


    if ($jumlah_orang < 5) {

        $no = 2;
        $pdf->Ln(2);
        $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');  // Kolom untuk nomor urut tanpa nol di depan
        $pdf->MultiCell(0, 0, 'Tidak Menerima gratifikasi dalam bentuk apapun sesuai ketentuan. ' . "\n", 0, 'J', 0, 1);
        $no++;
        $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');
        $pdf->MultiCell(0, 0, 'Melaporkan kepada Pejabat setempat guna pelaksanaan tugas tersebut. ' . "\n", 0, 'J', 0, 1);
        $no++;
        $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');
        $pdf->MultiCell(0, 0, 'Melaporkan Hasil Pelaksanaan Tugas kepada Pejabat pemberi tugas. ' . "\n", 0, 'J', 0, 1);
        $no++;
        $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');
        $pdf->MultiCell(0, 0, 'Perintah ini dilaksanakan dengan penuh tanggung jawab.' . "\n", 0, 'J', 0, 1);
        $no++;
        $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');
        $pdf->MultiCell(0, 0, 'Apabila terdapat kekeliruan dalam surat perintah ini akan diadakan perbaikan kembali sebagiamana mestinya. ' . "\n", 0, 'J', 0, 1);
        $pdf->Ln(10);


    } else {

        if ($jumlah_orang > 4) {
            $no = 2;
            $pdf->Ln(2);
            $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
            $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');  // Kolom untuk nomor urut tanpa nol di depan
            $pdf->MultiCell(0, 0, 'Tidak Menerima gratifikasi dalam bentuk apapun sesuai ketentuan. ' . "\n", 0, 'J', 0, 1);
            $no++;
            $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
            $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');
            $pdf->MultiCell(0, 0, 'Melaporkan kepada Pejabat setempat guna pelaksanaan tugas tersebut. ' . "\n", 0, 'J', 0, 1);
            $no++;
            $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
            $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');
            $pdf->MultiCell(0, 0, 'Melaporkan Hasil Pelaksanaan Tugas kepada Pejabat pemberi tugas. ' . "\n", 0, 'J', 0, 1);
            // Tambahkan logika untuk setiap poin selanjutnya

    $pdf->AddPage();

            $no++;
            $pdf->Ln();
            $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
            $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');
            $pdf->MultiCell(0, 0, 'Perintah ini dilaksanakan dengan penuh tanggung jawab.' . "\n", 0, 'J', 0, 1);
            $no++;
            $pdf->MultiCell(25, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
            $pdf->Cell(5, 0, $no . '. ', 0, 0, 'L');
            $pdf->MultiCell(0, 0, 'Apabila terdapat kekeliruan dalam surat perintah ini akan diadakan perbaikan kembali sebagiamana mestinya. ' . "\n", 0, 'J', 0, 1);

            $pdf->Ln(10);
            

        }
    }


    $pdf->SetX(108);
    $pdf->MultiCell(34.5, 40, 'Ditetapkan di', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(5, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->SetX(149);
    $pdf->MultiCell(97, 40, 'Semarang', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->Ln(5);

    $pdf->SetX(108);
    $pdf->MultiCell(32, 40, 'Pada Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(9.5, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(80, 40, tgl_indo($row_isi['tgl_spt']), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->Ln(5);



    $selectedName = $row_isi['NIP_penandatangan'];

    if (strpos($selectedName, 'Dr. SADIMIN') !== false) {
        // Without "plh"
        $pdf->Cell(260, 5, "", 0, 1, 'C');
        // Get current X and Y position for the line


        $x = $pdf->GetX();


        $y = $pdf->GetY();



        $line_length = 100; // Panjang garis dalam satuan TCPDF

        // Menggambar garis di bawah nama
        $pdf->Line($x + 104, $y + 47, $x + 56 + $line_length, $y + 47); // Garis sepanjang 100 unit




    } else {
        if (strpos($selectedName, 'Sri Sulistiyati, SE, M.Kom') !== false) {
            // Without "plh"
            $pdf->Cell(260, 5, "", 0, 1, 'C');
            // Get current X and Y position for the line


            $x = $pdf->GetX();


            $y = $pdf->GetY();



            $line_length = 100; // Panjang garis dalam satuan TCPDF

            // Menggambar garis di bawah nama
            $pdf->Line($x + 106, $y + 68, $x + 54 + $line_length, $y + 68); // Garis sepanjang 100 unit

            $pdf->Ln(5);
            // With "plh"
            $pdf->Cell(260, 5, "plh. KEPALA BADAN PENGEMBANGAN", 0, 1, 'C');
            $pdf->Cell(260, 5, "SUMBER DAYA MANUSIA DAERAH PROVINSI", 0, 1, 'C');
            $pdf->Cell(260, 5, "JAWA TENGAH", 0, 1, 'C');
        }

        if (strpos($selectedName, 'Sumarhendro, S.Sos') !== false) {
            // Without "plh"
            $pdf->Cell(260, 5, "", 0, 1, 'C');
            // Get current X and Y position for the line


            $x = $pdf->GetX();


            $y = $pdf->GetY();



            $line_length = 100; // Panjang garis dalam satuan TCPDF

            // Menggambar garis di bawah nama
            $pdf->Line($x + 110, $y + 68, $x + 50 + $line_length, $y + 68); // Garis sepanjang 100 unit

            $pdf->Ln(5);
            // With "plh"
            $pdf->Cell(260, 5, "plh. KEPALA BADAN PENGEMBANGAN", 0, 1, 'C');
            $pdf->Cell(260, 5, "SUMBER DAYA MANUSIA DAERAH PROVINSI", 0, 1, 'C');
            $pdf->Cell(260, 5, "JAWA TENGAH", 0, 1, 'C');
        }
        if (strpos($selectedName, 'Dr. Anon Priyantoro, S.Pd., M.Pd') !== false) {
            // Without "plh"
            $pdf->Cell(260, 5, "", 0, 1, 'C');
            // Get current X and Y position for the line


            $x = $pdf->GetX();


            $y = $pdf->GetY();



            $line_length = 100; // Panjang garis dalam satuan TCPDF

            // Menggambar garis di bawah nama
            $pdf->Line($x + 99, $y + 68, $x + 61 + $line_length, $y + 68); // Garis sepanjang 100 unit

            $pdf->Ln(5);
            // With "plh"
            $pdf->Cell(260, 5, "plh. KEPALA BADAN PENGEMBANGAN", 0, 1, 'C');
            $pdf->Cell(260, 5, "SUMBER DAYA MANUSIA DAERAH PROVINSI", 0, 1, 'C');
            $pdf->Cell(260, 5, "JAWA TENGAH", 0, 1, 'C');
        }
    }

    // This part will be the same for both cases
    $pdf->MultiCell(260, 5, $selectedName, 0, 'C', 0, 1); // Display selected name
    $pdf->Ln(3); // Add space

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

        $pdf->SetLineWidth(0.3);



        $pdf->AddPage('P');


        $pdf->SetFont('Helvetica', '', 10);
        $pdf->SetX(108);
        $pdf->Cell(0, 5, "Lampiran I", 0, 1, 'L');
        $pdf->SetX(108);
        $pdf->Cell(0, 5, "Surat Tugas Kepala Badan Pengembangan", 0, 1, 'L');
        $pdf->SetX(108);
        $pdf->Cell(0, 5, "Sumber Daya Manusia Daerah", 0, 1, 'L');
        $pdf->SetX(108);
        $pdf->Cell(0, 5, "Provinsi Jawa Tengah", 0, 1, 'L');



        $pdf->Ln(0);


        $pdf->SetX(108);
        $pdf->Cell(20, 5, 'Tanggal', 0, 0, 'L');
        $pdf->Cell(3, 5, ':', 0, 0, 'C');
        $pdf->Cell(80, 5, tgl_indo($row_isi['tgl_spt']), 0, 1, 'L');
        $pdf->Ln(0);

        $pdf->SetX(108);
        $pdf->Cell(20, 5, 'Nomor', 0, 0, 'L');
        $pdf->Cell(3, 5, ':', 0, 0, 'C');
        $pdf->Cell(80, 5, $row_isi['no_spt'], 0, 1, 'L');
        $pdf->Ln(10);

        $pdf->SetFont('Helvetica', '', 12);
        $no = 1;



        $pdf->MultiCell(11, 0, 'No.', 1, 'L', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->SetX(21);
        $pdf->MultiCell(156, 0, ' Nama/NIP/Pangkat/Jabatan', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->SetX(20);
        $pdf->MultiCell(30, 0, '    Keterangan', 'RTB', 'L', 0, 0, '172', '', true, 0, false, true, 40, 'T');
        $pdf->Ln();

        $no = 1; // Inisialisasi nomor
        $counter = 0; // Inisialisasi counter
        $max_data_per_page = 7; // Jumlah maksimal data per halaman
        while ($row = mysqli_fetch_assoc($result)) {
                $id_nama = $row['id_nama'];
                $querynama = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
                while ($row = mysqli_fetch_assoc($querynama)) {


            $pdf->MultiCell(11, 0, $no++, 1, 'L', 0, 0, '', '', true);

            // Nama
            $pdf->MultiCell(30, 0, 'Nama', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(5, 0, ':', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(121, 0, $row['nama'], 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(25, 0, '', 1, 'L', 0, 0, '', '', true);

            $pdf->Ln();

            // NIP
            $pdf->MultiCell(11, 0, '', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(30, 0, 'NIP', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(5, 0, ':', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(121, 0, $row['NIP'], 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(25, 0, '', 1, 'L', 0, 0, '', '', true);

            $pdf->Ln();

            // Pangkat/Gol
            $pdf->MultiCell(11, 0, '', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(30, 0, 'Pangkat/Gol', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(5, 0, ':', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(121, 0, $row['pangkat'], 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(25, 0, '', 1, 'L', 0, 0, '', '', true);
            $pdf->Ln();

            // Jabatan
            $pdf->MultiCell(11, 0, '', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(30, 0, 'Jabatan', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(5, 0, ':', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(121, 0, $row['jabatan'], 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(25, 0, '', 1, 'L', 0, 0, '', '', true);
            $pdf->Ln();
            $counter++; // Tambah counter

            // Jika sudah 5 data, buat halaman baru dan reset counter
            if ($counter > $max_data_per_page) {
                $pdf->AddPage(); // Tambah halaman baru
                $counter = 0; // Reset counter
            }
        }
    }

        $pdf->Ln(10);
        $pdf->SetX(108);
        $pdf->MultiCell(34.5, 40, 'Ditetapkan di', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(5, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(149);
        $pdf->MultiCell(97, 40, 'Semarang', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(5);

        $pdf->SetX(108);
        $pdf->MultiCell(32, 40, 'Pada Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(9.5, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(80, 40, tgl_indo($row_isi['tgl_spt']), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

        $pdf->Ln(5);



        $selectedName = $row_isi['NIP_penandatangan'];


        if (strpos($selectedName, 'Dr. SADIMIN') !== false) {
            // Without "plh"
            $pdf->Cell(260, 5, "", 0, 1, 'C');
            // Get current X and Y position for the line


            $x = $pdf->GetX();


            $y = $pdf->GetY();



            $line_length = 100; // Panjang garis dalam satuan TCPDF

            // Menggambar garis di bawah nama
            $pdf->Line($x + 104, $y + 47, $x + 56 + $line_length, $y + 47); // Garis sepanjang 100 unit




        } else {
            if (strpos($selectedName, 'Sri Sulistiyati, SE, M.Kom') !== false) {
                // Without "plh"
                $pdf->Cell(260, 5, "", 0, 1, 'C');
                // Get current X and Y position for the line


                $x = $pdf->GetX();


                $y = $pdf->GetY();



                $line_length = 100; // Panjang garis dalam satuan TCPDF

                // Menggambar garis di bawah nama
                $pdf->Line($x + 106, $y + 68, $x + 54 + $line_length, $y + 68); // Garis sepanjang 100 unit

                $pdf->Ln(5);
                // With "plh"
                $pdf->Cell(260, 5, "plh. KEPALA BADAN PENGEMBANGAN", 0, 1, 'C');
                $pdf->Cell(260, 5, "SUMBER DAYA MANUSIA DAERAH PROVINSI", 0, 1, 'C');
                $pdf->Cell(260, 5, "JAWA TENGAH", 0, 1, 'C');
            }

            if (strpos($selectedName, 'Sumarhendro, S.Sos') !== false) {
                // Without "plh"
                $pdf->Cell(260, 5, "", 0, 1, 'C');
                // Get current X and Y position for the line


                $x = $pdf->GetX();


                $y = $pdf->GetY();



                $line_length = 100; // Panjang garis dalam satuan TCPDF

                // Menggambar garis di bawah nama
                $pdf->Line($x + 110, $y + 68, $x + 50 + $line_length, $y + 68); // Garis sepanjang 100 unit

                $pdf->Ln(5);
                // With "plh"
                $pdf->Cell(260, 5, "plh. KEPALA BADAN PENGEMBANGAN", 0, 1, 'C');
                $pdf->Cell(260, 5, "SUMBER DAYA MANUSIA DAERAH PROVINSI", 0, 1, 'C');
                $pdf->Cell(260, 5, "JAWA TENGAH", 0, 1, 'C');
            }
            if (strpos($selectedName, 'Dr. Anon Priyantoro, S.Pd., M.Pd') !== false) {
                // Without "plh"
                $pdf->Cell(260, 5, "", 0, 1, 'C');
                // Get current X and Y position for the line


                $x = $pdf->GetX();


                $y = $pdf->GetY();



                $line_length = 100; // Panjang garis dalam satuan TCPDF

                // Menggambar garis di bawah nama
                $pdf->Line($x + 99, $y + 68, $x + 61 + $line_length, $y + 68); // Garis sepanjang 100 unit

                $pdf->Ln(5);
                // With "plh"
                $pdf->Cell(260, 5, "plh. KEPALA BADAN PENGEMBANGAN", 0, 1, 'C');
                $pdf->Cell(260, 5, "SUMBER DAYA MANUSIA DAERAH PROVINSI", 0, 1, 'C');
                $pdf->Cell(260, 5, "JAWA TENGAH", 0, 1, 'C');
            }
        }

        // This part will be the same for both cases
        $pdf->MultiCell(260, 5, $selectedName, 0, 'C', 0, 1); // Display selected name
        $pdf->Ln(3); // Add space




        //$xStart = $pdf->GetX() + 104; // Sesuaikan posisi mulai garis (adjust sesuai kebutuhan)
        //$yStart = $pdf->GetY() -24;   // Posisikan garis sedikit di bawah teks

        // Menggambar garis dengan panjang yang diinginkan
        //$pdf->Line($xStart, $yStart, $xStart + 54, $yStart); // Garis dengan panjang 60 (sesuaikan)
        //$pdf->Ln(10); // Spasi







    }





    // Output PDF ke browser
    $pdf->Output('surat_dari_database.pdf', 'I');

} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi
$conn->close();
?>