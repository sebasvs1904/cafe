<?php
include_once 'Ofertas.php';
require_once ('AccesoDatos.php');
require_once ('Aproductos.php');
class Aofertas extends Ofertas 
{
    private $idp=0;
    private $idp2=0;
    private $codigo="";
    
    public function getcodigo(){
        return $this->codigo;
   }
   
   public function setcodigo ($var){
       $this->codigo = $var;
   }
   public function getidp(){
    return $this->idp ;
    }

    public function setidp ($var){
    $this->idp = $var;
    }
    public function  getidp2(){
        return $this->idp2 ;
    }

    public function  setidp2 ($var){
    $this->idp2 = $var;
    }
    public function buscarTodos(Type $var = null)
    {
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $arrRS=null;
        $aLinea=null;
        $j=0;
        $Aofertas=null;
        $arrResultado=false;
            if ($oAccesoDatos->conectar()){
                $sQuery = "SELECT `codigooferta`, `nombre`, `Precio`, `descripcion`, `productosidproductos`, `productosidproductos2`
                 FROM `oferta` ";
                $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
                $oAccesoDatos->desconectar();
                if ($arrRS){
                    foreach($arrRS as $aLinea){
                        $Aofertas= new Aofertas;
                        $Aofertas->setcodigo($aLinea[0]);
                        $Aofertas->setnombre($aLinea[1]);
                        $Aofertas->setprecio($aLinea[2]);
                        $Aofertas->setdescripcion($aLinea[3]);
                        $Aofertas->setidp($aLinea[4]);
                        $Aofertas->setidp2($aLinea[5]);
                        $arrResultado[$j] = $Aofertas;
                        $j=$j+1;
                    }
                }
                else
				    $arrResultado = false;
            }
            return $arrResultado;
    }
    function buscar(){
        $oAccesoDatos=new AccesoDatos();
	    $sQuery="";
	    $arrRS=null;
	    $bRet = false;
            if ($this->codigo==0)
                throw new Exception("Productos->buscar(): faltan datos");
            else{
                if ($oAccesoDatos->conectar()){
                     $sQuery = "SELECT  `nombre`, `Precio`, `descripcion`, `productosidproductos`, `productosidproductos2`
                     FROM `oferta` where codigooferta=".$this->codigo;
                    $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
                    $oAccesoDatos->desconectar();
                    if ($arrRS){
                        //$oProductos = new Aproductos();
                        $this->nombre=$arrRS[0][0];
                        $this->precio=$arrRS[0][1];
                        $this->descripcion=$arrRS[0][2];
                        $this->idp=$arrRS[0][3];
                        $this->idp2=$arrRS[0][4];
    
                        
                    }
                } 
            }
            return $bRet;
    }
    public function insertar(Type $var = null) {
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $nAfectados=-1;
            if ($this->nombre=="" && $this->precio==0 && $this->descripcion=="" && $this->idp==""&& $this->idp2=="")
                throw new Exception("Aofertas->insertar(): faltan datos");
            else{
                if ($oAccesoDatos->conectar()){
           //         $fechaActu= date("Y-m-d");
                     $sQuery = "INSERT INTO `oferta`( `nombre`, `Precio`, `descripcion`, `idproductos`, `productosidproductos`, `productosidproductos2`) 
                     VALUES ('".$this->nombre."','".$this->precio."','".$this->descripcion."','".$this->idp."','".$this->idp."','".$this->idp."');";
                        // 
                    $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                    $oAccesoDatos->desconectar();			
                }
            }
            return $nAfectados;
            # code...
        }
        function borrar(){
            $oAccesoDatos=new AccesoDatos();
            $sQuery="";
            $nAfectados=-1;
                if ($this->codigo==0)
                    throw new Exception("Oferta->borrar(): faltan datos");
                else{
                    if ($oAccesoDatos->conectar()){
                         $sQuery = "DELETE FROM `oferta` WHERE `codigooferta` = ".$this->codigo;
                        $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                        $oAccesoDatos->desconectar();
                    }
                }
                return $nAfectados;
            }
            public function modificar()
            {
                $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $nAfectados=-1;
            if ($this->nombre=="" && $this->precio==0 && $this->descripcion=="" && $this->idp==""&& $this->idp2=="")
                throw new Exception("Productos->modificar(): faltan datos");
            else{
                if ($oAccesoDatos->conectar()){
                   // $fechaActu= date("Y-m-d");
                     $sQuery = "UPDATE `oferta` SET 
                     `nombre`='".$this->nombre."',
                     `Precio`='".$this->precio."',
                     `descripcion`='".$this->descripcion."',
                     `idproductos`='".$this->idp."',
                     `productosidproductos`='".$this->idp."',
                     `productosidproductos2`='".$this->idp2."'
                     WHERE  codigooferta = ".$this->codigo;
                    $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                    $oAccesoDatos->desconectar();
                }
            }
            return $nAfectados;
            }

}

?>