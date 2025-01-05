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
      <a class="nav-link" aria-current="page" id="indietro" href="mostra_magazzino.php"> Indietro </a>
        <a class="nav-link" href="admin_home.php"><nobr><b>Scuderia Torino</b></nobr></a>
       
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="navbar-brand" aria-current="page" href="mostra_magazzino.php">Magazzino</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="modifica_magazzino.php">Modifica magazzino</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="stato_lavori.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
          
        
      
      </nav>
      <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
        <div id="div_cerca_prodotto">
      
    <?php 
    $conn=mysqli_connect("localhost","root","","scuderia torino");
    $x="SELECT * FROM magazzino WHERE nome_prodotto='$_POST[cerca]' || azienda_produttrice='$_POST[cerca]' || fornitore='$_POST[cerca]'";

    $q=mysqli_query($conn,$x);

    if(mysqli_num_rows($q)>0){
        ?>
     
        <table class="table" id="table_cerca_prodotto">
        <th><center> Nome prodotto </center></th> <th><center> Fornitore </center></th> <th><center> Azienda produttrice </center></th> <th><center> Prezzo (€) </center></th> <th><center> Unità in sede </center></th>  <th><center> Soglia di avviso </center></th>
        <?php
        while($row=mysqli_fetch_assoc($q)){
         ?>
         <tr>
          <?php
        echo  "<td> 
            <a role='button' id='cerca_prodotto_link' title='clicca qui per vedere la scheda tecnica' href='scheda_tecnica.php?id_prodotto=$row[id_prodotto]'>  $row[nome_prodotto]  </a></td>"; ?>
         <td> <?php echo $row["fornitore"]; ?> </td>
            <td> <?php echo $row["azienda_produttrice"]; ?> </td><td><?php echo $row["prezzo"]; ?> </td>
            <td><?php echo $row["unità_sede"]; ?> </td>
            <td><?php echo $row["soglia_avviso"]; ?> </td>
        </tr>
        <?php
        }
        ?>
        </table>
   
        <?php
    }else{
      ?>
      <div id="div_error_cerca_prodotto">
        <p id="error"> Il nome del prodotto o dell'azienda produttrice selezionata non è presente nel magazzino! </p>
    </div> 
      <?php
    }
   
    ?>
    </div>
   </body>
 <?php
}

