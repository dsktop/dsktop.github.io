<?php
error_reporting(0);
$msg = "";
$validacion = True;
require 'cnx.php';
   
   session_start();

   $email_user = $_POST['email_user'];
   $pass_user = $_POST['pass_user'];

   $sql = "SELECT * FROM users WHERE email_user = '$email_user' AND pass_user = '$pass_user';";
   $resultado = $cnx->query($sql);
   $rsUsuarios = $resultado->fetch(PDO::FETCH_ASSOC);

   if($email_user === '' && $pass_user === '') {
      $_SESSION['msgError'] = 'Todos los campos son Obligatorios.';
      header("location: login.php");
   }else if($rsUsuarios['email_user'] == $email_user && $rsUsuarios['pass_user'] == $pass_user) {
         $_SESSION['email_user'] = $email_user;
         header("location: home/index.php");
   }else {
         $_SESSION['msgError'] = 'Error! EMAIL O PASSWORD INCORRECTOS.';
         header("location: login.php");
   }
?>