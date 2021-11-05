<?php

class CompraItemController
{
    public function cargarObjeto($param){

        $obj = null;

        if (array_key_exists('idproducto', $param) && array_key_exists('idcompra', $param) && array_key_exists('cicantidad', $param)) {

            $obj = new CompraItem();

            $obj->setear($param['idproductoitem'], $param['idproducto'], $param['idcompra'], $param['cicantidad']);

        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;

        if (isset($param['idproductoitem'])) {
            $obj = new CompraItem();
            $obj->setear($param['idproductoitem'], null, null, null);

        }
        return $obj;
    }

    private function seteadosCamposClaves($param){

        $resp = false;
        if (isset($param['idproductoitem']))

            $resp = true;
        return $resp;
    }
    
    public function insertar($param){

        $resp = false;
        $elObjtCompraItem = new CompraItem();
        $elObjtCompraItem = $this->cargarObjeto($param);

        if ($elObjtCompraItem != null and $elObjtCompraItem->insertar()) {
            $resp = true;
        }

        return $resp;
    }

    public function eliminar($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)) {

            $elObjtCompraItem = $this->cargarObjetoConClave($param);

            if ($elObjtCompraItem != null and $elObjtCompraItem->eliminar()) {

                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {

            $elObjtCompraItem = $this->cargarObjeto($param);

            if ($elObjtCompraItem != null and $elObjtCompraItem->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {


        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idproductoitem']))
                $where .= " and idproductoitem='" . $param['idproductoitem'] . "'";
            if (isset($param['idproducto']))
                $where .= " and idproducto ='" . $param['idproducto'] . "'";
            if (isset($param['idcompra']))
                $where .= " and idcompra ='" . $param['idcompra'] . "'";
            if (isset($param['cicantidad']))
                $where .= " and cicantidad ='" . $param['cicantidad'] . "'";
        }

        $arreglo = CompraItem::listar($where);

        return $arreglo;
    }
}