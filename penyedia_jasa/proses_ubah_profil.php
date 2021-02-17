<html>
<header>
<link rel="stylesheet" href="../tambahan/sweetalert.css">
</header>
<script src="../tambahan/sweetalert.min.js"></script>
<script type="text/javascript">
    	function berhasil () {
    		swal({ 
                title: "BERHASIL !",
                text: "Profil berhasil diubah",
                type: "success",
                timer: 1000,
                showConfirmButton: false 
          },
               function(){
                  //event to perform on click of ok button of sweetalert
                  document.location = 'kelola_profil.php';
          });
    	}
    	function gagal () {
    		swal({ 
                title: "GAGAL !",
                text: "Profil gagal diubah",
                type: "error",
                timer: 1000,
                showConfirmButton: false 
          },
               function(){
                  //event to perform on click of ok button of sweetalert
                  document.location = 'kelola_profil.php';
          });
    	}
</script>
</html>

<?php
    include "../koneksi.php";

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        if (isset($_POST['noRek'])) {
            $namaBank     =   $_POST['namaBank'];
            $noRek        =   $_POST['noRekening'];
            $namaPemilik  =   $_POST['namaPemilik'];                   
            $id_pj        =   $_POST['id_pj'];

            $query = "UPDATE tb_pj SET namaBank='".$namaBank."', noRekening='".$noRek."', pemilikRekening='".$namaPemilik."' WHERE noRekening = '".$_POST['noRek']."' ";
            $result = mysqli_query($connect, $query);

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
            
        } else {            
            $namaPJ     =   $_POST['namaPJ'];
            $alamat     =   $_POST['alamat'];
            $maps       =   $_POST['maps'];
            $kota       =   $_POST['kota'];
            $pool       =   $_POST['pool'];        
            $telepon    =   $_POST['telepon'];        
            $id_pj      =   $_POST['id_pj'];

            $query = "UPDATE tb_pj SET namaPJ='".$namaPJ."', alamat='".$alamat."', googleMaps='".$maps."', kota='".$kota."', pool='".$pool."', telepon='".$telepon."' WHERE id_pj = '".$id_pj."' ";
            $result = mysqli_query($connect, $query);

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
    }

?>