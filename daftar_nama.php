<?php 
include 'template/header_admin.php'; 
include 'koneksidb.php';
?>

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
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahproduk"><i class="fa fa-plus"></i> Tambah</a>
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
                    $queryview = mysqli_query($koneksi, "SELECT * FROM daftar_nama");
                    while ($row = mysqli_fetch_assoc($queryview)) {
                      
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama'];?></td>
                    <td><?php echo $row['NIP'];?></td>
                    <td><?php echo $row['pangkat'];?></td>
                    <td><?php echo $row['jabatan'];?></td>
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
                                <h4 align="center" >Apakah anda yakin ingin menghapus <?php echo $row['nama'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                <a href="function_nama.php?act=deleteproduk&id_nama=<?php echo $row['id_nama']; ?>" class="btn btn-success">Hapus</a>
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
                                <form action="function_nama.php?act=updateproduk" method="post" role="form">
                                  <?php
                                  $id_nama = $row['id_nama'];
                                  $query = "SELECT * FROM daftar_nama WHERE id_nama='$id_nama'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>

                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-sm-8"><input type="hidden" class="form-control" name="id_nama" placeholder="ID nama" value="<?php echo $row['id_nama']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Nama
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><select type="text" class="form-control" name="nama"
                                              placeholder="nama" value="<?php echo $row['nama']; ?>"></div>
                                          <option value=""></option>
                                          <option
                                            value="Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD">
                                            Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat
                                            Koordinasi dan Konsultasi SKPD </option>
                                          <option
                                            value="kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD">
                                            kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan
                                            Sistem Pemerintahan Berbasis Elektronik pada SKPD</option>
                                          <option
                                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian">
                                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan
                                            Pengolahan Administrasi Kepegawaian</option>
                                          <option
                                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi">
                                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan
                                            Pelatihan Pegawai Berdasarkan Tugas dan Fungsi</option>


                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">NIP
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><select type="text" class="form-control" name="NIP"
                                              placeholder="NIP" value="<?php echo $row['NIP']; ?>"></div>
                                          <option value=""></option>
                                          <option
                                            value="Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD">
                                            Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat
                                            Koordinasi dan Konsultasi SKPD </option>
                                          <option
                                            value="kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD">
                                            kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan
                                            Sistem Pemerintahan Berbasis Elektronik pada SKPD</option>
                                          <option
                                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian">
                                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan
                                            Pengolahan Administrasi Kepegawaian</option>
                                          <option
                                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi">
                                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan
                                            Pelatihan Pegawai Berdasarkan Tugas dan Fungsi</option>


                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Pangkat
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><select type="text" class="form-control" name="pangkat"
                                              placeholder="pangkat" value="<?php echo $row['pangkat']; ?>"></div>
                                          <option value=""></option>
                                          <option
                                            value="Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD">
                                            Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat
                                            Koordinasi dan Konsultasi SKPD </option>
                                          <option
                                            value="kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD">
                                            kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan
                                            Sistem Pemerintahan Berbasis Elektronik pada SKPD</option>
                                          <option
                                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian">
                                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan
                                            Pengolahan Administrasi Kepegawaian</option>
                                          <option
                                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi">
                                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan
                                            Pelatihan Pegawai Berdasarkan Tugas dan Fungsi</option>


                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Jabatan
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><select type="text" class="form-control" name="jabatan"
                                              placeholder="jabatan" value="<?php echo $row['jabatan']; ?>"></div>
                                          <option value=""></option>
                                          <option
                                            value="Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD">
                                            Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat
                                            Koordinasi dan Konsultasi SKPD </option>
                                          <option
                                            value="kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD">
                                            kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan
                                            Sistem Pemerintahan Berbasis Elektronik pada SKPD</option>
                                          <option
                                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian">
                                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan
                                            Pengolahan Administrasi Kepegawaian</option>
                                          <option
                                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi">
                                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan
                                            Pelatihan Pegawai Berdasarkan Tugas dan Fungsi</option>


                                          </select>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Tambah </h3>
                  </div>
                  <div class="modal-body">
                    <form action="function_nama.php?act=tambahproduk" method="post" role="form">
                    <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">nama<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select type="text" class="form-control" name="nama" placeholder=""
                              value=""></div>
                          <option value=""></option>
                          <option
                            value="Syifa Catur Wicaksono">
                            syifa catur wicaksono </option>
                          <option
                            value="yodida ilham perdana">
                            yodida ilham perdana</option>
                          <option
                            value="nastiti tri rahmawati">
                            nastiti rahmawati</option>
                           </select>
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">NIP<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select type="text" class="form-control" name="NIP" placeholder=""
                              value=""></div>
                          <option value=""></option>
                          <option
                            value="Syifa Catur Wicaksono">
                            syifa catur wicaksono </option>
                          <option
                            value="yodida ilham perdana">
                            yodida ilham perdana</option>
                          <option
                            value="nastiti tri rahmawati">
                            nastiti rahmawati</option>
                           </select>
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Pangkat<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select type="text" class="form-control" name="pangkat" placeholder=""
                              value=""></div>
                          <option value=""></option>
                          <option
                            value="Syifa Catur Wicaksono">
                            syifa catur wicaksono </option>
                          <option
                            value="yodida ilham perdana">
                            yodida ilham perdana</option>
                          <option
                            value="nastiti tri rahmawati">
                            nastiti rahmawati</option>
                            </select>
                            </div>
                            </div>


                            <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Jabatan<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select type="text" class="form-control" name="jabatan" placeholder=""
                              value=""></div>
                          <option value=""></option>
                          <option
                            value="Syifa Catur Wicaksono">
                            syifa catur wicaksono </option>
                          <option
                            value="yodida ilham perdana">
                            yodida ilham perdana</option>
                          <option
                            value="nastiti tri rahmawati">
                            nastiti rahmawati</option>
                          </select>
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