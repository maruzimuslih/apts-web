<?php

    include "koneksi.php";

    $id_pesanan        =   $_POST['id_pesanan'];    

    $query = mysqli_query($connect, "DELETE FROM tb_pemesanan WHERE id_pesanan = '$id_pesanan' ");

    $response = array();

        if (isset($query)) {
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