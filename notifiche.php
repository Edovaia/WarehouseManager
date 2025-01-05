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
    <a class="nav-link" href="admin_home.php"><nobr><b>Scuderia Torino</b></nobr></a>
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
          <a class="nav-link" href="stato_lavori.php">
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
            <a class="navbar-brand" href="notifiche.php">Notifiche</a><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $number;?> </span>
            <?php
          }else{
          ?>
          <a class="navbar-brand" href="notifiche.php">Notifiche</a>
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
      <div id="div_notifiche">
  <?php

 $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
 if(isset($_COOKIE["notifica_eliminata"])){    /*se c'è cookie di elimina notifica*/
  ?>
  <script type="text/javascript">   
    window.onload= function elimina(){
    alert("Hai eliminato la notifica di ordine del prodotto: <?php echo $_COOKIE['notifica_eliminata']; ?>");
    }
    </script>
  <?php
  setcookie("notifica_eliminata","",time()-1);
 }

$x="SELECT * FROM notifiche";
$q=mysqli_query($conn,$x);
if(mysqli_num_rows($q)>0){
  $xq="SELECT magazzino.id_prodotto,nome_prodotto,fornitore,azienda_produttrice,prezzo,unità_sede,soglia_avviso      /* inner join per associare all'id_prodotto in notifiche il prodotto corrispondente in magazzino*/
  FROM magazzino
  INNER JOIN notifiche ON magazzino.id_prodotto=notifiche.id_prodotto
  ORDER BY nome_prodotto";
  $qv=mysqli_query($conn,$xq);
  if(mysqli_num_rows($qv)>0){
   echo "<table class='table' id='table_ordina'>";
   echo "<th><center> Nome prodotto </center></th><th><center> Fornitore </center></th><th><center> Azienda produttrice </center></th> <th><center> Prezzo </center></th> <th><center> Unità in sede </center></th> <th><center> Soglia di avviso </center></th>";
   while($row=mysqli_fetch_assoc($qv)){
    ?>
    <tr>
    <td><?php echo $row["nome_prodotto"]; ?> </td><td> <?php echo $row["fornitore"]; ?> </td>
    <td> <?php echo $row["azienda_produttrice"]; ?> </td><td><?php echo $row["prezzo"]; ?> </td>
    <td><?php echo $row["unità_sede"]; ?> </td>
    <td><?php echo $row["soglia_avviso"]; ?> </td>
    <td id="notable"><form action="ordina_prodotto.php" method="POST"> <input type="hidden"  name="ordina" value="<?php echo $row['id_prodotto']; ?>"> 
    <button type="submit" value="ordina"  class="btn btn-outline-success" title='clicca per ordinare' onclick="var conferma=window.alert('Vuoi procedere con l`ordine del prodotto: <?php echo $row['nome_prodotto']; ?> ?');"> Ordina </button>
    </form></td>
    <td id="notable"><form action="elimina_notifica_ordine.php" method="POST"> <input type="hidden" value="<?php echo $row['id_prodotto'];?>" name="elimina"> <button type="submit"  class="btn btn-outline-danger" value="submit"> Elimina notifica </button></form></td>
    
    </tr>
    <?php
   }
   echo "</table>";

  }else{

  
  }
   


}else{
  ?>
  <center>
  <div id="div_no_notifiche">
  <p class="no_notifiche_notifiche">Non sono presenti avvisi di notifica acquisto prodotto.</p>
</div>
</center>
<?php
}
?>
</div>
</body>
<?php
}

