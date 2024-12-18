<?php
include 'koneksidb.php';
$id_spt = $_GET['id'];



if($_GET['act']== 'tambahproduk'){
    $id_spt = $_POST['id_spt'];
    $id_nama = $_POST['id_nama'];

    //cek id apakah sudah exist

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO cetak_laporan(id_spt, id_nama) VALUES('$id_spt', '$id_nama')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:tambah_nama.php?id=".$id_spt);
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
    
}
elseif($_GET['act']=='updateproduk'){
    $id_laporan = $_POST['id_laporan'];
    $id_spt = $_POST['id_spt'];
    $id_nama = $_POST['id_nama'];
    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE cetak_laporan SET id_spt='$id_spt', id_nama='$id_nama' WHERE id_laporan='$id_laporan' ");

    if ($queryupdate) {
        header("location:tambah_nama.php?id=".$id_spt);    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteproduk'){
    $id_nama = $_GET['id_nama'];
  
    
    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM cetak_laporan WHERE id_nama = '$id_nama'");


    if ($querydelete) {
        header("location:tambah_nama.php?id=".$id_spt);
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}

?>