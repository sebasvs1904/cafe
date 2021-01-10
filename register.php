<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets\css\styles.css">
    <link rel="stylesheet" href="assets\css\fontello.css">
    <link rel="stylesheet" href="assets\css\estilos.css">     
</head>
<body>
    <?php// require 'modelo/header.php'?> 
<!-- La siguiente instrucción mandará un mensaje el cual se concatena de la linea 14 o 16, segun sea el caso!-->
    <?php if(!empty($message)): ?>
      <p><?= $message ?></p>
    <?php endif; ?>

    <h1>Registro</h1>
    <span>O <a href="login.php">Ingresa a tu cuenta</a></span>
    
    <form action="registro.php" method="POST">
        <input type="text" name="email" placeholder="Ingresa tu email"> 
        <input type="password" name="password" placeholder="Ingresa tu contraseña">
        <input type="password" name="confirm_password" placeholder="Confirma tu contraseña">
        <input type="submit" value="Enviar">
    </form>
</body>
<?php
include_once("COFFE PLACE- Foot.html");
?>
</html>