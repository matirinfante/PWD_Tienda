<?php

class CompraController
{
    public function cargarObjeto($param){

        $obj = null;

        if (array_key_exists('cofecha', $param) && array_key_exists('idusuario', $param) ) {

            $obj = new Compra();

            $obj->setear($param['idcompra'], $param['cofecha'], $param['idusuario']);

        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;

        if (isset($param['idcompra'])) {
            $obj = new Compra();
            $obj->setear($param['idcompra'], null, null);

        }
        return $obj;
    }

    private function seteadosCamposClaves($param){

        $resp = false;
        if (isset($param['idcompra']))

            $resp = true;
        return $resp;
    }

    public function insertar($param){

        $resp = false;
        $elObjtCompra = new Compra();
        $elObjtCompra = $this->cargarObjeto($param);

        if ($elObjtCompra != null and $elObjtCompra->insertar()) {
            $resp = true;
        }

        return $resp;
    }

    public function eliminar($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)) {

            $elObjtCompra = $this->cargarObjetoConClave($param);

            if ($elObjtCompra != null and $elObjtCompra->eliminar()) {

                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {

            $elObjtCompra = $this->cargarObjeto($param);

            if ($elObjtCompra != null and $elObjtCompra->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {


        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idcompra']))
                $where .= " and idcompra='" . $param['idcompra'] . "'";
            if (isset($param['cofecha']))
                $where .= " and cofecha ='" . $param['cofecha'] . "'";
            if (isset($param['idusuario']))
                $where .= " and idusuario ='" . $param['idusuario'] . "'";            
        }

        $arreglo = Compra::listar($where);

        return $arreglo;
    }

}