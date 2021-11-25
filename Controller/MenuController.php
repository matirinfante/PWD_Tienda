<?php

class MenuController
{

    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idmenu', $param) and array_key_exists('menombre', $param)) {
            $obj = new Menu();
            $objPadre = null;
            if (isset($param['idpadre'])) {
                $objPadre = new Menu();
                $objPadre->setIdmenu($param['idpadre']);
                $objPadre->cargar();
            }
            if (!isset($param['medeshabilitado'])) {
                $param['medeshabilitado'] = null;
            }
            if (!isset($param['medescripcion'])) {
                $param['medescripcion'] = "";
            }
            $obj->setear($param['idmenu'], $param['menombre'], $param['medescripcion'], $objPadre, $param['medeshabilitado']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idmenu'])) {
            $obj = new Menu();
            $obj->setIdmenu($param['idmenu']);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idmenu'])) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idmenu'] = null;
        $param['medeshabilitado'] = "0000-00-00 00:00:00";
        $elObjtMenu = $this->cargarObjeto($param);
        if ($elObjtMenu != null and $elObjtMenu->insertar()) {
            $resp = true;
        } else {
            if ($elObjtMenu != null) {
                $resp = $elObjtMenu->getMensajeoperacion();
            }
        }
        return $resp;
    }


    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtMenu = $this->cargarObjetoConClave($param);
            if ($elObjtMenu != null) {
                if ($elObjtMenu->eliminar()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }


    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtMenu = $this->cargarObjeto($param);
            if ($elObjtMenu != null and $elObjtMenu->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idmenu'])) {
                $where .= " and idmenu =" . $param['idmenu'];
            }

            if (isset($param['menombre'])) {
                $where .= " and menombre ='" . $param['menombre'] . "'";
            }

            if (isset($param['medescripcion'])) {
                $where .= " and medescripcion ='" . $param['medescripcion'] . "'";
            }

            if (isset($param['idpadre'])) {
                $where .= " and idpadre =" . $param['idpadre'];
            }

            if (isset($param['medeshabilitado'])) {
                $where .= " and medeshabilitado ='" . $param['medeshabilitado'] . "'";
            }

        }
        $arreglo = Menu::listar($where);
        return $arreglo;
    }
}