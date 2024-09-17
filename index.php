<?php include 'template/header_admin.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-image: url(p.png); background-repeat: no-repeat;  background-position: center;  background-size: contain;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>BPSDMD</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="callout callout-success">
          <h4>Selamat Datang! Anda Login Sebagai <?php echo $_SESSION['username']?>!</h4>
            </p
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include 'template/footer.php'; ?>