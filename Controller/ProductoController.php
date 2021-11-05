<?php

class ProductoController
{
    public function cargarObjeto($param){

        $obj = null;

        if (array_key_exists('pronombre', $param) && array_key_exists('prodetalle', $param) && array_key_exists('procantstock', $param)) {

            $obj = new Producto();

            $obj->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['procantstock']);

        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;

        if (isset($param['idproducto'])) {
            $obj = new Producto();
            $obj->setear($param['idproducto'], null, null, null);

        }
        return $obj;
    }

    private function seteadosCamposClaves($param){

        $resp = false;
        if (isset($param['idproducto']))

            $resp = true;
        return $resp;
    }
    
    public function insertar($param){

        $resp = false;
        $elObjtProducto = new Producto();
        $elObjtProducto = $this->cargarObjeto($param);

        if ($elObjtProducto != null and $elObjtProducto->insertar()) {
            $resp = true;
        }

        return $resp;
    }

    public function eliminar($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)) {

            $elObjtProducto = $this->cargarObjetoConClave($param);

            if ($elObjtProducto != null and $elObjtProducto->eliminar()) {

                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {

            $elObjtProducto = $this->cargarObjeto($param);

            if ($elObjtProducto != null and $elObjtProducto->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {


        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idproducto']))
                $where .= " and idproducto='" . $param['idproducto'] . "'";
            if (isset($param['pronombre']))
                $where .= " and pronombre ='" . $param['pronombre'] . "'";
            if (isset($param['prodetalle']))
                $where .= " and prodetalle ='" . $param['prodetalle'] . "'";
            if (isset($param['procantstock']))
                $where .= " and procantstock ='" . $param['procantstock'] . "'";
        }

        $arreglo = Producto::listar($where);

        return $arreglo;
    }
}