<?php
  session_start();
  if($_SESSION['level'] != "pj" || $_SESSION['status'] != "login") {
    header('location:../index.php');
  }

  require_once("../koneksi.php");

  if($_SESSION['level']=='admin'){
    $query = mysqli_query($connect, "SELECT * FROM tb_admin WHERE id_user = '".$_SESSION['id_user']."'");
    $profil = mysqli_fetch_array($query);
  }elseif ($_SESSION['level']=='pj') {
    $query = mysqli_query($connect, "SELECT * FROM tb_pj WHERE id_user = '".$_SESSION['id_user']."'");
    $profil = mysqli_fetch_array($query);
  }else{

  }

  $q_pesanan = mysqli_query($connect, "SELECT * FROM tb_pemesanan WHERE id_pesanan = '".$_GET['id_pesanan']."' ");  
  $pesanan = mysqli_fetch_array($q_pesanan);    
  $date = DateTime::createFromFormat('l, d M Y', $pesanan['tglBerangkat']);
  $tgl_berangkat = $date->format('d-m-Y');                          

  $q_armada = mysqli_query($connect, "SELECT * FROM tb_armada JOIN tb_pemesanan ON tb_armada.id_armada=tb_pemesanan.id_armada WHERE id_pesanan = '".$_GET['id_pesanan']."' ");
  $armada = mysqli_fetch_array($q_armada);

  $q_penumpang = mysqli_query($connect, "SELECT * FROM tb_penumpang JOIN tb_pemesanan ON tb_penumpang.id_penumpang=tb_pemesanan.id_penumpang WHERE id_pesanan = '".$_GET['id_pesanan']."' ");
  $penumpang = mysqli_fetch_array($q_penumpang); 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APTS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="../tambahan/sweetalert.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>      
    </ul>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">        
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="../image/pp.jpg" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php echo $profil['namaPJ']; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="../image/pp.jpg" class="img-circle elevation-2" alt="User Image">
            <p>
              <?php echo $profil['namaPJ']; ?>             
            </p>
            <small>
              <?php echo $profil['kota']; ?>             
            </small>
          </li>                    
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="kelola_profil.php" class="btn btn-default btn-flat">Profil</a>
            <a href="../logout.php" class="btn btn-default btn-flat float-right">Keluar</a>
          </li>
        </ul>
      </li>        
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">APTSweb</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->          
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Beranda</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="kelola_armada.php" class="nav-link">
              <i class="nav-icon fas fa-bus"></i>
              <p>Armada</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Pemesanan Tiket
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="kelola_pesanan.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="kelola_verPesanan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Verifikas Pesanan</p>
                </a>                
              </li>              
            </ul>
          </li>            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail Pesanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="kelola_pesanan.php">Pesanan</a></li>
              <li class="breadcrumb-item active">Detail Pesanan</li>              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">        
        <div class="row">
        <div class="col-md-2"></div>           
        <div class="col-md-8">
            <div class="card card-outline card-primary">                
                <div class="card-body">
                    <dl class="row">
                    <dt class="col-sm-3">
                        <h3 class="card-title">
                        <i class="fas fa-bus mr-2"></i>
                        Info Shuttle
                        </h3>
                    </dt>              
                    </dl>                    
                    <hr>
                    <dl class="row mb-0">                        
                    <dt class="col-sm-4 ml-3">Nama Armada</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $armada['namaArmada']; ?></dd>
                    <dt class="col-sm-4 ml-3">Kota Tujuan</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $armada['kotaTujuan']; ?></dd>                    
                    <dt class="col-sm-4 ml-3">Pool Tujuan</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $armada['poolTujuan']; ?></dd>
                    <dt class="col-sm-4 ml-3">Tanggal Berangkat</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $tgl_berangkat; ?></dd>
                    <dt class="col-sm-4 ml-3">Jam Berangkat - Tiba</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $armada['jamBerangkat'].' - ';echo $armada['jamTiba']; ?></dd>                    
                    <dt class="col-sm-4 ml-3">Nomor Kursi</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $pesanan['noKursi']; ?></dd>
                    </dl>
                </div>
                <!-- /.card-body -->               
                <div class="card-body">
                    <dl class="row">
                    <dt class="col-sm-8">
                        <h3 class="card-title">
                        <i class="fas fa-user mr-2"></i>
                        Info Pemesan & Penumpang
                        </h3>
                    </dt>                
                    </dl>                    
                    <hr>
                    <dl class="row mb-0">
                    <dt class="col-sm-4 ml-3">Nama Pemesan</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $penumpang['namaPenumpang']; ?></dd>
                    <dt class="col-sm-4 ml-3">Nomor Telepon</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $penumpang['noHP']; ?></dd>                    
                    <dt class="col-sm-4 ml-3">Nama Penumpang</dt>
                    <dd>&ensp;:</dd>
                    <?php 
                        $query = mysqli_query($connect, "SELECT * FROM tb_namausiapesanan WHERE id_pesanan = '".$_GET['id_pesanan']."' ");
                        $no=0;  
                        while($tabel = mysqli_fetch_array($query)){
                            $no++;
                            if ($no==1) {
                                                            
                    ?>
                    <dd class="col-sm-4"><?php echo $no.'. '; echo $tabel['nama'].' ('; echo $tabel['usia'].' tahun)'; ?></dd>                                        
                    <?php
                            }elseif($no > 1){
                    ?>
                        <dd class="col-sm-4 offset-sm-4">&emsp;&ensp;&nbsp;<?php echo $no.'. '; echo $tabel['nama'].' ('; echo $tabel['usia'].' tahun)'; ?></dd>
                    <?php
                            }
                        }
                    ?>
                    </dl>
                </div>                
                <div class="card-body">
                    <dl class="row">
                    <dt class="col-sm-4">
                        <h3 class="card-title">
                        <i class="fas fa-wallet mr-2"></i>
                        Info Pembayaran
                        </h3>
                    </dt>                
                    </dl>                    
                    <hr>
                    <dl class="row mb-0">
                    <dt class="col-sm-4 ml-3">Metode Pembayaran</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $pesanan['metodePembayaran']; ?></dd>
                    <dt class="col-sm-4 ml-3">Total Pembayaran</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo 'Rp. '.$pesanan['totalPembayaran']; ?></dd>                    
                    <dt class="col-sm-4 ml-3">Status Pembayaran</dt>
                    <dd class="col-sm-4">:&ensp;<?php echo $pesanan['statusPembayaran']; ?></dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="kelola_pesanan.php" class="btn btn-default"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
                    <?php
                        if ($pesanan['statusPembayaran']=='Belum dibayar'||$pesanan['statusPembayaran']=='Ditolak') {                                                    
                    ?>                    
                    <button type="button" class="btn btn-danger btn-sm float-right" title="Hapus" data-toggle="modal" data-target="#modal-sm<?php echo $_GET['id_pesanan']; ?>">
                      <i class="far fa-trash-alt mr-2"></i>Hapus
                    </button>
                    <div class="modal fade" id="modal-sm<?php echo $_GET['id_pesanan']; ?>">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi Aksi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body text-center">                      
                              <p>Yakin ingin menghapus pesanan ini?</p>                    
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button id_pesanan="<?php echo $_GET['id_pesanan']; ?>" type="button" data-dismiss="modal" class="btn btn-primary ajaxhapus">Ya</button>                                   
                          </div>            
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <!-- /.card -->
            <!-- /.nav-tabs-custom -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 APTS.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Sweet Alert -->
<script src="../tambahan/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script>
  $('.ajaxhapus').click(function(){
    var id_pesanan = $(this).attr("id_pesanan");
    hapus_pesanan(id_pesanan);
  });
  function hapus_pesanan(id_pesanan) {
    $.ajax({
      type: "get",
      url: "proses_hapus_pesanan.php?",
      data: "id_pesanan="+id_pesanan,          
    }).done(function() {
      swal({ 
            title: "Berhasil Dihapus!",
            text: "Data Pesanan berhasil dihapus!",
            type: "success",
            showConfirmButton: false 
          });
      setTimeout("document.location = 'kelola_pesanan.php';", 2000);
    });    
  }
</script>
</body>
</html>
