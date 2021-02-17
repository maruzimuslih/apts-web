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
               
        $namaAdmin    =   $_POST['namaAdmin'];
        $email        =   $_POST['email'];
        $noTelp       =   $_POST['noTelp'];                   
        $id_admin     =   $_POST['id_admin'];
        $id_user      =   $_POST['id_user'];

        $query = "UPDATE tb_user SET email='".$email."' WHERE id_user = '".$id_user."' ";
        $result = mysqli_query($connect, $query);

        $response = array();
        

        if (isset($result)) {
            # code...
            $query2 = "UPDATE tb_admin SET namaAdmin='".$namaAdmin."', noTelp='".$noTelp."' WHERE id_admin = '".$id_admin."' ";
            $result2 = mysqli_query($connect, $query2);
            if (isset($result2)) {
                # code...
                ?>
                    <script type="text/javascript">
                        berhasil();
                    </script>
                <?php
            } else {
                # code...
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