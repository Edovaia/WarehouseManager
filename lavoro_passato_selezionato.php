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
      <a class="nav-link" aria-current="page" id="indietro" style="margin-right:20px;" href="lavori_conclusi.php"> Indietro </a>
      <a class="nav-item" href="cliente_home.php"><b>Scuderia Torino</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" id="lavori_cliente" aria-current="page" href="lavori_cliente.php">Lavori</a>
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
            <a class="navbar-brand" href="lavori_conclusi.php"><nobr>Lavori conclusi</nobr></a>
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
<body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
    <center>
     <div id="div_lavoro_passato_selezionato">
        <?php
        $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
        $xv="SELECT lavori_eliminati.nome_cliente, lavori_eliminati.id_lavoro, lavori_eliminati.vettura, lavori_eliminati.email, lavori_eliminati.descrizione, utenti.cognome
        FROM lavori_eliminati
        INNER JOIN utenti ON lavori_eliminati.email=utenti.email 
        WHERE lavori_eliminati.email='$f' && lavori_eliminati.id_lavoro='$_POST[lavori_eliminati]'";
        $qv=mysqli_query($conn,$xv);
        while($row=mysqli_fetch_assoc($qv)){
           
        echo "<h2 style='position:absolute; margin-top:20px; margin-left:45px;'>Nome cliente </h2>";
        echo "<div style='border-top:1.5px solid black; width:12%; position:absolute; margin-left:38px; margin-top:60px;' > </div>";
        echo "<p style='position:absolute; margin-top:80px; margin-bottom:20px; margin-left:90px;'>$row[nome_cliente] $row[cognome]</p>"; 
        echo "<h2 style='position:absolute; margin-top:20px; margin-left:830px;'> Vettura </h2>";
        echo "<div style='border-top:1.5px solid black; width:12%; position:absolute; margin-left:780px; margin-top:60px;'> </div>";
        echo "<div style=' position:absolute; margin-top:80px; margin-bottom:20px; margin-left:835px;'>";
        echo "<p style='padding:1px; '> $row[vettura] </p>";
        echo "</div>";
        echo "<h2 style='margin-top:160px;font-size:32px;'> Descrizione </h2>";
        echo "<div style='border-top:1.5px solid black; width:12%; position:absolute;  margin-left:405px; margin-top:2px;'> </div>";
        echo "<p style='margin-top:25px;width:500px;font-size:19px;'>$row[descrizione] </p>";


       } 
       ?>
       </div>
        </body>
        </center>
        <?php
        }
  
        