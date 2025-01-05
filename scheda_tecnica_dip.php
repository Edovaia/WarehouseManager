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
                   <title>Navbar Magazzino</title>
                   
                   <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
                   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
           
           </head>
       <nav class="navbar navbar-expand-lg bg-body-tertiary navbar" style="margin-top:-10px;">
     <div class="container-fluid">
     
     <a class="nav-link" aria-current="page" id="indietro" href="mostra_magazzino_dip.php"> Indietro </a>
       <a class="nav-link" href="dipendente_home.php"><nobr><b>Scuderia Torino</b></nobr></a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           <li class="nav-item">
             <a class="navbar-brand" aria-current="page" href="mostra_magazzino_dip.php">Magazzino</a>
           </li>
          
           <li class="nav-item">
             <a class="nav-link" href="notifica_a_admin.php">Notifiche</a>
           </li>
           <li class="nav-item">
             <a class="nav-link logout" href="logout_dipendente.php">Logout</a>
           </li>
         </ul>
        
       </div>
     </div>
   </nav>
    

    <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
      <div id="div_scheda_tecnica_dip">
      <center>
     <?php
     
     $conn=mysqli_connect("localhost","root","","scuderia torino");
     $x="SELECT * FROM magazzino WHERE id_prodotto='$_GET[id_prodotto]'";
     $q=mysqli_query($conn,$x);
     if(mysqli_num_rows($q)>0){
        while($row=mysqli_fetch_assoc($q)){
           
            ?>
          
         
          <h4 style="margin-top:20px;">Descrizione</h4>
          <div class="riga_descrizione">
        </div>
          <p style="margin-bottom:200px; padding:10px;"><?php echo $row["descrizione"]; ?> </p>
         
      
           
 
    <?php
        }
     }else{
        echo "Errore! Il prodotto selezionato non è presente nel magazzino!";
     }
     ?>
     </div>
    </center>
     </body>

     <?php
}