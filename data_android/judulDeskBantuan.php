<?php

    include "koneksi.php";

    $jenis  =   $_POST['jenisBantuan'];

    $query = "SELECT judul, deskripsi FROM tb_bantuan WHERE jenisBantuan = '".$jenis."' ";
    $queryResult = $connect->query($query);

    $result = array();

        while($fetchData=$queryResult->fetch_assoc()){
            $result[] = $fetchData;
        }

        echo json_encode($result);

?>