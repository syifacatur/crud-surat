<?php
//include library
include('library/TCPDF-main/tcpdf.php');
include('aset/java/function_tgl.php');

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
$pdf = new TCPDF('P', 'mm', 'Legal');



//remove default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// Menambahkan halaman
$pdf->AddPage();


$id = $_GET['id'];
$query = "SELECT * FROM cetak_laporan WHERE id_spt = $id ";
$result = $conn->query($query);
$jml = $result->num_rows + 1;

$jumlah_orang = mysqli_num_rows($result);

if ($jumlah_orang < 5) {
    while ($row = mysqli_fetch_assoc($result)) {


        //logo
        $pdf->Image('library/logo1.jpg', 15, 10, 25);
        //title
        $pdf->SetFont('Helvetica', 'B', 14);
        $pdf->Cell(195, 5, "PEMERINTAH PROVINSI JAWA TENGAH", 0, 1, 'C');
        $pdf->SetFont('Helvetica', 'B', 14);
        $pdf->Cell(195, 5, 'BADAN PENGEMBANGAN', 0, 1, 'C');
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
        $pdf->Ln(5);

        // ISI
        $pdf->SetFont('Helvetica', 'B', 13);
        $pdf->Cell(195, 5, "SURAT PERINTAH PERJALANAN DINAS", 0, 1, 'C');

        $pdf->SetFont('helvetica', '', 12);

        $query_isi = "SELECT * FROM form_spt where id_spt='$id'";
        $result_isi = $conn->query($query_isi);
        $row_isi = $result_isi->fetch_assoc();
        $pdf->MultiCell(190, 10, 'Nomor :' . $row_isi['no_spt'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $pdf->Ln(3);
        $pdf->SetFont('Helvetica', '', 11);
        $no = 1;

        $pdf->SetLineWidth(0.3);
        // $pdf->setCellPaddings(1, 1, 0, 0); 
        //BARIS 1

        // Menghitung tinggi dinamis berdasarkan konten dari sel "Nama"
        $tinggiNama = $pdf->getStringHeight(85, 'Pejabat yang memberi perintah');
        $tinggiInstansi = $pdf->getStringHeight(100, 'Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah');
        // Menentukan tinggi maksimum di antara sel "Nama" dan "Instansi"
        $tinggiMaks = max($tinggiNama, $tinggiInstansi);

        // Menyesuaikan tinggi sel "No" agar sesuai dengan sel lainnya
        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 'RTL', 'C', 0, 0, '', '', true);
        // Menyesuaikan tinggi sel "Nama"
        $pdf->MultiCell(85, $tinggiMaks, 'Pejabat yang memberi perintah', 'RT', 'L', 0, 0, '', '', true);
        // Menyesuaikan tinggi sel "Instansi"
        $pdf->MultiCell(102, $tinggiMaks, 'Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah', 1, 'L', 0, 1, '', '', true);

        //BARIS 2

        $id_nama = $row['id_nama'];
        $querynama = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
        while ($row = mysqli_fetch_assoc($querynama)) {
            // Menghitung tinggi dinamis berdasarkan konten deskripsi panjang
            $tinggiNama = $pdf->getStringHeight(80, "Nama Gubernur/Wakil Gubernur/Pimpinan dan Anggota DPRD/Pegawai ASN dan NIP/CPNS dan NIP/ Pegawai Non ASN/Bukan Pegawai yang melaksanakan perjalanan Dinas");
            // Reset padding setelah selesai jika ingin kembali ke default
            $tinggiInstansi = $pdf->getStringHeight(100, $row['nama'] . "\n\n\nNIP. " . $row['NIP']);
            $tinggiMaks = max($tinggiNama, $tinggiInstansi) - 3;

            // Kolom nomor
            $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);

            // Kolom deskripsi (pastikan newline pada teks)
            $pdf->MultiCell(85, $tinggiMaks, "Nama Gubernur/Wakil Gubernur/Pimpinan dan Anggota DPRD/Pegawai ASN dan NIP/CPNS dan NIP/ Pegawai Non ASN/Bukan Pegawai yang melaksanakan perjalanan Dinas", 1, 'L', 0, 0, '', '', true);

            // Gabungkan nama dan NIP dalam satu MultiCell (dengan penambahan jarak vertikal sebelum nama)
            $kontenNamaNIP = "\n" . $row['nama'] . "\n\nNIP. " . $row['NIP'];
            $pdf->MultiCell(102, $tinggiMaks, $kontenNamaNIP, 1, 'L', 0, 1, '', '', true);

            //BARIS 3

            //menggunakan if else 

            $selectedanggaran = $row['nama'];

            //anggaran 1

            if (strpos($selectedanggaran, 'Dr. SADIMIN, S.Pd., M.Eng.') !== false) {

                $tinggiNama = $pdf->getStringHeight(85, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi");
                $tinggiInstansi = $pdf->getStringHeight(100, "\n" . "a. " . $row['pangkat'] . "b. " . $row['jabatan']);
                $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

                $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(85, $tinggiMaks, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi", 1, 'L', 0, 0, '', '', true);


                $pdf->SetX(105);
                // MultiCell untuk "a." di bagian atas
                $pdf->MultiCell(6, 19, "a.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk teks panjang setelah "a."
                $pdf->MultiCell(94, 5, $row['pangkat'], 'R', 'L', 0, 1, '', '', true);

                $pdf->SetX(105);
                // MultiCell untuk "b." di sebelah kode anggaran
                $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk kode anggaran
                $pdf->MultiCell(94, 10, $row['jabatan'], 'R', 'L', 0, 1, '', '', true);

            } else

                if (strpos($selectedanggaran, 'SRI SULISTIYATI, SE, M.Kom') !== false) {

                    $tinggiNama = $pdf->getStringHeight(85, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi");
                    $tinggiInstansi = $pdf->getStringHeight(100, "\n" . "a. " . $row['pangkat'] . "b. " . $row['jabatan']);
                    $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

                    $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(85, $tinggiMaks, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi", 1, 'L', 0, 0, '', '', true);


                    $pdf->SetX(105);
                    // MultiCell untuk "a." di bagian atas
                    $pdf->MultiCell(6, 19, "a.", 0, 'C', 0, 0, '', '', true);

                    // MultiCell untuk teks panjang setelah "a."
                    $pdf->MultiCell(94, 5, $row['pangkat'], 'R', 'L', 0, 1, '', '', true);

                    $pdf->SetX(105);
                    // MultiCell untuk "b." di sebelah kode anggaran
                    $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                    // MultiCell untuk kode anggaran
                    $pdf->MultiCell(94, 10, $row['jabatan'], 'R', 'L', 0, 1, '', '', true);

                } else
                    if (strpos($selectedanggaran, 'SUMARHENDRO, S.Sos') !== false) {

                        $tinggiNama = $pdf->getStringHeight(85, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi");
                        $tinggiInstansi = $pdf->getStringHeight(100, "\n" . "a. " . $row['pangkat'] . "b. " . $row['jabatan']);
                        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

                        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                        $pdf->MultiCell(85, $tinggiMaks, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi", 1, 'L', 0, 0, '', '', true);


                        $pdf->SetX(105);
                        // MultiCell untuk "a." di bagian atas
                        $pdf->MultiCell(6, 19, "a.", 0, 'C', 0, 0, '', '', true);

                        // MultiCell untuk teks panjang setelah "a."
                        $pdf->MultiCell(94, 5, $row['pangkat'], 'R', 'L', 0, 1, '', '', true);

                        $pdf->SetX(105);
                        // MultiCell untuk "b." di sebelah kode anggaran
                        $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                        // MultiCell untuk kode anggaran
                        $pdf->MultiCell(94, 10, $row['jabatan'], 'R', 'L', 0, 1, '', '', true);

                    } else
                        if (strpos($selectedanggaran, 'Dr. ANON PRIYANTORO, S.Pd., M.Pd.') !== false) {

                            $tinggiNama = $pdf->getStringHeight(85, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi");
                            $tinggiInstansi = $pdf->getStringHeight(100, "\n" . "a. " . $row['pangkat'] . "b. " . $row['jabatan']);
                            $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

                            $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                            $pdf->MultiCell(85, $tinggiMaks, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi", 1, 'L', 0, 0, '', '', true);


                            $pdf->SetX(105);
                            // MultiCell untuk "a." di bagian atas
                            $pdf->MultiCell(6, 19, "a.", 0, 'C', 0, 0, '', '', true);

                            // MultiCell untuk teks panjang setelah "a."
                            $pdf->MultiCell(94, 5, $row['pangkat'], 'R', 'L', 0, 1, '', '', true);

                            $pdf->SetX(105);
                            // MultiCell untuk "b." di sebelah kode anggaran
                            $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                            // MultiCell untuk kode anggaran
                            $pdf->MultiCell(94, 10, $row['jabatan'], 'R', 'L', 0, 1, '', '', true);

                        } else {


                            $tinggiNama = $pdf->getStringHeight(85, ' a. Pangkat dan Golongan' . 'b. Jabatan/Instansi');
                            $tinggiInstansi = $pdf->getStringHeight(100, $row['pangkat'] . "\n " . $row['jabatan']);
                            $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 3;

                            $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);

                            $pdf->MultiCell(85, $tinggiMaks, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi", 1, 'L', 0, 0, '', '', true);
                            $kontenPangkatJabatan = '  a.  ' . $row['pangkat'] . "\n  b.  " . $row['jabatan'];
                            $pdf->MultiCell(102, $tinggiMaks, $kontenPangkatJabatan, 1, 'L', 0, 1, '', '', true);

                        }




        }


        //BARIS 4

        $tinggiNama = $pdf->getStringHeight(85, 'Maksud Mengadakan Perjalanan');
        $tinggiInstansi = $pdf->getStringHeight(100, $row_isi['maksud_tujuan']);
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 6;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(85, $tinggiMaks, 'Maksud Mengadakan Perjalanan', 1, 'L', 0, 0, '', '', true);
        $kontenmaksudtujuan = $row_isi['maksud_tujuan'];
        $pdf->MultiCell(102, $tinggiMaks, $kontenmaksudtujuan, 1, 'L', 0, 1, '', '', true);

        //BARIS 5


        $tinggiNama = $pdf->getStringHeight(85, 'Alat Angkut yang Dipergunakan');
        $tinggiInstansi = $pdf->getStringHeight(100, 'Kendaraan Dinas');
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);

        $pdf->MultiCell(85, $tinggiMaks, 'Alat Angkut yang Dipergunakan', 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(102, $tinggiMaks, 'Kendaraan Dinas', 1, 'L', 0, 1, '', '', true);

        //Baris 6

        $tinggiNama = $pdf->getStringHeight(85, 'a. Tempat Berangkat' . 'b. Tempat Tujuan');
        $tinggiInstansi = $pdf->getStringHeight(100, '  Semarang' . "\n " . $row_isi['lokasi']);
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 6;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);

        $pdf->MultiCell(85, $tinggiMaks, 'a. Tempat Berangkat' . "\nb. Tempat Tujuan", 1, 'L', 0, 0, '', '', true);
        $kontenBerangkatTujuan = '  a.   Semarang' . "\n  b.   " . $row_isi['lokasi'];
        $pdf->MultiCell(102, $tinggiMaks, $kontenBerangkatTujuan, 1, 'L', 0, 1, '', '', true);

        //baris 7





        $tinggiNama = $pdf->getStringHeight(85, 'a. Lamanya Perjalanan Dinas' . "\nb. Tanggal Berangkat" . "\nc. Tanggal Harus Kembali/Tiba Di Tempat Baru");
        $tinggiInstansi = $pdf->getStringHeight(100, '  a.  ' . $teks_hari . 'hari' . "\n  b.   " . tgl_indo($row_isi['tgl_kegiatan']) . "\n  c.   " . tgl_indo($row_isi['tgl_pulang']));
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 1;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(85, $tinggiMaks, 'a. Lamanya Perjalanan Dinas' . "\nb. Tanggal Berangkat" . "\nc. Tanggal Harus Kembali/Tiba Di Tempat Baru", 1, 'L', 0, 0, '', '', true);
        $kontentanggal = '  a.   ' . $teks_hari . 'hari' . "\n  b.   " . tgl_indo($row_isi['tgl_kegiatan']) . "\n  c.   " . tgl_indo($row_isi['tgl_pulang']);
        $pdf->MultiCell(102, $tinggiMaks, $kontentanggal, 1, 'L', 0, 1, '', '', true);

        //baris 8

        $tinggiNama = $pdf->getStringHeight(85, 'pengikut');
        $tinggiInstansi = $pdf->getStringHeight(100, '') + 0.5;
        $tinggiMaks = max($tinggiNama, $tinggiInstansi);

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(85, $tinggiMaks, 'pengikut', 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(102, $tinggiMaks, '', 1, 'L', 0, 1, '', '', true);

        //baris 9
//menggunakan if else 

        $selectedanggaran = $row_isi['anggaran'];

        //anggaran 1

        if (strpos($selectedanggaran, 'Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD') !== false) {

            $tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
            $tinggiInstansi = $pdf->getStringHeight(100, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.06.0009.5.1.2.4.1.1 ");
            $tinggiMaks = max($tinggiNama, $tinggiInstansi);

            $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);


            $pdf->SetX(105);
            // MultiCell untuk "a." di bagian atas
            $pdf->MultiCell(6, 19, "\na.", 0, 'C', 0, 0, '', '', true);

            // MultiCell untuk teks panjang setelah "a."
            $pdf->MultiCell(94, 15, "\nAPBD Tahun 2023 " . $row_isi['anggaran'], 'R', 'L', 0, 1, '', '', true);

            if (strpos($selectedanggaran, 'Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD') !== false) {
                $pdf->SetX(105);
                // MultiCell untuk "b." di sebelah kode anggaran
                $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk kode anggaran
                $pdf->MultiCell(94, 14.5, "5.04.0.00.0.00.01.X.XX.01.1.06.0009.5.1.2.4.1.1", 'R', 'L', 0, 1, '', '', true);



            }
        } else {


            //anggaran 2

            if (strpos($selectedanggaran, 'kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD') !== false) {

                $tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
                $tinggiInstansi = $pdf->getStringHeight(100, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb.5.04.0.00.0.00.01.X.XX.01.1.06.0011.5.1.2.4.1.1.01  ");
                $tinggiMaks = max($tinggiNama, $tinggiInstansi);

                $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);


                $pdf->SetX(105);
                // MultiCell untuk "a." di bagian atas
                $pdf->MultiCell(6, 19, "\na.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk teks panjang setelah "a."
                $pdf->MultiCell(94, 15, "\nAPBD Tahun 2023 " . $row_isi['anggaran'], 'R', 'L', 0, 1, '', '', true);

                if (strpos($selectedanggaran, 'kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD') !== false) {

                    $pdf->SetX(105);
                    // MultiCell untuk "b." di sebelah kode anggaran
                    $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                    // MultiCell untuk kode anggaran
                    $pdf->MultiCell(94, 9.7, "5.04.0.00.0.00.01.X.XX.01.1.06.0011.5.1.2.4.1.1.01", 'R', 'L', 0, 1, '', '', true);

                }
            }

            //anggaran 3

            if (strpos($selectedanggaran, 'Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian') !== false) {

                $tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
                $tinggiInstansi = $pdf->getStringHeight(100, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0003.5.1.2.4.1.1 ");
                $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 4;

                $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);


                $pdf->SetX(105);
                // MultiCell untuk "a." di bagian atas
                $pdf->MultiCell(6, 19, "\na.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk teks panjang setelah "a."
                $pdf->MultiCell(94, 15, "\nAPBD Tahun 2023 " . $row_isi['anggaran'], 'R', 'L', 0, 1, '', '', true);

                if (strpos($selectedanggaran, 'Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian') !== false) {

                    $pdf->SetX(105);
                    // MultiCell untuk "b." di sebelah kode anggaran
                    $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                    // MultiCell untuk kode anggaran
                    $pdf->MultiCell(94, 8.9, "5.04.0.00.0.00.01.X.XX.01.1.05.0003.5.1.2.4.1.1", 'R', 'L', 0, 1, '', '', true);
                }
            }

            //anggaran 4

            if (strpos($selectedanggaran, 'Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi') !== false) {
                $tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
                $tinggiInstansi = $pdf->getStringHeight(100, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.2.12.1 ");
                $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 4;

                $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);


                $pdf->SetX(105);
                // MultiCell untuk "a." di bagian atas
                $pdf->MultiCell(6, 19, "\na.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk teks panjang setelah "a."
                $pdf->MultiCell(94, 15, "\nAPBD Tahun 2023 " . $row_isi['anggaran'], 'R', 'L', 0, 1, '', '', true);

                if (strpos($selectedanggaran, 'Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi') !== false) {

                    $pdf->SetX(105);
                    // MultiCell untuk "b." di sebelah kode anggaran
                    $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                    // MultiCell untuk kode anggaran
                    $pdf->MultiCell(94, 13.7, "5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.2.12.1", 'R', 'L', 0, 1, '', '', true);

                }
            }
        }





        //baris 10

        $tinggiNama = $pdf->getStringHeight(85, 'Keterangan Lain-lain');
        $tinggiInstansi = $pdf->getStringHeight(100, '');
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(85, $tinggiMaks, 'Keterangan Lain-lain', 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(102, $tinggiMaks, '', 1, 'L', 0, 1, '', '', true);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $line_length = 100; // Panjang garis 

        $pdf->Ln(5);

        $pdf->SetX(127);
        $pdf->MultiCell(27, 40, 'Dikeluarkan di', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(3, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(157);
        $pdf->MultiCell(40, 40, 'Semarang', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(5);

        $pdf->SetX(127);
        $pdf->MultiCell(27, 40, 'Pada Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(3, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(159);
        $pdf->MultiCell(80, 40, '  Agustus 2024', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(5);

        $pdf->SetX(134);
        $pdf->MultiCell(27, 40, 'Ditetapkan di', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(3, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(164);
        $pdf->MultiCell(40, 40, 'Semarang', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(5);

        $pdf->SetX(134);
        $pdf->MultiCell(27, 40, 'Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(3, 40, '', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(162);
        $pdf->MultiCell(80, 40, '  Agustus 2024', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(10);
        $pdf->Cell(295, 5, "PENGGUNA ANGGARAN", 0, 1, 'C');
        $pdf->Ln(13);



        $pdf->Cell(295, 5, "Dr.SADIMIN,S.Pd, M.Eng", 0, 1, 'C');
        // Menggambar garis di bawah nama
        $pdf->Line($x + 126, $y + 53, $x + 69 + $line_length, $y + 53);
        $pdf->Cell(295, 5, "NIP. 197212061994121001", 0, 1, 'C');
        $no = 1;

        $pdf->AddPage();
    }

} else {

    $pdf = new TCPDF('P', 'mm', 'Legal');

    //remove default header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);


    // Menambahkan halaman
    $pdf->AddPage();

    if ($row = mysqli_fetch_assoc($result)) {


        //logo
        $pdf->Image('library/logo1.jpg', 15, 10, 25);
        //title
        $pdf->SetFont('Helvetica', 'B', 14);
        $pdf->Cell(195, 5, "PEMERINTAH PROVINSI JAWA TENGAH", 0, 1, 'C');
        $pdf->SetFont('Helvetica', 'B', 14);
        $pdf->Cell(195, 5, 'BADAN PENGEMBANGAN', 0, 1, 'C');
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
        $pdf->Ln(5);

        // ISI
        $pdf->SetFont('Helvetica', 'B', 13);
        $pdf->Cell(195, 5, "SURAT PERINTAH PERJALANAN DINAS", 0, 1, 'C');

        $pdf->SetFont('helvetica', '', 12);

        $query_isi = "SELECT * FROM form_spt where id_spt='$id'";
        $result_isi = $conn->query($query_isi);
        $row_isi = $result_isi->fetch_assoc();
        $pdf->MultiCell(190, 10, 'Nomor :' . $row_isi['no_spt'], 0, 'C', 0, 1); // Justify untuk rata kiri-kanan ('J')
        $pdf->Ln(3);
        $pdf->SetFont('Helvetica', '', 11);
        $no = 1;

        $pdf->SetLineWidth(0.3);
        // $pdf->setCellPaddings(1, 1, 0, 0); 
        //BARIS 1

        // Menghitung tinggi dinamis berdasarkan konten dari sel "Nama"
        $tinggiNama = $pdf->getStringHeight(85, 'Pejabat yang memberi perintah');
        $tinggiInstansi = $pdf->getStringHeight(100, 'Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah');
        // Menentukan tinggi maksimum di antara sel "Nama" dan "Instansi"
        $tinggiMaks = max($tinggiNama, $tinggiInstansi);

        // Menyesuaikan tinggi sel "No" agar sesuai dengan sel lainnya
        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 'RTL', 'C', 0, 0, '', '', true);
        // Menyesuaikan tinggi sel "Nama"
        $pdf->MultiCell(85, $tinggiMaks, 'Pejabat yang memberi perintah', 'RT', 'L', 0, 0, '', '', true);
        // Menyesuaikan tinggi sel "Instansi"
        $pdf->MultiCell(102, $tinggiMaks, 'Kepala Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Jawa Tengah', 1, 'L', 0, 1, '', '', true);

        //BARIS 2

        $id_nama = $row['id_nama'];
        $querynama = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
        while ($row = mysqli_fetch_assoc($querynama)) {
            // Menghitung tinggi dinamis berdasarkan konten deskripsi panjang
            $tinggiNama = $pdf->getStringHeight(80, "Nama Gubernur/Wakil Gubernur/Pimpinan dan Anggota DPRD/Pegawai ASN dan NIP/CPNS dan NIP/ Pegawai Non ASN/Bukan Pegawai yang melaksanakan perjalanan Dinas");
            // Reset padding setelah selesai jika ingin kembali ke default
            $tinggiInstansi = $pdf->getStringHeight(100, $row['nama'] . "\n\n\nNIP. " . $row['NIP']);
            $tinggiMaks = max($tinggiNama, $tinggiInstansi) - 3;

            // Kolom nomor
            $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);

            // Kolom deskripsi (pastikan newline pada teks)
            $pdf->MultiCell(85, $tinggiMaks, "Nama Gubernur/Wakil Gubernur/Pimpinan dan Anggota DPRD/Pegawai ASN dan NIP/CPNS dan NIP/ Pegawai Non ASN/Bukan Pegawai yang melaksanakan perjalanan Dinas", 1, 'L', 0, 0, '', '', true);

            // Gabungkan nama dan NIP dalam satu MultiCell (dengan penambahan jarak vertikal sebelum nama)
            $kontenNamaNIP = "\nTerlampir";
            $pdf->MultiCell(102, $tinggiMaks, $kontenNamaNIP, 1, 'L', 0, 1, '', '', true);

            //BARIS 3

            //menggunakan if else 



            $tinggiNama = $pdf->getStringHeight(85, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi");
            $tinggiInstansi = $pdf->getStringHeight(100, "\n" . "a. " . $row['pangkat'] . "b. " . $row['jabatan']);
            $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

            $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(85, $tinggiMaks, 'a. Pangkat dan Golongan' . "\nb. Jabatan/Instansi", 1, 'L', 0, 0, '', '', true);


            $pdf->SetX(105);
            // MultiCell untuk "a." di bagian atas
            $pdf->MultiCell(6, 19, "a.", 0, 'C', 0, 0, '', '', true);

            // MultiCell untuk teks panjang setelah "a."
            $pdf->MultiCell(94, 5, "Terlampir", 'R', 'L', 0, 1, '', '', true);

            $pdf->SetX(105);
            // MultiCell untuk "b." di sebelah kode anggaran
            $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

            // MultiCell untuk kode anggaran
            $pdf->MultiCell(94, 10, "Terlampir", 'R', 'L', 0, 1, '', '', true);


        }


        //BARIS 4

        $tinggiNama = $pdf->getStringHeight(85, 'Maksud Mengadakan Perjalanan');
        $tinggiInstansi = $pdf->getStringHeight(100, $row_isi['maksud_tujuan']);
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 6;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(85, $tinggiMaks, 'Maksud Mengadakan Perjalanan', 1, 'L', 0, 0, '', '', true);
        $kontenmaksudtujuan = $row_isi['maksud_tujuan'];
        $pdf->MultiCell(102, $tinggiMaks, $kontenmaksudtujuan, 1, 'L', 0, 1, '', '', true);

        //BARIS 5


        $tinggiNama = $pdf->getStringHeight(85, 'Alat Angkut yang Dipergunakan');
        $tinggiInstansi = $pdf->getStringHeight(100, 'Kendaraan Dinas');
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);

        $pdf->MultiCell(85, $tinggiMaks, 'Alat Angkut yang Dipergunakan', 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(102, $tinggiMaks, 'Kendaraan Dinas', 1, 'L', 0, 1, '', '', true);

        //Baris 6

        $tinggiNama = $pdf->getStringHeight(85, 'a. Tempat Berangkat' . 'b. Tempat Tujuan');
        $tinggiInstansi = $pdf->getStringHeight(100, '  Semarang' . "\n " . $row_isi['lokasi']);
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 6;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);

        $pdf->MultiCell(85, $tinggiMaks, 'a. Tempat Berangkat' . "\nb. Tempat Tujuan", 1, 'L', 0, 0, '', '', true);
        $kontenBerangkatTujuan = '  a.   Semarang' . "\n  b.   " . $row_isi['lokasi'];
        $pdf->MultiCell(102, $tinggiMaks, $kontenBerangkatTujuan, 1, 'L', 0, 1, '', '', true);

        //baris 7




        $tinggiNama = $pdf->getStringHeight(85, 'a. Lamanya Perjalanan Dinas' . "\nb. Tanggal Berangkat" . "\nc. Tanggal Harus Kembali/Tiba Di Tempat Baru");
        $tinggiInstansi = $pdf->getStringHeight(100, '  a.  ' . $teks_hari . 'hari' . "\n  b.   " . tgl_indo($row_isi['tgl_kegiatan']) . "\n  c.   " . tgl_indo($row_isi['tgl_pulang']));
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 1;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(85, $tinggiMaks, 'a. Lamanya Perjalanan Dinas' . "\nb. Tanggal Berangkat" . "\nc. Tanggal Harus Kembali/Tiba Di Tempat Baru", 1, 'L', 0, 0, '', '', true);
        $kontentanggal = '  a.   ' . $teks_hari . 'hari' . "\n  b.   " . tgl_indo($row_isi['tgl_kegiatan']) . "\n  c.   " . tgl_indo($row_isi['tgl_pulang']);
        $pdf->MultiCell(102, $tinggiMaks, $kontentanggal, 1, 'L', 0, 1, '', '', true);

        //baris 8

        $tinggiNama = $pdf->getStringHeight(85, 'pengikut');
        $tinggiInstansi = $pdf->getStringHeight(100, '') + 0.5;
        $tinggiMaks = max($tinggiNama, $tinggiInstansi);

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(85, $tinggiMaks, 'pengikut', 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(102, $tinggiMaks, '', 1, 'L', 0, 1, '', '', true);

        //baris 9
//menggunakan if else 

        $selectedanggaran = $row_isi['anggaran'];

        //anggaran 1

        if (strpos($selectedanggaran, 'Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD') !== false) {

            $tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
            $tinggiInstansi = $pdf->getStringHeight(100, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.06.0009.5.1.2.4.1.1 ");
            $tinggiMaks = max($tinggiNama, $tinggiInstansi);

            $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);


            $pdf->SetX(105);
            // MultiCell untuk "a." di bagian atas
            $pdf->MultiCell(6, 19, "\na.", 0, 'C', 0, 0, '', '', true);

            // MultiCell untuk teks panjang setelah "a."
            $pdf->MultiCell(94, 15, "\nAPBD Tahun 2023 " . $row_isi['anggaran'], 'R', 'L', 0, 1, '', '', true);

            if (strpos($selectedanggaran, 'Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD') !== false) {
                $pdf->SetX(105);
                // MultiCell untuk "b." di sebelah kode anggaran
                $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk kode anggaran
                $pdf->MultiCell(94, 14.5, "5.04.0.00.0.00.01.X.XX.01.1.06.0009.5.1.2.4.1.1", 'R', 'L', 0, 1, '', '', true);



            }
        } else {


            //anggaran 2

            if (strpos($selectedanggaran, 'kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD') !== false) {

                $tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
                $tinggiInstansi = $pdf->getStringHeight(100, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb.5.04.0.00.0.00.01.X.XX.01.1.06.0011.5.1.2.4.1.1.01  ");
                $tinggiMaks = max($tinggiNama, $tinggiInstansi);

                $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);


                $pdf->SetX(105);
                // MultiCell untuk "a." di bagian atas
                $pdf->MultiCell(6, 19, "\na.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk teks panjang setelah "a."
                $pdf->MultiCell(94, 15, "\nAPBD Tahun 2023 " . $row_isi['anggaran'], 'R', 'L', 0, 1, '', '', true);

                if (strpos($selectedanggaran, 'kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD') !== false) {

                    $pdf->SetX(105);
                    // MultiCell untuk "b." di sebelah kode anggaran
                    $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                    // MultiCell untuk kode anggaran
                    $pdf->MultiCell(94, 9.7, "5.04.0.00.0.00.01.X.XX.01.1.06.0011.5.1.2.4.1.1.01", 'R', 'L', 0, 1, '', '', true);

                }
            }

            //anggaran 3

            if (strpos($selectedanggaran, 'Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian') !== false) {

                $tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
                $tinggiInstansi = $pdf->getStringHeight(100, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0003.5.1.2.4.1.1 ");
                $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 4;

                $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);


                $pdf->SetX(105);
                // MultiCell untuk "a." di bagian atas
                $pdf->MultiCell(6, 19, "\na.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk teks panjang setelah "a."
                $pdf->MultiCell(94, 15, "\nAPBD Tahun 2023 " . $row_isi['anggaran'], 'R', 'L', 0, 1, '', '', true);

                if (strpos($selectedanggaran, 'Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian') !== false) {

                    $pdf->SetX(105);
                    // MultiCell untuk "b." di sebelah kode anggaran
                    $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                    // MultiCell untuk kode anggaran
                    $pdf->MultiCell(94, 8.9, "5.04.0.00.0.00.01.X.XX.01.1.05.0003.5.1.2.4.1.1", 'R', 'L', 0, 1, '', '', true);
                }
            }

            //anggaran 4

            if (strpos($selectedanggaran, 'Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi') !== false) {

                $tinggiNama = $pdf->getStringHeight(85, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\nb. Mata Anggaran");
                $tinggiInstansi = $pdf->getStringHeight(100, "\n" . 'a. APBD Tahun 2023 Anggaran ' . $row_isi['anggaran'] . "\n\nb. 5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.2.12.1 ");
                $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 4;

                $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(85, $tinggiMaks, 'Pembebanan anggaran' . "\na. Instansi" . "\n\n\n\nb. Mata Anggaran", 1, 'L', 0, 0, '', '', true);


                $pdf->SetX(105);
                // MultiCell untuk "a." di bagian atas
                $pdf->MultiCell(6, 19, "\na.", 0, 'C', 0, 0, '', '', true);

                // MultiCell untuk teks panjang setelah "a."
                $pdf->MultiCell(94, 15, "\nAPBD Tahun 2023 " . $row_isi['anggaran'], 'R', 'L', 0, 1, '', '', true);

                if (strpos($selectedanggaran, 'Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi') !== false) {

                    $pdf->SetX(105);
                    // MultiCell untuk "b." di sebelah kode anggaran
                    $pdf->MultiCell(6, 19, "b.", 0, 'C', 0, 0, '', '', true);

                    // MultiCell untuk kode anggaran
                    $pdf->MultiCell(94, 13.7, "5.04.0.00.0.00.01.X.XX.01.1.05.0009.5.1.2.2.12.1", 'R', 'L', 0, 1, '', '', true);

                }
            }
        }





        //baris 10

        $tinggiNama = $pdf->getStringHeight(85, 'Keterangan Lain-lain');
        $tinggiInstansi = $pdf->getStringHeight(100, '');
        $tinggiMaks = max($tinggiNama, $tinggiInstansi) + 0.5;

        $pdf->MultiCell(8, $tinggiMaks, $no++ . '. ', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(85, $tinggiMaks, 'Keterangan Lain-lain', 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(102, $tinggiMaks, '', 1, 'L', 0, 1, '', '', true);

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $line_length = 100; // Panjang garis 

        $pdf->Ln(5);

        $pdf->SetX(127);
        $pdf->MultiCell(27, 40, 'Dikeluarkan di', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(3, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(157);
        $pdf->MultiCell(40, 40, 'Semarang', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(5);

        $pdf->SetX(127);
        $pdf->MultiCell(27, 40, 'Pada Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(3, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(159);
        $pdf->MultiCell(80, 40, '  Agustus 2024', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(5);

        $pdf->SetX(134);
        $pdf->MultiCell(27, 40, 'Ditetapkan di', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(3, 40, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(164);
        $pdf->MultiCell(40, 40, 'Semarang', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(5);

        $pdf->SetX(134);
        $pdf->MultiCell(27, 40, 'Tanggal', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(3, 40, '', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->SetX(162);
        $pdf->MultiCell(80, 40, '  Agustus 2024', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(10);
        $pdf->Cell(295, 5, "PENGGUNA ANGGARAN", 0, 1, 'C');
        $pdf->Ln(13);



        $pdf->Cell(295, 5, "Dr.SADIMIN,S.Pd, M.Eng", 0, 1, 'C');
        // Menggambar garis di bawah nama
        $pdf->Line($x + 126, $y + 53, $x + 69 + $line_length, $y + 53);
        $pdf->Cell(295, 5, "NIP. 197212061994121001", 0, 1, 'C');
        $no = 1;

        $custom_f4 = array(210, 330); // Ukuran F4 dalam milimeter
        $pdf->AddPage('L', $custom_f4);

    }
}



if ($row = mysqli_fetch_assoc($result)) {



    if ($jumlah_orang > 4) {
        $query_isi = "SELECT * FROM form_spt where id_spt='$id'";
        $result_isi = $conn->query($query_isi);
        $row_isi = $result_isi->fetch_assoc();







        // Query untuk menghitung jumlah peserta per id_spt
        $query = "SELECT id_spt, COUNT(id_laporan) AS jumlah_peserta FROM cetak_laporan GROUP BY id_spt";

        $result = $conn->query($query);



        //title
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->SetX(250);
        $pdf->Cell(0, 5, "Lampiran ", 0, 1, 'L');
        $pdf->SetX(250);
        $pdf->Cell(0, 5, "SPPD", 0, 1, 'L');
        $pdf->SetX(250);
        $pdf->Cell(0, 5, "Kepala BPSDMD Prov. Jateng", 0, 1, 'L');
        $pdf->SetX(250);
        $pdf->Cell(0, 5, "Nomor" . "            :  " . $row_isi['no_spt'], 0, 1, 'L');
        $pdf->SetX(250);
        $pdf->Cell(0, 5, "Tanggal" . "          :  " . tgl_indo($row_isi['tgl_spt']), 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(300, 5, "Rekapitulasi Pelaksana Yang Melaksanakan Perjalanan Dinas", 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Helvetica', '', 9);
        //daftar peserta
//nama kegiatan
        $pdf->MultiCell(68.2, 0, 'Daftar Peserta', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(7, 0, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(220, 0, $jumlah_orang . angka_ke_kata($jumlah_orang) . " orang", 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');


        $pdf->Ln(5);

        //nama kegiatan
        $pdf->MultiCell(68.2, 0, 'Nama Kegiatan', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(7, 0, ':', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(220, 0, $row_isi['maksud_tujuan'], 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

        $pdf->Ln(5);

        //tgl kegiatan
        $pdf->MultiCell(70, 0, 'Tanggal Pelaksanaan Kegiatan', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(5, 0, ':', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(70, 0, tgl_indo($row_isi['tgl_kegiatan']) . " s.d " . tgl_indo($row_isi['tgl_pulang']), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

        $pdf->Ln(5);

        //tempat kegiatan
        $pdf->MultiCell(70, 0, 'Tempat Pelaksanaan Kegiatan', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(5, 0, ':', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(220, 0, $row_isi['lokasi'], 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

        $pdf->Ln(5);

        //bidang
        $pdf->MultiCell(70, 0, 'Bidang/UPT/Balai/Cabang Dinas', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(5, 0, ':', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(30, 0, '', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->Ln(10);

        //tabel
        $pdf->MultiCell(8, 17.3, 'No.', 1, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(50, 17.3, "Nama Pelaksana Perjalanan Dinas/NIP", 1, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(30, 17.3, 'Pangkat/Golongan', 1, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(35, 17.3, 'Jabatan', 1, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(25, 17.3, 'Tempat Kedudukan Asal', 1, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(25, 17.3, 'Transportasi Yang Digunakan', 1, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
        $pdf->MultiCell(50, 5, 'Surat Tugas', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->MultiCell(54, 5, 'tanggal', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->MultiCell(20, 17.3, 'Lama Perjalanan Dinas', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->MultiCell(20, 17.3, 'Keterangan', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');


        $pdf->Ln(); // Pindah ke baris berikutnya
        $pdf->SetX(183);
        $pdf->MultiCell(25, 12.3, 'Nomor', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->MultiCell(25, 12.3, 'Tanggal', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->SetX(233);
        $pdf->MultiCell(27, 10, 'Keberangkatan Dari Tempat  kedudukan asal', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');
        $pdf->MultiCell(27, 12.2, 'Tiba Kembali Kedudukan Asal', 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'T');

        $pdf->Ln(); // Pindah ke baris berikutnya

        $query = "SELECT * FROM cetak_laporan WHERE id_spt = $id";
        $result = $conn->query($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $id_nama = $row['id_nama'];
            $querynama = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
            while ($row = mysqli_fetch_assoc($querynama)) {

                $rowheight = 10;
                if (strlen($row['nama']) > 20) { // alocate as you need
                   $rowheight = 15;
                }

                // ISI
                $pdf->MultiCell(8, $rowheight, $no++, 1, 'C', 0, 0, '', '', true); // NoMOR
                $pdf->MultiCell(50, $rowheight, $row['nama'] . "\n" . $row['NIP'], 1, 'L', 0, 0, '', '', true); // Nama Dan NIP
                $pdf->MultiCell(30, $rowheight, $row['pangkat'], 1, 'L', 0, 0, '', '', true); // Pangkat/Gol
                $pdf->MultiCell(35, $rowheight, $row['jabatan'], 1, 'L', 0, 0, '', '', true); // Jabatan
                $pdf->MultiCell(25, $rowheight, 'Semarang', 1, 'L', 0, 0, '', '', true); // Tempat Kedudukan Asal
                $pdf->MultiCell(25, $rowheight, 'Kendaraan Dinas', 1, 'L', 0, 0, '', '', true); // Transportasi Yang Digunakan
                $pdf->MultiCell(25, $rowheight, $row_isi['no_spt'], 1, 'L', 0, 0, '', '', true); // nomor spt
                $pdf->MultiCell(25, $rowheight, tgl_indo($row_isi['tgl_spt']), 1, 'L', 0, 0, '', '', true); // tanggal spt
                $pdf->MultiCell(27, $rowheight, tgl_indo($row_isi['tgl_kegiatan']), 1, 'L', 0, 0, '', '', true); // tanggal berangkat
                $pdf->MultiCell(27, $rowheight, tgl_indo($row_isi['tgl_pulang']), 1, 'L', 0, 0, '', '', true); // tanggal pulang
                $pdf->MultiCell(20, $rowheight, $teks_hari . 'hari', 1, 'L', 0, 0, '', '', true); //Lama Perjalanan Dinas
                $pdf->MultiCell(20, $rowheight, '', 1, 'L', 0, 0, '', '', true); // Keterangan\

                $pdf->Ln();

            }
        }

    }
}








// Delete page 6
$pdf->deletePage($jml);


// Output PDF ke browser
$pdf->Output('Surat Perintah Perjalanan Dinas.pdf', 'I');

// Menutup koneksi
$conn->close();
?>