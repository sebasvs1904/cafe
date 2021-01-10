<?php
include_once("modelo\opAdmin.php");
//if(isset($_SESSION['user_id'])){
    //header('Location: /ProgWeb2020/cafeteriaprog/CafeteriaAuth/'); //Esta instrucción es para cuando el usuario ya ha ingresado a su cuenta
                                            //ya no pueda regresar a la ventana de logIn ya que sería ilógico.
//}
/*
require 'modelo/AccesoDatos.php'; 

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT idadmin, email, password1 FROM administrador WHERE email=:email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password1']))  {
        $_SESSION['user_id'] = $results['idadmin'];
        header('Location: /ProgWeb2020/cafeteriaprog/CafeteriaAuth');
    } else {
        $message = '<p style="color: red">!Contraseña Incorrecta!</p> Verifica nuevamente tus credenciales';
    }
}*/
$sErr="";
$sCve="";
$sNom="";
$sPwd="";	
$oUsu = new opAdmin();
    /*Verificar que hayan llegado los datos*/
	if (isset($_POST["email"]) && !empty($_POST["email"]) &&
		isset($_POST["password"]) && !empty($_POST["password"])){
		$sCve = $_POST["email"];
		$sPwd = $_POST["password"];
		$oUsu->setemail($sCve);
		$oUsu->setcontraseña($sPwd);
		try{
			if ( ($oUsu->iniciar()))
                $sErr = "Usuario desconocido".$oUsu->getemail()."".$oUsu.getcontraseña();
            

		}catch(Exception $e){
			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			$sErr = "Error al acceder a la base de datos".$e->getFile()." ".$e->getLine()." ".$e->getMessage();
		}
	}
	else
		$sErr = "Faltan datos";
	
	if ($sErr == "")
		header("Location: tablaProductos.php");
	else
		header("Location: error.php?sError=".$sErr);
?>
