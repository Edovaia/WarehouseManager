<?php
session_start();
if(!isset($_SESSION["cliente"])){
    header('location:login.php');
}else{
  $f=$_SESSION["cliente"]
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
    
      
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar admin" style="margin-top:-10px;">
      <div class="container-fluid">
      <a class="nav-item" href="cliente_home.php"><b>Scuderia Torino</b></a>
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
            <a class="navbar-brand" href="lavori_conclusi.php"><nobr>Lavori conclusi</nobr></a>
            </li>
            <?php
          }
          ?>

            <li class="nav-item">
              <a class="nav-link" href="servizio_clienti.php">Servizio clienti</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link logout" href="logout_cliente.php">Logout</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>

     <center>
    <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
    <div id="div_lavori_passati_cliente">
        <?php
      $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
      $x="SELECT lavori_eliminati.id_lavoro, lavori_eliminati.nome_cliente, lavori_eliminati.vettura, lavori_eliminati.descrizione
      FROM lavori_eliminati
      INNER JOIN utenti ON lavori_eliminati.email=utenti.email
      WHERE utenti.email='$f'";
      
      $q=mysqli_query($conn,$x);
      if(mysqli_num_rows($q)>0){
        $w="SELECT * FROM lavori_eliminati WHERE email='$f'";
        $qw=mysqli_query($conn,$w);
        ?>
        <form action="lavoro_passato_selezionato.php" method="POST">
        <select class="form-select form-select-lg mb-3" name="lavori_eliminati" style="margin-top:50px; width:330px; height:35px;" aria-label=".form-select-lg example" required>
        <option selected>Elenco lavori passati </option>
         
        <div class="col">
        <?php
        while($row=mysqli_fetch_assoc($qw)){
          ?>
          <option value="<?php echo $row['id_lavoro']; ?>"> <?php echo $row["vettura"];?> </option>
          <?php
      }
          ?>
          </select><br>
        
          <button type="submit" class="btn btn-primary" id="submit_ordina">Seleziona</button>
          </form>
          </div> <br>
              <?php
      }else{
        ?>
        <div class="no_lavori">
          <p class='p_no_lavori'> Non sono presenti lavori in corso </p>
      </div>
      <?php
      }
      ?>
    </div>
    </body>
    </center>
       <?php
}
?>