<?php
if (isset($_POST['submit'])) {
    include 'koneksidb.php';
    include 'proses_login.php';
}
?>

<html>

<head>
<script type="text/javascript" src="aset/bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="aset/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="aset/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="aset/font-awesome/css/font-awesome.min.css">


    <style>
        /* Global Styles */
        <?php
        switch ($_SERVER['QUERY_STRING']) {
            default:
                // Gaya CSS default dapat diletakkan di sini
                break;
            case 'signup':
                // Gaya CSS untuk 'signup' dapat diletakkan di sini
                break;
        }
        ?>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }

        .main-container {
            display: flex;
            height: 100vh;
        }

        .left-section {
    flex: 1;
    background-image: url('aset/img/hijau9.png'); /* Path gambar */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: -100px center; /* Geser ke kiri */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: black;
    text-align: center;
}



        .left-section .header {
            margin-bottom: 500px;
        }

        .left-section .header .logo {
            width: 50px;
        }

        .left-section h3 {
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .left-section p {
            font-size: 1em;
            margin: 0;
            font-weight: bold;
            /* Membuat teks tebal */

        }

        .title {
            font-size: 1.5em;
            /* Ukuran font, jika diperlukan */
            font-weight: bold;
            /* Membuat teks tebal */
            margin-bottom: 5px;
            /* Jarak bawah, jika diperlukan */
        }




        /* Right Section */
        .right-section {
            flex: 1;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 200px;

        }

        .form-container {
            text-align: center;
            max-width: 400px;
            width: 100%;


        }

        .form-container .form-logo {
            width: 60px;
            margin-bottom: 20px;
            position: absolute;
            /* Membuat elemen dapat diposisikan secara absolut */
            top: 30px;
            /* Jarak dari atas */
            left: 650px;
            /* Jarak dari kiri */
            color: black;
            /* Warna teks */
            text-align: left;
            /* Rata kiri */
            z-index: 10;
            /* Agar teks tidak tertimpa elemen lain */
        }

        .form-container h1 {
            position: absolute;
            /* Membuat elemen dapat diposisikan secara absolut */
            top: 30px;
            /* Jarak dari atas */
            left: 730px;
            /* Jarak dari kiri */
            color: black;
            /* Warna teks */
            text-align: left;
            /* Rata kiri */
            z-index: 10;
            /* Agar teks tidak tertimpa elemen lain */
            font-size: 1.5em;
            font-weight: bold;
            /* Membuat teks tebal */

        }

        .form-container h2 {
            position: absolute;
            /* Membuat elemen dapat diposisikan secara absolut */
            top: 130px;
            /* Jarak dari atas */
            left: 760px;
            /* Jarak dari kiri */
            color: black;
            /* Warna teks */
            text-align: left;
            /* Rata kiri */
            z-index: 10;
            /* Agar teks tidak tertimpa elemen lain */
            font-size: 1.5em;
            font-weight: bold;
            /* Membuat teks tebal */

        }

        .form-container p {
            position: absolute;
            /* Membuat elemen dapat diposisikan secara absolut */
            top: 180px;
            /* Jarak dari atas */
            left: 760px;
            /* Jarak dari kiri */
            color: dark gray;
            /* Warna teks */
            text-align: left;
            /* Rata kiri */
            z-index: 10;
            /* Agar teks tidak tertimpa elemen lain */
            font-size: 1.2em;
            font-weight: bold;
            /* Membuat teks tebal */

        }

        .spasi-besar {
            margin-bottom: 60px;
            /* Menambahkan jarak di bawah elemen */
            padding-top: 60px;
            /* Menambahkan jarak di atas elemen */
        }



        .form-group {

            margin-bottom: 20px;
            /* Jarak antar username dan pasword dan masuk */
            text-align: left;
            /* Label rata kiri */
            left: 650px;
            /* Jarak dari kiri */
            top: 200px;
            /* Jarak dari atas */

        }

        .form-group label {
            /*tulisan username*/
            font-size: 1.1em;
            color: #333;
            text-align: left;


        }

        .form-group input {
            /*kotak*/
            width: 100%;
            padding: 20px;
            font-size: 0.9em;
            border: 1px solid #ddd;
            border-radius: 5px;

        }


        .btn-submit {
            /*submit*/
            width: 45%;
            padding: 11px;
            background-color: #1c7371;
            border: none;
            color: white;
            font-size: 1.2em;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: flex-start;

        }

        .btn-submit:hover {
            background-color: #1c7371;
        }
    </style>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Login</title>
    </head>

<body>
    <div class="main-container">
        <!-- Left Section -->
        <div class="left-section">
            <div class="header">
                <img src="aset/img/logo2.png" alt="Logo" class="logo">
                <h3 class="title">Pemerintah Provinsi Jawa Tengah</h3>
                <p>E- letter</p>
            </div>

        </div>
        <!-- Right Section -->
        <div class="right-section">
            <div class="form-container">
                <img src="" alt="" class="">
                <h1></h1>
                <h2>Selamat Datang</h2>
                <p>Sistem Pembuatan Surat Elektronik<br>BPSDMD Provinsi Jawa Tengah</p>
                <form name="login_form" method="post" action="">
                    <div class="spasi-besar"></div>
                    <div class="geser-kiri"></div>
                    <?php if (isset($error)) { ?>
                        <p style="font-style: italic; color: red; margin-top: 15px">Username / Password anda salah</p>
                    <?php } ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input require name="username" id="username" type="text"
                            placeholder="Username" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input require name="password" id="form-password"  type="password"
                            placeholder="Password" autocomplete="off" />
                    </div>
                    <input name="submit" type="submit" value="Masuk" class="btn-submit">
                </form>

            </div>
        </div>
    </div>
    </div>
</body>

</html>