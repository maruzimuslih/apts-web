<?php
    include "koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $kodePemesanan     =   $_POST['kodePemesanan'];        
        $tglBerangkat      =   $_POST['tglBerangkat'];
        $noKursi           =   $_POST['noKursi'];
        $totalPembayaran   =   $_POST['totalPembayaran'];
        $metodePembayaran  =   $_POST['metodePembayaran'];
        $statusPembayaran  =   $_POST['statusPembayaran'];
        $id_penumpang      =   $_POST['id_penumpang'];
        $id_pj             =   $_POST['id_pj'];
        $id_armada         =   $_POST['id_armada'];

        $result = $connect->query("INSERT INTO tb_pemesanan (kodePemesanan, tglPesanan, tglBerangkat, noKursi, totalPembayaran, metodePembayaran, statusPembayaran, id_penumpang, id_pj, id_armada) 
        VALUES ('$kodePemesanan', NOW(),'$tglBerangkat','$noKursi','$totalPembayaran','$metodePembayaran','$statusPembayaran','$id_penumpang','$id_pj','$id_armada') ");

        $response = array();

        if (isset($result)) {
            # code...
            $response['value']=1;
            $response['message']="Berhasil";
        // echo json_encode($response);
        } else {
            # code...
            $response['value']=0;
            $response['message']="Gagal";
            //echo json_encode($response);     
        }
    }

?>