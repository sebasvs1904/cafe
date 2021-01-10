<?php
//include_once("modelo\Usuario.php");
include_once("modelo\opPedidos.php");
session_start();
$sErr="";
$sNom="";
$arrPersHosp=null;
$opPedidos = new opPedidos();
try{
    $arrP = $opPedidos->buscarTodos();
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
	require "nav-admin.html";
	?>
                <div class="formu">
                    <div class="pagina">
                    <div class="encabezado">
			Pedidos
			</div>
                    <div class="mostrar">
			<form name="formTablaGral" method="post" action="mostrarPedidos.php">
				<input type="hidden" name="txtClave">
			
				<table border=1 >
					<tr>
						<th>Folio</th>
						<th>Fecha</th>
						<th>Operaci&oacute;n</th>
					</tr>
					<?php
						if ($arrP!=null){
							foreach($arrP as $opPedidos){
					?>
					<tr>
						<td class="llave"><?php echo $opPedidos->getfolio(); ?></td>
						<td> <?php echo $opPedidos->getfecha(); ?>
						<td>
							<input type="submit" name="Submit" value="Mostrar" onClick="txtClave.value=<?php echo $opPedidos->getfolio(); ?>;">
							<!--input type="submit" name="Submit" value="Borrar" onClick="txtClave.value=<?//php echo $oClientes->getidCliente(); ?>; txtOpe.value='b'">--->
						</td>
					</tr>
					<?php 
							}//foreach
						}else{
					?>     
					<tr>
						<td colspan="3">No hay datos</td>
					</tr>
					<?php
						}
					?>
				</table>
				<br>
				
			</form>
			</div>
                    </div>
                   </div>
		</section>