<?php
session_start();
if(!isset($_SESSION["cliente"])){


    header('location:login.php');
}else{
    ?>
    <!DOCTYPE html>
        <html lang="it">
            <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Logout cliente</title>
                    
                    <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            
            </head>
 <?php   
    session_destroy();
    ?>
    <body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
<center>
    <div class="div_logout_admin">


<p class="logout_admin">Hai effettuato il logout correttamente</p>
<?php
    header('refresh:3;url=login.php');
?>
    </div>
  </body>
<?php
}

?>