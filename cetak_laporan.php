<?php
include 'template/header_admin.php';
include 'koneksidb.php';
$id_spt = $_GET['id'];

?>

<head>
  <!-- Sertakan jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Sertakan Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Sertakan Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
    .select2-container {
      width: 100% !important;
      /* Mengatur lebar menjadi 100% dari elemen induknya */
    }
  </style>


  <script>

    $(document).ready(function () {

      // Terapkan Select2 pada elemen dengan id ' '

      $('#id_nama').select2({

        placeholder: "--PILIH--", // Placeholder untuk dropdown
        allowClear: true          // Menambahkan tombol untuk menghapus pilihan

      });

      $('#NIP').select2({
        placeholder: "--PILIH--",
        allowClear: true
      });
      $('#pangkat').select2({
        placeholder: "--PILIH--",
        allowClear: true
      });
      $('#jabatan').select2({
        placeholder: "--PILIH--",
        allowClear: true
      });
      $('#nama2').select2({
        placeholder: "--PILIH--",
        allowClear: true
      });
      $('#NIP2').select2({
        placeholder: "--PILIH--",
        allowClear: true
      });
      $('#pangkat2').select2({
        placeholder: "--PILIH--",
        allowClear: true
      });
      $('#jabatan2').select2({
        placeholder: "--PILIH--",
        allowClear: true
      });
    });
  </script>
</head>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Daftar Nama
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Daftar Nama</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <div class="box-tools pull-left">
              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahproduk"><i
                  class="fa fa-plus"></i> Tambah</a>
            </div>
          </div>
          <div class="box-body">

            <div class="table-responsive22">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Pangkat/Gol</th>
                    <th>Jabatan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $queryview = mysqli_query($koneksi, "SELECT * FROM cetak_laporan WHERE id_spt = $id_spt");
                  while ($row = mysqli_fetch_assoc($queryview)) {
                    $id_nama = $row['id_nama'];
                    $querynama = mysqli_query($koneksi, "SELECT * FROM daftar_nama WHERE id_nama = $id_nama");
                    while ($row = mysqli_fetch_assoc($querynama)) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['NIP']; ?></td>
                        <td><?php echo $row['pangkat']; ?></td>
                        <td><?php echo $row['jabatan']; ?></td>
                        <td>
                          <!--<a href="form_edituser.php?id=<?php echo $row['id_user'] ?>" class="btn btn-success btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                        
                          <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal"
                            data-target="#deleteproduk<?php echo $no; ?>"><i class="fa fa-trash"></i> Hapus</a>

                            


                          <!-- modal delete -->
                          <div class="example-modal">
                            <div id="deleteproduk<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title">Konfirmasi Hapus Data </h3>
                                  </div>
                                  <div class="modal-body">
                                    <h4 align="center">Apakah anda yakin ingin menghapus
                                      <?php echo $row['nama']; ?><strong><span class="grt"></span></strong> ?
                                    </h4>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="nodelete" type="button" class="btn btn-danger pull-left"
                                      data-dismiss="modal">Cancel</button>
                                    <a href="function_cetak.php?act=deleteproduk&id_nama=<?php echo $row['id_nama']; ?>&id=<?php echo $id_spt?>"
                                      class="btn btn-success">Hapus</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><!-- modal delete -->

                          <!-- modal update user -->


                          <div class="example-modal">
                            <div id="updateproduk<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title">Edit</h3>
                                  </div>
                                  <div class="modal-body">
                                    <form action="function_cetak.php?act=updateproduk" method="post" role="form">

                         <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">NAMA
                            <span class="text-red">*</span></label>
                          <div class="col-sm-8"><select id="id_nama" class="form-control select2" name="id_nama"
                              placeholder="Search.." value="<?php echo $row['id_nama']; ?>">
                              <option value="">--PILIH--"</option>

                              <?php
                              $query = mysqli_query($koneksi, "SELECT * FROM daftar_nama");
                              while ($row = mysqli_fetch_assoc($query)) {
                                echo "<option value='" . $row['id_nama'] . "'>" . $row['nama'] . "</option>";
                              }
                              ?>

                            </select>
                          </div>
                        </div>                                        
                                                <div class="modal-footer">
                                                  <button id="noedit" type="button" class="btn btn-danger pull-left"
                                                    data-dismiss="modal">Batal</button>
                                                  <input type="submit" name="submit" class="btn btn-success" value="Update">
                                                </div>
                                                <?php
                                      }
                                      ?>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><!-- modal update user -->
                        </td>
                      </tr>
                      <?php
                    }
                  
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- modal insert -->
          <div class="example-modal">
            <div id="tambahproduk" class="modal fade" role="dialog" style="display:none;">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Tambah </h3>
                  </div>
                  <div class="modal-body">
                    <form action="function_cetak.php?act=tambahproduk" method="post" role="form">
                      <input type='hidden' name='id_spt' value='<?php echo "$id_spt"; ?>' />
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">NAMA
                            <span class="text-red">*</span></label>
                          <div class="col-sm-8"><select id="nama2" class="form-control select2" name="id_nama"
                              placeholder="Search.." value="<?php echo $row['id_nama']; ?>">
                              <option value="">--PILIH--"</option>

                              <?php
                              $query = mysqli_query($koneksi, "SELECT * FROM daftar_nama");
                              while ($row = mysqli_fetch_assoc($query)) {
                                echo "<option value='" . $row['id_nama'] . "'>" . $row['nama'] . "</option>";
                              }
                              ?>

                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button id="nosave" type="button" class="btn btn-danger pull-left"
                            data-dismiss="modal">Batal</button>
                          <input type="submit" name="submit" class="btn btn-success" value="Tambah">
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- modal insert close -->
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div>

<?php include 'template/footer.php'; ?>