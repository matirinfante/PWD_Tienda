<?php

class RolController
{
    public function cargarObjeto($param){

        $obj = null;

        if (array_key_exists('rodescripcion', $param) ) {

            $obj = new Rol();

            $obj->setear($param['idrol'], $param['rodescripcion']);

        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;

        if (isset($param['idrol'])) {
            $obj = new Rol();
            $obj->setear($param['idrol'], null);

        }
        return $obj;
    }

    private function seteadosCamposClaves($param){

        $resp = false;
        if (isset($param['idrol']))

            $resp = true;
        return $resp;
    }

    public function insertar($param){

        $resp = false;
        $elObjtRol = new Rol();
        $elObjtRol = $this->cargarObjeto($param);

        if ($elObjtRol != null and $elObjtRol->insertar()) {
            $resp = true;
        }

        return $resp;
    }

    public function eliminar($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)) {

            $elObjtRol = $this->cargarObjetoConClave($param);

            if ($elObjtRol != null and $elObjtRol->eliminar()) {

                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {

            $elObjtRol = $this->cargarObjeto($param);

            if ($elObjtRol != null and $elObjtRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {


        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idrol']))
                $where .= " and idrol='" . $param['idrol'] . "'";
            if (isset($param['rodescripcion']))
                $where .= " and rodescripcion ='" . $param['rodescripcion'] . "'";         
        }

        $arreglo = Rol::listar($where);

        return $arreglo;
    }
}