<html>
<?php

    require "koneksi.php";
    
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $response   = array();
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $nama       = $_POST['nama'];

        $cek = "SELECT * FROM tb_user JOIN tb_penumpang ON tb_penumpang.id_user = tb_user.id_user WHERE email='$email'";
        $result = mysqli_fetch_array(mysqli_query($connect, $cek));

        if (isset($result)) {
?>            
            <script type="text/javascript">
                alert('Email telah digunakan!');
            </script>
<?php            
        } else {
            # code...
            $insert = "INSERT INTO tb_user (email, password, level) VALUES ('$email', '$password', 'penumpang')";
            if (mysqli_query($connect, $insert)) {
                # code...
                $query = mysqli_query($connect, "SELECT * FROM tb_user WHERE email = '$email' ");
                $user = mysqli_fetch_array($query);
                $in_penumpang = mysqli_query($connect, "INSERT INTO tb_penumpang (namaPenumpang, id_user) VALUES ('$nama', '".$user['id_user']."')");
?>
            <script type="text/javascript">
                alert('Verifikasi Berhasil!');
            </script>
<?php                
            } else {
?>                
            <script type="text/javascript">
                alert('Verifikasi Gagal!');
            </script>
<?php
            }                        
        }        
    }

?>
</html>
