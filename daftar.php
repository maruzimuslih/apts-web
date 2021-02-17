<?php
  $alert=NULL;
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
  <link rel="stylesheet" href="tambahan/sweetalert.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">  
</head>
<body class="hold-transition register-page" style="background-image: url(image/6729.jpg); background-attachment: fixed; background-size: cover;">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php"><b>APTS</b>web</a>
  </div>    
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Buat akun baru</p>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <input type="text" name="namaPJ" class="form-control" placeholder="Nama Jasa Shuttle" required>          
        </div>
        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>          
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>          
        </div>
        <div class="mb-3">
          <input type="password" name="ulangPassword" class="form-control" placeholder="Ulangi password" required>          
        </div>
        <div class="mb-3">
         <p><b>Upload bukti pendukung berdirinya instansi:</b></p>
        </div>
        <div class="mb-3">          
          <input type="file" name="file" id="file" required>          
        </div>
        <div class="row mb-3">          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>      
      <p class="mb-0 text-center"> Sudah punya akun?
        <a href="index.php" class="text-center">Masuk</a>
      </p>
    </div>
    <!-- /.form-box -->
  </div>
  <script src="tambahan/sweetalert.min.js"></script> 
  <?php

    require "koneksi.php";
    
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...        
        $namaPJ          = $_POST['namaPJ'];
        $email           = $_POST['email'];
        $password        = $_POST['password'];
        $ulangPassword   = $_POST['ulangPassword'];
        $file            = $_FILES['file']['name'];
        $filePath        = "bukti_instansi/".$file;
        $pindahBerkas    = move_uploaded_file($_FILES['file']['tmp_name'], $filePath);               

        if ($ulangPassword != $password) {
          $alert = 'Password yang anda masukkan tidak sama!';
        }else {
          if (isset($pindahBerkas)) {
            $cek = mysqli_query($connect, "SELECT email FROM tb_user WHERE email = '$email' ");
            $cek_email = mysqli_fetch_array($cek);        
            if ($cek_email['email']==$email) {
              $alert = 'Email sudah digunakan!';
            } else {
                $insert = "INSERT INTO tb_user (email, password, level) VALUES ('$email', '$password', 'pj')";
                if (mysqli_query($connect, $insert)) {
                    # code...
                    $query = mysqli_query($connect, "SELECT * FROM tb_user WHERE email = '$email' ");
                    $user = mysqli_fetch_array($query);
                    $in_pj = mysqli_query($connect, "INSERT INTO tb_pj (namaPJ, buktiPendukung, id_user) VALUES ('$namaPJ', '$file', '".$user['id_user']."')");
                    if (isset($in_pj)) {
                        $to = $email;
                        $subject = "Verifikasi Akun";                        
                        $headers = "From: Support APTS <testingemailmus@gmail.com> \r\n";
                        $headers .= "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $variables = array();
                        
                        $variables['email'] = $email;
                        $variables['nama'] = $namaPJ;

                        $template = file_get_contents("email_template.html");

                        foreach($variables as $key=>$value)
                        {
                            $template = str_replace('{{ '.$key.' }}', $value, $template);
                        }

                        $kirim = mail($to,$subject,$template,$headers);
                        
                        if (isset($kirim)) {
                        ?>
                            <script type="text/javascript">                                                                
                                swal({ 
                                        title: "BERHASIL !",
                                        text: "Berhasil mendaftar, silahkan cek email anda untuk melakukan verifikasi",
                                        type: "success",
                                        timer: 2000,
                                        showConfirmButton: false 
                                  },
                                      function(){
                                          //event to perform on click of ok button of sweetalert
                                          document.location = 'index.php';
                                  });                              
                            </script>
                        <?php
                        } else {
                          $alert = 'Gagal mengirim email verifikasi';
                        }
                        
                        
                    }
                }else {
                  $alert = 'Gagal didaftarkan!';
                }                
            }
          } else {
            $alert = 'File gagal diupload!';
          }                                   
        }              
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
  <!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script> 
</body>
</html>