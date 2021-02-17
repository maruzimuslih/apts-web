<?php
  require_once("../koneksi.php");

  $id_pesanan   = $_GET['id_pesanan'];
  $status       = $_GET['status'];

  $edit = mysqli_query($connect, "UPDATE tb_pemesanan SET statusPembayaran='$status' WHERE id_pesanan='$id_pesanan'");
  if ($status=='Ditolak') {
    $query2 = mysqli_query($connect, "DELETE FROM tb_infopembayaran WHERE id_pesanan = '$id_pesanan' ");
  }
  
  ?>

  <script type="text/javascript">
      document.location = 'kelola_pesanan.php';
  </script>