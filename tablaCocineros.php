<?php
//include_once("modelo\Usuario.php");
include_once("modelo\opAdmin.php");
session_start();
$sErr="";
$sNom="";
$arrPersHosp=null;
$opAdmin = new opAdmin();
try{
    $arrP = $opAdmin->buscarTodosC(2);
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
			Cocineros 
			</div>
                    <div class="mostrar">
			<form name="formTablaGral" method="post" action="abcCocineros.php">
				<input type="hidden" name="txtClave">
				<input type="hidden" name="txtOpe">
				<table border=1 >
					<tr>
						<th>id</th>
                        <th>Nombre completo</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>RFC</th>
                        <th> turno</th>
                        <th>Salario</th>
						<th>Operaci&oacute;n</th>
					</tr>
					<?php
						if ($arrP!=null){
							foreach($arrP as $opAdmin){
					?>
					<tr>
						<td class="llave"><?php echo $opAdmin->getidaAmin(); ?></td>
                        <td><?php echo $opAdmin->getNombreCompleto(); ?></td>
                        <td><?php echo $opAdmin->getemail(); ?> </td>
                        <td><?php echo $opAdmin->gettelefono(); ?> </td>
                        <td><?php echo $opAdmin->getrfc(); ?> </td>
                        <td><?php echo $opAdmin->getturno(); ?> </td>
                        <td><?php echo $opAdmin->getsalario(); ?> </td>
						<td>
							<input type="submit" name="Submit" value="Modificar" onClick="txtClave.value=<?php echo $opAdmin->getidaAmin(); ?>; txtOpe.value='m'">
							<input type="submit" name="Submit" value="Borrar" onClick="txtClave.value=<?php echo $opAdmin->getidaAmin(); ?>; txtOpe.value='b'">
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
                <input type="submit" name="Submit" value="Agregar Cocinero" onClick="txtClave.value='-1';txtOpe.value='a'">

			</form>
			</div>
                    </div>
                   </div>
		</section>