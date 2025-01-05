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

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
</head>


   <nav class="navbar navbar-expand-lg bg-body-tertiary navbar" style="margin-top:-10px;">

  <div class="container-fluid">
 
  <a class="nav-link" aria-current="page" id="indietro" href="modifica_magazzino.php"> Indietro </a>
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
          <a class="navbar-brand" href="modifica_magazzino.php">Modifica magazzino</a>
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
       <div id="div_modifica_quantità">
    <?php
    $id=$_POST["modifica"];
    setcookie("id_modifica","$id", time()+60*60);      /* cookie con id prodotto da modificare */
    $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
    $x="SELECT * FROM magazzino WHERE id_prodotto=$id";
    $q=mysqli_query($conn,$x);
   

    if(mysqli_num_rows($q)>0){
        ?>
        <table class="table" id="table_modifica_quantità">
        <th>Nome prodotto</th> <th>Fornitore</th> <th>Azienda produttrice</th> <th>Prezzo (€)</th> <th>Unità in sede</th> <th>Soglia di avviso</th>
       <?php
        while($row=mysqli_fetch_assoc($q)){
            
            ?>
            
        <tr>
        <td><?php echo $row["nome_prodotto"]; ?> </td><td> <?php echo $row["fornitore"]; ?> </td>
         <td> <?php echo $row["azienda_produttrice"]; ?> </td><td><?php echo $row["prezzo"]; ?> </td>
         <td><?php echo $row["unità_sede"]; ?> </td>
         <td><?php echo $row["soglia_avviso"]; ?> </td>
        </tr>
        <?php
        }
        ?>
        </table>
        <br> <br>
         <center>
          <div id="form_modifica_quantità">
        <form action="confirm_modificaquanti.php" method="POST"> 
            <input type="number"  id="mod_quantità" name="mod_quanti" placeholder="0"> <button type="submit" class=" btn btn-primary btn-sm " value="modifica quantità"> Modifica quantità </button>
        </form>
      </center>
    <?php
    }else{
        echo "Errore, il prodotto non è presente nel magazzino!";
        echo "<br>";
        echo "<a href='modifica_magazzino.php'>Torna alla pagina precedente </a>";
    }

?>
    </div>
  </body>
<?php  
}