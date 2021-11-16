<?php

class MenuRolController
{

    private function cargarObjeto($param)
    {
        $obj = null;

        if (array_key_exists('idmenu', $param) and array_key_exists('idrol', $param)) {
            $abmMenu = new abmMenu();
            $objMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
            $abmRol = new abmRol();
            $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
            $obj = new MenuRol();
            $obj->setear($objMenu[0], $objRol[0]);
        }
        return $obj;
    }


    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idmenu']) && isset($param['idrol'])) {
            $abmMenu = new abmMenu();
            $objMenu = $abmMenu->buscar(['idmenu' => $param['idmenu']]);
            $abmRol = new abmRol();
            $objRol = $abmRol->buscar(['idrol' => $param['idrol']]);
            $obj = new MenuRol();
            $obj->setear($objMenu[0], $objRol[0]);
        }
        return $obj;
    }


    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idmenu']) && isset($param['idrol']))
            $resp = true;
        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        //$param['idmenu'] =null;
        $elObjtMenurol = $this->cargarObjeto($param);
        if ($elObjtMenurol != null and $elObjtMenurol->insertar()) {
            $resp = true;
        }
        return $resp;

    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtMenurol = $this->cargarObjetoConClave($param);
            if ($elObjtMenurol != null and $elObjtMenurol->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtMenurol = $this->cargarObjeto($param);
            if ($elObjtMenurol != null and $elObjtMenurol->modificar()) {
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
                $where .= " and idmenu =" . $param['idmenu'];
            if (isset($param['idrol']))
                $where .= " and idrol ='" . $param['idrol'] . "'";
        }
        var_dump($param);
        $arreglo = MenuRol::listar($where);
        return $arreglo;
    }

}

?>