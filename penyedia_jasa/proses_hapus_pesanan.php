<?php
    include "../koneksi.php";

    $id_pesanan = $_GET['id_pesanan'];
     
    $get_id_armada = mysqli_query($connect, "SELECT id_armada FROM tb_pemesanan WHERE id_pesanan = '$id_pesanan' ");
    $get_id_kursi = mysqli_query($connect, "SELECT id_kursi FROM tb_kursipesanan WHERE id_pesanan = '$id_pesanan' ");    

    $response = array();    

        if (isset($get_id_armada) && isset($get_id_kursi)) {              
            $armada = mysqli_fetch_array($get_id_armada);            
            $update_sisa_kursi = $connect->query("UPDATE tb_armada SET sisaKursi = sisaKursi + 1 WHERE id_armada = '".$armada['id_armada']."' ");
            while($pesanan = mysqli_fetch_array($get_id_kursi)){
                $update_status_kursi = $connect->query("UPDATE tb_kursi SET dipesan='tidak' WHERE id_kursi = '".$pesanan['id_kursi']."' ");
            }
            if (isset($update_sisa_kursi) && isset($update_status_kursi)) {                
                $del_nama_usia = mysqli_query($connect, "DELETE FROM tb_namausiapesanan WHERE id_pesanan = '$id_pesanan' ");
                $del_kursi_pesanan = mysqli_query($connect, "DELETE FROM tb_kursipesanan WHERE id_pesanan = '$id_pesanan' ");
                if (isset($del_nama_usia) && isset($del_kursi_pesanan)) {                    
                    $del_pesanan = mysqli_query($connect, "DELETE FROM tb_pemesanan WHERE id_pesanan = '$id_pesanan' ");
                    header("location:kelola_pesanan.php");                 
                } else {
                    # code...
                    $response['value']=0;
                    $response['message']="Gagal";
                    echo json_encode($response);
                }
                
            }else {
                # code...
                $response['value']=0;
                $response['message']="Gagal";
                echo json_encode($response); 
            }
                                                                                   
        } else {
            # code...
            $response['value']=0;
            $response['message']="Gagal";
            echo json_encode($response);     
        }
?>