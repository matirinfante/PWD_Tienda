<?php
class Compra{
    private $idcompra;
    private $cofecha;
    private $idusuario;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompra="";
        $this->cofecha=null;
        $this->idusuario="";
        $this->mensajeoperacion="";
    }
    public function getIdcompra(){
        return $this->idcompra;
    }
    public function setIdcompra($valor){
        $this->idcompra = $valor;
    }

    public function getCofecha(){
        return $this->cofecha;
    }
    public function setCofecha($valor){
        $this->cofecha = $valor;
    }

    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($valor){
        $this->idusuario = $valor;
    }
    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompra, $cofecha, $idusuario){
        $this->setIdcompra($idcompra);
        $this->setCofecha($cofecha);
        $this->setIdusuario($idusuario);
    }
    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compra WHERE idcompra = ".$this->getIdcompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idcompra'], $row['cofecha'], $row['idusuario']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Compra->listar: ".$base->getError());
        }
        return $resp;
        
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compra(cofecha, idusuario)  VALUES(".$this->getCofecha()."," . $this->getIdusuario() . ");";
        echo $sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompra($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compra SET cofecha='{$this->getCofecha()}', idusuario = '{$this->getIdusuario()}' WHERE idcompra=".$this->getIdcompra();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("Compra->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compra WHERE idcompra =".$this->getIdcompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compra ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idcompra'], $row['cofecha'], $row['idusuario']);
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