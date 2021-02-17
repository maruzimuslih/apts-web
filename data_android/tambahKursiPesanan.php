<?php

    include "koneksi.php";
    
    $id_kursi      = $_POST['id_kursi'];
    $kodePemesanan = $_POST['kode'];

    $query = mysqli_query($connect, "SELECT id_pesanan FROM tb_pemesanan WHERE kodePemesanan = '$kodePemesanan' ");

    $response = array();

        if (isset($query)) {
            # code...
            $pesanan = mysqli_fetch_array($query);
            $queryResult = $connect->query("INSERT INTO tb_kursipesanan (id_kursi, id_pesanan) VALUES ('$id_kursi', '".$pesanan['id_pesanan']."') ");
            $response['value']=1;
            $response['message']="Berhasil";
            $response['id_pesanan']=$pesanan['id_pesanan'];
            echo json_encode($response);
        } else {
            # code...
            $response['value']=0;
            $response['message']="Gagal";
            echo json_encode($response);     
        }
    
?>