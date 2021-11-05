<?php

class UsuarioRolController
{
    public function cargarObjeto($param){

        $obj = null;

        if (array_key_exists('idrol', $param) ) {

            $obj = new UsuarioRol();

            $obj->setear($param['idusuario'], $param['idrol']);

        }
        return $obj;
    }

    private function cargarObjetoConClave($param){
        $obj = null;

        if (isset($param['idusuario'])) {
            $obj = new UsuarioRol();
            $obj->setear($param['idusuario'], null);

        }
        return $obj;
    }

    private function seteadosCamposClaves($param){

        $resp = false;
        if (isset($param['idusuario']))

            $resp = true;
        return $resp;
    }

    public function insertar($param){

        $resp = false;
        $elObjtUsuarioRol = new UsuarioRol();
        $elObjtUsuarioRol = $this->cargarObjeto($param);

        if ($elObjtUsuarioRol != null and $elObjtUsuarioRol->insertar()) {
            $resp = true;
        }

        return $resp;
    }

    public function eliminar($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)) {

            $elObjtUsuarioRol = $this->cargarObjetoConClave($param);

            if ($elObjtUsuarioRol != null and $elObjtUsuarioRol->eliminar()) {

                $resp = true;
            }
        }
        return $resp;
    }

    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {

            $elObjtUsuarioRol = $this->cargarObjeto($param);

            if ($elObjtUsuarioRol != null and $elObjtUsuarioRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {


        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idusuario']))
                $where .= " and idusuario='" . $param['idusuario'] . "'";
            if (isset($param['idrol']))
                $where .= " and idrol ='" . $param['idrol'] . "'";         
        }

        $arreglo = UsuarioRol::listar($where);

        return $arreglo;
    }
}