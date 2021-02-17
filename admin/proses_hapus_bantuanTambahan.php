<?php
    include "../koneksi.php";

    $id_bantuanTambahan = $_GET['id_bantuanTambahan'];
     
    $del_pertanyaan = mysqli_query($connect, "DELETE FROM tb_bantuantambahan WHERE id_bantuanTambahan = '$id_bantuanTambahan' "); 

    $response = array();    

        if (isset($del_pertanyaan)) {                          
            header("location:kelola_perPengguna.php");
        } else {
            # code...
            $response['value']=0;
            $response['message']="Gagal";
            echo json_encode($response);     
        }
?>