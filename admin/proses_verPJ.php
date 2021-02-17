<?php
  require_once("../koneksi.php");

  $id_pj        = $_GET['id_pj'];
  $status       = $_GET['status'];

  $edit = mysqli_query($connect, "UPDATE tb_pj SET statusPJ='$status' WHERE id_pj='$id_pj'");  
  
  ?>

  <script type="text/javascript">
      document.location = 'kelola_verPJ.php';
  </script>