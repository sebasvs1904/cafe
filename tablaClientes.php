<?php
//include_once("modelo\Usuario.php");
include_once("modelo\opCliente.php");
session_start();
$sErr="";
$sNom="";
$arrPersHosp=null;
$opCliente = new opCliente();
try{
    $arrP = $opCliente->buscarTodos();
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
			Clientes 
			</div>
                    <div class="mostrar">
			<form name="formTablaGral" method="post" action="mostrarCliente.php">
				<input type="hidden" name="txtClave">
			
				<table border=1 >
					<tr>
						<th>id</th>
						<th>Nombre completo</th>
						<th>E-mail</th>
						<th>Operaci&oacute;n</th>
					</tr>
					<?php
						if ($arrP!=null){
							foreach($arrP as $opCliente){
					?>
					<tr>
						<td class="llave"><?php echo $opCliente->getidCli(); ?></td>
						<td><?php echo $opCliente->getNombreCompleto(); ?></td>
						<td> <?php echo $opCliente->getemail(); ?>
						<td>
							<input type="submit" name="Submit" value="Mostrar" onClick="txtClave.value=<?php echo $opCliente->getidCli(); ?>;">
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