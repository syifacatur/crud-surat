<?php
include 'koneksidb.php';

if($_GET['act']== 'tambahproduk'){
    $nama_spt = $_POST['nama_spt'];
    $nip_spt = $_POST['nip_spt'];
    $pangkat_spt = $_POST['pangkat_spt'];
    $jabatan_spt = $_POST['jabatan_spt'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO cetak_laporan(nama_spt, nip_spt, pangkat_spt, jabatan_spt) VALUES('$nama_spt', '$nip_spt', '$pangkat_spt', '$jabatan_spt')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:cetak_laporan.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
    
}
elseif($_GET['act']=='updateproduk'){
    $id_laporan = $_POST['id_laporan'];
    $nama_spt = $_POST['nama_spt'];
    $nip_spt = $_POST['nip_spt'];
    $pangkat_spt = $_POST['pangkat_spt'];
    $jabatan_spt = $_POST['jabatan_spt'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE cetak_laporan SET nama_spt='$nama_spt', nip_spt='$nip_spt', pangkat_spt='$pangkat_spt', jabatan_spt='$jabatan_spt' WHERE id_laporan='$id_laporan' ");

    if ($queryupdate) {
        header("location:cetak_laporan.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteproduk'){
    $id_laporan = $_GET['id_laporan'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM cetak_laporan WHERE id_laporan = '$id_laporan'");

    if ($querydelete) {
        header("location:cetak_laporan.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}

?>