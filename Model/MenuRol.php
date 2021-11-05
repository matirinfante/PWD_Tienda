<?php
class MenuRol{
    private $idmenu;
    private $idrol;
    private $mensajeoperacion;

    public function __construct(){
        $this->idmenu="";
        $this->idrol="";
        $this->mensajeoperacion="";
    }
    public function getIdmenu(){
        return $this->idmenu;
    }
    public function setIdmenu($valor){
        $this->idmenu = $valor;
    }
    public function getIdrol(){
        return $this->idrol;
    }
    public function setIdrol($valor){
        $this->idrol = $valor;
    }    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }
    public function setear($idmenu, $idrol){
        $this->setIdmenu($idmenu);
        $this->setIdrol($idrol);
    }    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol WHERE idmenu = ".$this->getIdmenu();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idmenu'], $row['idrol']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("MenuRol->listar: ".$base->getError());
        }
        return $resp;
        
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO menurol(idrol)  VALUES(".$this->getIdrol().");";
        echo $sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdmenu($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("MenuRol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuRol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE menurol SET idrol='{$this->getIdrol()}' WHERE idmenu=".$this->getIdmenu();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("MenuRol->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuRol->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menurol WHERE idmenu =".$this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("MenuRol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuRol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idmenu'], $row['idrol']);
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