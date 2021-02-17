<?php
    include "../koneksi.php";

    if (!empty($_POST['kotaTujuan'])) {
        $q_pjPool = mysqli_query($connect, "SELECT pool FROM tb_pj WHERE kota = '".$_POST['kotaTujuan']."' ");        
        if ($q_pjPool->num_rows > 0) {
            echo '<option value="" hidden > Pilih Pool Tujuan</option>';
            while ($row = $q_pjPool->fetch_assoc()) {
                echo "<option value='".$row['pool']."'> ".$row['pool']." </option>";
            }
        }else{
            echo '<option value="">Pool Tidak Tersedia</option>';
        }
    }
?>