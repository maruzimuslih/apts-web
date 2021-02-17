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
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pesanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
              <li class="breadcrumb-item active">Data Pesanan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">            
            <div class="card">              
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Pesanan</th>
                    <th>Tanggal Pesanan</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Berangkat</th>
                    <th>Metode Pembayaran</th>
                    <th>Total</th>                                        
                    <th>Status</th>                                     
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php                    
                      $q_tabel = mysqli_query($connect, "SELECT * FROM tb_pemesanan JOIN tb_penumpang ON tb_pemesanan.id_penumpang=tb_penumpang.id_penumpang WHERE id_pj='".$profil['id_pj']."' ORDER BY id_pesanan DESC");                      
                      $no = 0;
                      while($tabel = mysqli_fetch_array($q_tabel)){
                        $no++;                    
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $tabel['kodePemesanan']; ?></td>                      
                      <td><?php echo date('d-m-Y',strtotime($tabel['tglPesanan'])); ?></td>                      
                      <td><?php echo $tabel['namaPenumpang']; ?></td>
                      <td>
                        <?php 
                          $date = DateTime::createFromFormat('l, d M Y', $tabel['tglBerangkat']);
                          $dateFix = $date->format('d-m-Y');
                          echo $dateFix;
                        ?>
                      </td>
                      <td><?php echo $tabel['metodePembayaran']; ?></td>
                      <td><?php echo 'Rp. '.$tabel['totalPembayaran']; ?></td>
                      <td>
                        <?php
                         if($tabel['metodePembayaran']=='Tunai'){
                            if ($tabel['statusPembayaran']=='Belum dibayar') {?>
                              <form action="proses_verTunai.php" method="post">
                                <button type="submit" class="btn btn-block btn-success btn-sm" title="Dibayar">Dibayar</button>                                
                                <input type='hidden' name='id_pesanan' value="<?php echo $tabel['id_pesanan']; ?>">
                              </form>
                            <?php 
                            }else{
                              echo "<span style='color:green;'> Lunas </span>";
                            }
                         }elseif($tabel['statusPembayaran']=='Belum dibayar'){
                            echo "<span style='color:red;'> Belum dibayar </span>";
                         }elseif ($tabel['statusPembayaran']=='Belum diverifikasi') {
                            echo "<span style='color:blue;'> Belum diverifikasi </span>";
                         }elseif ($tabel['statusPembayaran']=='Lunas'){
                            echo "<span style='color:green;'> Lunas </span>";
                         }else {
                            echo "<span style='color:red;'> Verifikasi ditolak </span>";
                         }
                        ?>
                      </td>                      
                      <td>
                        <?php
                          if ($tabel['statusPembayaran']=='Belum dibayar' || $tabel['statusPembayaran']=='Ditolak') {
                        ?>
                            <a href="detail_pesanan.php?id_pesanan=<?php echo $tabel['id_pesanan']; ?>" class="btn btn-block btn-info btn-xs" title="Detail Pesanan">Selengkapnya...</a>
                            <button type="button" class="btn btn-block btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#modal-sm<?php echo $tabel['id_pesanan']; ?>">
                            <i class="far fa-trash-alt"></i>
                            </button>

                            <div class="modal fade" id="modal-sm<?php echo $tabel['id_pesanan']; ?>">
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
                                    <button id_pesanan="<?php echo $tabel['id_pesanan']; ?>" type="button" data-dismiss="modal" class="btn btn-primary ajaxhapus">Ya</button>                                   
                                  </div>            
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                        <?php
                          }else {
                        ?>
                          <a href="detail_pesanan.php?id_pesanan=<?php echo $tabel['id_pesanan']; ?>" class="btn btn-block btn-info btn-xs" title="Detail Pesanan">Selengkapnya...</a>
                        <?php
                          }
                        ?>                                                
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>
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
<script>  
  $(function () {
    $("#example1").dataTable({
      "responsive": true,
      "autoWidth": false,
      "language" : {
        "url" : "../tambahan/dataTables-id.json"
      }
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
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
      setTimeout("location.reload(true);", 2000);
    });    
  }
</script>
</body>
</html>
