<?php 
//pag de logout
session_start();
session_unset();
session_destroy();
header('Location: ../views/login_form.php');
exit();
?>