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
            background-image: url('aset/img/website.jpg'); /* Update with your image path */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
    
    <title>Login</title>
</head>
<body>

<div align="center">
    <div align="center" style="width:450px; margin-top:8%;">
        <form name="login_form" method="post" class="well well-lg" action="" style="background-color: rgba(255, 255, 255, 0.8); -webkit-box-shadow: 0px 0px 5px #888888; padding: 20px; border-radius: 20px;">
        <h4 style="margin-bottom: 25px;"><b>BPSDMD PROV JATENG</b></h4>

            <?php if (isset($error)) { ?>
                <p style="font-style: italic; color: red; margin-top: 15px">Username / Password anda salah</p>
            <?php } ?>
            
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input require name="username" id="username" class="form-control" type="text" placeholder="Username" autocomplete="off" />
            </div>
            <br/>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input require name="password" id="form-password" class="form-control" type="password" placeholder="Password" autocomplete="off" />
            </div>
            <br />
            <div class="checkboxcss" style="color:#000000; float:right;">
                <input type="checkbox" onchange="document.getElementById('form-password').type = this.checked ? 'text' : 'password'"> Show Password
            </div>
            <span class="text-danger msg-error"><?php if (isset($error)) ?></span>
            
            <div class="form-group" class="checkboxcss" style="color:#000000; text-align: left;">
                <input type="checkbox" name="remember" value="on"> Remember Me
            </div>
            
            <input name="submit" type="submit" value="Login" class="btn btn-primary btn-block" style="margin-bottom: 15px;">       
        </form>
    </div>
</div>





</body>
</html>
