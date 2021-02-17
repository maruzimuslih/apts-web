<?php

    include "koneksi.php";

    $id_penumpang = $_POST['id_penumpang'];

    $queryResult = $connect->query("SELECT * FROM tb_pemesanan 
        JOIN tb_armada
            on tb_pemesanan.id_armada = tb_armada.id_armada
        JOIN tb_pj
            on tb_pemesanan.id_pj = tb_pj.id_pj
    WHERE id_penumpang = '".$id_penumpang."' ORDER BY id_pesanan desc");

    $result = array();

    while($fetchData=$queryResult->fetch_assoc()){
        $result[] = $fetchData;
    }

    echo json_encode($result);

?>