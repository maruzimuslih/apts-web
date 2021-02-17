<?php
    include "koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $email     =   $_POST['email'];
        $subjek    =   $_POST['subjek'];
        $deskripsi =   $_POST['deskripsi'];        

        $result = $connect->query("INSERT INTO tb_bantuantambahan (email, subjek, deskripsi) 
            VALUES ('$email', '$subjek','$deskripsi') ");

        $response = array();

        if (isset($result)) {
            # code...
            $response['value']=1;
            $response['message']="Berhasil";
            echo json_encode($response);
        } else {
            # code...
            $response['value']=0;
            $response['message']="Gagal";
            echo json_encode($response);     
        }
    }

?>