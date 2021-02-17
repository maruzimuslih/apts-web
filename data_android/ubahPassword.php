<?php
    include "koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $id         =   $_POST['id_user'];
        $email      =   $_POST['email'];
        $password   =   $_POST['password'];

        $result = $connect->query("UPDATE tb_user SET password = '".$password."' WHERE id_user = '".$id."' OR email='".$email."' ");

        $response = array();

        if (isset($result)) {
            # code...
            $response['value']=1;
            $response['message']="Login Berhasil";
            echo json_encode($response);
        } else {
            # code...
            $response['value']=0;
            $response['message']="Login Gagal";
            echo json_encode($response);     
        }
    }

?>