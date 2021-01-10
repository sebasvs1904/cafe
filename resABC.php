<?php
/*
Archivo:  resABC.php
Objetivo: ejecuta la afectación al personal y retorna a la pantalla de consulta general
Autor:  BAOZ  
*/
include_once("modelo\Aproductos.php");
session_start();

$sErr=""; $sOpe = ""; $sCve = "";
$oProductos = new Aproductos();

	/*Verificar que exista la sesión*/
	//if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		/*Verifica datos de captura mínimos*/
		//if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
		if(isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])){
			$sOpe = $_POST["txtOpe"];
			$sCve = $_POST["txtClave"];
			$oProductos->setidProducto($sCve);
			
			if ($sOpe != "b"){
				$imagen=addslashes(file_get_contents($_FILES['image']['tmp_name']));
				///echo $imagen; 
				$oProductos->setnombre($_POST["txtNombre"]);
				$oProductos->setprecio($_POST["txtPrecio"]);
				$oProductos->setdescripcion($_POST["txtDescripcion"]);
				$oProductos->setfechaCaducidad(DateTime::createFromFormat('Y-m-d', $_POST["txtFechaC"]));
                $oProductos->setcantidad($_POST["txtCantidad"]);
                $oProductos->setcantidad($_POST["txtCantidad"]);
                $oProductos->setcategoria($_POST["Categoria"]);
				$oProductos->setingredientes($_POST["txtIngrediente"]);
				$oProductos->setimage($imagen);
			}
			try{
				if ($sOpe == 'a')
					$nResultado = $oProductos->insertar();
				else if ($sOpe == 'b')
					$nResultado = $oProductos->borrar();
				else 
					$nResultado = $oProductos->modificar();
				
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
		header("Location: tablaProductos.php");
	else
		header("Location: error.php?sError=".$sErr);
	exit();
?>