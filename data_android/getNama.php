<?php
    include "koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...        
        $email      =   $_POST['email'];        

        $cek = "SELECT * FROM tb_penumpang JOIN tb_user ON tb_penumpang.id_user = tb_user.id_user WHERE email='$email'";
        $result = mysqli_fetch_array(mysqli_query($connect, $cek));

        $response = array();

        if (isset($result)) {
            # code...
            $response['value']=1;
            $response['message']="Nama Berhasil didapat";
            $response['nama'] = $result['namaPenumpang'];
            echo json_encode($response);
        } else {
            # code...
            $response['value']=0;
            $response['message']="Nama Gagal didapat";
            echo json_encode($response);     
        }
    }

?>