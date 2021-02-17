<?php

    include "koneksi.php";

    $queryResult = $connect->query("SELECT kota FROM tb_pj JOIN tb_user on tb_pj.id_user = tb_user.id_user GROUP BY kota ORDER BY kota asc ");

    $result = array();

    while($fetchData=$queryResult->fetch_assoc()){
        $result[] = $fetchData;
    }

    echo json_encode($result);

?>