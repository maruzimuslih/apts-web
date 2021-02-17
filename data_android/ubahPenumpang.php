<?php
    include "koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $id     =   $_POST['id_penumpang'];
        $nama   =   $_POST['namaPenumpang'];
        $jk     =   $_POST['jenisKelamin'];
        $usia   =   $_POST['usia'];
        $noHP   =   $_POST['noHP'];

        $result = $connect->query("UPDATE tb_penumpang SET namaPenumpang = '".$nama."', jenisKelamin = '".$jk."', 
        usia = '".$usia."', noHP = '".$noHP."' WHERE id_penumpang = '".$id."' ");

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