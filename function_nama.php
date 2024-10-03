<?php
include 'koneksidb.php';

if($_GET['act']== 'tambahproduk'){
    $nama = $_POST['nama'];
    $NIP = $_POST['NIP'];
    $pangkat = $_POST['pangkat'];
    $jabatan = $_POST['jabatan'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO daftar_nama(nama, NIP, pangkat, jabatan) VALUES('$nama', '$NIP', '$pangkat', '$jabatan')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:daftar_nama.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updateproduk'){
    $id_nama = $_POST['id_nama'];
    $nama = $_POST['nama'];
    $NIP = $_POST['NIP'];
    $pangkat = $_POST['pangkat'];
    $jabatan = $_POST['jabatan'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE daftar_nama SET nama='$nama', NIP='$NIP', pangkat='$pangkat', jabatan='$jabatan' WHERE id_nama='$id_nama' ");

    if ($queryupdate) {
        header("location:daftar_nama.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteproduk'){
    $id_nama = $_GET['id_nama'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM daftar_nama WHERE id_nama = '$id_nama'");

    if ($querydelete) {
        header("location:daftar_nama.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>