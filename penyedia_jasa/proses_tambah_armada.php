<html>
<header>
<link rel="stylesheet" href="../tambahan/sweetalert.css">
</header>
<script src="../tambahan/sweetalert.min.js"></script>
<script type="text/javascript">
    	function berhasil () {
    		swal({ 
                title: "BERHASIL !",
                text: "Data armada berhasil ditambahkan",
                type: "success",
                timer: 1000,
                showConfirmButton: false 
          },
               function(){
                  //event to perform on click of ok button of sweetalert
                  document.location = 'kelola_armada.php';
          });
    	}
    	function gagal () {
    		swal({ 
                title: "GAGAL !",
                text: "Data armada gagal ditambahkan",
                type: "error",
                timer: 1000,
                showConfirmButton: false 
          },
               function(){
                  //event to perform on click of ok button of sweetalert
                  document.location = 'kelola_armada.php';
          });
    	}
</script>
</html>

<?php
    include "../koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $namaArmada     =   $_POST['namaArmada'];
        $kotaTujuan     =   $_POST['kotaTujuan'];
        $poolTujuan     =   $_POST['poolTujuan'];
        $jamBerangkat   =   $_POST['jamBerangkat'];
        $jamTiba        =   $_POST['jamTiba'];
        $kapasitasKursi =   $_POST['kapasitasKursi'];
        $harga          =   $_POST['harga'];
        $id_pj          =   $_POST['id_pj'];

        $result = $connect->query("INSERT INTO tb_armada (namaArmada, kotaTujuan, poolTujuan, jamBerangkat, jamTiba, kapasitasKursi, sisaKursi, harga, id_pj) 
        VALUES ('$namaArmada','$kotaTujuan','$poolTujuan','$jamBerangkat','$jamTiba','$kapasitasKursi','$kapasitasKursi','$harga','$id_pj') ");

        $response = array();

        if (isset($result)) {
            # code...
            $query = mysqli_query($connect, "SELECT max(id_armada) as id_armada FROM tb_armada limit 1");
            $armada = mysqli_fetch_array($query);
            for($i=0; $i < $kapasitasKursi; $i++) { 
                # code...
                $in_kursi = mysqli_query($connect, "INSERT INTO tb_kursi (dipesan, id_armada) VALUES ('tidak', '".$armada['id_armada']."')");
            }
            if (isset($in_kursi)) {
            ?>
                <script type="text/javascript">
                    berhasil();
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    gagal();
                </script>
            <?php
            }            
            $response['value']=1;
            $response['message']="Berhasil";
        // echo json_encode($response);
        } else {
            # code...
            $response['value']=0;
            $response['message']="Gagal";
            //echo json_encode($response);     
        }
    }

?>