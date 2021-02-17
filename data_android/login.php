<?php

    require "koneksi.php";
        
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $response   = array();
        $email      = $_POST['email'];
        $password   = $_POST['password'];

        $cek = "SELECT * FROM tb_penumpang JOIN tb_user on tb_penumpang.id_user = tb_user.id_user WHERE email='".$email."' and password='".$password."' ";
        $result = mysqli_fetch_array(mysqli_query($connect, $cek));

        if (isset($result)) {
            # code...
            $response['value']=1;
            $response['message']="Login Berhasil";
            $response['level'] = $result['level'];
            $response['email'] = $result['email'];
            $response['id_penumpang'] = $result['id_penumpang'];
            $response['noHP'] = $result['noHP'];
            $response['namaPenumpang'] = $result['namaPenumpang'];
            $response['password'] = $result['password'];
            echo json_encode($response);
        } else {
            # code...
            $response['value']=0;
            $response['message']="Login Gagal";
            echo json_encode($response);     
        }
    }

?>