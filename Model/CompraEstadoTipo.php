<?php
class CompraEstadoTipo{
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompraestadotipo="";
        $this->cetdescripcion="";
        $this->cetdetalle="";
        $this->mensajeoperacion="";
    }
    public function getIdcompraestadotipo(){
        return $this->idcompraestadotipo;
    }
    public function setIdcompraestadotipo($valor){
        $this->idcompraestadotipo = $valor;
    }

    public function getCetdescripcion(){
        return $this->cetdescripcion;
    }
    public function setCetdescripcion($valor){
        $this->cetdescripcion = $valor;
    }

    public function getCetdetalle(){
        return $this->cetdetalle;
    }
    public function setCetdetalle($valor){
        $this->cetdetalle = $valor;
    }
    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompraestadotipo, $cetdescripcion, $cetdetalle){
        $this->setIdcompraestadotipo($idcompraestadotipo);
        $this->setCetdescripcion($cetdescripcion);
        $this->setCetdetalle($cetdetalle);
    }
    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestadotipo WHERE idcompraestadotipo = ".$this->getIdcompraestadotipo();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Compraestadotipo->listar: ".$base->getError());
        }
        return $resp;
        
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestadotipo(cetdescripcion, cetdetalle)  VALUES(".$this->getCetdescripcion()."," . $this->getCetdetalle() . ");";
        echo $sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompraestadotipo($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraestadotipo->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraestadotipo->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraestadotipo SET cetdescripcion='{$this->getCetdescripcion()}', cetdetalle = '{$this->getCetdetalle()}' WHERE idcompraestadotipo=".$this->getIdcompraestadotipo();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("Compraestadotipo->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraestadotipo->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestadotipo WHERE idcompraestadotipo =".$this->getIdcompraestadotipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraestadotipo->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraestadotipo->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestadotipo ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
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