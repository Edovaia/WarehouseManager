<?php


?>
<!DOCTYPE html> 

<head>

    <link rel="stylesheet" href="style_register.css?ts=<?=time()?>&quot" type="text/css">
   
</head>

<body>
    <center>
        <div id="form_register"> 
            <p> <h1 id="benvenuto"> CREA IL TUO ACCOUNT </h1> </p>
            <div id="riga">

            <div>
            <form action="confirm_register.php" method="POST">
            

                

                <input type="mail" id="email" name="mail" placeholder="indirizzo mail" required> <br>

                <input type="text" id="nome" name="nome" placeholder="nome" required>
                
                <input type="text" id="cognome" name="cognome" placeholder=" cognome" required><br>
                
               
                <input type="password"  id="password" name="password" placeholder="password" required>
                
                <input type="password" id="password2" name="password2" placeholder="conferma password" required> <br>
                <input type="radio" name="tipologia" id="radio" value="1"> Cliente privato 
                <input type="radio" name="tipologia" id="radio" value="2"> Azienda 
                <input type="radio" name="tipologia" id="radio" value="3" > Dipendente <br>
                <br>

                <button type="submit" id="bottone_submit" class="btn btn-outline-primary" value="registrati"> <p id="registrati">Registrati </p></button>
                

            </form>
        



            <p id="accedere">Sei già registrato? Clicca qui per <a href="login.php"> accedere </a> </p>
        </div>

    <center>

</body>



