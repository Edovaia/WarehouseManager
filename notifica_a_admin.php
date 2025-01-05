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
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
          <a class="nav-link" aria-current="page" href="mostra_magazzino_dip.php">Magazzino</a>
        </li>
       
        <li class="nav-item">
          <a class="navbar-brand" href="notifica_a_admin.php">Notifiche</a>
        </li>
        <li class="nav-item">
          <a class="nav-link logout" href="logout_dipendente.php">Logout</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    <?php
    if(isset($_COOKIE["invio_notifica"])){
       ?>
       <script type="text/javascript">
        window.onload=function notifica(){
          alert("Hai inviato correttamente la notifica ordine");
        
        }
        </script>
        <?php
        setcookie("invio_notifica","",time()-1);
        
    }
    ?>
   <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
<div id="div_principale_notifica_a_admin">
   <?php
echo "<center>";
   $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita");

   $x="SELECT * FROM magazzino ORDER BY nome_prodotto ASC";

   $q=mysqli_query($conn,$x);

   if(mysqli_num_rows($q)>0){
   ?>
   <p style="margin-left:10px; font-size:25px; margin-top:30px"> Seleziona i prodotti da ordinare </p>
   <div class='riga_notifica'>
   </div>
   <br>
      <form action="invia_notifica_admin.php" method="POST">
      <?php
      while($row=mysqli_fetch_assoc($q)){ ?>     
      <input class="w3-check " type="checkbox" name="ordina[]" style="margin-left:10px; margin-bottom:30px;" 
      value="<?php echo $row["id_prodotto"]; ?>"><label><p style="margin-left:15px"><?php echo "Nome prodotto:<b>"." ".$row["nome_prodotto"]." "."</b>Quantita' in 
      magazzino:<b>"." ".$row["unità_sede"]."</b>"; ?> </p></label>

      <br> 
<?php
      }  
      ?>
     
     <button type="submit" title="clicca qui per notificare l'ordine" id="button_ordina_notifiche_a_admin" class="btn btn-outline-success"  value="Ordina">Ordina</button>
      </form>
    <?php
   }else{
     ?>
      <div id="notifica_a_admin">
      <center>
      <?php
      echo "Non sono presenti prodotti nel magazzino";
     
    ?>
    </center>
    </div>
    <?php
   }
    ?>
   </div>
   </body>
   <?php
  }
  echo "</center>";