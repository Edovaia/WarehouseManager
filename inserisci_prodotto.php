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
  <a class="nav-link" aria-current="page" id="indietro" href="modifica_magazzino.php"> Indietro </a>
    <a class="nav-link" href="admin_home.php"><nobr><b>Scuderia Torino</b></nobr></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="mostra_magazzino.php">Magazzino</a>
        </li>
        <li class="nav-item">
          <a class="navbar-brand" href="modifica_magazzino.php">Modifica magazzino</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="stato_lavori.php">
           Lavori cliente
          </a>
         
        </li>
        <li class="nav-item">
        <?php 
          $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
          $xf="SELECT * FROM notifiche";
          $qf=mysqli_query($conn,$xf);
          if(mysqli_num_rows($qf)>0){
            $number=mysqli_num_rows($qf); ?>
            <a class="navbar-brand no_brand" href="notifiche.php">Notifiche</a><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $number;?> </span>
            <?php
          }else{
          ?>
          <a class="nav-link" href="notifiche.php">Notifiche</a>
          <?php
          }
          ?>
        </li>
        <li class="nav-item">
          <a class="nav-link logout" href="logout_admin.php">Logout</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">



   <div id="div_inserisci_prodotto">
<center>
<form action="confirm_inserisci.php" style="margin-bottom:50px;" method="POST">
<div class="form-row">

    <div class="col" >
      <input type="text" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey" name="nome_prodotto" placeholder="inserisci nome prodotto" required>
    </div>
    <div class="col">
      <input type="text" class="form-control form_aggiungi" style="width:320px;  border:0.5px solid grey;"  name="fornitore" placeholder="inserisci nome fornitore" required>
    </div>
    <div class="col">
      <input type="text" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey " name="azienda_produttrice" placeholder="inserisci azienda produttrice" required>
    </div>

    <div class="form-row">

    <div class="col">
      <input type="number" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey" name="prezzo" placeholder="inserisci il prezzo" required> 
    </div>

    <div class="col">
      <input type="number" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey " name="unità_sede" placeholder="inserisci il numero di unità in sede" required>
    </div>
    <div class="col">
      <input type="number" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey"  name="soglia_avviso"  placeholder="inserisci la soglia di avviso"  required> 
    </div>
   

    <div class="form-row">
    <div class="col">
    <textarea class="form-control form_aggiungi"  style="width:350px; border:0.5px solid grey; height:150px; margin-left:25px;" name="descrizione" maxlenght="255" placeholder="Inserisci una descrizione del prodotto" required></textarea>
    </div>
    <div class="col">
      <textarea class="form-control form_aggiungi"  style="width:350px; margin-left:365px; height:150px; border:0.5px solid grey;" name="utilizzo" maxlength="255" placeholder="Come viene utilizzato il prodotto?"  required></textarea>
    </div>
        </div>
      
        <br> <br>
       <div class="form-row">
       <div class="col" id="inserisci_position_button">
       <button type="submit" class="btn btn-primary" id="submit_ordina2">Aggiungi</button>
       </div>
        </div>
        </form>
        
        </div>

        </body>
        </center>
    <?php

}
