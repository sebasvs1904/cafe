<?php
/*
Archivo:  abcPersHosp.php
Objetivo: edición sobre Personal Hospitalario
Autor:    
*/
include_once("modelo\opCliente.php");
require_once("modelo\Direccion.php");
require_once("modelo\Tarjeta.php");
//session_start();

$sErr=""; $sOpe = ""; $sCve = ""; $sNomBoton ="Borrar";
$opCliente=new opCliente();
$bCampoEditable = false; $bLlaveEditable=false;

//$oPersHosp = new PersonalHospitalario();
	/*Verificar que haya sesión
	if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		/*Verificar datos de captura*/
		if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"])){
			
			$sCve = $_POST["txtClave"];
                $opCliente->setidCli($sCve);
                echo $opCliente->getidCli();
				try{
					if (!$opCliente->buscar()){
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
 <div class="formu">
                    <div class="pagina">
                    <div class="encabezado">
					Mostar cliente
			</div>
                    <div class="mostrar">
                    <form name="abcPH" action="rescABC.php" method="post" enctype="multipart/form-data">
               <table border=1> 
                <tr>
                    <th colspan="3"><h2>Datos personales</h2></th>
                   </tr>
                   <tr>
                   <th>Nombre completo</th>
                   <td colspan="2" ><p><?php echo $opCliente->getNombreCompleto();?></p></td>
                </tr>
                  
                <tr>
                   <th colspan="2">E-mail</th>
                  <th >Numero de Telefono
                </tr>
                <tr>
                   <td colspan="2"><p ><?php echo $opCliente->getemail();?></p></td>
                   <td><p><?php echo $opCliente->gettelefono();?></p></td>
                </tr>
        
				<input type="submit" name="Submit" value="Regresar" 
				 onClick="abcPH.action='tablaClientes.php';">    
                <tr>
                <th colspan="3">
                <h3>Tarjetas</h3>
                </th>
                </tr>
                <tr>
                <th>#</th>
                <th>Numero de Tarjeta</th>
                <th> CVV </th>
               </tr> 
              

                <?php
                $tar=new Tarjeta;
                $tar=$opCliente->gettarjeta();
                $c=0;
                if ($tar!=null){
                    foreach ($tar as $key ) {
                ?> 
                  <tr>
                <td> <p><?php echo ++$c; ?></p></td>
                <td> <p><?php echo $key->getnTarjeta(); ?></p></td>
                <td> <p> *****</p></td>
                </tr>
                <?php       
                    }
                }
                $dir= new Direccion;
                $dir=$opCliente->getdireccion();
                $d=0;
                if ($dir!=null){
                    foreach ($dir as $key ) {
                ?>
                <tr>
                <th colspan="3"> Direccion #<?php echo ++$d; ?></th>
                </tr>
                <tr>
                <th>Codigo Postal</th>
                <th>Ciudad </th>
                <th> Colonia</th>
                </tr>
                <tr>
                <td><p> <?php echo $key->getcp(); ?></td>
                <td><p> <?php echo $key->getciudad(); ?></td>                
                <td><p> <?php echo $key->getcolonia(); ?></td>
                </tr>
                <tr>
                <th colspan="2"> Calle</th>
                <th> Num. Casa</th>
                </tr>
                <tr>
                <td colspan="2"> <?php echo $key->getcalle();?></td>
                <td> <?php echo $key->getnCasa();?></td>
                </tr>
                <?php       
                    }
                }
                ?>
                        </table>
			</form>
			</div>
                    </div>
                   </div>
<?php
//include_once("pie.html");
//onClick="return evalua(txtNombre, txtApePat, rbSexo, txtFecNacim);"
?>