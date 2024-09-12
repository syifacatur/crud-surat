<?php
    if(isset($_POST['submit']))
    {
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
        <title>Login</title>
    </head>
    <body>
        <div align="center">
            <br>
            <img src='aset/img/logo1.jpg' width="150px">
            <hr>
            
            <div align="center" style="width:500px;margin-top:3%;">
                <form name="login_form" method="post" class="well well-lg" action="" style="-webkit-box-shadow: 0px 0px 5px #888888;">
                    <h4 style="margin-bottom: 25px;">
                        BPSDMD 
                    </h4>
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
                        <input require name="password" id="password" class="form-control" type="password" placeholder="Password" autocomplete="off" />
                    </div>
                    <br />
                    <input name="submit" type="submit" value="Login" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </body>

</html>