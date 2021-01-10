<?php
//include_once("modelo\Usuario.php");
include_once("modelo\Aproductos.php");
session_start();
$sErr="";
$sNom="";
$arrPersHosp=null;
$oProductos = new Aproductos();
try{
    $arrP = $oProductos->buscarTodos();
}catch(Exception $e){
    //Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
    error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
    $sErr = "Error en base de datos, comunicarse con el administrador";
}
?>
 <link rel="stylesheet" href="assets/css/centrodividido.css">
 <link rel="stylesheet" href="assets/css/tabla.css">
<section id="cuadro">
	<?php
	require_once "footer_admin.html";
	require_once "header_admin.html";
	require_once "nav-admin.html";
	?>
                <div class="formu">
                    <div class="pagina">
                    <div class="encabezado">
			Productos
			</div>
                    <div class="mostrar">
			<form name="formTablaGral" method="post" action="abcProductos.php">
				<input type="hidden" name="txtClave">
				<input type="hidden" name="txtOpe">
				<table border=1 >
					<tr>
						<th>Clave</th>
						<th>Nombre</th>
						<th>Imagen</th>
						<th>Descripcion</th>
						<th>Operaci&oacute;n</th>
					</tr>
					<?php
						if ($arrP!=null){
							foreach($arrP as $oProductos){
					?>
					<tr>
						<td class="llave"><?php echo $oProductos->getidProducto(); ?></td>
						<td><?php echo $oProductos->getnombre(); ?></td>
						<td><img src="data:image/jpg;base64,<?php echo base64_encode($oProductos->getimage())?>"></td>
						<td><?php echo $oProductos->getdescripcion(); ?></td>
						<td>
							<input type="submit" name="Submit" value="Modificar" onClick="txtClave.value=<?php echo $oProductos->getidProducto(); ?>; txtOpe.value='m'">
							<input type="submit" name="Submit" value="Borrar" onClick="txtClave.value=<?php echo $oProductos->getidProducto(); ?>; txtOpe.value='b'">
						</td>
					</tr>
					<?php 
							}//foreach
						}else{
					?>     
					<tr>
						<td colspan="2">No hay datos</td>
					</tr>
					<?php
						}
					?>
				</table>
				<br>
				<input type="submit" name="Submit" value="Crear Nuevo" onClick=" txtClave.value='-1';txtOpe.value='a'">
			</form>
			</div>
                    </div>
                   </div>
		</section>