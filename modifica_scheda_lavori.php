<?php
session_start();
if(!isset($_SESSION["admin"])){
 header('location:login.php');
}else{
    ?>

<!DOCTYPE HTML>
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
<a class="nav-link" aria-current="page" id="indietro" href="stato_lavori.php"> Indietro </a>
<a class=" nav-link" href="admin_home.php"><nobr><b>Scuderia Torino</b></nobr></a>
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
      <a class="navbar-brand" href="stato_lavori.php">
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
  <div id="div_modifica_scheda_lavori">
  <center>
    <?php
       
      
     if(isset($_GET["id_lavoro"]) && isset($_GET["stato_lavori"])){      /* se clicchi su modifica stato lavori */
        setcookie("id_lavoro","$_GET[id_lavoro]",time()+60*60*60);       /* cookie per individuare scheda da modificare*/
       ?>
 <h2 style='margin-top:15px'> Modifica stato lavori </h2>
        <form action="confirm_modifica_scheda.php" method="POST">
<select class="form-select form-select-lg mb-3" name="stato_lavori" style="margin-top:20px; width:300px; height:25px;" aria-label=".form-select-lg example">
 
  <option value="Da iniziare"> Da iniziare </option>
  <option value="In preparazione"> In preparazione </option>
  <option value="Smontaggio"> Smontaggio </option>
  <option value="Verniciatura"> Verniciatura </option>
  <option value="Rimontaggio"> Rimontaggio </option>
</select><br>
<button type="submit" title="clicca qui per confermare" style="margin-bottom:15px; margin-top:5px;" class="btn btn-outline-success transform_button"  value="conferma madifica">Conferma modifica</button>
</form>

    <?php
     }elseif(isset($_GET["id_lavoro"])&& isset($_GET["descrizione"])){   /* se clicchi su modifica descrizione */
        setcookie("id_lavoro","$_GET[id_lavoro]",time()+60*60*60); 
        ?>
         <h2 style='margin-top:15px'> Modifica descrizione </h2>
        <form action="confirm_modifica_scheda.php" method="POST">
        <div class="form-floating">
  <textarea class="form-control" placeholder="inserisci nuova descrizione"  name="descrizione" id="floatingTextarea2" style="height: 100px; width:650px; margin:20px; margin-top:25px;"></textarea>
</div>

<button type="submit" title="clicca qui per confermare" style="margin-bottom:15px; margin-top:5px;" class="btn btn-outline-success transform_button"  value="conferma madifica">Conferma modifica</button>
     </form> 
   
     <?php   
    }
      
    /* in realtà sono due pagine indietro*/
    ?>
    </center>
   </div> 
   </body>
   <?php
}