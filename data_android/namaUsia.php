<?php

    include "koneksi.php";

    $id_pesanan  = $_POST['id_pesanan'];

    $queryResult = $connect->query("SELECT nama, usia FROM tb_namausiapesanan WHERE id_pesanan = '".$id_pesanan."' ");

    $result = array();

    while($fetchData=$queryResult->fetch_assoc()){
        $result[] = $fetchData;
    }

    echo json_encode($result);
?>