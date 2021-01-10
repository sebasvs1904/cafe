<?php
//include_once("modelo\Usuario.php");
include_once("modelo\Aofertas.php");
session_start();
$sErr="";
$sNom="";
$arrPersHosp=null;
$Aofertas = new Aofertas();
try{
    $arrP = $Aofertas->buscarTodos();
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
			Ofertas
			</div>
                    <div class="mostrar">
			<form name="formTablaGral" method="post" action="abcOfertas.php">
				<input type="hidden" name="txtClave">
				<input type="hidden" name="txtOpe">
				<table border=1 >
					<tr>
						<th>Clave</th>
                        <th>Nombre</th>
                        <th>Precio</th>
						<th>Descripcion</th>
						<th>Operaci&oacute;n</th>
					</tr>
					<?php
						if ($arrP!=null){
							foreach($arrP as $Aofertas){
					?>
					<tr>
						<td class="llave"><?php echo $Aofertas->getcodigo(); ?></td>
                        <td><?php echo $Aofertas->getnombre(); ?></td>
                        <td> $<?php echo $Aofertas->getprecio();?></td>
						<td><?php echo $Aofertas->getdescripcion(); ?></td>
						<td>
							<input type="submit" name="Submit" value="Modificar" onClick="txtClave.value=<?php echo $Aofertas->getcodigo(); ?>; txtOpe.value='m'">
							<input type="submit" name="Submit" value="Borrar" onClick="txtClave.value=<?php echo $Aofertas->getcodigo(); ?>; txtOpe.value='b'">
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
				<input type="submit" name="Submit" value="Crear Nuevo" onClick="formTablaGral.action='elegirP.php'; txtClave.value='-1';txtOpe.value='a'">
			</form>
			</div>
                    </div>
                   </div>
		</section>