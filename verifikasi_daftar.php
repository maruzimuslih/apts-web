<html>
<header>
<link rel="stylesheet" href="tambahan/sweetalert.css">
</header>
<script src="tambahan/sweetalert.min.js"></script>
<script type="text/javascript">
    	function berhasil () {
    		swal({ 
                title: "BERHASIL !",
                text: "Email anda berhasil diverifikasi, silahkan masuk",
                type: "success",
                timer: 2000,
                showConfirmButton: false 
          },
               function(){
                  //event to perform on click of ok button of sweetalert
                  document.location = 'index.php';
          });
    	}
    	function gagal () {
    		swal({ 
                title: "GAGAL !",
                text: "Email anda gagal diverifikasi atau sudah diverifikasi",
                type: "error",
                timer: 2000,
                showConfirmButton: false 
          },
               function(){
                  //event to perform on click of ok button of sweetalert
                  document.location = 'index.php';
          });
    	}
</script>
</html>

<?php

    require "koneksi.php";
            
        # code...        
        $email      = $_GET['email'];        

        $cek = mysqli_query($connect, "SELECT * FROM tb_user WHERE email='".$email."' ") ;
        $cek_status = mysqli_fetch_array($cek);
        
        if ($cek_status['status_verif']==0) {
            $verif = mysqli_query($connect, "UPDATE tb_user SET status_verif = 1 WHERE email = '$email' ");
            if (isset($verif)) {
            ?>
                <script type="text/javascript">
                    berhasil();
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    gagal();
                </script>
            <?php            
            }
            
        }else{
            ?>
                <script type="text/javascript">
                    gagal();
                </script>
            <?php
        }            
?>