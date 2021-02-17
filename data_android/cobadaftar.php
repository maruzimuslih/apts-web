<html>
<form name="myForm" id="myForm" action="http://192.168.43.120/apts/data_android/daftar.php" method="POST">          
        <input type="hidden" name="nama" value="<?php echo $_GET['nama']; ?>"/>
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>"/>
        <input type="hidden" name="password" value="<?php echo $_GET['password']; ?>"/>        
</form>

<script type="text/javascript">
    window.onload = function formAutoSubmit () {        
        var frm = document.getElementById("myForm");
        frm.submit();
    };
</script>
    
</html>