<?php
session_start();
if(!isset($_SESSION["admin"])){
    header('location:login.php');
}else{
?>
<!DOCTYPE html>
    <html lang="it">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Navbar Magazzino</title>
                
                <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        </head>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar" style="margin-top:-10px;">
  <div class="container-fluid">
    <a class="nav-link" href="admin_home.php">Home page</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="mostra_magazzino.php">Magazzino</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="modifica_magazzino.php">Modifica magazzino</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="stato_lavori.php">
           Lavori cliente
          </a>
         
        </li>
        <li class="nav-item">
          <a class="navbar-brand" href="notifiche.php">Notifiche</a>
        </li>
        <li class="nav-item">
          <a class="nav-link logout" href="logout_admin.php">Logout</a>
        </li>
      </ul>
      <form class="d-flex search"role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php

$elimina=$_POST["elimina"];

$conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
$xq="SELECT nome_prodotto                         /* inner join per prendere il nome prodotto corrispondente da inserire nel cookie che mi servirà per fare alert di notifica eliminata*/
FROM magazzino
INNER JOIN notifiche ON magazzino.id_prodotto=notifiche.id_prodotto";
$qv=mysqli_query($conn,$xq);
while($row=mysqli_fetch_assoc($qv)){
  $name=$row["nome_prodotto"];
}
$x="DELETE FROM notifiche WHERE id_prodotto=$elimina";
$q=mysqli_query($conn,$x);
if($q){
  setcookie("notifica_eliminata","$name",time()+60*60*60); /* creazione cookie notifica eliminata per avviso con alert*/
header('location:notifiche.php');
}else{
  echo "Errore!";
  echo "<br>";
  echo "<a href='notifiche.php'> Riprova </a>";
}
}