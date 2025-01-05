<?php
session_start();

if(!isset($_SESSION["admin"])){
    header('location:login.php');
}else{
    $conn=mysqli_connect("localhost","root","","scuderia torino");
    $n="SELECT * FROM magazzino WHERE nome_prodotto='$_POST[nome_prodotto]'";
    $qn=mysqli_query($conn,$n);
            if(mysqli_num_rows($qn)>0){
                echo "Il prodotto"." ".$_POST["nome_prodotto"]." "."è gia presente nel magazzino!";
                echo "<br>";
                echo "Clicca <a href='inserisci_prodotto.php'> qui </a> per inserire un nuovo prodotto";
            }else{

    
                $x="INSERT INTO magazzino (nome_prodotto,fornitore,azienda_produttrice,prezzo,unità_sede,soglia_avviso,descrizione,utilizzo)
                VALUES('$_POST[nome_prodotto]','$_POST[fornitore]','$_POST[azienda_produttrice]',$_POST[prezzo], $_POST[unità_sede], '$_POST[soglia_avviso]','$_POST[descrizione]','$_POST[utilizzo]')";
                $q=mysqli_query($conn,$x);

                if($q){
                    setcookie("aggiunto","1",time()+60*60);
                    header('location:modifica_magazzino.php');
                }else{
                    echo "Errore!";
                    echo "<br>";
                    echo "Clicca <a href='inserisci_prodotto.php'> qui </a> per riprovare!";
                }
            }
}