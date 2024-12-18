<?php
include 'koneksidb.php';

if($_GET['act']== 'tambahproduk'){
    $no_spt = $_POST['no_spt'];
    $dasar_undangan = $_POST['dasar_undangan'];
    $lokasi = $_POST['lokasi'];
    $kab_kota = $_POST['kab_kota'];
    $tgl_kegiatan = $_POST['tgl_kegiatan'];
    $tgl_pulang = $_POST['tgl_pulang'];
    $tgl_spt = $_POST['tgl_spt'];
    $anggaran = $_POST['anggaran'];
    $maksud_tujuan = $_POST['maksud_tujuan'];
    $NIP_penandatangan = $_POST['NIP_penandatangan'];
    $bidang = $_POST['bidang'];
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO form_spt (no_spt, dasar_undangan , lokasi, kab_kota, tgl_kegiatan, tgl_pulang , tgl_spt, anggaran, maksud_tujuan,  NIP_penandatangan, bidang) VALUES('$no_spt', '$dasar_undangan', '$lokasi', '$kab_kota', '$tgl_kegiatan', '$tgl_pulang', '$tgl_spt', '$anggaran', '$maksud_tujuan', '$NIP_penandatangan', '$bidang')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:surat_perintah_tugas.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updateproduk'){
    $id_spt = $_POST['id_spt'];
    $no_spt = $_POST['no_spt'];
    $dasar_undangan = $_POST['dasar_undangan'];
    $lokasi = $_POST['lokasi'];
    $kab_kota = $_POST['kab_kota'];
    $tgl_kegiatan = $_POST['tgl_kegiatan'];
    $tgl_pulang = $_POST['tgl_pulang'];
    $tgl_spt = $_POST['tgl_spt'];
    $anggaran = $_POST['anggaran'];
    $maksud_tujuan = $_POST['maksud_tujuan'];
    $NIP_penandatangan = $_POST['NIP_penandatangan'];
    $bidang = $_POST['bidang'];


    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE form_spt SET no_spt='$no_spt', dasar_undangan='$dasar_undangan', lokasi='$lokasi', kab_kota='$kab_kota', tgl_kegiatan='$tgl_kegiatan',  tgl_pulang='$tgl_pulang', tgl_spt='$tgl_spt', anggaran='$anggaran', maksud_tujuan='$maksud_tujuan', NIP_penandatangan='$NIP_penandatangan', bidang='$bidang' WHERE id_spt='$id_spt' ");

    if ($queryupdate) {
        header("location:surat_perintah_tugas.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteproduk'){
    $id_spt = $_GET['id_spt'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM form_spt WHERE id_spt = '$id_spt'");

    if ($querydelete) {
        header("location:surat_perintah_tugas.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

   

    mysqli_close($koneksi);
}
?>