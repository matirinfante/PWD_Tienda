<?php
class CompraItem{
    private $idcompraitem;
    private $idproducto;
    private $idcompra;
    private $cicantidad;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompraitem="";
        $this->idproducto="";
        $this->idcompra="";
        $this->cicantidad=null;
        $this->mensajeoperacion="";
    }
    
    public function getIdcompraitem(){
        return $this->idcompraitem;
    } 
    public function setIdcompraitem($idcompraitem){
        $this->idcompraitem = $idcompraitem;

        return $this;
    }
    public function getIdproducto(){
        return $this->idproducto;
    }
    public function setIdproducto($idproducto){
        $this->idproducto = $idproducto;

        return $this;
    }
    public function getIdcompra(){
        return $this->idcompra;
    }
    public function setIdcompra($idcompra){
        $this->idcompra = $idcompra;

        return $this;
    }
    public function getCicantidad(){
        return $this->cicantidad;
    } 
    public function setCicantidad($cicantidad){
        $this->cicantidad = $cicantidad;

        return $this;
    }      
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompraitem, $idproducto, $idcompra, $cicantidad){
        $this->setIdcompraitem($idcompraitem);
        $this->setIdproducto($idproducto);
        $this->setIdcompra($idcompra);
        $this->setCicantidad($cicantidad);
    }  
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem WHERE idcompraitem = ".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idcompraitem'], $row['idproducto'], $row['idcompra'], $row['cicantidad']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("CompraItem->listar: ".$base->getError());
        }
        return $resp;
        
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraitem(idproducto, idcompra, cicantidad) VALUES(".$this->getIdproducto()."," . $this->getIdcompra() . "," . $this->getCicantidad() . ");";
        
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompraitem($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraItem->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraItem->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraitem SET idproducto='{$this->getIdproducto()}', idcompra = '{$this->getIdcompra()}',cicantidad='{$this->getCicantidad()}' WHERE idcompraitem=".$this->getIdcompraitem();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("CompraItem->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraItem->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraitem WHERE idcompraitem =".$this->getIdcompraestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraItem->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraItem->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idcompraitem'], $row['idproducto'], $row['idcompra'], $row['cicantidad']);
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