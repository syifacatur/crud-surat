<?php
include 'template/header_admin.php';
include 'koneksidb.php';
?>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Sertakan jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Sertakan Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Sertakan Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<style>
    .select2-container {
        width: 100% !important; /* Mengatur lebar menjadi 100% dari elemen induknya */
    }
</style>


<script>

  $(document).ready(function() {

    // Terapkan Select2 pada elemen dengan id ' '
    
    $('#NIP_penandatangan').select2({

      placeholder: "--PILIH--", // Placeholder untuk dropdown
      allowClear: true          // Menambahkan tombol untuk menghapus pilihan
            
    });
    $('#anggaran').select2({

placeholder: "--PILIH--", // Placeholder untuk dropdown
allowClear: true          // Menambahkan tombol untuk menghapus pilihan
      
});
$('#NIP2').select2({

placeholder: "--PILIH--", // Placeholder untuk dropdown
allowClear: true          // Menambahkan tombol untuk menghapus pilihan
      
});
$('#anggaran2').select2({

placeholder: "--PILIH--", // Placeholder untuk dropdown
allowClear: true          // Menambahkan tombol untuk menghapus pilihan
      
});
  });

    </script>
</head>



<div class="content-wrapper">
  <section class="content-header">
    <h1>Form_SPT
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Form_SPT</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
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
                    <th>No SPT</th>
                    <th>Dasar Undangan</th>
                    <th>Lokasi</th>
                    <th>Berangkat</th>
                    <th>Pulang</th>
                    <th>Tanggal SPT</th>
                    <th>Anggaran</th>
                    <th>Maksud dan Tujuan</th>
                    <th>NIP Penandatangan</th>
                    
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  function tgl_indo($tanggal)
                  {
                    $bulan = array(
                      1 => 'Januari',
                      'Februari',
                      'Maret',
                      'April',
                      'Mei',
                      'Juni',
                      'Juli',
                      'Agustus',
                      'September',
                      'Oktober',
                      'November',
                      'Desember'
                    );
                    $pecahkan = explode('-', $tanggal);

                    // variabel pecahkan 0 = tanggal
                    // variabel pecahkan 1 = bulan
                    // variabel pecahkan 2 = tahun
                  
                    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
                  }
                  $no = 1;
                  $queryview = mysqli_query($koneksi, "SELECT * FROM form_spt");
                  while ($row = mysqli_fetch_assoc($queryview)) {
                    $date_awal = new DateTime($row['tgl_kegiatan']);
                    $date_akhir = new DateTime($row['tgl_pulang']);
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $row['no_spt']; ?></td>
                      <td><?php echo $row['dasar_undangan']; ?></td>
                      <td><?php echo $row['lokasi']; ?></td>
                      <td><?php echo tgl_indo($row['tgl_kegiatan']); ?></td>
                      <td><?php echo tgl_indo($row['tgl_pulang']); ?></td>
                      <td><?php echo tgl_indo($row['tgl_spt']); ?></td>
                      <td><?php echo $row['anggaran']; ?></td>
                      <td><?php echo $row['maksud_tujuan']; ?></td>
                      <td><?php echo $row['NIP_penandatangan']; ?></td>
        

                      <td>
                        <!--<a href="form_edituser.php?id=<?php echo $row['id_user'] ?>" class="btn btn-success btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                        <a href="#" class="btn btn-success btn-flat btn-xs" data-toggle="modal"
                          data-target="#updateproduk<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal"
                          data-target="#deleteproduk<?php echo $no; ?>"><i class="fa fa-trash"></i> Hapus</a>
                        <a target="_blank" href="cetakform_dinamis.php?id=<?php echo $row['id_spt'] ?>" data="_blank"><button
                            class="btn btn-default btn-xs" data="_blank"><i class="fa fa-print"></i> Cetak
                            SPT</button></a>



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
                                    <?php echo $row['no_spt']; ?><strong><span class="grt"></span></strong> ?
                                  </h4>
                                </div>
                                <div class="modal-footer">
                                  <button id="nodelete" type="button" class="btn btn-danger pull-left"
                                    data-dismiss="modal">Cancel</button>
                                  <a href="function_spt.php?act=deleteproduk&id_spt=<?php echo $row['id_spt']; ?>"
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
                                  <form action="function_spt.php?act=updateproduk" method="post" role="form">
                                    <?php
                                    $id_spt = $row['id_spt'];
                                    $query = "SELECT * FROM form_spt WHERE id_spt='$id_spt'";
                                    $result = mysqli_query($koneksi, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                      ?>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-8"><input type="hidden" class="form-control" name="id_spt"
                                              placeholder="ID spt" value="<?php echo $row['id_spt']; ?>"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">NO SPT
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><input type="text" class="form-control" name="no_spt"
                                              placeholder="no_spt" value="<?php echo $row['no_spt']; ?>"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Dasar Undangan
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><input type="text" class="form-control"
                                              name="dasar_undangan" placeholder="dasar_undangan"
                                              value="<?php echo $row['dasar_undangan']; ?>"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Lokasi
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><input type="text" class="form-control" name="lokasi"
                                              placeholder="lokasi" value="<?php echo $row['lokasi']; ?>"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Berangkat
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><input type="date" class="form-control" name="tgl_kegiatan"
                                              placeholder="tgl_kegiatan" value="<?php echo $row['tgl_kegiatan']; ?>"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Pulang
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><input type="date" class="form-control" name="tgl_pulang"
                                              placeholder="tgl_pulang" value="<?php echo $row['tgl_pulang']; ?>"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Tanggal SPT
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><input type="date" class="form-control" name="tgl_spt"
                                              placeholder="tgl_spt" value="<?php echo $row['tgl_spt']; ?>"></div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">Anggaran
                                            <span class="text-red">*</span></label>
                                            <div class="col-sm-8"><select id="anggaran" class="form-control select2" name="anggaran" placeholder="Search.."value="<?php echo $row['anggaran']; ?>"></div>
                                          <option value="">--PILIH--</option>
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
                                          <label class="col-sm-3 control-label text-right">Maksud dan Tujuan
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><input type="text" class="form-control" name="maksud_tujuan"
                                              placeholder="maksud_tujuan" value="<?php echo $row['maksud_tujuan']; ?>">
                                          </div>
                                        </div>
                                      </div>
                                    
                                  <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">NIP Penandatangan
                                            <span class="text-red">*</span></label>
                                            <div class="col-sm-8"><select id="NIP_penandatangan" class="form-control select2" name="NIP_penandatangan" placeholder="Search.."value="<?php echo $row['NIP_penandatangan']; ?>"></div>
                                          <option value="">--PILIH--</option>
                                          <option
                                            value="KEPALA BADAN PENGEMBANGAN SUMBER DAYA 
MANUSIA DAERAH PROVINSI JAWA TENGAH






Dr. SADIMIN, S.Pd., M.Eng
Pembina Utama Madya
NIP. 197212061994121001


">
KEPALA BADAN PENGEMBANGAN SUMBER DAYA 
MANUSIA DAERAH PROVINSI JAWA TENGAH






Dr. SADIMIN, S.Pd., M.Eng
Pembina Utama Madya
NIP. 197212061994121001


 </option>
                                          <option
                                            value="Kepala Bidang Sertifikasi Kompetensi 
Dan Penjaminan Mutu






Sri Sulistiyati, SE, M.Kom
Pembina Tingkat I
NIP. 197001121992032006


">
Kepala Bidang Sertifikasi Kompetensi 
Dan Penjaminan Mutu





Sri Sulistiyati, SE, M.Kom
Pembina Tingkat I
NIP. 197001121992032006


/option>
                                          <option
                                            value="Kepala Bidang Pengembangan
 Kompetensi Teknis






Sumarhendro, S.Sos
Pembina Tingkat I
NIP. 196709221998031006


">
Kepala Bidang Pengembangan 
Kompetensi Teknis







Sumarhendro, S.Sos
Pembina Tingkat I
NIP. 196709221998031006


</option>
                                          <option
                                            value="Kabid Pengembangan Kompetensi 
Jabatan Fungsional






Dr. Anon Priyantoro, S.Pd., M.Pd
Pembina Tingkat I
NIP. 197305011998011001


">
Kabid Pengembangan Kompetensi 
Jabatan Fungsional






Dr. Anon Priyantoro, S.Pd., M.Pd
Pembina Tingkat I
NIP. 197305011998011001


</option>
<option
                                            value="Plt. Kepala Bidang Pengembangan
Kompetensi Manajerial






Sumarhendro, S.Sos
Pembina Tingkat I
NIP. 196709221998031006




">
Plt. Kepala Bidang Pengembangan
 Kompetensi Manajerial






Sumarhendro, S.Sos
Pembina Tingkat I
NIP. 196709221998031006
IV/B




</option>



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
          <div class="example-modal modal-lg">
            <div id="tambahproduk" class="modal fade" role="dialog" style="display:none;">
              <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Tambah </h3>
                  </div>
                  <div class="modal-body">
                    <form action="function_spt.php?act=tambahproduk" method="post" role="form">
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">NO SPT<span class="text-red">*</span></label>
                          <div class="col-sm-8"><input type="text" class="form-control" name="no_spt" placeholder=""
                              value=""></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Dasar Undangan<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><input type="text" class="form-control" name="dasar_undangan"
                              placeholder="" value=""></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Lokasi<span class="text-red">*</span></label>
                          <div class="col-sm-8"><input type="text" class="form-control" name="lokasi" placeholder=""
                              value=""></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Berangkat<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><input type="date" class="form-control" name="tgl_kegiatan"
                              placeholder="" value=""></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Pulang<span class="text-red">*</span></label>
                          <div class="col-sm-8"><input type="date" class="form-control" name="tgl_pulang" placeholder=""
                              value=""></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Tanggal SPT<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><input type="date" class="form-control" name="tgl_spt" placeholder=""
                              value=""></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Maksud dan Tujuan<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><input type="text" class="form-control" name="maksud_tujuan"
                              placeholder="" value=""></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">Anggaran<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select id="anggaran2" class="form-control select2" name="anggaran" placeholder=""
                              value=""></div>
                          <option value="">-pilih anggaran-</option>
                          <option
                            value="Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD">
                            Kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Penyelenggaraan Rapat Koordinasi
                            dan Konsultasi SKPD </option>
                          <option
                            value="kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem Pemerintahan Berbasis Elektronik pada SKPD">
                            kegiatan Administrasi Umum Perangkat Daerah Sub Kegiatan Dukungan Pelaksanaan Sistem
                            Pemerintahan Berbasis Elektronik pada SKPD</option>
                          <option
                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan Administrasi Kepegawaian">
                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendataan dan Pengolahan
                            Administrasi Kepegawaian</option>
                          <option
                            value="Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi">
                            Kegiatan Administrasi Kepegawaian Perangkat Daerah Sub Kegiatan Pendidikan dan Pelatihan
                            Pegawai Berdasarkan Tugas dan Fungsi</option>

                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">NIP Penandatangan<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select id="NIP2" class="form-control select2" name="NIP_penandatangan" placeholder=""
                              value=""></div>
                          <option value=""></option>
                          <option value="">-pilih NIP-</option>
                          <option
                            value="KEPALA BADAN PENGEMBANGAN SUMBER DAYA 
MANUSIA DAERAH PROVINSI JAWA TENGAH






Dr. Sadimin, S.Pd, M.Eng
Pembina Utama Madya
NIP. 197212061994121001
">
KEPALA BADAN PENGEMBANGAN SUMBER DAYA 
MANUSIA DAERAH PROVINSI JAWA TENGAH






Dr. Sadimin, S.Pd., M.Eng
Pembina Utama Madya
NIP. 197212061994121001
</option>
                          <option
                            value="Kepala Bidang Sertifikasi Kompetensi
Dan Penjaminan Mutu






Sri Sulistiyati, SE, M.Kom
Pembina Tingkat I
NIP. 197001121992032006
">
Kepala Bidang Sertifikasi Kompetensi 
Dan Penjaminan Mutu





Sri Sulistiyati, SE, M.Kom
Pembina Tingkat I
NIP. 197001121992032006
</option>
                          <option
                            value="Kepala Bidang Pengembangan
Kompetensi Teknis






Sumarhendro, S.Sos
Pembina Tingkat I
NIP. 196709221998031006
">
Kepala Bidang Pengembangan 
Kompetensi Teknis





Sumarhendro, S.Sos
Pembina Tingkat I
NIP. 196709221998031006
</option>
                          <option
                            value="Kabid Pengembangan Kompetensi 
Jabatan Fungsional






Dr. Anon Priyantoro, S.Pd., M.Pd.
Pembina Tingkat I
NIP. 197305011998011001
">
Kabid Pengembangan Kompetensi 
Jabatan Fungsional





Dr. Anon Priyantoro, S.Pd., M.Pd.
Pembina Tingkat I
NIP. 197305011998011001
</option>
<option
                            value="Plt. Kepala Bidang Pengembangan
Kompetensi Manajerial






Sumarhendro, S.Sos
Pembina Tingkat I
NIP. 196709221998031006
">
Plt. Kepala Bidang Pengembangan 
Kompetensi Manajerial






Sumarhendro, S.Sos
Pembina Tingkat I
NIP. 196709221998031006
</option>

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