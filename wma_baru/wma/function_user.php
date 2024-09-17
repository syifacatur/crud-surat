<?php
include 'koneksidb.php';

if($_GET['act']== 'tambahuser'){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_role = $_POST['role'];

    //query
    $querytambah =  mysqli_query($koneksi, "INSERT INTO tb_user (nama, username, password, user_role) VALUES('$nama', '$username' , '$password' , '$user_role')");

    if ($querytambah) {
        header("location:data_user.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($koneksi);
    }
}
elseif($_GET['act']=='updateuser'){
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $queryupdate = mysqli_query($koneksi, "UPDATE tb_user SET nama='$nama', username='$username' , password='$password' , user_role='$role' WHERE id_user='$id_user' ");

    if ($queryupdate) {
        header("location:data_user.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteuser'){
    $id_user = $_GET['id_user'];

    $querydelete = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user = '$id_user'");

    if ($querydelete) {
        header("location:data_user.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>