<?php
require_once("modelo/opAdmin.php");
$sErr="";
$sEmail="";
$sNom="";
$sPwd="";	
$oUsu = new opAdmin();
if (isset($_POST["email"]) && !empty($_POST["email"]) &&
		isset($_POST["password"]) && !empty($_POST["password"])){
            $sEmail=$_POST["email"];
            $sPwd=$_POST["password"];
            $oUsu->setemail($sEmail);
            $oUsu->setcontraseña($sPwd);
            
                if($oUsu->registrar(1)!=1)
                $sErr="El correo ya existe";

        }else
		$sErr = "Faltan datos";	
	if ($sErr == "")
		header("Location: tablaProductos.php");
	else
		header("Location: error.php?sError=".$sErr);
?>