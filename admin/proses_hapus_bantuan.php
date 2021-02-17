<?php
    include "../koneksi.php";

    $id_bantuan = $_GET['id_bantuan'];
     
    $del_bantuan = mysqli_query($connect, "DELETE FROM tb_bantuan WHERE id_bantuan = '$id_bantuan' "); 

    $response = array();    

        if (isset($del_bantuan)) {                          
            header("location:kelola_bantuan.php");
        } else {
            # code...
            $response['value']=0;
            $response['message']="Gagal";
            echo json_encode($response);     
        }
?>