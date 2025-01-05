<?php

session_start();

if(!isset($_SESSION["dipendente"])){
    header('location:login.php');
}else{
    
    $contenitore=$_POST["ordina"];


$conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita");
for($i=0;$i<count($contenitore);$i++){         
$x="INSERT INTO notifiche (id_prodotto) VALUES($contenitore[$i])";  /*inserisco con for l'id prodotto nel database*/
$q=mysqli_query($conn,$x);
} 
 if($q){
      setcookie("invio_notifica","9",time()+60*60*60);
    header('location:notifica_a_admin.php');
 }



}
   
  
  



         
       
       

