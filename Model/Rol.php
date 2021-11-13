<?php

class Rol
{
    private $idrol;
    private $roldescripcion;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idrol = "";
        $this->roldescripcion = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idrol, $roldescripcion)
    {
        $this->idrol = $idrol;
        $this->roldescripcion = $roldescripcion;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol WHERE idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idrol'], $row['roldescripcion']);

                }
            }
        } else {
            $this->setmensajeoperacion("rol->cargar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO rol(roldescripcion)  VALUES('" . $this->getRoldescripcion() . "');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdrol($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("rol->insertar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("rol->insertar-2: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE rol SET roldescripcion='" . $this->getRoldescripcion() . "' WHERE idrol=" . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("rol->modificar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("rol->modificar-2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM rol WHERE idrol=" . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("rol->eliminar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("rol->eliminar-2: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Rol();
                    $obj->setear($row['idrol'], $row['roldescripcion']);
                    array_push($arreglo, $obj);
                }

            }

        }
        return $arreglo;
    }

    public function getIdrol()
    {
        return $this->idrol;
    }

    public function setIdrol($idrol)
    {
        $this->idrol = $idrol;
    }

    public function getRoldescripcion()
    {
        return $this->roldescripcion;
    }

    public function setRoldescripcion($roldescripcion)
    {
        $this->roldescripcion = $roldescripcion;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }
}