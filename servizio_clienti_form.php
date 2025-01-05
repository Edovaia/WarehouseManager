<?php
session_start();
if(!isset($_SESSION["cliente"])){
    header('location:login.php');
}else{
    $f=$_SESSION["cliente"];
    $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
    $c="SELECT * FROM utenti WHERE email='$f'";
    $qc=mysqli_query($conn,$c);
   if(mysqli_num_rows($qc)>0){
    while($row=mysqli_fetch_assoc($qc)){
        $nome=$row['nome'];
        $cognome=$row['cognome'];
    }
   }


    $x="INSERT INTO richieste (email_cliente,richiesta,nome_cliente,cognome_cliente) VALUES ('$f','$_POST[richiesta]','$nome','$cognome')";
    $q=mysqli_query($conn,$x);

    if($q){
        setcookie("richiesta_inv","0",time()+60*60*60);
        header('location:servizio_clienti.php');
    }else{
        setcookie("richiesta_no_inv","1",time()+60*60*60);
        header('location:servizio_clienti.php');
    }
}