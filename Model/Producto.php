<?php
class Producto
{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $proprecio;
    private $proeditorial;
    private $proautor;
    private $proimagen;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idproducto = "";
        $this->pronombre = "";
        $this->prodetalle = "";
        $this->procantstock = "";
        $this->proprecio = "";
        $this->proeditorial = "";
        $this->proautor = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idproducto, $pronombre, $prodetalle, $procantstock, $proprecio, $proeditorial, $proautor, $proimagen)
    {
        $this->idproducto = $idproducto;
        $this->pronombre = $pronombre;
        $this->prodetalle = $prodetalle;
        $this->procantstock = $procantstock;
        $this->proprecio = $proprecio;
        $this->proeditorial = $proeditorial;
        $this->proautor = $proautor;
        $this->proimagen = $proimagen;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getIdproducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proprecio'], $row['proeditorial'], $row['proautor'], $row['proimagen']);
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->cargar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO producto(pronombre,prodetalle,procantstock, proprecio, proeditorial, proautor, proimagen)  VALUES('" . $this->getPronombre() . "','" . $this->getProdetalle() . "','" . $this->getProCantstock() . "','" . $this->getProprecio() ."','" . $this->getProeditorial() ."','" . $this->getProautor() . "','" . $this->getProimagen() ."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdproducto($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->insertar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->insertar-2: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET pronombre='" . $this->getPronombre() . "', prodetalle= '" . $this->getProdetalle() . "', procantstock= '" . $this->getProCantstock() . "', proprecio= '" . $this->getProprecio() . "', proeditorial= '" . $this->getProeditorial() . "', proautor= '" . $this->getProautor() . "', proimagen= '" . $this->getProimagen() . "' WHERE idproducto=" . $this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->modificar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar-2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto=" . $this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Producto->eliminar-1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->eliminar-2: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {

                while ($row = $base->Registro()) {
                    $obj = new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proprecio'], $row['proeditorial'], $row['proautor'], $row['proimagen']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: " . $base->getError());
        }
        return $arreglo;
    }

    public function getIdproducto()
    {
        return $this->idproducto;
    }

    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    public function getPronombre()
    {
        return $this->pronombre;
    }

    public function setPronombre($pronombre)
    {
        $this->pronombre = $pronombre;
    }

    public function getProdetalle()
    {
        return $this->prodetalle;
    }

    public function setProdetalle($prodetalle)
    {
        $this->prodetalle = $prodetalle;
    }

    public function getProCantstock()
    {
        return $this->procantstock;
    }

    public function setProCantstock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function getProprecio()
    {
        return $this->proprecio;
    }

    public function setProprecio($proprecio)
    {
        $this->proprecio = $proprecio;
    }

    public function getProeditorial()
    {
        return $this->proeditorial;
    }

    public function setProeditorial($proeditorial)
    {
        $this->proeditorial = $proeditorial;
    }
    public function getProautor()
    {
        return $this->proautor;
    }
    public function setProautor($proautor)
    {
        $this->proautor = $proautor;
    }
    public function getProimagen()
    {
        return $this->proimagen;
    }
    public function setProimagen($proimagen)
    {
        $this->proimagen = $proimagen;
    }
}