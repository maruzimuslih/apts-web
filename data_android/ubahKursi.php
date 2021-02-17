<?php

    include "koneksi.php";

    $id_kursi    =   $_POST['id_kursi'];
    $queryResult = $connect->query("UPDATE tb_kursi SET dipesan = 'ya' WHERE id_kursi = '".$id_kursi."' ");

    $response = array();

        if (isset($queryResult)) {
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
    
?>