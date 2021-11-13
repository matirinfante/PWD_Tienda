<?php

class UsuarioRolController
{

    private function cargarObjeto($param)
    {
        $obj = null;

        if (array_key_exists('idusuario', $param) and array_key_exists('idrol', $param)) {
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param['idusuario']);
            $objUsuario->cargar();
            $objRol = new Rol();
            $objRol->setIdrol($param['idrol']);
            $objRol->cargar();
            $obj = new UsuarioRol();
            $obj->setear($objUsuario, $objRol);
        }
        return $obj;
    }


    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $elObjtUsuariorol = $this->cargarObjeto($param);
        if ($elObjtUsuariorol != null and $elObjtUsuariorol->insertar()) {
            $resp = true;
        }
        return $resp;

    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtUsuariorol = $this->cargarObjeto($param);
            if ($elObjtUsuariorol != null and $elObjtUsuariorol->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtUsuariorol = $this->cargarObjeto($param);
            if ($elObjtUsuariorol != null and $elObjtUsuariorol->modificar()) {
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
                $where .= " and idusuario =" . $param['idusuario'];
            if (isset($param['idrol']))
                $where .= " and idrol ='" . $param['idrol'] . "'";
        }
        $arreglo = UsuarioRol::listar($where);
        return $arreglo;
    }

}

?>