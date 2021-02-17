<?php

    include "koneksi.php";

    $kodePemesanan = $_POST['kodePemesanan'];
    $response = array();

    $query = "SELECT namaBank, noRekening, id_pesanan FROM tb_pj JOIN tb_pemesanan on tb_pj.id_pj = tb_pemesanan.id_pj
        WHERE kodePemesanan = '".$kodePemesanan."' ";
    $queryID = "SELECT * FROM tb_pemesanan WHERE kodePemesanan = '$kodePemesanan' ";
    $result = mysqli_fetch_array(mysqli_query($connect, $query));
    $resultID = mysqli_fetch_array(mysqli_query($connect, $queryID));
    
    if (isset($resultID)) {
        # code...
        $response['value']=1;
        $response['message']="Login Berhasil";
        $response['id_pesanan'] = $result['id_pesanan'];
        $response['namaBank'] = $result['namaBank'];
        $response['noRekening'] = $result['noRekening'];
        $response['idPesanan'] = $resultID['id_pesanan'];
        echo json_encode($response);
    } else {
        # code...
        $response['value']=0;
        $response['message']="Login Gagal";
        echo json_encode($response);     
    }

?>