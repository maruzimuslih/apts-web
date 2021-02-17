<?php

    include "koneksi.php";

    $id_armada  = $_POST['id_armada'];

    $queryResult = $connect->query("SELECT id_kursi, dipesan FROM tb_kursi WHERE id_armada = '".$id_armada."' ");

    $result = array();

    while($fetchData=$queryResult->fetch_assoc()){
        $result[] = $fetchData;
    }

    echo json_encode($result);
?>