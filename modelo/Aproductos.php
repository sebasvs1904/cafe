<?php
include_once ("AccesoDatos.php");
include ("Productos.php");
class Aproductos extends Productos 
{
    private $idProducto=0;
    //private $fechaActu;
    function setidProducto($ps){
        $this->idProducto = $ps;
     }
     function getidProducto(){
        return $this->idProducto;
     }
    public function insertar(Type $var = null) {
    $oAccesoDatos=new AccesoDatos();
    $sQuery="";
   
	$nAfectados=-1;
		if ($this->nombre=="" && $this->precio==0 && $descripcion=="" &&  $this->cantidad==0 && $ingrediente==""&& $this->fechaCaducidad==NULL && $this->categoria=="" && $this->image==NULL)
			throw new Exception("AProductos->insertar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
                $fechaActu= date("Y-m-d");
		 		$sQuery = "INSERT INTO productos( nombre, cantidad, precio, 
                 descripcion, categoria,ingredientes, fechaatualizacion, fechacaducacion, imagen) 
					VALUES ('".$this->nombre."', '".$this->cantidad."', 
					'".$this->precio."','".$this->descripcion."','".$this->categoria."','".$this->ingrediente."',
                    '".$fechaActu."', '".$this->fechaCaducidad->format('Y-m-d')."', '".$this->image."');";
                    // 
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();			
			}
		}
		return $nAfectados;
        # code...
    }
    function buscar(){
        $oAccesoDatos=new AccesoDatos();
	    $sQuery="";
	    $arrRS=null;
	    $bRet = false;
            if ($this->idProducto==0)
                throw new Exception("Productos->buscar(): faltan datos");
            else{
                if ($oAccesoDatos->conectar()){
                     $sQuery = "SELECT `nombre`, `cantidad`, `precio`, `descripcion`, `categoria`,
                    `ingredientes`, `imagen`, `fechacaducacion`,`fechaatualizacion` 
                     FROM `productos` WHERE `idproductos`=".$this->idProducto;
                    $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
                    $oAccesoDatos->desconectar();
                    if ($arrRS){
                        //$oProductos = new Aproductos();
                        $this->nombre=$arrRS[0][0];
                        $this->cantidad=$arrRS[0][1];
                        $this->precio=$arrRS[0][2];
                        $this->descripcion=$arrRS[0][3];
                        $this->categoria=$arrRS[0][4];
                        $this->ingrediente=$arrRS[0][5];
                        $this->image=$arrRS[0][6];
                        $this->fechaCaducidad=DateTime::createFromFormat('d-m-Y',$arrRS[0][7]);
                        $this->fechaCaducidad=DateTime::createFromFormat('d-m-Y',$arrRS[0][8]);
                        $bRet = true;
                        
                    }
                } 
            }
            return $bRet;
    }
    public function buscarTodos(Type $var = null)
    {
    $oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$aLinea=null;
	$j=0;
	$oProductos=null;
	$arrResultado=false;
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT `idproductos`, `nombre`, `cantidad`, `precio`, `descripcion`, `categoria`,
              `ingredientes`, `imagen`, `fechacaducacion` FROM `productos`";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$oProductos = new Aproductos();
					$oProductos->setidProducto($aLinea[0]);
					$oProductos->setnombre($aLinea[1]);
					$oProductos->setcantidad($aLinea[2]);
                    $oProductos->setprecio($aLinea[3]);
                    $oProductos->setdescripcion($aLinea[4]);
                    $oProductos->setcategoria($aLinea[5]);
                    $oProductos->setingredientes($aLinea[6]);
                    $oProductos->setimage($aLinea[7]);
					$oProductos->setfechaCaducidad(DateTime::createFromFormat('Y-m-d',$aLinea[8]));
            		$arrResultado[$j] = $oProductos;
					$j=$j+1;
                }
			}
			else
				$arrResultado = false;
        }
		return $arrResultado;
	}
    function modificar(){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $nAfectados=-1;
            if ($this->nombre=="" && $this->precio==0 && $descripcion=="" &&  $this->cantidad==0 && $ingrediente==""&& 
            $this->fechaCaducidad==NULL && $this->categoria=="" && $this->image==NULL)
                throw new Exception("Productos->modificar(): faltan datos");
            else{
                if ($oAccesoDatos->conectar()){
                    $fechaActu= date("Y-m-d");
                     $sQuery = "UPDATE productos SET 
                     nombre='".$this->nombre."',
                     cantidad='".$this->cantidad."',
                     precio='".$this->precio."',
                     descripcion='".$this->descripcion."',
                     categoria='".$this->categoria."',
                     ingredientes='".$this->ingrediente."',
                     imagen='".$this->image."',
                     fechaatualizacion='".$fechaActu."',
                     fechacaducacion='".$this->fechaCaducidad->format('Y-m-d')."' 
                     WHERE  idproductos = ".$this->idProducto;
                    $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                    $oAccesoDatos->desconectar();
                }
            }
            return $nAfectados;
        }
        function borrar(){
            $oAccesoDatos=new AccesoDatos();
            $sQuery="";
            $nAfectados=-1;
                if ($this->idProducto==0)
                    throw new Exception("Productos->borrar(): faltan datos");
                else{
                    if ($oAccesoDatos->conectar()){
                         $sQuery = "DELETE FROM productos 
                                    WHERE idproductos = ".$this->idProducto;
                        $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                        $oAccesoDatos->desconectar();
                    }
                }
                return $nAfectados;
            }
            function buscarP($id){
                $oAccesoDatos=new AccesoDatos();
                $sQuery="";
                $arrRS=null;
                $oProductos=null;
                $bRet = false;
                    if ($id==0)
                        throw new Exception("Productos->buscar(): faltan datos");
                    else{
                        if ($oAccesoDatos->conectar()){
                             $sQuery = "SELECT `nombre`, `cantidad`, `precio`, `descripcion`, `categoria`,
                            `ingredientes`, `imagen`, `fechacaducacion`,`fechaatualizacion`,`idproductos`
                             FROM `productos` WHERE `idproductos`=".$id;
                            $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
                            $oAccesoDatos->desconectar();
                            if ($arrRS){
                                $oProductos = new Aproductos();
                               // 
                                $oProductos->setnombre($arrRS[0][0]);
                                $oProductos->setcantidad($arrRS[0][1]);
                                $oProductos->setprecio($arrRS[0][2]);
                                $oProductos->setdescripcion($arrRS[0][3]);
                                $oProductos->setcategoria($arrRS[0][4]);
                                $oProductos->setingredientes($arrRS[0][5]);
                                $oProductos->setimage($arrRS[0][6]);
                                $oProductos->setfechaCaducidad(DateTime::createFromFormat('d-m-Y',$arrRS[0][7]));
                                $oProductos->setfechaCaducidad(DateTime::createFromFormat('d-m-Y',$arrRS[0][8]));
                                $oProductos->setidProducto($arrRS[0][9]);
                               
                                
                            }
                        } 
                    }
                    return $oProductos;
            }
}


?>
