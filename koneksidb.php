<?php

$server = "localhost";
$user = "root";
$pass = "";
$dbname = "wma";

$koneksi = mysqli_connect($server,$user,$pass,$dbname);

if(mysqli_connect_errno()){
	echo "Koneksi Gagal".mysqli_connect_error();
}
?>