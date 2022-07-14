<?php

session_start();
$_SESSION = [];
session_destroy();
setcookie('id','',time()-1);
setcookie('pass','',time()-1);
echo"<script>document.location.href='login.php'</script>";

?>