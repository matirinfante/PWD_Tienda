<?php

class MenuRolController
{
    public function cargarObjeto($param){

        $obj = null;

        if (array_key_exists('idrol', $param) ) {

            $obj = new MenuRol();

            $obj->setear($param['idmenu'], $param['idrol']);

        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;

        if (isset($param['idmenu'])) {
            $obj = new MenuRol();
            $obj->setear($param['idmenu'], null);

        }
        return $obj;
    }

    private function seteadosCamposClaves($param){

        $resp = false;
        if (isset($param['idmenu']))

            $resp = true;
        return $resp;
    }

    public function insertar($param){

        $resp = false;
        $elObjtMenuRol = new MenuRol();
        $elObjtMenuRol = $this->cargarObjeto($param);

        if ($elObjtMenuRol != null and $elObjtMenuRol->insertar()) {
            $resp = true;
        }

        return $resp;
    }

    public function eliminar($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)) {

            $elObjtMenuRol = $this->cargarObjetoConClave($param);

            if ($elObjtMenuRol != null and $elObjtMenuRol->eliminar()) {

                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {

            $elObjtMenuRol = $this->cargarObjeto($param);

            if ($elObjtMenuRol != null and $elObjtMenuRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {


        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idmenu']))
                $where .= " and idmenu='" . $param['idmenu'] . "'";
            if (isset($param['idrol']))
                $where .= " and idrol ='" . $param['idrol'] . "'";         
        }

        $arreglo = MenuRol::listar($where);

        return $arreglo;
    }
}