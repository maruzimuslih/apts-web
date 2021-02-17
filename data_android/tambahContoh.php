<?php
    include "../koneksi.php";

    $id = $_POST["id_alamat"];
    $isi = $_POST["isi"];

    $query = mysqli_query($connect, "INSERT INTO alamat (id_alamat, isi) VALUES ('$id', '$isi')");
?>