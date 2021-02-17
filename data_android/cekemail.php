<?php

    require "koneksi.php";
    
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $response   = array();
        $email      = $_POST['email'];               

        $cek = "SELECT * FROM tb_user JOIN tb_penumpang ON tb_penumpang.id_user = tb_user.id_user WHERE email='$email'";
        $result = mysqli_fetch_array(mysqli_query($connect, $cek));

        if (isset($result)) {
            # code...
            $response['value']=2;
            $response['message']="Email telah digunakan";            
            echo json_encode($response);
        } else {            
            # code...
            $response['value']=0;
            $response['message']="Email dapat dipakai";
            echo json_encode($response);                                    
        }        
    }

?>