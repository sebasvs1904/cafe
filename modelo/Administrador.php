
<?php
class Administrador{
	protected $sNombre="";
	protected $sApePat="";
    protected $sApeMat="";
    protected $telefono="";
    protected $rfc="";
    protected $salario="";
   protected $turno="";
   protected $tarjeta="";
	//protected $dFechaNacim=null;
   //protected $sSexo="";
   function settarjeta($ps){
      $this->tarjeta = $ps;
   }
   function gettarjeta(){
      return $this->tarjeta;
   }
   function setturno($ps){
      $this->turno = $ps;
   }
   function getturno(){
      return $this->turno;
   }
   function setsalario($ps){
      $this->salario = $ps;
   }
   function getsalario(){
      return $this->salario;
   }
   function setrfc($ps){
      $this->rfc = $ps;
   }
   function getrfc(){
      return $this->rfc;
   }
    function setNombre($psNombre){
       $this->sNombre = $psNombre;
    }
    function getNombre(){
       return $this->sNombre;
    }
   
    function setApePat($psApePat){
       $this->sApePat = $psApePat;
    }   
    function getApePat(){
       return $this->sApePat;
    }
   
    function setApeMat($psApeMat){
       $this->sApeMat = $psApeMat;
    }
    function getApeMat(){
       return $this->sApeMat;
    }
    
    function settelefono($pstelefono){
        $this->telefono = $pstelefono;
     }
     function gettelefono(){
        return $this->telefono;
     }
	function getNombreCompleto(){
		return $this->sApePat." ".$this->sApeMat." ".$this->sNombre;
	}
}
?> 