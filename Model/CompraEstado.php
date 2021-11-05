<?php
class CompraEstado{
    private $idcompraestado;
    private $idcompra;
    private $idcompraestadotipo;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompraestado="";
        $this->idcompra="";
        $this->idcompraestadotipo="";
        $this->cefechaini=null;
        $this->cefechafin=null;
        $this->mensajeoperacion="";
    }
    public function getIdcompraestado(){
        return $this->idcompraestado;
    }
    public function setIdcompraestado($valor){
        $this->idcompraestado = $valor;
    }
    public function getIdcompra(){
        return $this->idcompra;
    }
    public function setIdcompra($valor){
        $this->idcompra = $valor;
    }
    public function getIdcompraestadotipo(){
        return $this->idcompraestadotipo;
    }
    public function setIdcompraestadotipo($valor){
        $this->idcompraestadotipo = $valor;
    }
    public function getCefechaini(){
        return $this->cefechaini;
    }
    public function setCefechaini($valor){
        $this->cefechaini = $valor;
    }
    public function getCefechafin(){
        return $this->cefechafin;
    }
    public function setCefechafin($valor){
        $this->cefechafin = $valor;
    }    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompraestado, $idcompra, $idcompraestadotipo, $cefechaini, $cefechafin){
        $this->setIdcompraestado($idcompraestado);
        $this->setIdcompra($idcompra);
        $this->setIdcompraestadotipo($idcompraestadotipo);
        $this->setCefechaini($cefechaini);
        $this->setCefechafin($cefechafin);
    }    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado WHERE idcompraestado = ".$this->getIdcompraestado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idcompraestado'], $row['idcompra'], $row['idcompraestadotipo'], $row['cefechaini'], $row['cefechafin'] );
                    
                }
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->listar: ".$base->getError());
        }
        return $resp;
        
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestado(idcompra, idcompraestadotipo, cefechaini, cefechafin)  VALUES(".$this->getIdcompra()."," . $this->getIdcompraestadotipo() . "," . $this->getCefechaini() . "," . $this->getCefechafin() . ");";
        
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompraestado($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraEstado->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraestado SET idcompra='{$this->getIdcompra()}', idcompraestadotipo = '{$this->getIdcompraestadotipo()}',cefechaini='{$this->getCefechaini()}', cefechafin = '{$this->getCefechafin()}' WHERE idcompraestado=".$this->getIdcompraestado();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("CompraEstado->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestado WHERE idcompraestado =".$this->getIdcompraestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraEstado->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idcompraestado'], $row['idcompra'], $row['idcompraestadotipo'], $row['cefechaini'], $row['cefechafin']);
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