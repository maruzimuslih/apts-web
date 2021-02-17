<?php
  require_once("koneksi.php");

  session_start();
  if(isset($_SESSION['id_user'])) {
    if($_SESSION['level'] == "pj"){
      header('location: penyedia_jasa/index.php');
    } else if($_SESSION['level'] == "admin"){
      header('location: admin/index.php');
    } else{
      echo "<script>alert('Nama lengkap atau password Anda SALAH !');</script>";
      echo "<script>window.location='index.php';</script>";
    }
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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: url(image/6729.jpg); background-attachment: fixed; background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>APTS</b>web</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan masukkan email dan password</p>
      <form action="" method="POST">
        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>          
        </div>
        <div class="mb-0">
          <input type="password" name="password" class="form-control" placeholder="Password" required>          
        </div>
        <div class="row mb-3">
          <div class="col-12 text-right">
          <p class="mb-3">
            <a href="lupa_password.php">Lupa password?</a>
          </p>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>         
      <p class="mb-0 text-center">Belum punya akun? 
        <a href="daftar.php" class="text-center">Daftar</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
  <?php

    require "koneksi.php";
    $alert = NULL;
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...        
        $email      = $_POST['email'];
        $password   = $_POST['password'];

        $cek = "SELECT * FROM tb_user WHERE email='".$email."' and password='".$password."' ";
        $result = mysqli_fetch_array(mysqli_query($connect, $cek));
        if ($result['email']==$email&&$result['password']==$password) {
          if ($result['status_verif']==1) {
            # code...
            session_start();
            $_SESSION['id_user'] = $result['id_user'];
            $_SESSION['level']   = $result['level'];
            $_SESSION['status']	 = "login";

            if($result['level'] == "pj"){
                header('location: penyedia_jasa/index.php');
            }else if($result['level'] == "admin"){
                header('location: admin/index.php');
            }else{
              $alert = "Email dan Password Salah!";
            }
          } else {
              $alert = "Email verifikasi sudah dikirim ke $email, lakukan verifikasi agar dapat masuk";
          }
        } else {
          $alert = "Email atau Password yang anda masukkan salah!";
        }
        
                            
        $connect->close();        
    }
?>
  <div class="text-center">
    <?php
      if ($alert==NULL) {
        echo "";
      } else {
        echo "<p class='pt-2 pb-2' style='color:white'><span class='pt-1 pb-1 pl-2 pr-2' style='background-color:red'> $alert</span></p>";
      }
      
    ?>     
  </div> 
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
