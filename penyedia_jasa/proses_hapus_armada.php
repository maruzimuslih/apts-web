<?php
    include "../koneksi.php";

    $id_armada = $_GET['id_armada'];
     
    $del_kursi = mysqli_query($connect, "DELETE FROM tb_kursi WHERE id_armada = '$id_armada' "); 

    $response = array();    

        if (isset($del_kursi)) {              
            $del_armada = mysqli_query($connect, "DELETE FROM tb_armada WHERE id_armada = '$id_armada' ");
            header("location:kelola_armada.php");
        } else {
            # code...
            $response['value']=0;
            $response['message']="Gagal";
            echo json_encode($response);     
        }
?>