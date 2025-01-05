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
  <div id="div_scheda_lavori_personale_admin">
<?php
    



     $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
   
     $x="SELECT * FROM lavori WHERE id_lavoro='$_POST[research]'";
     $q=mysqli_query($conn,$x);
     ?>
     <center>
      <?php
     while($row=mysqli_fetch_assoc($q)){
        ?>
       <h3 style='margin-top:10px; margin-bottom:5px;'> Descrizione </h3><br>
         <p style="width:700px; "><?php echo $row["descrizione"]; echo "<br>";?></p>
         <?php echo "<button type='submit' title='modifica descrizione' id='bottone_stato_lavori' class='btn btn-outline-primary transform_button'>  <a class='a_scheda_lavori' href='modifica_scheda_lavori.php?id_lavoro=$row[id_lavoro]&&descrizione=$row[descrizione]'> Modifica descrizione </a>  </button>";
          echo "<button type='submit' title='modifica stato lavori' style='margin-left:10px;'id='bottone_stato_lavori' class='btn btn-outline-primary transform_button'>  <a class='a_scheda_lavori' href='modifica_scheda_lavori.php?id_lavoro=$row[id_lavoro]&&stato_lavori=$row[stato_lavori]'> Modifica stato lavori </a>  </button>";
          ?><br>
          <button type='submit' title='elimina scheda' id='bottone_stato_lavori_elimina' class='btn btn-outline-primary transform_button'>  <a class='a_scheda_lavori_elimina' href='modifica_scheda_lavori.php?id_lavoro=$row[id_lavoro]&&descrizione=$row[descrizione]'> Elimina scheda lavori </a>  </button>
      
          <?php

     }
 

 
  ?>
</center>
    </div>
 </body>
   
<?php
}