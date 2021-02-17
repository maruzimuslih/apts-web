<?php
    include "koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $id         =   $_POST['id_armada'];
        $sisaKursi   =   $_POST['sisaKursi'];

        $result = $connect->query("UPDATE tb_armada SET sisaKursi = '".$sisaKursi."' WHERE id_armada = '".$id."' ");

        $response = array();

        if (isset($result)) {
            # code...
            $response['value']=1;
            $response['message']="Login Berhasil";
        // echo json_encode($response);
        } else {
            # code...
            $response['value']=0;
            $response['message']="Login Gagal";
            //echo json_encode($response);     
        }
    }

?>