<?php
include 'koneksidb.php';

if($_GET['act']== 'tambahproduk'){
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO tb_produk (kode_produk, nama_produk) VALUES('$kode_produk', '$nama_produk')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:dasar_surat.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updateproduk'){
    $id_produk = $_POST['id_produk'];
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];

    //query update
    $queryupdate = mysqli_query($koneksi, "UPDATE tb_produk SET kode_produk='$kode_produk', nama_produk='$nama_produk' WHERE id_produk='$id_produk' ");

    if ($queryupdate) {
        header("location:dasar_surat.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteproduk'){
    $id_produk = $_GET['id_produk'];

    //query hapus
    $querydelete = mysqli_query($koneksi, "DELETE FROM tb_produk WHERE id_produk = '$id_produk'");

    if ($querydelete) {
        header("location:dasar_surat.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>