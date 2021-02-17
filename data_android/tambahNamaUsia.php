<?php

    include "koneksi.php";

    $nama        =   $_POST['nama'];
    $usia        =   $_POST['usia'];
    $kodePemesanan = $_POST['kode'];

    $query = mysqli_query($connect, "SELECT id_pesanan FROM tb_pemesanan WHERE kodePemesanan = '$kodePemesanan' ");

    $response = array();

        if (isset($query)) {
            # code...
            $pesanan = mysqli_fetch_array($query);
            $queryResult = $connect->query("INSERT INTO tb_namausiapesanan (nama, usia, id_pesanan) VALUES ('$nama', '$usia', '".$pesanan['id_pesanan']."') ");
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