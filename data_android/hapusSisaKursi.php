<?php
    include "koneksi.php";

    $id_pesanan = $_POST['id_pesanan'];    
     
    $query = mysqli_query($connect, "SELECT id_armada FROM tb_pemesanan WHERE id_pesanan = '$id_pesanan' ");

    $response = array();

        if (isset($query)) {
            # code...
            $armada = mysqli_fetch_array($query);            
            $queryResult = $connect->query("UPDATE tb_armada SET sisaKursi = sisaKursi + 1 WHERE id_armada = '".$armada['id_armada']."' ");            
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