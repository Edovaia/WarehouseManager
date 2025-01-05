<?php
session_start();
if(!isset($_SESSION["cliente"])){
    header('location:login.php');
}else{
  $f=$_SESSION["cliente"];
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
    <style>
        .carousel-item img {
          max-height: 300px;
          margin: auto;
        }
      </style>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar admin" style="margin-top:-10px;">
      <div class="container-fluid">
      <a class="nav-item" href="cliente_home.php"><nobr><b>Scuderia Torino</b></nobr></a>
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
            <a class="nav-link" href="lavori_conclusi.php"><nobr>Lavori conclusi</nobr></a>
            </li>
            <?php
          }
          ?>

            <li class="nav-item">
              <a class="navbar-brand" href="servizio_clienti.php">Servizio clienti</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link logout" href="logout_cliente.php">Logout</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
    <?php
    if(isset($_COOKIE["richiesta_inv"])){
      ?>
     <script type="text/javascript">
        window.onload=function richiesta(){
           alert("La richiesta è stata inviata correttamente!");
        }
        </script>
        <?php
        setcookie("richiesta_inv","",time()-1);
      }

      if(isset($_COOKIE["richiesta_no_inv"])){
        ?>
        <script type="text/javascript">
        window.onload=function no_notifica(){
         alert("La rischiesta non è stata inviata correttamente!");
        }
        </script>
        <?php
      }
      ?>
    <center>
    <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
      <div id="div_servizio_clienti">
     <form action="servizio_clienti_form.php" method="POST">
     <div class="form-floating">
     <textarea class="form-control" maxlenght="255" name="richiesta" placeholder="inserisci la tua richiesta" id="floatingTextarea2" style="height: 150px; width:650px; padding:20px; margin-top:60px;  margin-bottom:25px; color:black;"></textarea>
     </div>

    <button type="submit" title="invia richiesta" style="margin-bottom:15px; margin-top:5px;" 
    class="btn btn-outline-success transform_button"  value="conferma madifica">Invia richiesta</button>
     </form> 
        </div>
      </div>
      </body>
      </center>


    <?php
}