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
          <a class="navbar-brand current_page" href="modifica_magazzino.php">Modifica magazzino</a>
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
      
    
</nav>
<body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
   <?php
   if(isset($_COOKIE["aggiunto"])){  /* se aggiunto un nuovo prodotto */
      ?>
      <script type="text/javascript">
         window.onload =function(){
            alert("Hai aggiunto un nuovo prodotto!");
         }
         </script>
         <?php
         setcookie("aggiunto","",time()-1);
   }
      if(isset($_COOKIE["nome_elimina_prod"])){   /* se prodotto eliminato */
      ?>
      <script type="text/javascript">
         window.onload=function(){
          alert("Hai eliminato il prodotto: <?php echo $_COOKIE['nome_elimina_prod']; ?>");
         }
         </script>
         <?php
         setcookie("nome_elimina_prod","",time()-1);
      }

      if(isset($_COOKIE['nome_prod_mod'])){         /* se è presente il cookie con il nome prodotto parte  l'alert con js */
      ?>
     <script type="text/javascript">         
      window.onload= function(){
         alert("Hai modificato la quantita' in magazzino di <?php echo $_COOKIE['nome_prod_mod']; ?>");
      
      }
      </script>
      <?php
      setcookie("nome_prod_mod","",time()-1);
     }
   
     echo "<center>";
    $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione non riuscita!");



    $x="SELECT * FROM magazzino";

    $q=mysqli_query($conn,$x);
   
    ?>
    <div id="div_modifica_magazzino">
    <?php
    if(mysqli_num_rows($q)>0){
            ?>
            <table id="tablee" class="table">
            <th><center>Nome prodotto</center></th> <th><center>Fornitore</center></th> <th><center>Azienda produttrice</center></th> <th><center>Prezzo (€)</center></th> <th><center>Unità in sede</center></th>  <th><center>Soglia di avviso</center></th>
            <?php
         while($row=mysqli_fetch_assoc($q)){
            ?>
               <tr>
               <td><?php echo $row["nome_prodotto"]; ?> </td><td> <?php echo $row["fornitore"]; ?> </td>
               <td> <?php echo $row["azienda_produttrice"]; ?> </td><td><?php echo $row["prezzo"]; ?> </td>
               <td><?php echo $row["unità_sede"]; ?> </td>
               <td><?php echo $row["soglia_avviso"]; ?> </td>
               <div id="quantità">
               <td id="notable"><form action="modifica_quantità.php" method="POST"> <input type="hidden"  name="modifica" value="<?php echo $row['id_prodotto']; ?>"> <button type="submit" class="btn btn-outline-secondary" title="clicca per modificare quantità" value="modifica quantità">Modifica quantità</button></form></td>
               </div>
               <div id="elimina_bottone">
               <td  id="notable"><form action="elimina_prodotto.php" method="POST"> <input type="hidden" name="elimina" value="<?php echo $row['id_prodotto']; ?>"> <button type="submit" class="btn btn-outline-danger" title="clicca per eliminare prodotto" value="elimina prodotto">Elimina prodotto</button></form> </td>
               </div>
               </tr>
            <?php

         }
         ?>
            </table>
            <br>
            <?php
            
      }else{
        echo "Non sono presenti prodotti nel magazzino!";
     
       

    }
    echo "<br>";
    ?>
    <form action="inserisci_prodotto.php" method="POST">
    
    <button type="submit" id="bottone_modifica_magazzino"class="btn btn-outline-primary">Inserisci un nuovo prodotto</button>
  </form>
    <?php
    
   
   
    ?>
   
    <?php
echo "</center>";
?>
</div>
<body>
  <?php
}