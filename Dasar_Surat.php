<?php 
include 'template/header_admin.php'; 
include 'koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Dasar Surat
  </h1>
  <ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dasar Surat</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahproduk"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Deskripsi</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT * FROM tb_produk");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                      
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['kode_produk'];?></td>
                    <td>
                      <!--<a href="form_edituser.php?id=<?php echo $row['id_user']?>" class="btn btn-success btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-success btn-flat btn-xs" data-toggle="modal" data-target="#updateproduk<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deleteproduk<?php echo $no; ?>"><i class="fa fa-trash"></i> Hapus</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deleteproduk<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Hapus Data </h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus <?php echo $row['nama_produk'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                <a href="function_dasarsurat.php?act=deleteproduk&id_produk=<?php echo $row['id_produk']; ?>" class="btn btn-success">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updateproduk<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Deskripsi</h3>
                              </div>
                              <div class="modal-body">
                                <form action="function_dasarsurat.php?act=updateproduk" method="post" role="form">
                                  <?php
                                  $id_produk = $row['id_produk'];
                                  $query = "SELECT * FROM tb_produk WHERE id_produk='$id_produk'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-sm-8"><input type="hidden" class="form-control" name="id_produk" placeholder="ID Produk" value="<?php echo $row['id_produk']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Deskripsi
                                      <span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="kode_produk" placeholder="Kode Produk" value="<?php echo $row['kode_produk']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="noedit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
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
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Tambah </h3>
                </div>
                <div class="modal-body">
                  <form action="function_dasarsurat.php?act=tambahproduk" method="post" role="form">
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Deskripsi<span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="kode_produk" placeholder="" value=""></div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
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