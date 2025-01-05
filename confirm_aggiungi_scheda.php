<?php
session_start();

include("function.php");
admin();
  
    $conn=mysqli_connect("localhost","root","","scuderia torino");
    $q="SELECT * FROM lavori WHERE email='$_POST[email]'";
    $qx=mysqli_query($conn,$q);
    if(mysqli_num_rows($qx)>0){
       ?>
       <body background="immagini\DSC_0277.jpg">
        <div id="div_confirm_aggiungi_scheda">
        <p> E' già presente una scheda lavori associata a questo indirizzo email </p>
       
    </div>
    </body>
    <?php
    }else{
    $x="INSERT INTO lavori(nome_cliente,email,vettura,descrizione,stato_lavori) VALUES ('$_POST[nome]', '$_POST[email]','$_POST[vettura]',
    '$_POST[descrizione]','$_POST[stato_lavori]')";
    $q=mysqli_query($conn,$x);
    if($q){
        setcookie("agg_scheda","1",time()+60*60*60);
        header('location:stato_lavori.php');

    }else{
        setcookie("failed","0",time()+60*60*60);
        header('location:stato_lavori.php');
    }
}
