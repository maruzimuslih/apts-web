<?php
    include "koneksi.php";

    $id_pesanan = $_POST['id_pesanan'];
     
    $query = mysqli_query($connect, "SELECT id_kursi FROM tb_kursipesanan WHERE id_pesanan = '$id_pesanan' ");

    $response = array();    

        if (isset($query)) {
            # code...            
            while($pesanan = mysqli_fetch_array($query)){
                $queryResult = $connect->query("UPDATE tb_kursi SET dipesan='tidak' WHERE id_kursi = '".$pesanan['id_kursi']."' ");
            }            
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