<?php
session_start();
if(!isset($_SESSION["cliente"])){
    header('location:login.php');
}else{
  $f=$_SESSION["cliente"]
    ?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home cliente </title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      
    </head>
    
      
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar admin" style="margin-top:-10px;">
      <div class="container-fluid">
      <a class="nav-item" href="cliente_home.php"><nobr><b>Scuderia Torino</b></nobr></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="navbar-brand" id="lavori_cliente" aria-current="page" href="lavori_cliente.php">Lavori</a>
            </li>

            <?php
          $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
          $x="SELECT utenti.nome, utenti.cognome, utenti.email, lavori_eliminati.vettura, lavori_eliminati.descrizione
          FROM utenti
          INNER JOIN lavori_eliminati ON lavori_eliminati.email=utenti.email
          WHERE lavori_eliminati.email='$f'";
          $q=mysqli_query($conn,$x);
          if(mysqli_num_rows($q)>0){
            ?>
          <li class="nav-item">
            <a class="nav-link" href="lavori_conclusi.php"><nobr>Lavori conclusi</nobr></a>
            </li>
            <?php
          }
          ?>

            <li class="nav-item">
              <a class="nav-link" href="servizio_clienti.php">Servizio clienti</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link logout" href="logout_cliente.php">Logout</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>

     <center>
    <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
      
     <?php
      $conn=mysqli_connect("localhost","root","","scuderia torino");
     
      $x="SELECT lavori.nome_cliente,lavori.vettura,lavori.descrizione,utenti.cognome,lavori.stato_lavori  FROM lavori 
          INNER JOIN utenti ON lavori.email=utenti.email
          WHERE utenti.email='$f'";

      $q=mysqli_query($conn,$x);
      if(mysqli_num_rows($q)>0){
        echo "<div id='div_lavori_cliente'>";
      while($row=mysqli_fetch_assoc($q)){
        echo "<h2 style='position:absolute; margin-top:20px; margin-left:45px;'>Nome cliente </h2>";
        echo "<div style='border-top:1.5px solid black; width:12%; position:absolute; margin-left:38px; margin-top:60px;' > </div>";
        echo "<p style='position:absolute; margin-top:80px; margin-bottom:20px; margin-left:90px;'>$row[nome_cliente] $row[cognome]</p>"; 
        echo "<h2 style='position:absolute; margin-top:20px; margin-left:695px;'> Vettura </h2>";
        echo "<div style='border-top:1.5px solid black; width:12%; position:absolute; margin-left:650px; margin-top:60px;' > </div>";
        echo "<p style='position:absolute; margin-top:80px; margin-bottom:20px; margin-left:708px;'> $row[vettura] </p>";
        echo "<h2 style='position:absolute; margin-top:20px; margin-left:1200px;'> Stato lavori </h2>";
        echo "<div style='border-top:1.5px solid black; width:12%; position:absolute; margin-left:1180px; margin-top:60px;'> </div>";
        echo "<p style='position:absolute; margin-top:80px; margin-bottom:10px; margin-left:1240px;'> $row[stato_lavori] </p>";
        echo "<div style='margin-top:20px;'>";
        echo "<h2 style='position:absolute; margin-top:-25px; margin-left:670px;font-size:32px;'> Descrizione </h2>";
        echo "<div style='border-top:1.5px solid black; width:12%; position:absolute; margin-left:650px; margin-top:18px;'> </div>";
        echo "<p style=' padding:30px; margin-top:215px; width:750px; font-size:19px;'> $row[descrizione] </p>";
        echo "</div>";
     
      }
      echo "</div>";
    }else{
      ?>
      <div class="no_lavori">
        <p class='p_no_lavori'> Non sono presenti lavori in corso </p>
    </div>
    <?php
    }
     ?>
    
    </body>
    </center>
    <?php
}