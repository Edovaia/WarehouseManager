<?php

function admin(){
 if(!isset($_SESSION["admin"])){
    header('location:login.php');
  }
   
}



?>