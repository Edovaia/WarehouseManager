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
   <div id="div_principale_mostra_magazzino_dip">
  <div id="div_form_mostra_magazzino_dip">
        <form action="cerca_magazzino_dip.php" method="POST" class="d-flex search" role="search">          <!-- form cerca prodotto-->
          <input type="text" name="cerca" style="width:400px; margin-left:8px" class="form-control me-2" id="cerca" aria-label="Search" placeholder="inserisci nome prodotto o azienda produttrice"> 
          <button type="submit" class="btn btn-outline-success" value="cerca">Cerca</button> 
         </form>
      </div>
      <br><br>
<?php

    $conn=mysqli_connect("localhost","root","","scuderia torino");


    $x="SELECT * FROM magazzino";
    $q=mysqli_query($conn,$x);
    if(mysqli_num_rows($q)>0){

        ?>
        <table class="table" id="table_mag_dip">
        <th><center> Nome prodotto </center></th> <th><center> Fornitore </center></th> <th><center> Azienda produttrice </center></th> <th><center> Prezzo (€) </center></th> <th><center> Unità in sede </center></th> 
        <?php
        while($row=mysqli_fetch_assoc($q)){
            ?>
            <tr><?php
            echo "<td><a role='button' id='mostra_magazzino_dip_link' title='clicca qui per vedere la scheda tecnica' href='scheda_tecnica_dip.php?id_prodotto=$row[id_prodotto]'> $row[nome_prodotto] </a></td>"; ?>
               <td> <?php echo $row["fornitore"]; ?> </td>
              <td> <?php echo $row["azienda_produttrice"]; ?> </td><td><?php echo $row["prezzo"]; ?> </td>
              <td><?php echo $row["unità_sede"]; ?> </td>
              
            </tr>
               <?php
              
        }
        ?>
        </table>
        <?php
    
    }else{
        echo "Non sono presenti prodotti nel magazzino!";
    }
?>
</div>
</body>
<?php  
}