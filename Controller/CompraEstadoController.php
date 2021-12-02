<?php

class CompraEstadoController
{
    private function cargarObjeto($param)
    {
        $obj = null;

        if (array_key_exists('idcompraestado', $param) and array_key_exists('idcompra', $param) and array_key_exists('idcompraestadotipo', $param) and array_key_exists('cefechaini', $param) and array_key_exists('cefechafin', $param)) {
            $obj = new CompraEstado();
            $abmCompra = new CompraController();
            $objCompra = $abmCompra->buscar(['idcompra' => $param['idcompra']]);
            $abmCompraestadotipo = new CompraEstadoTipoController();
            $objCompraestadotipo = $abmCompraestadotipo->buscar(['idcompraestadotipo' => $param['idcompraestadotipo']]);
            $obj->setear($param['idcompraestado'], $objCompra[0], $objCompraestadotipo[0], $param['cefechaini'], $param['cefechafin']);
        }
        return $obj;
    }

    private function cargarObjetoConClave($param)
    {
        $obj = null;

        if (isset($param['idcompraestado'])) {
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'], null, null, "", "");
        }
        return $obj;
    }


    private function seteadosCamposClaves($param)
    {
        $resp = false;

        if (isset($param['idcompraestado'])) {
            $resp = true;
        }

        return $resp;
    }

    public function alta($param)
    {
        $resp = false;
        $param['idcompraestado'] = null;
        $elObjtCompraEstado = $this->cargarObjeto($param);
        if ($elObjtCompraEstado != null and $elObjtCompraEstado->insertar()) {
            $resp = true;
        }
        return $resp;

    }

    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtCompraEstado = $this->cargarObjetoConClave($param);
            if ($elObjtCompraEstado != null and $elObjtCompraEstado->eliminar()) {
                $resp = true;
            }
        }

        return $resp;
    }

    public function modificacion($param)
    {
        $resp = false;

        if ($this->seteadosCamposClaves($param)) {
            $objCompraEstado = $this->cargarObjeto($param);
            if ($objCompraEstado != null and $objCompraEstado->modificar()) {
                $resp = true;
            }
        }

        return $resp;
    }


    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idcompraestado']))
                $where .= " and idcompraestado =" . $param['idcompraestado'];
            if (isset($param['idcompra']))
                $where .= " and idcompra =" . $param['idcompra'];
            if (isset($param['idcompraestadotipo']))
                $where .= " and idcompraestadotipo =" . $param['idcompraestadotipo'];
            if (isset($param['cefechaini']))
                $where .= " and cefechaini ='" . $param['cefechaini'] . "'";
            if (isset($param['cefechafin']))
                $where .= " and cefechafin ='" . $param['cefechafin'] . "'";
        }
        $arreglo = CompraEstado::listar($where);
        return $arreglo;
    }

    public function cambiarEstado($datos)
    {
        if (isset($datos['idcompraestado']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin'])) {
            if ($datos['idcompraestadotipo'] != 4) {
                $datos['idcompraestadotipo'] = $datos['idcompraestadotipo'] + 1;
            } else {
                $datos['idcompraestadotipo'] = 1;
            }
            $resp = $this->modificacion($datos);
            $retorno['errorMsg'] = $datos['idcompraestado'];
        } else {
            $resp = false;
            $retorno['errorMsg'] = "No se pudo MODIFICAR el estado.";
        }
        return $resp;
    }
}

?>