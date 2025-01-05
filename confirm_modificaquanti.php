<?php
session_start();

if(!isset($_SESSION["admin"])){
    header('location:login.php');
}else{

    $conn=mysqli_connect("localhost","root","","scuderia torino") or die("Connessione fallita!");
    $id=$_COOKIE["id_modifica"]; 
    $v="SELECT nome_prodotto FROM magazzino WHERE id_prodotto=$id";
    $qv=mysqli_query($conn,$v);
    while($rows=mysqli_fetch_assoc($qv)){
    setcookie("nome_prod_mod","$rows[nome_prodotto]",time()+60*60);            /* creo cookie con nome prodotto modificato, così da fare alert*/
    }
        
    $quantità=$_POST['mod_quanti'];
    $x="UPDATE magazzino SET unità_sede=unità_sede+ $quantità WHERE id_prodotto=$id";
    $q=mysqli_query($conn,$x);

    if($q){
        setcookie("id_modifica","",time()-1);     
        header('location:modifica_magazzino.php');
    }else{
        echo "Errore!";
        echo "<br>";
        echo "<a href='modifica_magazzino.php'> Riprova </a>";
    }

}