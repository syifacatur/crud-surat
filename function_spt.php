<?php
include 'koneksidb.php';

if($_GET['act']== 'tambahproduk'){
    $no_spt = $_POST['no_spt'];
    $dasar_undangan = $_POST['dasar_undangan'];
    $lokasi = $_POST['lokasi'];
    $tgl_kegiatan = $_POST['tgl_kegiatan'];
    $tgl_pulang = $_POST['tgl_pulang'];
    $tgl_spt = $_POST['tgl_spt'];
    $anggaran = $_POST['anggaran'];
    $NIP_penandatangan = $_POST['NIP_penandatangan'];
    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO form_spt (no_spt, dasar_undangan , lokasi, tgl_kegiatan, tgl_pulang , tgl_spt, anggaran,  NIP_penandatangan) VALUES('$no_spt', '$dasar_undangan', '$lokasi', '$tgl_kegiatan', '$tgl_pulang', '$tgl_spt', '$anggaran', '$NIP_penandatangan')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:form_spt.php");
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
    $tgl_kegiatan = $_POST['tgl_kegiatan'];
    $tgl_pulang = $_POST['tgl_pulang'];
    $tgl_spt = $_POST['tgl_spt'];
    $anggaran = $_POST['anggaran'];
    $NIP_penandatangan = $_POST['NIP_penandatangan'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE form_spt SET no_spt='$no_spt', dasar_undangan='$dasar_undangan', lokasi='$lokasi', tgl_kegiatan='$tgl_kegiatan',  tgl_pulang='$tgl_pulang', tgl_spt='$tgl_spt', anggaran='$anggaran', NIP_penandatangan='$NIP_penandatangan' WHERE id_spt='$id_spt' ");

    if ($queryupdate) {
        header("location:form_spt.php");    
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
        header("location:form_spt.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

   

    mysqli_close($koneksi);
}
?>