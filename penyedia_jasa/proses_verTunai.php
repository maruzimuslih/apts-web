<?php
  require_once("../koneksi.php");

  $id_pesanan       = $_POST['id_pesanan'];  

  $edit = mysqli_query($connect, "UPDATE tb_pemesanan SET statusPembayaran='Lunas' WHERE id_pesanan='$id_pesanan'");

  ?>

  <script type="text/javascript">
      document.location = 'kelola_pesanan.php';
  </script>