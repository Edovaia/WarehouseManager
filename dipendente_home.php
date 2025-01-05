<?php
session_start();

if(!isset($_SESSION["dipendente"])){
    header('location:login.php');
}else{
    ?>


<!DOCTYPE html>
    <html lang="it">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Dipendente Home</title>
                
                <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        </head>
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar admin" style="margin-top:-10px;">
  <div class="container-fluid">
 
  <a class="navbar_brand" href="dipendente_home.php"><nobr><b>Scuderia Torino</b></nobr></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="mostra_magazzino_dip.php">Magazzino</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="notifica_a_admin.php">Notifiche</a>
        </li>
        <li class="nav-item">
          <a class="nav-link logout" id="logout" href="logout_dipendente.php">Logout</a>
        </li>
      </ul>
      <form action="ricerca_prodotto_dip.php" method="POST" class="d-flex search" role="search">
        <input class="form-control me-2" name="ricerca" style="width:250px" type="search" placeholder="Cerca scheda prodotto" aria-label="Search">
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



    <?php
}