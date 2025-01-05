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
      
    
</nav>

    <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
      <div id="div_stato_lavori">
        <?php
        if(isset($_COOKIE["fallito"])){   /* alert non eliminato*/
            ?>
         <script>
         window.onload=function(){     
           alert("Errore! Scheda lavori non eliminata correttamente");
         }
         </script>
         <?php
         setcookie("fallito","",time()-1);
      }elseif(isset($_COOKIE["eliminato"])){  /* alert eliminato */
         ?>
         <script> 
         window.onload=function(){
             alert("Scheda lavori eliminata correttamente!");
         }
         </script>
         <?php
         setcookie("eliminato","",time()-1);
      }elseif(isset($_COOKIE["agg_scheda"])){   /* alert aggiunta */
            ?>
            <script>
                window.onload=function(){
                    alert("Scheda lavori aggiunta con successo!");
                }

                </script>
                <?php
                setcookie("agg_scheda","",time()-1);
                
        }elseif(isset($_COOKIE["failed"])){    /* alert non aggiunta*/
            ?>
            <script>
                window.onload=function(){
                    alert("Errore! Scheda lavori non aggiunta");
                }
                </script>
                <?php
               setcookie("failed","",time()-1);

        }else{

        }
        
        if(isset($_COOKIE["descrizione"])){  /* non funziona avvviso */
            echo "Descizione modificata correttamente!";
                setcookie("descrizione","",time()-1);
        }
        if(isset($_COOKIE["stato_lavori"])){  /* non funziona avvviso */
            ?>
            <script> 
          
                alert("Hai modificato lo stato lavori della scheda lavori di <?php echo $_COOKIE["stato_lavori"]; ?>");
            
            </script>
            <?php
            setcookie("stato_lavori","",time()-1);
        }
        ?>
     





        <?php
        $conn=mysqli_connect("localhost","root","","scuderia torino");
        $x="SELECT * FROM lavori";
        $q=mysqli_query($conn,$x);
        if(mysqli_num_rows($q)>0){
            ?>
              <form action="lista_utenti.php" method="POST" class="d-flex search" role="search" id="search_stato_lavori"> 
               <input type="text" name="ricerca" style="width:400px; margin-left:10px;" class="form-control me-2" placeholder="cerca per cliente, per vettura o per stato lavori">
               <button type="submit" class="btn btn-outline-success" value="cerca">Cerca</button> 
              </form>
        <table class="table" id="table_stato_lavori">
    
            <th><center> Nome cliente </center></th><th><center> Vettura </center></th> <th><center> Email </center></th><th><center> Stato lavori</center></th>
            <?php
            while($row=mysqli_fetch_assoc($q)){
                echo "<tr>";
                echo "<td> $row[nome_cliente] </td><td> $row[vettura] </td><td> $row[email] </td><td> $row[stato_lavori] </td>";
                ?>
                <div>
            <td id="notable"> <form action="scheda_lavori_personale_admin.php" method="POST"> 
                <input type="hidden" name="research" id="table_bottoni" value="<?php echo $row['id_lavoro']; ?>"><button type="submit" class="btn btn-outline-secondary" title="Clicca qui per dettagli" class="buttons_tabella" value="dettagli">Dettagli </button></form></td>
                </div>
                <div>
                <td id="notable"><form action="elimina_scheda.php" method="POST"> 
                  <input type="hidden" name="elimina" value="<?php echo $row['id_lavoro'];?>"> 
                  <input type="hidden" name="nome_cliente" value="<?php echo $row['nome_cliente'];?>"> 
                  <input type="hidden" name="vettura" value="<?php echo $row['vettura'];?>">
                  <input type="hidden" name="email" value="<?php echo $row['email'];?>">
                  <input type="hidden" name="descrizione" value="<?php echo $row['descrizione'];?>">
                  <input type="hidden" name="stato_lavori" value="<?php echo $row['stato_lavori'];?>">
                <button type="submit" class="btn btn-outline-danger" title="Clicca qui per eliminare scheda lavori" value="elimina">Elimina</button></form> </td>
                </div>
                <?php
                echo "</tr>";

            }
            
            echo "</table>";
            ?>
         
            <center>
                <form action="aggiungi_scheda.php" method="POST">
                     <button type="submit" id="bottone_stato_lavori" class="btn btn-outline-primary" value="aggiungi"> Aggiungi nuova scheda lavori </button>
                </form>
            </center>
      <?php
        }else{
          ?>
          <center>
            <div id="stato_lavori_no_lavori">
              <p id="p_no_lavori"> Non sono presenti veicoli in lavorazione </p>
        </div>
        <center>
                <form action="aggiungi_scheda.php" method="POST">
                     <button type="submit" id="bottone_stato_lavori" class="btn btn-outline-primary" value="aggiungi"> Aggiungi nuova scheda lavori </button>
                </form>
            </center>
        </center>
        <?php
        }
         ?> 
    
      </div>
  </body>
<?php

}