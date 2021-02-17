<?php
  session_start();
  if($_SESSION['level'] != "admin" || $_SESSION['status'] != "login") {
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

  $q_user = mysqli_query($connect, "SELECT COUNT(id_user) FROM tb_user WHERE level <> 'admin' ");
  $user = mysqli_fetch_row($q_user);
  mysqli_free_result($q_user);
  $q_pj = mysqli_query($connect, "SELECT COUNT(id_user) FROM tb_user WHERE level = 'pj' ");
  $pj = mysqli_fetch_row($q_pj);
  mysqli_free_result($q_pj);
  $q_penumpang = mysqli_query($connect, "SELECT COUNT(id_user) FROM tb_user WHERE level = 'penumpang' ");
  $penumpang = mysqli_fetch_row($q_penumpang);
  mysqli_free_result($q_penumpang);

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
          <img src="../image/admin.jpg" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php echo $profil['namaAdmin']; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="../image/admin.jpg" class="img-circle elevation-2" alt="User Image">
            <p>
              <?php echo $profil['namaAdmin']; ?>             
            </p>
            <small>
              <?php echo $profil['noTelp']; ?>             
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
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Beranda</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                Kelola Bantuan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="kelola_bantuan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Bantuan (FAQ)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="kelola_perPengguna.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pertanyaan Pengguna</p>
                </a>                
              </li>              
            </ul>
          </li>         
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Kelola Pengguna
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="kelola_pengguna.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="kelola_verPJ.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Verifikasi Pengguna</p>
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
            <h1 class="m-0 text-dark">Beranda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Beranda</li>              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">          
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php 
                    if($user[0]==0){
                      echo '0';   
                    }else{
                      echo $user[0];
                    } 
                  ?>
                </h3>
                <p>Pengguna</p>                
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <?php 
                    if($pj[0]==0){
                      echo '0';   
                    }else{
                      echo $pj[0];
                    } 
                  ?>
                </h3>
                <p>Penyedia Jasa Shuttle</p>
              </div>
              <div class="icon">
                <i class="fa fa-bus"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php 
                    if($penumpang[0]==0){
                      echo '0';   
                    }else{
                      echo $penumpang[0];
                    } 
                  ?>
                </h3>

                <p>Penumpang</p>
              </div>
              <div class="icon">
                <i class="fa fa-portrait"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->        
        <!-- /.row (main row) -->
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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
