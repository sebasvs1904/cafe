<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/fontello.css">
    
</head>

<body>
    <?php //require 'modelo/header.php'
     //background="assets/img/cafecito.webp"?>
    <h1>¡Te damos la bienvenida a Coffee Place&#174 !</h1>
    <h2>Login</h2>
    <span>O <a href="register.php">Registrate</a></span>

    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form action="iniciar.php" method="POST">
        <input type="text" name="email" placeholder="Ingresa tu email">
        <input type="password" name="password" placeholder="Ingresa tu contraseña">
        <input type="submit" value="Enviar">
    </form>
</body>
<?php
include_once("COFFE PLACE- Foot.html");
?>
</html>