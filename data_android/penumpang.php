<?php
    include "koneksi.php";
    //include "login.php";

    $email = $_POST['email'];

    $queryResult = $connect->query("SELECT * FROM tb_penumpang JOIN tb_user on tb_penumpang.id_user = tb_user.id_user WHERE email = '".$email."' ");

    $result = array();

    while($fetchData=$queryResult->fetch_assoc()){
        $result[] = $fetchData;
    }

    echo json_encode($result);
?>