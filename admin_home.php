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
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
</head>
<style>
    .carousel-item img {
      max-height: 300px;
      margin: auto;
    }
  </style>
<nav class="navbar navbar-expand-lg bg-body-tertiary navbar admin" style="margin-top:-10px;">
  <div class="container-fluid">
  <a class="nav-item" href="admin_home.php" style="margin-right:10px;"><nobr><b>Scuderia Torino</b></nobr></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="mostra_magazzino.php"><nobr>Magazzino</nobr></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="modifica_magazzino.php"><nobr>Modifica magazzino</nobr></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="stato_lavori.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <nobr>Lavori cliente</nobr>
          </a>
         
        </li>
        <li class="nav-item">
        <?php 
          $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
          $xf="SELECT * FROM notifiche";
          $qf=mysqli_query($conn,$xf);
          if(mysqli_num_rows($qf)>0){
            $number=mysqli_num_rows($qf); ?>
            <a class="navbar-brand no_brand" href="notifiche.php"><nobr>Notifiche</nobr></a><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $number;?> </span>
            <?php
          }else{
          ?>
          <a class="nav-link" href="notifiche.php"><nobr>Notifiche</nobr></a>
          <?php
          }
          ?>
        </li>
        <li class="nav-item">
          <a class="nav-link logout" href="logout_admin.php"><nobr>Logout</nobr></a>
        </li>
      </ul>
      <form action="ricerca_prodotto.php" method="POST" class="d-flex search" role="search">
        <input class="form-control me-2" name="ricerca" style="width:250px; margin-left:-30px;"type="search" placeholder="Cerca scheda prodotto" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Cerca</button>
      </form>
    </div>
  </div>
</nav>
<body>

<style>
    .carousel-item img {
      max-height: 100%;
      margin: auto;
      max-width:100%;

    }
  </style>



<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
    
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="immagini\lastratura-3-2.jpg" alt="Prima immagine">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="immagini\DSC_1264.jpg" alt="Seconda immagine">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="immagini\DSC_0474_PS_2_senza-scritta.jpg" alt="Terza immagine">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="immagini\DSC_0277.jpg" alt="Quarta immagine">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Precedente</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Successivo</span>
  </a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>






<?php






}
