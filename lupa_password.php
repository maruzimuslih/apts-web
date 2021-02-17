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
<body class="hold-transition login-page" style="background-image: url(image/6729.jpg); background-attachment: fixed; background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>APTS</b>web</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Lupa Password?<br>Masukkan email yang sudah terdaftar</p>

      <form action="" method="post">
        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>          
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Reset password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>      
    </div>
    <!-- /.login-card-body -->
  </div>
  <script src="tambahan/sweetalert.min.js"></script>
  <?php

    require "koneksi.php";
    $alert = NULL;
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...        
        $email      = $_POST['email'];        

        $cek = "SELECT * FROM tb_pj JOIN tb_user ON tb_pj.id_user = tb_user.id_user WHERE email='".$email."' ";
        $result = mysqli_fetch_array(mysqli_query($connect, $cek));
        $id = $result['id_user'];
        $namaPJ = $result['namaPJ'];
        if ($result['email']==$email) {
          # code...
          $to = $email;
          $subject = "Reset Password";                        
          $headers = "From: Support APTS <testingemailmus@gmail.com> \r\n";
          $headers .= "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $variables = array();

          $random_set = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $pass_baru = substr(str_shuffle($random_set), 0, 10);

          $variables['nama'] = $namaPJ;
          $variables['password'] = $pass_baru;

          $template = file_get_contents("email_resetPass.html");

          foreach($variables as $key=>$value)
          {
              $template = str_replace('{{ '.$key.' }}', $value, $template);
          }

          $kirim = mail($to,$subject,$template,$headers);          
          if (isset($kirim)) {
            $ubah_pass = mysqli_query($connect, "UPDATE tb_user SET password = '".$pass_baru."' WHERE id_user = '".$id."' OR email='".$email."'");
          ?>
              <script type="text/javascript">                                                                
                  swal({ 
                          title: "BERHASIL !",
                          text: "Password berhasil direset, silahkan cek email anda",
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
            $alert = 'Gagal mengirim password baru';
          }
        } else {
            $alert = "Email yang anda masukkan tidak terdaftar!";
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
