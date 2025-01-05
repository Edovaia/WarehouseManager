<?php
session_start();

if(!isset($_SESSION["admin"])){
    header('location:login.php');
}else{
    if(!isset($_POST["elimina"]) && !isset($_POST["descrizione"])){
        $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
        $x="INSERT INTO lavori_eliminati (nome_cliente,vettura,email,descrizione,stato_lavori) VALUES ('$_POST[nome_cliente]', '$_POST[vettura]','$_POST[email]','$_POST[descrizione]','$_POST[stato_lavori]')";
        $v=mysqli_query($conn,$x);


        $elimina=$_POST['elimina'];
        $e="DELETE FROM lavori WHERE id_lavoro=$elimina";
        $q=mysqli_query($conn,$e);
            if($q){
                setcookie("eliminato","1",time()+60*60*60);
                header('location:stato_lavori.php');
            }else{
                setcookie("fallito","1",time()+60*60*60);
                header('location:stato_lavori.php');
            }
    }else{
        header('location:stato_lavori.php');
    }
}