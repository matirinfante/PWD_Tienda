<?php

class CompraItemController{

    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idcompraitem',$param) and array_key_exists('idproducto',$param) and array_key_exists('idcompra',$param) and array_key_exists('cicantidad',$param)){
            $obj = new CompraItem();
            $abmProducto=new ProductoController();
            $objProducto=$abmProducto->buscar(['idproducto'=>$param['idproducto']]);
            $abmCompra=new CompraController();
            $objCompra=$abmCompra->buscar(['idcompra'=>$param['idcompra']]);
            $obj->setear($param['idcompraitem'], $objProducto[0],$objCompra[0],$param['cicantidad']);
        }
        return $obj;
    }
    
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idcompraitem']) ){
            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'],null,null,"");
        }
        return $obj;
    }
    
    
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraitem']))
            $resp = true;
        return $resp;
    }
    

    public function alta($param){
        $resp = false;
        $param['idcompraitem'] =null;
        $elObjtCompraItem = $this->cargarObjeto($param);
        if ($elObjtCompraItem!=null and $elObjtCompraItem->insertar()){
            $resp = true;
        }
        return $resp;
        
    }

    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtCompraItem = $this->cargarObjetoConClave($param);
            if ($elObjtCompraItem!=null and $elObjtCompraItem->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    

    public function modificacion($param){
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtCompraItem = $this->cargarObjeto($param);
            if($elObjtCompraItem!=null and $elObjtCompraItem->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idcompraitem']))
                $where.=" and idcompraitem =".$param['idcompraitem'];
            if  (isset($param['idproducto']))
                 $where.=" and idproducto ='".$param['idproducto']."'";
            if  (isset($param['idcompra']))
            $where.=" and idcompra ='".$param['idcompra']."'";
            if  (isset($param['cicantidad']))
            $where.=" and cicantidad ='".$param['cicantidad']."'";
        }
        $arreglo = CompraItem::listar($where);  
        return $arreglo;
    }

}

?>