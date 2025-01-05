<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if(isset($_POST["send"])){
    $mail=new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host= 'smtp.gmail.com';
    $mail->Username= 'edoardovaiarelli99@gmail.com';
    $mail->Password='xvzasngrgyyiugud';
    $mail->SMTPSecure='ssl';
    $mail->Port= 465;
    $mail->SMTPAuth = true;

    $mail->setFrom('edoardovaiarelli99@gmail.com');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject= $_POST["subject"];
    $mail->Body= $_POST["message"];

    $mail->send();
   
    ?>

    <script>
    var conferma=alert("L'ordine è stato inviato!");
    if(conferma===true){
      location.href='mostra_magazzino.php';
    }else{
        location.href='mostra_magazzino.php';
    }
    </script>
    <?php

}else{
  echo "Errore, impossibile inviare l'email d'ordine";
  header('refresh:3;url=ordina_prodotto.php');
}


?>