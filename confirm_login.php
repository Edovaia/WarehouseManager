<?php
session_start();
if(!empty($_POST["email"]) && !empty($_POST["password"])){
    ?>
    <!DOCTYPE html>
    <html lang="it">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Dipendente Home</title>
                
                <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        </head>
    
     <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
     <?php
    
      $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione non riuscita!");
        
      $x="SELECT * FROM utenti WHERE email='$_POST[email]' && password='$_POST[password]'";
      $q=mysqli_query($conn,$x);
         if(mysqli_num_rows($q)>0){
             while($row=mysqli_fetch_assoc($q)){
                if($row['tipologia']==0){    /* admin */
                    $_SESSION["admin"]=0;
                    header('location:admin_home.php');
                }elseif($row['tipologia']==1 || $row['tipologia']==2){   /*  Cliente privato e azienda */
                    $_SESSION["cliente"]=$_POST['email'];
                    header('location:cliente_home.php');
                }elseif($row['tipologia']==3){   /* Dipendente */
                    $_SESSION["dipendente"]=3;
                    header('location:dipendente_home.php');
                }else{
                    echo "Errore!";
                    echo "<br>";
                    header('refresh:5;url=login.php');
                    mysqli_close($conn);
                }
             }
         }else{
            ?>
            <center>
            <div id="div_confirm_login">

            <p class="p_confirm_login">Credenziali errate.<p id="text_link_confirm_login"><a  href='login.php'> Riprova </a> </p></p>
            
           </div>
         </center>
          
           <?php
         }
}else{
    ?>
    <center>
    <div id="div_confirm_login">
       <p class="p_confirm_login">Uno o più paramentri sono mancanti.</p>
       
       <a href='login.php'> Riprova </a>
    </div>
</center>
    <?php
}
mysqli_close($conn);
?>

</body>

