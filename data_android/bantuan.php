<?php

    include "koneksi.php";

    $query = "SELECT jenisBantuan FROM tb_bantuan GROUP BY jenisBantuan ORDER BY id_bantuan asc";
    $queryResult = $connect->query($query);

    $result = array();

        while($fetchData=$queryResult->fetch_assoc()){
            $result[] = $fetchData;
        }

        echo json_encode($result);

?>