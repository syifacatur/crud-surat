<?php 
include 'template/header_admin.php'; 
include 'koneksidb.php';
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
        width: 100% !important; /* Mengatur lebar menjadi 100% dari elemen induknya */
    }
</style>


<script>

  $(document).ready(function() {

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
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit</h3>
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
                                      <div class="col-sm-8"><input type="hidden" class="form-control select2" name="id_nama" placeholder="ID nama" value="<?php echo $row['id_nama']; ?>"></div>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">NAMA
                                            <span class="text-red">*</span></label>
                                            <div class="col-sm-8"><select id="id_nama" class="form-control select2" name="nama" placeholder="Search.."value="<?php echo $row['nama']; ?>">
                                          <option value="">--PILIH--</option>
                                          <option
                                            value="ADJI SURYA PRATAMA, SH">
                                             ADJI SURYA PRATAMA, SH</option>
                                          <option
                                            value="ILHAM HABIBULLAH AKBAR, S.KOM">
                                            ILHAM HABIBULLAH AKBAR, S.KOM</option>
                                          <option
                                            value="BAGAS ARUNA YUDHATAMA, S.Kom">
                                            BAGAS ARUNA YUDHATAMA, S.Kom</option>
                                          <option
                                            value="ABDUR ROHMAN">
                                            ABDUR ROHMAN</option>
                                            <option
                                            value="Ir. YATNO ISWORO, MP">
                                            Ir. YATNO ISWORO, MP</option>
                                            <option
                                            value="Dr.Ir. KRISTIYO SUMARWONO, M.Sc.">
                                            Dr.Ir. KRISTIYO SUMARWONO, M.Sc.</option>
                                            <option
                                            value="Ir. WARDI ASTUTI, M.Pd.">
                                            Ir. WARDI ASTUTI, M.Pd.</option>
                                            <option
                                            value="Drs. SISWANTA JAKA PURNAMA, Apt.,M.Kes.">
                                            Drs. SISWANTA JAKA PURNAMA, Apt.,M.Kes.</option>
                                            <option
                                            value="Dr. Ir. SUPRIYANTO, M.Si.">
                                            Dr. Ir. SUPRIYANTO, M.Si.</option>
                                            <option
                                            value="GIGUS NURYATNO, A.Pi.,M.A.P.">
                                            GIGUS NURYATNO, A.Pi.,M.A.P.</option>
                                            <option
                                            value="WAHJU WIDIARSIH, ST.,M.Pi.">
                                            WAHJU WIDIARSIH, ST.,M.Pi.</option>
                                            <option
                                            value="DWI TITI SUNDARI, SKM.,M.Kes.">
                                            DWI TITI SUNDARI, SKM.,M.Kes.</option>
                                            <option
                                            value="HARINI SETIJOWATI, SKM., M.HSc.">
                                            HARINI SETIJOWATI, SKM., M.HSc.</option>
                                            <option
                                            value="Dra. SITI AMINAH ZURIAH, MM.">
                                            Dra. SITI AMINAH ZURIAH, MM.</option>
                                            <option
                                            value="SODIKIN, SS., M.Si.">
                                            SODIKIN, SS., M.Si.</option>
                                            <option
                                            value="Drs. SUMARNO, M.SI.">
                                            Drs. SUMARNO, M.SI.</option>
                                            <option
                                            value="DIYAH MUBAROKAH AKHADIYATI, S.Pi.,M.Pi.">
                                            DIYAH MUBAROKAH AKHADIYATI, S.Pi.,M.Pi.</option>
                                            <option
                                            value="SRIYATUN, S.Kep.,MM. ">
                                            SRIYATUN, S.Kep.,MM.</option>
                                            <option
                                            value="ARIF EFENDY, SH.,MM. ">
                                            ARIF EFENDY, SH.,MM.</option>
                                            <option
                                            value="Drs. HERU GUNAWAN, M.M">
                                            Drs. HERU GUNAWAN, M.M</option>
                                            <option
                                            value="AGUS ANDRIYANTO, S.Sos.,MM.">
                                            AGUS ANDRIYANTO, S.Sos.,MM.</option>
                                            <option
                                            value="KRISTIANA WIDIAWATI, S.Pi.,MT.">
                                            KRISTIANA WIDIAWATI, S.Pi.,MT.</option>
                                            <option
                                            value="Drs. PAMUNGKAS TUNGGUL WASANA, M.Si">
                                            Drs. PAMUNGKAS TUNGGUL WASANA, M.Si</option>
                                            <option
                                            value="IKBAL KHAFID, S.IP.,M.Si">
                                            IKBAL KHAFID, S.IP.,M.Si</option>
                                            <option
                                            value="MUHAMMAD ALAZIZ, S.E.,M.M">
                                            MUHAMMAD ALAZIZ, S.E.,M.M</option>
                                            <option
                                            value="AGUS PUJIANTO, SH.MM">
                                            AGUS PUJIANTO, SH.MM</option>
                                            <option
                                            value="TRI MARDIYANTI RATNASARI, SE.,Macc.">
                                            TRI MARDIYANTI RATNASARI, SE.,M.Acc.</option>
                                            <option
                                            value="Dra. NILA AGUSTINA, M.P.A">
                                            Dra. NILA AGUSTINA, M.P.A</option>
                                            <option
                                            value="MUCHAMAD RIZAL, ST.,M.Sc.,M.Eng.">
                                            MUCHAMAD RIZAL, ST.,M.Sc.,M.Eng.</option>
                                            <option
                                            value="Dr. ERNI IRAWATI, S.E.,M.Pd.">
                                            Dr. ERNI IRAWATI, S.E.,M.pd.</option>
                                            <option
                                            value="EDI WINARNO A S, S.T.,M.Kom.">
                                            EDI WINARNO A S, S.T.,M.Kom.</option>
                                            <option
                                            value="ANDIS TRIYANTO, S.KM.,M.Kes.">
                                            ANDIS TRIYANTO, S.KM.,M.Kes.</option>
                                            <option
                                            value="YUNI INDARTI, S.Sos., M.M">
                                            YUNI INDARTI, S.Sos., M.M</option>
                                            <option
                                            value="ABDUL MANAN, S.Pd.,MM.">
                                            ABDUL MANAN, S.Pd.,MM.</option>
                                            <option
                                            value="NUNI PURWATI">
                                            NUNI PURWATI</option>
                                            <option
                                            value="LILIK BUDI IRWANTO, S.Sos.,M.P.A">
                                            LILIK BUDI IRWANTO, S.Sos.,M.P.A</option>
                                            <option
                                            value="ISMU PANDOYO, S.I.Kom.">
                                            ISMU PANDOYO, S.I.Kom.</option>
                                            <option
                                            value="KURNIAWAN SETYADHI">
                                            KURNIAWAN SETYADHI</option>
                                            <option
                                            value="IMAROH YUNIANA, S.Mn.,MM.">
                                            IMAROH YUNIANA, S.Mn.,MM.</option>
                                            <option
                                            value="YUNI DWI ASTUTI, SE.">
                                            YUNI DWI ASTUTI, SE.</option>
                                            <option
                                            value="Rr. ASTUTI EKAWATI, SE.">
                                            Rr. ASTUTI EKAWATI, SE.</option>
                                            <option
                                            value="MUHLISIN">
                                            MUHLISIN</option>
                                            <option
                                            value="NATALIA HERIANY, S.Psi.">
                                            NATALIA HERIANY, S.Psi.</option>
                                            <option
                                            value="EKA WATININGSIH, S.Pd.">
                                            EKA WATININGSIH, S.Pd.</option>
                                            <option
                                            value="RATEH ARIYANI, SH.">
                                            RATEH ARIYANI, SH.</option>
                                            <option
                                            value="SRI MOERDJIJATOEN">
                                            SRI MOERDJIJATOEN</option>
                                            <option
                                            value="BAYU CANDRA PERKASA, S.STP.,M.Sc.">
                                            BAYU CANDRA PERKASA, S.STP.,M.Sc.</option>
                                            <option
                                            value="SUPARNO, SH.">
                                            SUPARNO, SH.</option>
                                            <option
                                            value="PURWANTO, SH.">
                                            PURWANTO, SH.</option>
                                            <option
                                            value="RONY HERYANTO">
                                            RONY HERYANTO</option>
                                            <option
                                            value="SUROSO, SH.">
                                            SUROSO, SH.</option>
                                            <option
                                            value="LASTIYO">
                                            LASTIYO</option>
                                            <option
                                            value="JAUHARI">
                                            JAUHARI</option>
                                            <option
                                            value="NURHADI">
                                            NURHADI</option>
                                            <option
                                            value="ANWAR">
                                            ANWAR</option>
                                            <option
                                            value="LULUS">
                                            LULUS</option>
                                            <option
                                            value="SUTARMO">
                                            SUTARMO</option>
                                            <option
                                            value="KANDAR">
                                            KANDAR</option>
                                            <option
                                            value="PARIDI">
                                            PARIDI</option>
                                            <option
                                            value="ITA KARTIKA, S.Kom">
                                            ITA KARTIKA, S.Kom</option>
                                            <option
                                            value="MARINI HASID, S.STP., M.M.">
                                            MARINI HASID, S.STP., M.M.</option>
                                            <option
                                            value="YULIUS SAPTA SETIAJI, SH">
                                            YULIUS SAPTA SETIAJI, SH</option>
                                            <option
                                            value="MUNTOHA">
                                            MUNTOHA</option>
                                            <option
                                            value="MOCHAMAD SAID, S.H.">
                                            MOCHAMAD SAID, S.H.</option>
                                            <option
                                            value="EKA YUNITA DESARI, S.S., M.Si">
                                            EKA YUNITA DESARI, S.S., M.Si</option>
                                            <option
                                            value="SARTONO">
                                            SARTONO</option>
                                            <option
                                            value="HENDRIYANI MUKHTAR, SE, M.Si">
                                            HENDRIYANI MUKHTAR, SE, M.Si</option>
                                            <option
                                            value="ATTHATHUR MASSALENA AM, SE, MM">
                                            ATTHATHUR MASSALENA AM, SE, MM</option>
                                            <option
                                            value="JAKA MUJIHANA, S.Pd., M.M.">
                                            JAKA MUJIHANA, S.Pd., M.M.</option>
                                            <option
                                            value="DINAR KURNIAWAN , S.STP">
                                            DINAR KURNIAWAN , S.STP</option>
                                            <option
                                            value="Dra. HERAWATI WIDYARINI, MM">
                                            Dra. HERAWATI WIDYARINI, MM</option>
                                            <option
                                            value="SUDIBYO BUDI SETYAWAN, S.E.">
                                            SUDIBYO BUDI SETYAWAN, S.E.</option>
                                            <option
                                            value="V. WINARTI AGUSTININGTYAS, SH, M.Si">
                                            V. WINARTI AGUSTININGTYAS, SH, M.Si</option>
                                            <option
                                            value="GIGIH HARYONO, SH">
                                            GIGIH HARYONO, SH</option>
                                            <option
                                            value="HARI WIDADA">
                                            HARI WIDADA</option>
                                            <option
                                            value="MOH SAMSUDIN">
                                            MOH SAMSUDIN</option>
                                            <option
                                            value="MUSTARI, SH, MH.">
                                            MUSTARI, SH, MH.</option>
                                            <option
                                            value="DIAN ARISETYANTO, SE">
                                            DIAN ARISETYANTO, SE</option>
                                            <option
                                            value="SUKARDI">
                                            SUKARDI</option>
                                            <option
                                            value="ROHMY IRMA ASTUTI, SE">
                                            ROHMY IRMA ASTUTI, SE</option>
                                            <option
                                            value="Dr. ENDANG RIAGUSTRIANINGSIH N, S.IP, M.Pd">
                                            Dr. ENDANG RIAGUSTRIANINGSIH N, S.IP, M.Pd</option>
                                            <option
                                            value="ANDI SURYANTO, S.STP., M.Si.">
                                            ANDI SURYANTO, S.STP., M.Si.</option>
                                            <option
                                            value="ANDI SETIAWAN, SH, MH.">
                                            ANDI SETIAWAN, SH, MH.</option>
                                            <option
                                            value="AMANDA SORAYA, S.Psi">
                                            AMANDA SORAYA, S.Psi</option>
                                            <option
                                            value="ARI DHAMAYANTI, M.Psi">
                                            ARI DHAMAYANTI, M.Psi</option>
                                            <option
                                            value="HASTIN ARFIANI, SH">
                                            HASTIN ARFIANI, SH</option>
                                            <option
                                            value="SUHARTO, SE, M.Si">
                                            SUHARTO, SE, M.Si</option>
                                            <option
                                            value="JUMADI">
                                            JUMADI</option>
                                            <option
                                            value="ANDIKA HIDAYAT ADI, S.Kom.">
                                            ANDIKA HIDAYAT ADI, S.Kom.</option>
                                            <option
                                            value="RIDWAN NUGRAHA PASA, S.STP.">
                                            RIDWAN NUGRAHA PASA, S.STP.</option>
                                            <option
                                            value="ARIS GUNAWAN">
                                            ARIS GUNAWAN</option>
                                            <option
                                            value="SUDIRMAN MUSTAFA, S.H., M.Hum.">
                                            SUDIRMAN MUSTAFA, S.H., M.Hum.</option>
                                            <option
                                            value="SUTARDI, A.Pi., M.M.A.">
                                            SUTARDI, A.Pi., M.M.A.</option>
                                            <option
                                            value="ARIF RACHMAN, SP, MPP,M.Ec.Dev">
                                            ARIF RACHMAN, SP, MPP,M.Ec.Dev</option>
                                            <option
                                            value="NUNUNG NURJANAH, SE,M.Si">
                                            NUNUNG NURJANAH, SE,M.Si</option>
                                            <option
                                            value="SRI MARYUNI, S.Pd, MM">
                                            SRI MARYUNI, S.Pd, MM</option>
                                            <option
                                            value="SAGUNG ISTIONO, SE.Ak,M.Si">
                                            AGUNG ISTIONO, SE.Ak,M.Si</option>
                                            <option
                                            value="Drs. SUDARYANTO, M.Si.">
                                            Drs. SUDARYANTO, M.Si.</option>
                                            <option
                                            value="MARIA SUSIAWATI, S.Sos.,MPA">
                                            MARIA SUSIAWATI, S.Sos.,MPA</option>
                                            <option
                                            value="H. SANTOSA, S.KEP,MM">
                                            H. SANTOSA, S.KEP,MM</option>
                                            <option
                                            value="SENNA VIRGIAWAN, S.STP">
                                            SENNA VIRGIAWAN, S.STP</option>
                                            <option
                                            value="ANI YULIYATI, A.Md.">
                                            ANI YULIYATI, A.Md.</option>
                                            <option
                                            value="PRIMA MAHARDIKA PUTRA, S.A.P">
                                            PRIMA MAHARDIKA PUTRA, S.A.P</option>
                                            <option
                                            value="ZAROH LAILATUL CHANIFAH, S.Pd.">
                                            ZAROH LAILATUL CHANIFAH, S.Pd.</option>
                                            <option
                                            value="CHINTIA PRAHESTI YUGATPUTRI, A.Md.">
                                            CHINTIA PRAHESTI YUGATPUTRI, A.Md.</option>
                                            <option
                                            value="FERZI EDI WARDOYO, A.Md">
                                            FERZI EDI WARDOYO, A.Md</option>
                                            <option
                                            value="ERMIN KARTI ANDARI, A.Md">
                                            ERMIN KARTI ANDARI, A.Md</option>
                                            <option
                                            value="EKA WIDIYANI, S.Pd.">
                                            EKA WIDIYANI, S.Pd.</option>
                                            <option
                                            value="DIAN AL RIZKY AGUSTIN, A.Md.">
                                            DIAN AL RIZKY AGUSTIN, A.Md.</option>
                                            <option
                                            value="RUDI SANTOSO ADI, S.IP.">
                                            RUDI SANTOSO ADI, S.IP.</option>
                                            <option
                                            value="Dra. MUKAROMAH SYAKOER, M.M">
                                            Dra. MUKAROMAH SYAKOER, M.M</option>
                                            <option
                                            value="Dr. SUDALMA, S.Si., M.Si.">
                                            Dr. SUDALMA, S.Si., M.Si.</option>
                                            <option
                                            value="AGUS SUPRIYANTO, S.E., M.M.">
                                            AGUS SUPRIYANTO, S.E., M.M.</option>
                                            <option
                                            value="Ir. H. YOYON INDRAYANA, MT">
                                            Ir. H. YOYON INDRAYANA, MT</option>
                                            <option
                                            value="MELATI KRISTANTI, A.Md.">
                                            MELATI KRISTANTI, A.Md.</option>
                                            <option
                                            value="SUMARHENDRO, S.Sos">
                                            SUMARHENDRO, S.Sos</option>
                                            <option
                                            value="ADITYA IIP WISUDAWAN NUGROHO, S.STP, M.Si">
                                            ADITYA IIP WISUDAWAN NUGROHO, S.STP, M.Si</option>
                                            <option
                                            value="HENDRI SANTOSA, SE, Ak, M.Si. CA">
                                            HENDRI SANTOSA, SE, Ak, M.Si. CA</option>
                                            <option
                                            value="SRI SULISTIYATI, SE, M.Kom">
                                            SRI SULISTIYATI, SE, M.Kom</option>
                                            <option
                                            value="RINI KUSWARDANI, S.E">
                                            RINI KUSWARDANI, S.E</option>
                                            <option
                                            value="ASA BANI CHITARA, A.Md.Kb.N.">
                                            ASA BANI CHITARA, A.Md.Kb.N.</option>
                                            <option
                                            value="AZKY ILAHI RATU CONSINA, A.Md.Ak.">
                                            AZKY ILAHI RATU CONSINA, A.Md.Ak.</option>
                                            <option
                                            value="NOPRI PRIANTO, S.Pd.">
                                            NOPRI PRIANTO, S.Pd.</option>
                                            <option
                                            value="NUR SAFIRAH ADLINA, S.Hum">
                                            NUR SAFIRAH ADLINA, S.Hum</option>
                                            <option
                                            value="Drs. HARI KUNTJORO, S.Sos, M.Si">
                                            Drs. HARI KUNTJORO, S.Sos, M.Si</option>
                                            <option
                                            value="Drs. EKO SUPRAYITNO, MM">
                                            Drs. EKO SUPRAYITNO, MM</option>
                                            <option
                                            value="INDRA ADI NUGROHO, S.ST.">
                                            INDRA ADI NUGROHO, S.ST.</option>
                                            <option
                                            value="Dr. SADIMIN, S.Pd., M.Eng.">
                                            Dr. SADIMIN, S.Pd., M.Eng.</option>
                                            <option
                                            value="Dr. ANON PRIYANTORO, S.Pd., M.Pd.">
                                            Dr. ANON PRIYANTORO, S.Pd., M.Pd.</option>
                                            <option
                                            value="FREIDA TRIASTUTI RATNA JATI, S.E.">
                                            FREIDA TRIASTUTI RATNA JATI, S.E.</option>
                                            <option
                                            value="VITA DWI IRMAWATI, S.Sos.">
                                            VITA DWI IRMAWATI, S.Sos.</option>
                                            <option
                                            value="SYLVI PANAMASARI, S.Psi">
                                            SYLVI PANAMASARI, S.Psi</option>
                                            <option
                                            value="HENDRA SUGIARTO, S.E.">
                                            HENDRA SUGIARTO, S.E.</option>
                                            <option
                                            value="DHARU PUNJUNG WIJAYA, SAP, M.Si">
                                            DHARU PUNJUNG WIJAYA, SAP, M.Si</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group ">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">NIP
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><select id="NIP" class="form-control select2" name="NIP" placeholder="Search.."value="<?php echo $row['nama']; ?>">
                                          <option value="">--PILIH--</option>
                                              
                                              <option
                                            value="196410101999031002">
                                            196410101999031002 </option>
                                          <option
                                            value="196001111986031010">
                                            196001111986031010</option>
                                          <option
                                            value="196608181992032015">
                                            196608181992032015</option>
                                          <option
                                            value="196310281989111001">
                                            196310281989111001</option>
                                            <option
                                            value="197312102007012010">
                                            197312102007012010</option>
                                            <option
                                            value="197008081993031008">
                                            197008081993031008</option>
                                            <option
                                            value="197906202009012003">
                                            197906202009012003</option>
                                            <option
                                            value="197505041999031006">
                                            197505041999031006</option>
                                            <option
                                            value="197502022005011004">
                                            197502022005011004</option>
                                            <option
                                            value="197308292009012002">
                                            197308292009012002</option>
                                            <option
                                            value="197608171999032005">
                                            197608171999032005</option>
                                            <option
                                            value="197103171997032005">
                                            197103171997032005</option>
                                            <option
                                            value="197008101994031004">
                                            197008101994031004</option>
                                            <option
                                            value="197003142005011008">
                                            197003142005011008</option>
                                            <option
                                            value="196705041986031002">
                                            196705041986031002</option>
                                            <option
                                            value="197301101992031001">
                                            197301101992031001</option>
                                            <option
                                            value="197112041999032007">
                                            197112041999032007</option>
                                            <option
                                            value="197008241995031002">
                                            197008241995031002</option>
                                            <option
                                            value="196911091990031006">
                                            196911091990031006</option>
                                            <option
                                            value="196911021990031003">
                                            196911021990031003</option>
                                            <option
                                            value="196901121989032005">
                                            196901121989032005</option>
                                            <option
                                            value="196901091997032002">
                                            196901091997032002</option>
                                            <option
                                            value="196807041988031003">
                                            196807041988031003</option>
                                            <option
                                            value="196803241998031002">
                                            196803241998031002</option>
                                            <option
                                            value="196701181993032003">
                                            196701181993032003</option>
                                            <option
                                            value="196811091993032005">
                                            196811091993032005</option>
                                            <option
                                            value="196512131988032004">
                                            196512131988032004</option>
                                            <option
                                            value="196706071998032001">
                                            196706071998032001</option>
                                            <option
                                            value="196708221991031011">
                                            196708221991031011</option>
                                            <option
                                            value="196205171991031004">
                                            196205171991031004</option>
                                            <option
                                            value="197707222010011014">
                                            197707222010011014</option>
                                            <option
                                            value="197410142008011005">
                                            197410142008011005</option>
                                            <option
                                            value="198305062009011006">
                                            198305062009011006</option>
                                            <option
                                            value="196906161994032006">
                                            196906161994032006</option>
                                            <option
                                            value="197506021994032001">
                                            197506021994032001</option>
                                            <option
                                            value="198112112010012029">
                                            198112112010012029</option>
                                            <option
                                            value="198011082007011004">
                                            198011082007011004</option>
                                            <option
                                            value="197910012005012014">
                                            197910012005012014</option>
                                            <option
                                            value="197811182008012012">
                                            197811182008012012</option>
                                            <option
                                            value="197309072008012005">
                                            197309072008012005</option>
                                            <option
                                            value="196802112007012020">
                                            196802112007012020</option>
                                            <option
                                            value="198201102014061003">
                                            198201102014061003</option>
                                            <option
                                            value="199302062015071001">
                                            199302062015071001</option>
                                            <option
                                            value="197504152007011013">
                                            197504152007011013</option>
                                            <option
                                            value="197708092007011009">
                                            197708092007011009</option>
                                            <option
                                            value="197810152007011027">
                                            197810152007011027</option>
                                            <option
                                            value="197405302006041013">
                                            197405302006041013</option>
                                            <option
                                            value="197305112008011008">
                                            197305112008011008</option>
                                            <option
                                            value="196901012010011003">
                                            196901012010011003</option>
                                            <option
                                            value="196807222007011004">
                                            196807222007011004</option>
                                            <option
                                            value="197004042010011003">
                                            197004042010011003</option>
                                            <option
                                            value="198302012010011001">
                                            198302012010011001</option>
                                            <option
                                            value="196907092007011015">
                                            196907092007011015</option>
                                            <option
                                            value="197104232010011002">
                                            197104232010011002</option>
                                            <option
                                            value="197607162009011008">
                                            197607162009011008</option>
                                            <option
                                            value="197812182002122004">
                                            197812182002122004</option>
                                            <option
                                            value="198304282003122001">
                                            198304282003122001</option>
                                            <option
                                            value="196705281992101001">
                                            196705281992101001</option>
                                            <option
                                            value="196807272007011022">
                                            196807272007011022</option>
                                            <option
                                            value="196712031987031003">
                                            196712031987031003</option>
                                            <option
                                            value="197104191995032002">
                                            197104191995032002</option>
                                            <option
                                            value="196804102009011006">
                                            196804102009011006</option>
                                            <option
                                            value="196901311996012001">
                                            196901311996012001</option>
                                            <option
                                            value="197607162010011003">
                                            197607162010011003</option>
                                            <option
                                            value="197305192002121002">
                                            197305192002121002</option>
                                            <option
                                            value="198603112004121001">
                                            198603112004121001</option>
                                            <option
                                            value="196908171996032004">
                                            196908171996032004</option>
                                            <option
                                            value="197901062010011005">
                                            197901062010011005</option>
                                            <option
                                            value="197008171995032006">
                                            197008171995032006</option>
                                            <option
                                            value="197306011994031010">
                                            197306011994031010</option>
                                            <option
                                            value="197003272008011004">
                                            197003272008011004</option>
                                            <option
                                            value="197003252008011005">
                                            197003252008011005</option>
                                            <option
                                            value="197510272005011005">
                                            197510272005011005</option>
                                            <option
                                            value="198301072009121002">
                                            198301072009121002</option>
                                            <option
                                            value="197103272007011007">
                                            197103272007011007</option>
                                            <option
                                            value="197504202006042018">
                                            197504202006042018</option>
                                            <option
                                            value="198208162010012020">
                                            198208162010012020</option>
                                            <option
                                            value="197804101997031005">
                                            197804101997031005</option>
                                            <option
                                            value="197205091991031005">
                                            197205091991031005</option>
                                            <option
                                            value="198007262010012010">
                                            198007262010012010</option>
                                            <option
                                            value="197811192010012008">
                                            197811192010012008</option>
                                            <option
                                            value="196910011994012001">
                                            196910011994012001</option>
                                            <option
                                            value="196806101998031006">
                                            196806101998031006</option>
                                            <option
                                            value="196808182007011023">
                                            196808182007011023</option>
                                            <option
                                            value="199406172019021008">
                                            199406172019021008</option>
                                            <option
                                            value="199203192014061002">
                                            199203192014061002</option>
                                            <option
                                            value="196912171992121001">
                                            196912171992121001</option>
                                            <option
                                            value="196209161995011001">
                                            196209161995011001</option>
                                            <option
                                            value="196005311985031005">
                                            196005311985031005</option>
                                            <option
                                            value="197506252000031002">
                                            197506252000031002</option>
                                            <option
                                            value="197410161994032002">
                                            197410161994032002</option>
                                            <option
                                            value="197306081993032003">
                                            197306081993032003</option>
                                            <option
                                            value="198006212010011022">
                                            198006212010011022</option>
                                            <option
                                            value="196005121989031012">
                                            196005121989031012</option>
                                            <option
                                            value="196505221986032013">
                                            196505221986032013</option>
                                            <option
                                            value="197212101992031004">
                                            197212101992031004</option>
                                            <option
                                            value="199306202016091001">
                                            199306202016091001</option>
                                            <option
                                            value="198707132020122004">
                                            198707132020122004</option>
                                            <option
                                            value="199608162020121002">
                                            199608162020121002</option>
                                            <option
                                            value="199312092020122013">
                                            199312092020122013</option>
                                            <option
                                            value="199804282020122002">
                                            199804282020122002</option>
                                            <option
                                            value="199307172020121004">
                                            199307172020121004</option>                                      
                                            <option
                                            value="198605082009121003">
                                            198605082009121003</option>
                                            <option
                                            value="198405252024211003">
                                            198405252024211003</option>
                                            <option
                                            value="198901272024212005">
                                            198901272024212005</option>
                                            <option
                                            value="199505202024212010">
                                            199505202024212010</option>
                                            <option
                                            value="199008232024212004">
                                            199008232024212004</option>
                                            <option
                                            value="197305011998011001">
                                            197305011998011001</option>
                                            <option
                                            value="197212061994121001">
                                            197212061994121001</option>
                                            <option
                                            value="196709251993031004">
                                            196709251993031004</option>
                                            <option
                                            value="197012141991011001">
                                            197012141991011001</option>
                                            <option
                                            value="199607192022031008">
                                            199607192022031008</option>
                                            <option
                                            value="199703252022032009">
                                            199703252022032009</option>
                                            <option
                                            value="199811052022031003">
                                            199811052022031003</option>
                                            <option
                                            value="200002252022012002">
                                            200002252022012002</option>
                                            <option
                                            value="199901222022012001">
                                            199901222022012001</option>
                                            <option
                                            value="198908192022032003">
                                            198908192022032003</option>
                                            <option
                                            value="197001121992032006">
                                            197001121992032006</option>
                                            <option
                                            value="196112261983031001">
                                            196112261983031001</option>
                                            <option
                                            value="198710052006021003">
                                            198710052006021003</option>
                                            <option
                                            value="196709221998031006">
                                            196709221998031006</option>
                                            <option
                                            value="199211222020122009">
                                            199211222020122009</option>
                                            <option
                                            value="196607221993011001">
                                            196607221993011001</option>
                                            <option
                                            value="197608052005011008">
                                            197608052005011008</option>
                                            <option
                                            value="197003021998031009">
                                            197003021998031009</option>
                                            <option
                                            value="196102171985032008">
                                            196102171985032008</option>
                                            <option
                                            value="198712092020121006">
                                            198712092020121006</option>
                                            <option
                                            value="199608222020121007">
                                            199608222020121007</option>
                                            <option
                                            value="199507232020122005">
                                            199507232020122005</option>
                                            <option
                                            value="198509042020122003">
                                            198509042020122003</option>
                                            <option
                                            value="196709251993031004">
                                            196709251993031004</option>
                                            


                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">PANGKAT
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><select id="pangkat" class="form-control select2" name="pangkat" placeholder="Search.."value="<?php echo $row['nama']; ?>">
                                          <option value="">--PILIH--</option>
                                              <option
                                            value="Pembina Utama (IV/E)">
                                            Pembina Utama (IV/E)</option>
                                          <option
                                            value="Pembina Utama Madya (IV/D)">
                                            Pembina Utama Madya (IV/D)</option>
                                          <option
                                            value="Pembina Utama Muda (IV/C)">
                                            Pembina Utama Muda (IV/C) </option>
                                          <option
                                            value="Pembina(IV/A)">
                                            Pembina(IV/A) </option>
                                            <option
                                            value="Pembina Tingkat I (IV/B)">
                                            Pembina Tingkat I (IV/B) </option>
                                            <option
                                            value="Penata Tingkat I (III/D)">
                                            Penata Tingkat I (III/B) </option>
                                            <option
                                            value="Penata (III/C)">
                                            Penata (III/C)</option>
                                            <option
                                            value="Penata Muda Tingkat I (III/B)">
                                            Penata Muda Tingkat I (III/B) </option>
                                            <option
                                            value="Penata Muda (III/A)">
                                            Penata Muda (III/A) </option>
                                            <option
                                            value="Pengatur Muda (II/A)">
                                            Pengatur Muda (II/A)</option>
                                            <option
                                            value="Pengatur Tingkat I (II/D)">
                                            Pengatur Tingkat I (II/D)</option>
                                            <option
                                            value="Pengatur (II/C)">
                                            Pengatur (II/C) </option>
                                            <option
                                            value="Pengatur Muda Tingkat I (II/B)">
                                            Pengatur Muda Tingkat I (II/B)</option>
                                            <option
                                            value="Juru Tingkat I (I/D)">
                                            Juru Tingkat I (I/D) </option>
                                            <option
                                            value="Golongan IX">
                                            Golongan IX </option>
                                            <option
                                            value="Penata Tingkat I (III/D)">
                                            Penata Tingkat I (III/D) </option>

                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">JABATAN
                                            <span class="text-red">*</span></label>
                                          <div class="col-sm-8"><select id="jabatan" class="form-control select2" name="jabatan" placeholder="Search.."value="<?php echo $row['nama']; ?>">
                                          <option value="">--PILIH--</option>
                                             
                                              <option
                                            value="WIDYAISWARA AHLI MADYA">
                                            WIDYAISWARA AHLI MADYA</option>
                                          <option
                                            value="WIDYAISWARA AHLI MUDA">
                                            WIDYAISWARA AHLI MUDA</option>
                                          <option
                                            value="WIDYAISWARA AHLI PERTAMA">
                                            WIDYAISWARA AHLI PERTAMA</option>
                                          <option
                                            value="Analisis Pengembangan Kompetensi">
                                            Analisis Pengembangan Kompetensi</option>
                                            <option
                                            value="Pramu Bakti">
                                            Pramu Bakti</option>
                                            <option
                                            value="Analisis Pengembangan Kompetensi ASN Ahli Muda ">
                                            Analisis Pengembangan Kompetensi ASN Ahli Muda </option>
                                            <option
                                            value="Analis Program Diklat ">
                                            Analis Program Diklat </option>
                                            <option
                                            value="Pengadministrasi Umum ">
                                            Pengadministrasi Umum </option>
                                            <option
                                            value="Pengolah Data Anggaran dan Perbendaharaan  ">
                                            Pengolah Data Anggaran dan Perbendaharaan </option>
                                            <option
                                            value="Pengelola Penyelenggaraan Diklat ">
                                            Pengelola Penyelenggaraan Diklat</option>
                                            <option
                                            value="Analis Jabatan ">
                                            Analis Jabatan</option>
                                            <option
                                            value="Bendahara ">
                                            Bendahara</option>
                                            <option
                                            value="Pustakawan Ahli Muda  ">
                                            Pustakawan Ahli Muda </option>
                                            <option
                                            value="Pengadministrasi Pelatihan ">
                                            Pengadministrasi Pelatihan</option>
                                            <option
                                            value="Pengelola Layanan Kehumasan">
                                            Pengelola Layanan Kehumasan</option>
                                            <option
                                            value="Analis Kompetensi ">
                                            Analis Kompetensi </option>
                                            <option
                                            value="Pengelola Kepegawaian ">
                                            Pengelola Kepegawaian  </option>
                                            <option
                                            value="Penjaga Asrama ">
                                            Penjaga Asrama  </option>
                                            <option
                                            value="Teknisi Listrik  ">
                                            Teknisi Listrik   </option>
                                            <option
                                            value="Pramu Kebersihan   ">
                                            Pramu Kebersihan   </option>
                                            <option
                                            value=" Kepala Sub Bagian Umum dan Kepegawaian    ">
                                            Kepala Sub Bagian Umum dan Kepegawaian  </option>
                                            <option
                                            value="  Pengelola Barang Milik Negara   ">
                                            Pengelola Barang Milik Negara  </option>
                                            <option
                                            value="  Sekretaris   ">
                                            Sekretaris  </option>
                                            <option
                                            value="  Penyusun Program Anggaran dan Pelaporan    ">
                                            Penyusun Program Anggaran dan Pelaporan   </option>
                                            <option
                                            value="  Sekretaris   ">
                                            Sekretaris  </option>
                                            <option
                                            value="  KEPALA BIDANG SERTIFIKASI KOMPETENSI DAN PENJAMINAN MUTU   ">
                                            KEPALA BIDANG SERTIFIKASI KOMPETENSI DAN PENJAMINAN MUTU  </option>
                                            <option
                                            value="   KEPALA SUB BAGIAN PROGRAM    ">
                                            KEPALA SUB BAGIAN PROGRAM   </option>
                                            <option
                                            value="  KEPALA BIDANG PENGEMBANGAN KOMPETENSI TEKNIS   ">
                                            KEPALA BIDANG PENGEMBANGAN KOMPETENSI TEKNIS  </option>
                                            <option
                                            value="   Analis Kerjasama Diklat   ">
                                            Analis Kerjasama Diklat  </option>
                                            <option
                                            value="  Analis Mutu Pendidikan   ">
                                            Analis Mutu Pendidikan  </option>
                                            <option
                                            value="   Pengelola Sarana dan Prasarana Kantor   ">
                                            Pengelola Sarana dan Prasarana Kantor  </option>
                                            <option
                                            value="  Verifaktor Data Laporan Keuangan   ">
                                            Verifaktor Data Laporan Keuangan  </option>
                                            <option
                                            value="  Analisis Kurikulum dan Pembelajaran    ">
                                            Analisis Kurikulum dan Pembelajaran   </option>
                                            <option
                                            value="  KASUBBAG KEUANGAN    ">
                                            KASUBBAG KEUANGAN   </option>
                                            <option
                                            value="  Pengembang Teknologi Pembelajaran Ahli Muda    ">
                                            Pengembang Teknologi Pembelajaran Ahli Muda   </option>
                                            <option
                                            value="  WIDYAISWARA AHLI UTAMA   ">
                                            WIDYAISWARA AHLI UTAMA  </option>
                                            <option
                                            value="  ANALISIS PENGEMBANGAN KOMPETENSI ASN   ">
                                            ANALISIS PENGEMBANGAN KOMPETENSI ASN  </option>
                                            <option
                                            value="  KABID PENGEMBANGAN KOMPETENSI JABATAN FUNGSIONAL    ">
                                            KABID PENGEMBANGAN KOMPETENSI JABATAN FUNGSIONAL   </option>
                                            <option
                                            value="  KEPALA BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH   ">
                                            KEPALA BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH  </option>
                                            <option
                                            value="  Ahli Pertama - Pranata Komputer    ">
                                            Ahli Pertama - Pranata Komputer   </option>
                                            <option
                                            value="  Ahli Pertama - Arsiparis   ">
                                            Ahli Pertama - Arsiparis  </option>

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
              <div class="modal-dialog modal-lg">
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
                                          <label class="col-sm-3 control-label text-right">NAMA
                                            <span class="text-red">*</span></label>
                                            <div class="col-sm-8"><select id="nama2" class="form-control select2" name="nama" placeholder="Search.."value="<?php echo $row['nama']; ?>">
                                          <option value="">--PILIH--"</option>
                                          <option
                                            value="ADJI SURYA PRATAMA, SH">
                                             ADJI SURYA PRATAMA, SH</option>
                                          <option
                                            value="ILHAM HABIBULLAH AKBAR, S.KOM">
                                            ILHAM HABIBULLAH AKBAR, S.KOM</option>
                                          <option
                                            value="BAGAS ARUNA YUDHATAMA, S.Kom">
                                            BAGAS ARUNA YUDHATAMA, S.Kom</option>
                                          <option
                                            value="ABDUR ROHMAN">
                                            ABDUR ROHMAN</option>
                                            <option
                                            value="Ir. YATNO ISWORO, MP">
                                            Ir. YATNO ISWORO, MP</option>
                                            <option
                                            value="Dr.Ir. KRISTIYO SUMARWONO, M.Sc.">
                                            Dr.Ir. KRISTIYO SUMARWONO, M.Sc.</option>
                                            <option
                                            value="Ir. WARDI ASTUTI, M.Pd.">
                                            Ir. WARDI ASTUTI, M.Pd.</option>
                                            <option
                                            value="Drs. SISWANTA JAKA PURNAMA, Apt.,M.Kes.">
                                            Drs. SISWANTA JAKA PURNAMA, Apt.,M.Kes.</option>
                                            <option
                                            value="Dr. Ir. SUPRIYANTO, M.Si.">
                                            Dr. Ir. SUPRIYANTO, M.Si.</option>
                                            <option
                                            value="GIGUS NURYATNO, A.Pi.,M.A.P.">
                                            GIGUS NURYATNO, A.Pi.,M.A.P.</option>
                                            <option
                                            value="WAHJU WIDIARSIH, ST.,M.Pi.">
                                            WAHJU WIDIARSIH, ST.,M.Pi.</option>
                                            <option
                                            value="DWI TITI SUNDARI, SKM.,M.Kes.">
                                            DWI TITI SUNDARI, SKM.,M.Kes.</option>
                                            <option
                                            value="HARINI SETIJOWATI, SKM., M.HSc.">
                                            HARINI SETIJOWATI, SKM., M.HSc.</option>
                                            <option
                                            value="Dra. SITI AMINAH ZURIAH, MM.">
                                            Dra. SITI AMINAH ZURIAH, MM.</option>
                                            <option
                                            value="SODIKIN, SS., M.Si.">
                                            SODIKIN, SS., M.Si.</option>
                                            <option
                                            value="Drs. SUMARNO, M.SI.">
                                            Drs. SUMARNO, M.SI.</option>
                                            <option
                                            value="DIYAH MUBAROKAH AKHADIYATI, S.Pi.,M.Pi.">
                                            DIYAH MUBAROKAH AKHADIYATI, S.Pi.,M.Pi.</option>
                                            <option
                                            value="SRIYATUN, S.Kep.,MM. ">
                                            SRIYATUN, S.Kep.,MM.</option>
                                            <option
                                            value="ARIF EFENDY, SH.,MM. ">
                                            ARIF EFENDY, SH.,MM.</option>
                                            <option
                                            value="Drs. HERU GUNAWAN, M.M">
                                            Drs. HERU GUNAWAN, M.M</option>
                                            <option
                                            value="AGUS ANDRIYANTO, S.Sos.,MM.">
                                            AGUS ANDRIYANTO, S.Sos.,MM.</option>
                                            <option
                                            value="KRISTIANA WIDIAWATI, S.Pi.,MT.">
                                            KRISTIANA WIDIAWATI, S.Pi.,MT.</option>
                                            <option
                                            value="Drs. PAMUNGKAS TUNGGUL WASANA, M.Si">
                                            Drs. PAMUNGKAS TUNGGUL WASANA, M.Si</option>
                                            <option
                                            value="IKBAL KHAFID, S.IP.,M.Si">
                                            IKBAL KHAFID, S.IP.,M.Si</option>
                                            <option
                                            value="MUHAMMAD ALAZIZ, S.E.,M.M">
                                            MUHAMMAD ALAZIZ, S.E.,M.M</option>
                                            <option
                                            value="AGUS PUJIANTO, SH.MM">
                                            AGUS PUJIANTO, SH.MM</option>
                                            <option
                                            value="TRI MARDIYANTI RATNASARI, SE.,Macc.">
                                            TRI MARDIYANTI RATNASARI, SE.,M.Acc.</option>
                                            <option
                                            value="Dra. NILA AGUSTINA, M.P.A">
                                            Dra. NILA AGUSTINA, M.P.A</option>
                                            <option
                                            value="MUCHAMAD RIZAL, ST.,M.Sc.,M.Eng.">
                                            MUCHAMAD RIZAL, ST.,M.Sc.,M.Eng.</option>
                                            <option
                                            value="Dr. ERNI IRAWATI, S.E.,M.Pd.">
                                            Dr. ERNI IRAWATI, S.E.,M.pd.</option>
                                            <option
                                            value="EDI WINARNO A S, S.T.,M.Kom.">
                                            EDI WINARNO A S, S.T.,M.Kom.</option>
                                            <option
                                            value="ANDIS TRIYANTO, S.KM.,M.Kes.">
                                            ANDIS TRIYANTO, S.KM.,M.Kes.</option>
                                            <option
                                            value="YUNI INDARTI, S.Sos., M.M">
                                            YUNI INDARTI, S.Sos., M.M</option>
                                            <option
                                            value="ABDUL MANAN, S.Pd.,MM.">
                                            ABDUL MANAN, S.Pd.,MM.</option>
                                            <option
                                            value="NUNI PURWATI">
                                            NUNI PURWATI</option>
                                            <option
                                            value="LILIK BUDI IRWANTO, S.Sos.,M.P.A">
                                            LILIK BUDI IRWANTO, S.Sos.,M.P.A</option>
                                            <option
                                            value="ISMU PANDOYO, S.I.Kom.">
                                            ISMU PANDOYO, S.I.Kom.</option>
                                            <option
                                            value="KURNIAWAN SETYADHI">
                                            KURNIAWAN SETYADHI</option>
                                            <option
                                            value="IMAROH YUNIANA, S.Mn.,MM.">
                                            IMAROH YUNIANA, S.Mn.,MM.</option>
                                            <option
                                            value="YUNI DWI ASTUTI, SE.">
                                            YUNI DWI ASTUTI, SE.</option>
                                            <option
                                            value="Rr. ASTUTI EKAWATI, SE.">
                                            Rr. ASTUTI EKAWATI, SE.</option>
                                            <option
                                            value="MUHLISIN">
                                            MUHLISIN</option>
                                            <option
                                            value="NATALIA HERIANY, S.Psi.">
                                            NATALIA HERIANY, S.Psi.</option>
                                            <option
                                            value="EKA WATININGSIH, S.Pd.">
                                            EKA WATININGSIH, S.Pd.</option>
                                            <option
                                            value="RATEH ARIYANI, SH.">
                                            RATEH ARIYANI, SH.</option>
                                            <option
                                            value="SRI MOERDJIJATOEN">
                                            SRI MOERDJIJATOEN</option>
                                            <option
                                            value="BAYU CANDRA PERKASA, S.STP.,M.Sc.">
                                            BAYU CANDRA PERKASA, S.STP.,M.Sc.</option>
                                            <option
                                            value="SUPARNO, SH.">
                                            SUPARNO, SH.</option>
                                            <option
                                            value="PURWANTO, SH.">
                                            PURWANTO, SH.</option>
                                            <option
                                            value="RONY HERYANTO">
                                            RONY HERYANTO</option>
                                            <option
                                            value="SUROSO, SH.">
                                            SUROSO, SH.</option>
                                            <option
                                            value="LASTIYO">
                                            LASTIYO</option>
                                            <option
                                            value="JAUHARI">
                                            JAUHARI</option>
                                            <option
                                            value="NURHADI">
                                            NURHADI</option>
                                            <option
                                            value="ANWAR">
                                            ANWAR</option>
                                            <option
                                            value="LULUS">
                                            LULUS</option>
                                            <option
                                            value="SUTARMO">
                                            SUTARMO</option>
                                            <option
                                            value="KANDAR">
                                            KANDAR</option>
                                            <option
                                            value="PARIDI">
                                            PARIDI</option>
                                            <option
                                            value="ITA KARTIKA, S.Kom">
                                            ITA KARTIKA, S.Kom</option>
                                            <option
                                            value="MARINI HASID, S.STP., M.M.">
                                            MARINI HASID, S.STP., M.M.</option>
                                            <option
                                            value="YULIUS SAPTA SETIAJI, SH">
                                            YULIUS SAPTA SETIAJI, SH</option>
                                            <option
                                            value="MUNTOHA">
                                            MUNTOHA</option>
                                            <option
                                            value="MOCHAMAD SAID, S.H.">
                                            MOCHAMAD SAID, S.H.</option>
                                            <option
                                            value="EKA YUNITA DESARI, S.S., M.Si">
                                            EKA YUNITA DESARI, S.S., M.Si</option>
                                            <option
                                            value="SARTONO">
                                            SARTONO</option>
                                            <option
                                            value="HENDRIYANI MUKHTAR, SE, M.Si">
                                            HENDRIYANI MUKHTAR, SE, M.Si</option>
                                            <option
                                            value="ATTHATHUR MASSALENA AM, SE, MM">
                                            ATTHATHUR MASSALENA AM, SE, MM</option>
                                            <option
                                            value="JAKA MUJIHANA, S.Pd., M.M.">
                                            JAKA MUJIHANA, S.Pd., M.M.</option>
                                            <option
                                            value="DINAR KURNIAWAN , S.STP">
                                            DINAR KURNIAWAN , S.STP</option>
                                            <option
                                            value="Dra. HERAWATI WIDYARINI, MM">
                                            Dra. HERAWATI WIDYARINI, MM</option>
                                            <option
                                            value="SUDIBYO BUDI SETYAWAN, S.E.">
                                            SUDIBYO BUDI SETYAWAN, S.E.</option>
                                            <option
                                            value="V. WINARTI AGUSTININGTYAS, SH, M.Si">
                                            V. WINARTI AGUSTININGTYAS, SH, M.Si</option>
                                            <option
                                            value="GIGIH HARYONO, SH">
                                            GIGIH HARYONO, SH</option>
                                            <option
                                            value="HARI WIDADA">
                                            HARI WIDADA</option>
                                            <option
                                            value="MOH SAMSUDIN">
                                            MOH SAMSUDIN</option>
                                            <option
                                            value="MUSTARI, SH, MH.">
                                            MUSTARI, SH, MH.</option>
                                            <option
                                            value="DIAN ARISETYANTO, SE">
                                            DIAN ARISETYANTO, SE</option>
                                            <option
                                            value="SUKARDI">
                                            SUKARDI</option>
                                            <option
                                            value="ROHMY IRMA ASTUTI, SE">
                                            ROHMY IRMA ASTUTI, SE</option>
                                            <option
                                            value="Dr. ENDANG RIAGUSTRIANINGSIH N, S.IP, M.Pd">
                                            Dr. ENDANG RIAGUSTRIANINGSIH N, S.IP, M.Pd</option>
                                            <option
                                            value="ANDI SURYANTO, S.STP., M.Si.">
                                            ANDI SURYANTO, S.STP., M.Si.</option>
                                            <option
                                            value="ANDI SETIAWAN, SH, MH.">
                                            ANDI SETIAWAN, SH, MH.</option>
                                            <option
                                            value="AMANDA SORAYA, S.Psi">
                                            AMANDA SORAYA, S.Psi</option>
                                            <option
                                            value="ARI DHAMAYANTI, M.Psi">
                                            ARI DHAMAYANTI, M.Psi</option>
                                            <option
                                            value="HASTIN ARFIANI, SH">
                                            HASTIN ARFIANI, SH</option>
                                            <option
                                            value="SUHARTO, SE, M.Si">
                                            SUHARTO, SE, M.Si</option>
                                            <option
                                            value="JUMADI">
                                            JUMADI</option>
                                            <option
                                            value="ANDIKA HIDAYAT ADI, S.Kom.">
                                            ANDIKA HIDAYAT ADI, S.Kom.</option>
                                            <option
                                            value="RIDWAN NUGRAHA PASA, S.STP.">
                                            RIDWAN NUGRAHA PASA, S.STP.</option>
                                            <option
                                            value="ARIS GUNAWAN">
                                            ARIS GUNAWAN</option>
                                            <option
                                            value="SUDIRMAN MUSTAFA, S.H., M.Hum.">
                                            SUDIRMAN MUSTAFA, S.H., M.Hum.</option>
                                            <option
                                            value="SUTARDI, A.Pi., M.M.A.">
                                            SUTARDI, A.Pi., M.M.A.</option>
                                            <option
                                            value="ARIF RACHMAN, SP, MPP,M.Ec.Dev">
                                            ARIF RACHMAN, SP, MPP,M.Ec.Dev</option>
                                            <option
                                            value="NUNUNG NURJANAH, SE,M.Si">
                                            NUNUNG NURJANAH, SE,M.Si</option>
                                            <option
                                            value="SRI MARYUNI, S.Pd, MM">
                                            SRI MARYUNI, S.Pd, MM</option>
                                            <option
                                            value="SAGUNG ISTIONO, SE.Ak,M.Si">
                                            AGUNG ISTIONO, SE.Ak,M.Si</option>
                                            <option
                                            value="Drs. SUDARYANTO, M.Si.">
                                            Drs. SUDARYANTO, M.Si.</option>
                                            <option
                                            value="MARIA SUSIAWATI, S.Sos.,MPA">
                                            MARIA SUSIAWATI, S.Sos.,MPA</option>
                                            <option
                                            value="H. SANTOSA, S.KEP,MM">
                                            H. SANTOSA, S.KEP,MM</option>
                                            <option
                                            value="SENNA VIRGIAWAN, S.STP">
                                            SENNA VIRGIAWAN, S.STP</option>
                                            <option
                                            value="ANI YULIYATI, A.Md.">
                                            ANI YULIYATI, A.Md.</option>
                                            <option
                                            value="PRIMA MAHARDIKA PUTRA, S.A.P">
                                            PRIMA MAHARDIKA PUTRA, S.A.P</option>
                                            <option
                                            value="ZAROH LAILATUL CHANIFAH, S.Pd.">
                                            ZAROH LAILATUL CHANIFAH, S.Pd.</option>
                                            <option
                                            value="CHINTIA PRAHESTI YUGATPUTRI, A.Md.">
                                            CHINTIA PRAHESTI YUGATPUTRI, A.Md.</option>
                                            <option
                                            value="FERZI EDI WARDOYO, A.Md">
                                            FERZI EDI WARDOYO, A.Md</option>
                                            <option
                                            value="ERMIN KARTI ANDARI, A.Md">
                                            ERMIN KARTI ANDARI, A.Md</option>
                                            <option
                                            value="EKA WIDIYANI, S.Pd.">
                                            EKA WIDIYANI, S.Pd.</option>
                                            <option
                                            value="DIAN AL RIZKY AGUSTIN, A.Md.">
                                            DIAN AL RIZKY AGUSTIN, A.Md.</option>
                                            <option
                                            value="RUDI SANTOSO ADI, S.IP.">
                                            RUDI SANTOSO ADI, S.IP.</option>
                                            <option
                                            value="Dra. MUKAROMAH SYAKOER, M.M">
                                            Dra. MUKAROMAH SYAKOER, M.M</option>
                                            <option
                                            value="Dr. SUDALMA, S.Si., M.Si.">
                                            Dr. SUDALMA, S.Si., M.Si.</option>
                                            <option
                                            value="AGUS SUPRIYANTO, S.E., M.M.">
                                            AGUS SUPRIYANTO, S.E., M.M.</option>
                                            <option
                                            value="Ir. H. YOYON INDRAYANA, MT">
                                            Ir. H. YOYON INDRAYANA, MT</option>
                                            <option
                                            value="MELATI KRISTANTI, A.Md.">
                                            MELATI KRISTANTI, A.Md.</option>
                                            <option
                                            value="SUMARHENDRO, S.Sos">
                                            SUMARHENDRO, S.Sos</option>
                                            <option
                                            value="ADITYA IIP WISUDAWAN NUGROHO, S.STP, M.Si">
                                            ADITYA IIP WISUDAWAN NUGROHO, S.STP, M.Si</option>
                                            <option
                                            value="HENDRI SANTOSA, SE, Ak, M.Si. CA">
                                            HENDRI SANTOSA, SE, Ak, M.Si. CA</option>
                                            <option
                                            value="SRI SULISTIYATI, SE, M.Kom">
                                            SRI SULISTIYATI, SE, M.Kom</option>
                                            <option
                                            value="RINI KUSWARDANI, S.E">
                                            RINI KUSWARDANI, S.E</option>
                                            <option
                                            value="ASA BANI CHITARA, A.Md.Kb.N.">
                                            ASA BANI CHITARA, A.Md.Kb.N.</option>
                                            <option
                                            value="AZKY ILAHI RATU CONSINA, A.Md.Ak.">
                                            AZKY ILAHI RATU CONSINA, A.Md.Ak.</option>
                                            <option
                                            value="NOPRI PRIANTO, S.Pd.">
                                            NOPRI PRIANTO, S.Pd.</option>
                                            <option
                                            value="NUR SAFIRAH ADLINA, S.Hum">
                                            NUR SAFIRAH ADLINA, S.Hum</option>
                                            <option
                                            value="Drs. HARI KUNTJORO, S.Sos, M.Si">
                                            Drs. HARI KUNTJORO, S.Sos, M.Si</option>
                                            <option
                                            value="Drs. EKO SUPRAYITNO, MM">
                                            Drs. EKO SUPRAYITNO, MM</option>
                                            <option
                                            value="INDRA ADI NUGROHO, S.ST.">
                                            INDRA ADI NUGROHO, S.ST.</option>
                                            <option
                                            value="Dr. SADIMIN, S.Pd., M.Eng.">
                                            Dr. SADIMIN, S.Pd., M.Eng.</option>
                                            <option
                                            value="Dr. ANON PRIYANTORO, S.Pd., M.Pd.">
                                            Dr. ANON PRIYANTORO, S.Pd., M.Pd.</option>
                                            <option
                                            value="FREIDA TRIASTUTI RATNA JATI, S.E.">
                                            FREIDA TRIASTUTI RATNA JATI, S.E.</option>
                                            <option
                                            value="VITA DWI IRMAWATI, S.Sos.">
                                            VITA DWI IRMAWATI, S.Sos.</option>
                                            <option
                                            value="SYLVI PANAMASARI, S.Psi">
                                            SYLVI PANAMASARI, S.Psi</option>
                                            <option
                                            value="HENDRA SUGIARTO, S.E.">
                                            HENDRA SUGIARTO, S.E.</option>
                                            <option
                                            value="DHARU PUNJUNG WIJAYA, SAP, M.Si">
                                            DHARU PUNJUNG WIJAYA, SAP, M.Si</option>                                         
                                                          
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">NIP<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select id="NIP2" class="form-control select2" name="NIP" placeholder=""
                              value="">
                          <option value=""></option>
                          <option
                                            value="196410101999031002">
                                            196410101999031002 </option>
                                          <option
                                            value="196001111986031010">
                                            196001111986031010</option>
                                          <option
                                            value="196608181992032015">
                                            196608181992032015</option>
                                          <option
                                            value="196310281989111001">
                                            196310281989111001</option>
                                            <option
                                            value="197312102007012010">
                                            197312102007012010</option>
                                            <option
                                            value="197008081993031008">
                                            197008081993031008</option>
                                            <option
                                            value="197906202009012003">
                                            197906202009012003</option>
                                            <option
                                            value="197505041999031006">
                                            197505041999031006</option>
                                            <option
                                            value="197502022005011004">
                                            197502022005011004</option>
                                            <option
                                            value="197308292009012002">
                                            197308292009012002</option>
                                            <option
                                            value="198008272005011010">
                                            198008272005011010</option>
                                            <option
                                            value="197608171999032005">
                                            197608171999032005</option>
                                            <option
                                            value="197103171997032005">
                                            197103171997032005</option>
                                            <option
                                            value="197008101994031004">
                                            197008101994031004</option>
                                            <option
                                            value="197003142005011008">
                                            197003142005011008</option>
                                            <option
                                            value="196705041986031002">
                                            196705041986031002</option>
                                            <option
                                            value="197301101992031001">
                                            197301101992031001</option>
                                            <option
                                            value="197112041999032007">
                                            197112041999032007</option>
                                            <option
                                            value="197008241995031002">
                                            197008241995031002</option>
                                            <option
                                            value="196911091990031006">
                                            196911091990031006</option>
                                            <option
                                            value="196911021990031003">
                                            196911021990031003</option>
                                            <option
                                            value="196901121989032005">
                                            196901121989032005</option>
                                            <option
                                            value="196901091997032002">
                                            196901091997032002</option>
                                            <option
                                            value="196807041988031003">
                                            196807041988031003</option>
                                            <option
                                            value="196803241998031002">
                                            196803241998031002</option>
                                            <option
                                            value="196701181993032003">
                                            196701181993032003</option>
                                            <option
                                            value="196811091993032005">
                                            196811091993032005</option>
                                            <option
                                            value="196512131988032004">
                                            196512131988032004</option>
                                            <option
                                            value="196706071998032001">
                                            196706071998032001</option>
                                            <option
                                            value="196708221991031011">
                                            196708221991031011</option>
                                            <option
                                            value="196205171991031004">
                                            196205171991031004</option>
                                            <option
                                            value="197707222010011014">
                                            197707222010011014</option>
                                            <option
                                            value="197410142008011005">
                                            197410142008011005</option>
                                            <option
                                            value="198305062009011006">
                                            198305062009011006</option>
                                            <option
                                            value="196906161994032006">
                                            196906161994032006</option>
                                            <option
                                            value="197506021994032001">
                                            197506021994032001</option>
                                            <option
                                            value="198112112010012029">
                                            198112112010012029</option>
                                            <option
                                            value="198011082007011004">
                                            198011082007011004</option>
                                            <option
                                            value="197910012005012014">
                                            197910012005012014</option>
                                            <option
                                            value="197811182008012012">
                                            197811182008012012</option>
                                            <option
                                            value="197309072008012005">
                                            197309072008012005</option>
                                            <option
                                            value="196802112007012020">
                                            196802112007012020</option>
                                            <option
                                            value="198201102014061003">
                                            198201102014061003</option>
                                            <option
                                            value="199302062015071001">
                                            199302062015071001</option>
                                            <option
                                            value="197504152007011013">
                                            197504152007011013</option>
                                            <option
                                            value="197708092007011009">
                                            197708092007011009</option>
                                            <option
                                            value="197810152007011027">
                                            197810152007011027</option>
                                            <option
                                            value="197405302006041013">
                                            197405302006041013</option>
                                            <option
                                            value="197305112008011008">
                                            197305112008011008</option>
                                            <option
                                            value="196901012010011003">
                                            196901012010011003</option>
                                            <option
                                            value="196807222007011004">
                                            196807222007011004</option>
                                            <option
                                            value="197004042010011003">
                                            197004042010011003</option>
                                            <option
                                            value="198302012010011001">
                                            198302012010011001</option>
                                            <option
                                            value="196907092007011015">
                                            196907092007011015</option>
                                            <option
                                            value="197104232010011002">
                                            197104232010011002</option>
                                            <option
                                            value="197607162009011008">
                                            197607162009011008</option>
                                            <option
                                            value="197812182002122004">
                                            197812182002122004</option>
                                            <option
                                            value="198304282003122001">
                                            198304282003122001</option>
                                            <option
                                            value="196705281992101001">
                                            196705281992101001</option>
                                            <option
                                            value="196807272007011022">
                                            196807272007011022</option>
                                            <option
                                            value="196712031987031003">
                                            196712031987031003</option>
                                            <option
                                            value="197104191995032002">
                                            197104191995032002</option>
                                            <option
                                            value="196804102009011006">
                                            196804102009011006</option>
                                            <option
                                            value="196901311996012001">
                                            196901311996012001</option>
                                            <option
                                            value="197607162010011003">
                                            197607162010011003</option>
                                            <option
                                            value="197305192002121002">
                                            197305192002121002</option>
                                            <option
                                            value="198603112004121001">
                                            198603112004121001</option>
                                            <option
                                            value="196908171996032004">
                                            196908171996032004</option>
                                            <option
                                            value="197901062010011005">
                                            197901062010011005</option>
                                            <option
                                            value="197008171995032006">
                                            197008171995032006</option>
                                            <option
                                            value="197306011994031010">
                                            197306011994031010</option>
                                            <option
                                            value="197003272008011004">
                                            197003272008011004</option>
                                            <option
                                            value="197003252008011005">
                                            197003252008011005</option>
                                            <option
                                            value="197510272005011005">
                                            197510272005011005</option>
                                            <option
                                            value="198301072009121002">
                                            198301072009121002</option>
                                            <option
                                            value="197103272007011007">
                                            197103272007011007</option>
                                            <option
                                            value="197504202006042018">
                                            197504202006042018</option>
                                            <option
                                            value="198208162010012020">
                                            198208162010012020</option>
                                            <option
                                            value="197804101997031005">
                                            197804101997031005</option>
                                            <option
                                            value="197205091991031005">
                                            197205091991031005</option>
                                            <option
                                            value="198007262010012010">
                                            198007262010012010</option>
                                            <option
                                            value="197811192010012008">
                                            197811192010012008</option>
                                            <option
                                            value="196910011994012001">
                                            196910011994012001</option>
                                            <option
                                            value="196806101998031006">
                                            196806101998031006</option>
                                            <option
                                            value="196808182007011023">
                                            196808182007011023</option>
                                            <option
                                            value="199406172019021008">
                                            199406172019021008</option>
                                            <option
                                            value="199203192014061002">
                                            199203192014061002</option>
                                            <option
                                            value="196912171992121001">
                                            196912171992121001</option>
                                            <option
                                            value="196209161995011001">
                                            196209161995011001</option>
                                            <option
                                            value="196005311985031005">
                                            196005311985031005</option>
                                            <option
                                            value="197506252000031002">
                                            197506252000031002</option>
                                            <option
                                            value="197410161994032002">
                                            197410161994032002</option>
                                            <option
                                            value="197306081993032003">
                                            197306081993032003</option>
                                            <option
                                            value="198006212010011022">
                                            198006212010011022</option>
                                            <option
                                            value="196005121989031012">
                                            196005121989031012</option>
                                            <option
                                            value="196505221986032013">
                                            196505221986032013</option>
                                            <option
                                            value="197212101992031004">
                                            197212101992031004</option>
                                            <option
                                            value="199306202016091001">
                                            199306202016091001</option>
                                            <option
                                            value="198707132020122004">
                                            198707132020122004</option>
                                            <option
                                            value="199608162020121002">
                                            199608162020121002</option>
                                            <option
                                            value="199312092020122013">
                                            199312092020122013</option>
                                            <option
                                            value="199804282020122002">
                                            199804282020122002</option>
                                            <option
                                            value="199307172020121004">
                                            199307172020121004</option>                                      
                                            <option
                                            value="198605082009121003">
                                            198605082009121003</option>
                                            <option
                                            value="198405252024211003">
                                            198405252024211003</option>
                                            <option
                                            value="198901272024212005">
                                            198901272024212005</option>
                                            <option
                                            value="199505202024212010">
                                            199505202024212010</option>
                                            <option
                                            value="199008232024212004">
                                            199008232024212004</option>
                                            <option
                                            value="197305011998011001">
                                            197305011998011001</option>
                                            <option
                                            value="197212061994121001">
                                            197212061994121001</option>
                                            <option
                                            value="198704192008121001">
                                            198704192008121001</option>
                                            <option
                                            value="197012141991011001">
                                            197012141991011001</option>
                                            <option
                                            value="199607192022031008">
                                            199607192022031008</option>
                                            <option
                                            value="199703252022032009">
                                            199703252022032009</option>
                                            <option
                                            value="199811052022031003">
                                            199811052022031003</option>
                                            <option
                                            value="200002252022012002">
                                            200002252022012002</option>
                                            <option
                                            value="199901222022012001">
                                            199901222022012001</option>
                                            <option
                                            value="198908192022032003">
                                            198908192022032003</option>
                                            <option
                                            value="197001121992032006">
                                            197001121992032006</option>
                                            <option
                                            value="196112261983031001">
                                            196112261983031001</option>
                                            <option
                                            value="198710052006021003">
                                            198710052006021003</option>
                                            <option
                                            value="196709221998031006">
                                            196709221998031006</option>
                                            <option
                                            value="199211222020122009">
                                            199211222020122009</option>
                                            <option
                                            value="196607221993011001">
                                            196607221993011001</option>
                                            <option
                                            value="197608052005011008">
                                            197608052005011008</option>
                                            <option
                                            value="197003021998031009">
                                            197003021998031009</option>
                                            <option
                                            value="196102171985032008">
                                            196102171985032008</option>
                                            <option
                                            value="198712092020121006">
                                            198712092020121006</option>
                                            <option
                                            value="199608222020121007">
                                            199608222020121007</option>
                                            <option
                                            value="199507232020122005">
                                            199507232020122005</option>
                                            <option
                                            value="198509042020122003">
                                            198509042020122003</option>
                                            <option
                                            value="196709251993031004">
                                            196709251993031004</option>
                           </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">PANGKAT<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select id="pangkat2" class="form-control select2" name="pangkat" placeholder=""
                              value="">
                          <option value=""></option>
                          <option
                                            value="Pembina Utama (IV/E)">
                                            Pembina Utama (IV/E)</option>
                                          <option
                                            value="Pembina Utama Madya (IV/D)">
                                            Pembina Utama Madya (IV/D)</option>
                                          <option
                                            value="Pembina Utama Muda (IV/C)">
                                            Pembina Utama Muda (IV/C) </option>
                                          <option
                                            value="Pembina(IV/A)">
                                            Pembina(IV/A) </option>
                                            <option
                                            value="Pembina Tingkat I (IV/B)">
                                            Pembina Tingkat I (IV/B) </option>
                                            <option
                                            value="Penata Tingkat I (III/D)">
                                            Penata Tingkat I (III/B) </option>
                                            <option
                                            value="Penata (III/C)">
                                            Penata (III/C)</option>
                                            <option
                                            value="Penata Muda Tingkat I (III/B)">
                                            Penata Muda Tingkat I (III/B) </option>
                                            <option
                                            value="Penata Muda (III/A)">
                                            Penata Muda (III/A) </option>
                                            <option
                                            value="Pengatur Muda (II/A)">
                                            Pengatur Muda (II/A)</option>
                                            <option
                                            value="Pengatur Tingkat I (II/D)">
                                            Pengatur Tingkat I (II/D)</option>
                                            <option
                                            value="Pengatur (II/C)">
                                            Pengatur (II/C) </option>
                                            <option
                                            value="Pengatur Muda Tingkat I (II/B)">
                                            Pengatur Muda Tingkat I (II/B)</option>
                                            <option
                                            value="Juru Tingkat I (I/D)">
                                            Juru Tingkat I (I/D) </option>
                                            <option
                                            value="Golongan IX">
                                            Golongan IX </option>
                                            <option
                                            value="Penata Tingkat I (III/D)">
                                            Penata Tingkat I (III/D) </option>
                                          </select>
                            
                                        </div>
                            
                                      </div>


                            <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 control-label text-right">JABATAN<span
                              class="text-red">*</span></label>
                          <div class="col-sm-8"><select id="jabatan2" class="form-control select2" name="jabatan" placeholder=""
                              value="">
                          <option value=""></option>
                          <option
                                            value="WIDYAISWARA AHLI MADYA">
                                            WIDYAISWARA AHLI MADYA</option>
                                          <option
                                            value="WIDYAISWARA AHLI MUDA">
                                            WIDYAISWARA AHLI MUDA</option>
                                          <option
                                            value="WIDYAISWARA AHLI PERTAMA">
                                            WIDYAISWARA AHLI PERTAMA</option>
                                          <option
                                            value="Analisis Pengembangan Kompetensi">
                                            Analisis Pengembangan Kompetensi</option>
                                            <option
                                            value="Pramu Bakti">
                                            Pramu Bakti</option>
                                            <option
                                            value="Analisis Pengembangan Kompetensi ASN Ahli Muda ">
                                            Analisis Pengembangan Kompetensi ASN Ahli Muda </option>
                                            <option
                                            value="Analis Program Diklat ">
                                            Analis Program Diklat </option>
                                            <option
                                            value="Pengadministrasi Umum ">
                                            Pengadministrasi Umum </option>
                                            <option
                                            value="Pengolah Data Anggaran dan Perbendaharaan  ">
                                            Pengolah Data Anggaran dan Perbendaharaan </option>
                                            <option
                                            value="Pengelola Penyelenggaraan Diklat ">
                                            Pengelola Penyelenggaraan Diklat</option>
                                            <option
                                            value="Analis Jabatan ">
                                            Analis Jabatan</option>
                                            <option
                                            value="Bendahara ">
                                            Bendahara</option>
                                            <option
                                            value="Pustakawan Ahli Muda  ">
                                            Pustakawan Ahli Muda </option>
                                            <option
                                            value="Pengadministrasi Pelatihan ">
                                            Pengadministrasi Pelatihan</option>
                                            <option
                                            value="Pengelola Layanan Kehumasan">
                                            Pengelola Layanan Kehumasan</option>
                                            <option
                                            value="Analis Kompetensi ">
                                            Analis Kompetensi </option>
                                            <option
                                            value="Pengelola Kepegawaian ">
                                            Pengelola Kepegawaian  </option>
                                            <option
                                            value="Penjaga Asrama ">
                                            Penjaga Asrama  </option>
                                            <option
                                            value="Teknisi Listrik  ">
                                            Teknisi Listrik   </option>
                                            <option
                                            value="Pramu Kebersihan   ">
                                            Pramu Kebersihan   </option>
                                            <option
                                            value=" Kepala Sub Bagian Umum dan Kepegawaian    ">
                                            Kepala Sub Bagian Umum dan Kepegawaian  </option>
                                            <option
                                            value="  Pengelola Barang Milik Negara   ">
                                            Pengelola Barang Milik Negara  </option>
                                            <option
                                            value="  Sekretaris   ">
                                            Sekretaris  </option>
                                            <option
                                            value="  Penyusun Program Anggaran dan Pelaporan    ">
                                            Penyusun Program Anggaran dan Pelaporan   </option>
                                            <option
                                            value="  Sekretaris   ">
                                            Sekretaris  </option>
                                            <option
                                            value="  KEPALA BIDANG SERTIFIKASI KOMPETENSI DAN PENJAMINAN MUTU   ">
                                            KEPALA BIDANG SERTIFIKASI KOMPETENSI DAN PENJAMINAN MUTU  </option>
                                            <option
                                            value="   KEPALA SUB BAGIAN PROGRAM    ">
                                            KEPALA SUB BAGIAN PROGRAM   </option>
                                            <option
                                            value="  KEPALA BIDANG PENGEMBANGAN KOMPETENSI TEKNIS   ">
                                            KEPALA BIDANG PENGEMBANGAN KOMPETENSI TEKNIS  </option>
                                            <option
                                            value="   Analis Kerjasama Diklat   ">
                                            Analis Kerjasama Diklat  </option>
                                            <option
                                            value="  Analis Mutu Pendidikan   ">
                                            Analis Mutu Pendidikan  </option>
                                            <option
                                            value="   Pengelola Sarana dan Prasarana Kantor   ">
                                            Pengelola Sarana dan Prasarana Kantor  </option>
                                            <option
                                            value="  Verifaktor Data Laporan Keuangan   ">
                                            Verifaktor Data Laporan Keuangan  </option>
                                            <option
                                            value="  Analisis Kurikulum dan Pembelajaran    ">
                                            Analisis Kurikulum dan Pembelajaran   </option>
                                            <option
                                            value="  KASUBBAG KEUANGAN    ">
                                            KASUBBAG KEUANGAN   </option>
                                            <option
                                            value="  Pengembang Teknologi Pembelajaran Ahli Muda    ">
                                            Pengembang Teknologi Pembelajaran Ahli Muda   </option>
                                            <option
                                            value="  WIDYAISWARA AHLI UTAMA   ">
                                            WIDYAISWARA AHLI UTAMA  </option>
                                            <option
                                            value="  ANALISIS PENGEMBANGAN KOMPETENSI ASN   ">
                                            ANALISIS PENGEMBANGAN KOMPETENSI ASN  </option>
                                            <option
                                            value="  KABID PENGEMBANGAN KOMPETENSI JABATAN FUNGSIONAL    ">
                                            KABID PENGEMBANGAN KOMPETENSI JABATAN FUNGSIONAL   </option>
                                            <option
                                            value="  KEPALA BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH   ">
                                            KEPALA BADAN PENGEMBANGAN SUMBER DAYA MANUSIA DAERAH  </option>
                                            <option
                                            value="  Ahli Pertama - Pranata Komputer    ">
                                            Ahli Pertama - Pranata Komputer   </option>
                                            <option
                                            value="  Ahli Pertama - Arsiparis   ">
                                            Ahli Pertama - Arsiparis  </option>
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