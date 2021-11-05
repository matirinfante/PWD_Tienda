<?php
class Producto{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $mensajeoperacion;

    public function __construct(){
        $this->idproducto="";
        $this->pronombre="";
        $this->prodetalle="";
        $this->procantstock=null;
        $this->mensajeoperacion="";
    }
    
    public function getIdproducto(){
        return $this->idproducto;
    } 
    public function setIdproducto($idproducto){
        $this->idproducto = $idproducto;

        return $this;
    }
    public function getPronombre(){
        return $this->pronombre;
    }
    public function setPronombre($pronombre){
        $this->pronombre = $pronombre;

        return $this;
    }
    public function getProdetalle(){
        return $this->prodetalle;
    }
    public function setProdetalle($prodetalle){
        $this->prodetalle = $prodetalle;

        return $this;
    }
    public function getProcantstock(){
        return $this->procantstock;
    } 
    public function setProcantstock($procantstock){
        $this->procantstock = $procantstock;

        return $this;
    }      
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idproducto, $pronombre, $prodetalle, $procantstock){
        $this->setIdproducto($idproducto);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProcantstock($procantstock);
    }  
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM producto WHERE idproducto = ".$this->getIdproducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: ".$base->getError());
        }
        return $resp;
        
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO producto(pronombre, prodetalle, procantstock) VALUES(".$this->getPronombre()."," . $this->getProdetalle() . "," . $this->getProcantstock() . ");";
        
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdproducto($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE producto SET pronombre='{$this->getPronombre()}', prodetalle = '{$this->getProdetalle()}',procantstock='{$this->getProcantstock()}' WHERE idproducto=".$this->getIdproducto();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("Producto->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM producto WHERE idproducto =".$this->getProdetalleestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM producto ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock']);
                    array_push($arreglo, $obj);
                }
                
            }
            
        } else {
            // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
        }
        
        return $arreglo;
    }
        
}

?>