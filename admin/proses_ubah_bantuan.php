<html>
<header>
<link rel="stylesheet" href="../tambahan/sweetalert.css">
</header>
<script src="../tambahan/sweetalert.min.js"></script>
<script type="text/javascript">
    	function berhasil () {
    		swal({ 
                title: "BERHASIL !",
                text: "Data bantuan berhasil diubah",
                type: "success",
                timer: 1000,
                showConfirmButton: false 
          },
               function(){
                  //event to perform on click of ok button of sweetalert
                  document.location = 'kelola_bantuan.php';
          });
    	}
    	function gagal () {
    		swal({ 
                title: "GAGAL !",
                text: "Data bantuan gagal diubah",
                type: "error",
                timer: 1000,
                showConfirmButton: false 
          },
               function(){
                  //event to perform on click of ok button of sweetalert
                  document.location = 'kelola_bantuan.php';
          });
    	}
</script>
</html>

<?php
    include "../koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $judul      =   $_POST['judul'];
        $deskripsi  =   $_POST['deskripsi'];
        $jenis      =   $_POST['jenis'];
        $id_bantuan =   $_POST['id_bantuan'];

        $result = $connect->query("UPDATE tb_bantuan SET judul = '".$judul."', deskripsi = '".$deskripsi."', 
        jenisBantuan = '".$jenis."' WHERE id_bantuan = '".$id_bantuan."' ");

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