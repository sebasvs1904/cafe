<?php
/*
Archivo:  resABC.php
Objetivo: ejecuta la afectación al personal y retorna a la pantalla de consulta general
Autor:  BAOZ  
*/
include_once("modelo\Aofertas.php");
session_start();

$sErr=""; $sOpe = ""; $sCve = "";
$Aofertas = new Aofertas();

	/*Verificar que exista la sesión*/
	//if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		/*Verifica datos de captura mínimos*/
		//if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
		if(isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])){
			$sOpe = $_POST["txtOpe"];
			$sCve = $_POST["txtClave"];
			$Aofertas->setcodigo($sCve);
			
			if ($sOpe != "b"){
				//$imagen=addslashes(file_get_contents($_FILES['image']['tmp_name']));
				///echo $imagen; 
				$Aofertas->setnombre($_POST["txtNombre"]);
				$Aofertas->setprecio($_POST["txtPrecio"]);
				$Aofertas->setdescripcion($_POST["txtDescripcion"]);
				//$Aofertas->setfechaCaducidad(DateTime::createFromFormat('Y-m-d', $_POST["txtFechaC"]));
               // $Aofertas->setcodigo($_POST["txtCantidad"]);
                $Aofertas->setidp($_POST["txtidp"]);
                $Aofertas->setidp2($_POST["txtidp2"]);
				//$Aofertas->setingredientes($_POST["txtIngrediente"]);
				//$Aofertas->setimage($imagen);
			}
			try{
				if ($sOpe == 'a')
					$nResultado = $Aofertas->insertar();
				else if ($sOpe == 'b')
					$nResultado = $Aofertas->borrar();
				else 
					$nResultado = $Aofertas->modificar();
				
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
		header("Location: tablaOfertas.php");
	else
		header("Location: error.php?sError=".$sErr);
	exit();
?>