<html>
<header>
<link rel="stylesheet" href="../tambahan/sweetalert.css">
</header>
<script src="../tambahan/sweetalert.min.js"></script>
<script type="text/javascript">
    	function berhasil () {
    		swal({ 
                title: "BERHASIL !",
                text: "Data armada berhasil diubah",
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
                text: "Data armada gagal diubah",
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
        $id_armada      =   $_POST['id_armada'];

        $result = $connect->query("UPDATE tb_armada SET namaArmada = '".$namaArmada."', kotaTujuan = '".$kotaTujuan."', 
        poolTujuan = '".$poolTujuan."', jamBerangkat = '".$jamBerangkat."', jamTiba = '".$jamTiba."', kapasitasKursi = '".$kapasitasKursi."',
        harga = '".$harga."' WHERE id_armada = '".$id_armada."' ");

        $response = array();

        if (isset($result)) {
            # code...
            ?>
                <script type="text/javascript">
                    berhasil();
                </script>
            <?php           
            $response['value']=1;
            $response['message']="Berhasil";
        // echo json_encode($response);
        } else {
            # code...
            ?>
                <script type="text/javascript">
                    gagal();
                </script>
            <?php
            $response['value']=0;
            $response['message']="Gagal";
            //echo json_encode($response);     
        }
    }

?>