<?php
session_start();

$sess = $_SESSION['user_role'];

if(empty($sess)){
    echo "<script>alert('Silahkan Login Terlebih Dahulu')</script>";
    echo "<script>location.href='login.php'</script>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BPSDMD Prov Jateng</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="aset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="aset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="aset/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="aset/dist/css/skins/_all-skins.min.css">
    <!-- jQuery 2.1.4 -->
    <script src="aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="aset/plugins/jQuery/jquery-1.11.2.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="icon" href="aset/img/logo2.png" type="image/png">
<link rel="icon" href="aset/img/logo2.png" type="image/png+xml">

    <style type="text/css" media="print">
    @page { 
        size: landscape;
    }
</style>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">BPSDMD</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="aset/img/cowok.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Welcome <b><?php echo $_SESSION['username']?></b></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="aset/img/cowok.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo "Username : ".$_SESSION['username']?>
                      <small><?php echo "Role : ".$_SESSION['user_role']?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="aset/img/cowok.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>
                <?php 
                  echo $_SESSION['nama'];
                ?>
              </p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="header">Navigation</li>
            <!-- <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> -->

            
                <?php
                if($sess == "admin" || $sess == "user"){
                 
                  
                  echo "<li><a href='surat_perintah_tugas.php'><i class='fa fa-archive'></i> Surat Perintah Tugas </a></li>";
                  echo "<li><a href='daftar_nama.php'><i class='fa fa-archive'></i> Daftar Nama </a></li>";
                  echo "<li><a href='dasar_surat.php'><i class='fa fa-archive'></i> Dasar Surat </a></li>";
                  if($sess == "admin"){
                    echo "<li><a href='data_user.php'><i class='fa fa-user'></i> User</a></li>";
                  }
              

              
                }
                ?>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>