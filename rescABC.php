<?php
/*
Archivo:  resABC.php
Objetivo: ejecuta la afectación al personal y retorna a la pantalla de consulta general
Autor:  BAOZ  
*/
include_once("modelo\opAdmin.php");
session_start();

$sErr=""; $sOpe = ""; $sCve = "";
$opAdmin = new opAdmin();

	/*Verificar que exista la sesión*/
	//if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		/*Verifica datos de captura mínimos*/
		//if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
		if(isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])){
			$sOpe = $_POST["txtOpe"];
			$sCve = $_POST["txtClave"];
			$opAdmin->setidAdmin($sCve);
			
			if ($sOpe != "b"){
			//	$imagen=addslashes(file_get_contents($_FILES['image']['tmp_name']));
				///echo $imagen; 
				$opAdmin->setnombre($_POST["txtNombre"]);
				$opAdmin->setApePat($_POST["txtApellidoP"]);
				$opAdmin->setApeMat($_POST["txtApellidoM"]);
				$opAdmin->setuser($_POST["txtUser"]);
                $opAdmin->setsalario($_POST["txtSalario"]);
                $opAdmin->setemail($_POST["txtEmail"]);
				$opAdmin->setrfc($_POST["txtRfc"]);
				$opAdmin->setturno($_POST["turno"]);
				$opAdmin->setcontraseña(["txtContraseña"]);
				$opAdmin->settarjeta($_POST["txtTarjeta"]);
				$opAdmin->settelefono($_POST["txtTelefono"]);
			}
			try{
				if ($sOpe == 'a')
					$nResultado = $opAdmin->insertar();
				else if ($sOpe == 'b')
					$nResultado = $opAdmin->borrar();
				else 
					$nResultado = $opAdmin->modificar();
				
				if ($nResultado !=-1){
					$sError = "Error en bd";
				}
			}catch(Exception $e){
				//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
				error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
				$sErr = "Error en base de datos, comunicarse con el administrador".$e->getFile()." ".$e->getLine()." ".$e->getMessage();
			}
		}
		else{
			$sErr = "Faltan datos";
		}
	/*}
	else
		$sErr = "Falta establecer el login";
	*/
	if ($sErr == "")
		header("Location: tablaCocineros.php");
	else
		header("Location: error.php?sError=".$sErr);
	exit();
?>