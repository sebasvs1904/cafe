<?php
/*
Archivo:  abcPersHosp.php
Objetivo: edición sobre Personal Hospitalario
Autor:    
*/
include_once("modelo\opPedidos.php");
include_once("modelo\opCliente.php");
//include_once("modelo\Aproductos.php");
//require_once("modelo\Direccion.php");
//require_once("modelo\Tarjeta.php");
//session_start();

$sErr=""; $sOpe = ""; $sCve = ""; $sNomBoton ="Borrar";
$opPedidos=new opPedidos();
$bCampoEditable = false; $bLlaveEditable=false;

//$oPersHosp = new PersonalHospitalario();
	/*Verificar que haya sesión
	if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		/*Verificar datos de captura*/
		if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"])){
			
			$sCve = $_POST["txtClave"];
				$opPedidos->setfolio($sCve);
				
                //echo $opCliente->getidCli();
				try{
					$opPedidos=$opPedidos->buscar();
					if (!$opPedidos){
						$sError = "El cocinero no Existe";
					}
				}catch(Exception $e){
					error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
					$sErr = "Error en base de datos, comunicarse con el administrador";
				}
			}
						//Si fue borrado, nada es editable y es el valor por omisión
		
		//else{
	//		$sErr = "Faltan datos";
		//}
	//}
	else
	//	$sErr = "Falta establecer el login";
	
	if ($sErr == ""){
	//	include_once("cabecera.html");
	//	include_once("menu.php");
	//	include_once("aside.html");
	}
	else{
	//	header("Location: error.php?sError=".$sErr);
	//	exit();
	}
?>
<link rel="stylesheet" href="assets/css/centrodividido.css">
<link rel="stylesheet" href="assets/css/tabla.css">

 <div class="formu">
                    <div class="pagina">
                    <div class="encabezado">
					Mostar Detalles del pedido
			</div>
                    <div class="mostrar">
                    <form name="abcPH" action="tablaPedidos.php" method="post" enctype="multipart/form-data">
               <table border=1> 
                <tr>
                    <th colspan="6"><h2>Datos personales del cliente</h2></th>
                   </tr>
                   <tr>
				   <th colspan="2">Nombre completo</th>
				   <?php
				   $opCliente=new opCliente() ;
				   $opCliente=$opPedidos[0]->getcliente();
				   ?>
                   <td colspan="4" ><p><?php echo $opCliente->getNombreCompleto();?></p></td>
				</tr>
				<tr>
				  <th>E-mail</th>
				  <td colspan="3"><p><?php echo $opCliente->getemail();?></p></td>
				  <th>Telefono</th>
				  <td><p><?php echo $opCliente->gettelefono();?></p></td>
				</tr>
				<tr>
                    <th colspan="6"><h2>Productos del pedido</h2></th>
                   </tr>
				<tr>
					<th> Nombre Producto </th>
					<th>Imagen</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Descripcion</th>
					<th>Total </td>
				</tr>
				<?php
				$total=0;
				foreach ($opPedidos as $key) {
				
							?>
				<tr>
				<td> <?php echo $key->getnombre();?> </td>
				<td><img src="data:image/jpg;base64,<?php echo base64_encode($key->getimage())?>"></td>
				<td><?php echo $key->getprecio();?></td>
				<td><?php echo $key->getcantidad();?></td>
				<td><?php echo $key->getdescripcion();?></td>
				<td><?php echo ($key->getcantidad()*$key->getprecio());$total=$total+($key->getcantidad()*$key->getprecio());?></td>

				</tr>
				
				<?php
					
				}?>
				<tr>
				<td colspan="5">Total </td>
				<td colspan="5"><?php echo $total?> </td>

</tr>
				<tr>
				<td colspan="6"><input type="submit" name="Submit" value="Regresar"/> </td>

</tr>
				

