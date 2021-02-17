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
  <!-- SweetAlert -->
  <link rel="stylesheet" href="../tambahan/sweetalert.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
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
      <!-- Profil Menu -->
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
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Beranda</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                Kelola Bantuan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="kelola_bantuan.php" class="nav-link active">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ubah Data Bantuan (FAQ)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
              <li class="breadcrumb-item"><a href="kelola_bantuan.php">Data Bantuan (FAQ)</a></li>
              <li class="breadcrumb-item active">Ubah Data Bantuan (FAQ)</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-primary">
                <!-- card-header -->  
                <div class="card-header">
                    <h3 class="card-title">Ubah Data Bantuan (FAQ)</h3>
                </div>
                <!-- /.card-header -->
                <?php
                    $q_tabel = mysqli_query($connect, " SELECT * FROM tb_bantuan WHERE id_bantuan='".$_GET['id_bantuan']."' ");
                    $tabel = mysqli_fetch_array($q_tabel);
                ?>
                <!-- form start -->
                <form class="form-horizontal" name="ubahbantuan" method="post" action="proses_ubah_bantuan.php">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9">
                                <textarea name="judul" class="form-control" id="judul" cols="42" rows="2" required><?php echo $tabel['judul']; ?></textarea>                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea name="deskripsi" class="form-control" id="deskripsi" cols="42" rows="5" required><?php echo $tabel['deskripsi']; ?></textarea>                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis" class="col-sm-3 col-form-label">Jenis Bantuan</label>
                            <div class="col-sm-9">
                                <input type="text" name="jenis" id="jenis" value="<?php echo $tabel['jenisBantuan']; ?>" class="form-control" list="listJenis" required>
                                    <datalist id="listJenis">                                    
                                        <?php                                        
                                        $q_jenis = mysqli_query($connect, "SELECT jenisBantuan FROM tb_bantuan GROUP BY jenisBantuan");
                                        while($jenis = mysqli_fetch_array($q_jenis)){                                          
                                          echo "<option value='".$jenis['jenisBantuan']."'> ".$jenis['jenisBantuan']." </option>";                                          
                                        }
                                        ?>
                                    </datalist>                              
                            </div>
                        </div>
                        <!--input-id_bantuan-->
                        <input type="hidden" class="form-control" name="id_bantuan" value="<?php echo $tabel['id_bantuan'];?>">                                                
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">                        
                        <a href="kelola_bantuan.php" class="btn btn-default"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save mr-2"></i>Simpan</button>                                      
                    </div>
                    <!-- /.card-footer -->  
                </form>                
                </div>
            </div>
            <div class="col-md-3"></div>
       </div>        
      </div>
    <!-- /.container-fluid -->
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
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert -->
<script src="../tambahan/sweetalert.min.js"></script>
<!-- DataTables -->
<script src="../tambahan/dataTables-id.json"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
</body>
</html>
