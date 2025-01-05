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
    <a class=" nav-link" href="admin_home.php"> <nobr><b>Scuderia Torino</b></nobr></a>
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
      
    <center>
    <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
    <div id="div_aggiungi_scheda">

    <form action="confirm_aggiungi_scheda.php" method="POST" autocomplete="on">

  <div class="form-row">
    <div class="col">
      <input type="text" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey" name="nome" placeholder="nome cliente" required>
    </div>
    <div class="col">
      <input type="email" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey" name="email" placeholder="indirizzo email" required>
    </div>
        </div>
  <div class="form-row ">
    <div class="col">
      <input type="text" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey " name="vettura" placeholder="vettura" required>
    </div>
    <div class="col">
      <!--
      <input type="text" class="form-control form_aggiungi " style="width:320px; border:0.5px solid grey" name="stato_lavori" placeholder="stato lavorazione" require> 
        -->
        <select class="form-select form-select-lg mb-3" name="stato_lavori" style="margin-top:42px; width:330px; height:35px;" aria-label=".form-select-lg example" required>
        <option selected>Stato lavori </option>
      <option value="Da iniziare"> Da iniziare </option>
      <option value="In preparazione"> In preparazione </option>
      <option value="Smontaggio"> Smontaggio </option>
      <option value="Verniciatura"> Verniciatura </option>
      <option value="Rimontaggio"> Rimontaggio </option>
      <option value="In attesa"> In attesa di ritiro </option>
    </select><br>
    </div> <br>
    </div>
      <div>
    <textarea class="form-control" maxlenght="255" id="textarea_form_aggiungi" style="margin-top:30px; border:0.5px solid grey; height:60px;" name="descrizione" placeholder="Inserisci una descrizione dei lavori da effettuare" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary" id="submit_ordina">Invia</button>
     </form>
     </div>




    
        </center>
    </body>
    <?php
}