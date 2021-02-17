<?php
    include "koneksi.php";

    $reponse            =   array();
    $image              =   $_FILES['image']['name'];
    $namaPemilikRek     =   $_POST['namaPemilikRek'];
    $namaBankPengirim   =   $_POST['namaBankPengirim'];
    $id_pesanan         =   $_POST['id_pesanan'];

    $imagePath          =   "../bukti_transfer/".$image;

    $pindahBerkas = move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    
    if (isset($pindahBerkas)) {
        $connect->query("INSERT INTO tb_infopembayaran (namaPemilikRek, namaBankPengirim, buktiTransfer, id_pesanan) 
        VALUES ('$namaPemilikRek', '$namaBankPengirim', '$image', '$id_pesanan') ");
    
        $connect->query("UPDATE tb_pemesanan SET statusPembayaran = 'Belum diverifikasi' WHERE id_pesanan = '".$id_pesanan."' ");
    } else {
        $reponse['message']="Gagal";
        echo json_encode($reponse);
    }
    
    


?>