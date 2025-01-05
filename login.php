<?php




?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tabella.css?ts=<?=time()?>&quot">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
  <body background="immagini\DSC_3688_sfumato.jpg">


<div class="wrapper fadeInDown">
  <div id="formContent">
   

 

    <!-- Login Form -->
    <form action="confirm_login.php" method="POST">
      <input type="text" id="login" class="fadeIn second top" name="email" placeholder="inserisci email">
      <input type="text" id="password" class="fadeIn third" name="password" placeholder="inserisci password">
      <input type="submit" id="submit" class="fadeIn fourth" value="Login">
    </form>

    
    <div id="formFooter">
      <a class="underlineHover" href="register.php">Crea un account</a>
    </div>

  </div>
</div>
</body>
</html>