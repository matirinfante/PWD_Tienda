<?php
class UsuarioRol{
    private $idusuario;
    private $idrol;
    private $mensajeoperacion;

    public function __construct(){
        $this->idusuario="";
        $this->idrol="";
        $this->mensajeoperacion="";
    }
    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($valor){
        $this->idusuario = $valor;
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

    public function setear($idusuario, $idrol){
        $this->setIdusuario($idusuario);
        $this->setIdrol($idrol);
    }    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idusuario = ".$this->getIdusuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idusuario'], $row['idrol']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->listar: ".$base->getError());
        }
        return $resp;
        
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuariorol(idrol)  VALUES(".$this->getIdrol().");";
        echo $sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdusuario($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("UsuarioRol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE usuariorol SET idrol='{$this->getIdrol()}' WHERE idusuario=".$this->getIdusuario();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("UsuarioRol->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE idusuario =".$this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idusuario'], $row['idrol']);
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