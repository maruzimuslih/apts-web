<?php

    include "koneksi.php";

    $kota       = $_POST['kota'];
    $kotaTujuan = $_POST['kotaTujuan'];

    $queryResult = $connect->query("SELECT * FROM tb_armada JOIN tb_pj on tb_armada.id_pj = tb_pj.id_pj
    WHERE kota = '".$kota."' and kotaTujuan = '".$kotaTujuan."' ORDER BY jamBerangkat asc");

    $result = array();

    while($fetchData=$queryResult->fetch_assoc()){
        $result[] = $fetchData;
    }

    echo json_encode($result);

?>