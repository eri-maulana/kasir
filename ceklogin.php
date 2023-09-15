<?php
 require 'function.php';

 if(isset($_SESSION['login'])){
   // biarkan masuk
 } else {
   // jangan biarkan ke dashboard
   header('location: login.php');
 }

?>