<?php
session_start();


if(!isset($_SESSION["admin"])){
    header('location:login.php');
}else{

$id_elimina=$_POST["elimina"];
$conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
$n="SELECT * FROM magazzino WHERE id_prodotto=$id_elimina";
$qn=mysqli_query($conn,$n);
while($row=mysqli_fetch_assoc($qn)){
    setcookie("nome_elimina_prod","$row[nome_prodotto]",time()+60*60);
}


$con=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
$x="DELETE FROM magazzino WHERE id_prodotto=$id_elimina";

$q=mysqli_query($con,$x);

if($q){
  
  header('location:modifica_magazzino.php');
}else{
    echo "Errore!";
    echo "<br>";
    echo "<a href='modifica_magazzino.php'> Riprova </a>";
}


}