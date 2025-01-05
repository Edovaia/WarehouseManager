<?php
session_start();
if(!isset($_SESSION["admin"])){
  header('location:login.php');
}else{
    if(isset($_POST["stato_lavori"])&& isset($_COOKIE["id_lavoro"])){
     $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
     $x="UPDATE lavori SET stato_lavori='$_POST[stato_lavori]' WHERE id_lavoro='$_COOKIE[id_lavoro]'";
     $q=mysqli_query($conn,$x);
     if($q){
        
        setcookie("id_lavoro","",time()-1);
        setcookie("stato_lavori","$_POST[nome_cliente]",time()+60*60*60);  /* non funziona avvviso */
        header('location:stato_lavori.php');
     }
    }elseif(isset($_POST["descrizione"])&& isset($_COOKIE["id_lavoro"])){
      $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
      $x="UPDATE lavori SET descrizione= '$_POST[descrizione]' WHERE id_lavoro='$_COOKIE[id_lavoro]'";
      $q=mysqli_query($conn,$x);
      if($q){
        setcookie("id_lavoro","",time()-1);
        setcookie("descrizione","$_POST[nome_cliente]",time()+60*60*60);  /* non funziona avvviso */
        header('location:stato_lavori.php');
      }

    }
}