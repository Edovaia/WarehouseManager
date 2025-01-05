<?php
 ?>
 <!DOCTYPE html>
 <head>
    <html lang="it">
    <link rel="stylesheet" type="text/css" href="style_admin.css?ts=<?=time()?>&quot">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body background="immagini\DSC_0474_PS_2_senza-scritta.jpg">
    <div id="div_confirm_register">
    <?php
if(!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["mail"]) && !empty($_POST["password"]) && !empty($_POST["tipologia"])){
    $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione non riuscita!");

        
   echo "<center>";
   $v="SELECT * FROM utenti WHERE email='$_POST[mail]'";

   $qv=mysqli_query($conn,$v);
   if(mysqli_num_rows($qv)>0){
    echo "<p class='p_register'>";
    echo "Il tuo indirizzo mail è già stato associato ad un altro account!";
    echo "<br>";
    echo "Effettua il <a href='login.php'> Login </a>";
    echo "</p>";
      mysqli_close($conn); /* chiudo perche errore */
   }else{
     
        if($_POST["password"]==$_POST["password2"]){
                $x="INSERT INTO utenti(nome,cognome,email,password,tipologia) VALUES('$_POST[nome]','$_POST[cognome]','$_POST[mail]','$_POST[password]',$_POST[tipologia])";

                $q=mysqli_query($conn,$x);
     
                if($q){
                    echo "<p class='p_register'>";
                    echo "Benvenuto ".$_POST["nome"]." ".$_POST["cognome"]." "."ti sei registrato correttamente!";
                    echo "<br>";
                    echo "Utilizza la tua mail e la tua password per <a href='login.php'> accedere </a>";
                    echo "</p>";
                   mysqli_close($conn);  /* chiudo perche registrato */
                }else{
                    echo "<p class='p_register'>";
                    echo "errore!";
                    echo "</p>";
                    mysqli_close($conn);   /* chiudo perche errore */
                }
     
        }else{
            echo "<p class='p_register'>";
            echo "Le due password non coincidono!";
            echo "<br>";
            echo "<a href='register.php'> Riprova</a>";
            echo "</p>";
            mysqli_close($conn);   /* chiudo perche errore */
            
        }

    }




}else{ 
    echo "<p class='p_register'>";
    echo "Uno o più paramentri sono mancanti.";
    echo "<br>";
    echo "<a href='login.php'> Riprova </a>";
    echo "</p>";
}
?>
</div>
</body>
</center>
