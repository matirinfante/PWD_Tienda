<?php

class Compra
{
    private $idcompra;
    private $cofecha;
    private $objUsuario;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idcompra = "";
        $this->cofecha = null;
        $this->objUsuario = null;
        $this->mensajeoperacion = "";
    }

    public function getIdcompra()
    {
        return $this->idcompra;
    }

    public function setIdcompra($valor)
    {
        $this->idcompra = $valor;
    }

    public function getCofecha()
    {
        return $this->cofecha;
    }

    public function setCofecha($valor)
    {
        $this->cofecha = $valor;
    }

    public function getObjUsuario()
    {
        return $this->objUsuario;
    }

    public function setIdusuario($valor)
    {
        $this->objUsuario = $valor;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompra, $cofecha, $objUsuario)
    {
        $this->setIdcompra($idcompra);
        $this->setCofecha($cofecha);
        $this->setIdusuario($objUsuario);
    }


    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra WHERE idcompra = " . $this->getIdcompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $usuarioController = new UsuarioController();
                    $objUsuario = $usuarioController->buscar(['idusuario' => $row['idusuario']]);
                    if (empty($objUsuario)) {
                        $objUsuario = null;
                    } else {
                        $objUsuario = $objUsuario[0];
                    }
                    $this->setear($row['idcompra'], $row['cofecha'], $objUsuario);

                }
            }
        } else {
            $this->setmensajeoperacion("Compra->listar: " . $base->getError());
        }
        return $resp;


    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compra(cofecha, idusuario)  VALUES('" . $this->getCofecha() . "'," . $this->getObjUsuario()->getIdusuario() . ");";
        echo $sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompra($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compra SET cofecha='{$this->getCofecha()}', idusuario = '{$this->getObjUsuario()->getIdusuario()}' WHERE idcompra=" . $this->getIdcompra();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;

            } else {
                $this->setmensajeoperacion("Compra->modificar 1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->modificar 2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compra WHERE idcompra ='{$this->getIdcompra()}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compra ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Compra();
                    $usuarioController = new UsuarioController();
                    $objUsuario = $usuarioController->buscar(['idusuario' => $row['idusuario']]);

                    if (empty($objUsuario)) {
                        $objUsuario = null;
                    } else {
                        $objUsuario = $objUsuario[0];
                    }
                    $obj->setear($row['idcompra'], $row['cofecha'], $objUsuario);
                    array_push($arreglo, $obj);
                }
            }
        }
        return $arreglo;
    }


}

?>