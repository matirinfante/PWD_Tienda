<?php

class ProductoController
{

    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idproducto', $param) and array_key_exists('pronombre', $param) and array_key_exists('prodetalle', $param)
            and array_key_exists('procantstock', $param) and array_key_exists('proprecio', $param) and array_key_exists('proeditorial', $param) and array_key_exists('proautor', $param) and array_key_exists('proimagen', $param)) {
            $obj = new Producto();
            $obj->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['procantstock'], $param['proprecio'], $param['proeditorial'], $param['proautor'], $param['proimagen']);
        }
        return $obj;
    }


    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idproducto'])) {
            $obj = new Producto();
            $obj->setear($param['idproducto'], null, null, null, null, null, null, null);
        }
        return $obj;
    }


    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idproducto']))
            $resp = true;
        return $resp;
    }


    public function alta($param)
    {
        $resp = false;
        $elObjtProducto = $this->cargarObjeto($param);
        if ($elObjtProducto != null and $elObjtProducto->insertar()) {
            $resp = true;
        }
        return $resp;
    }


    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtProducto = $this->cargarObjetoConClave($param);
            if ($elObjtProducto != null) {
                if ($elObjtProducto->eliminar()) {
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
            $elObjtProducto = $this->cargarObjeto($param);
            if ($elObjtProducto != null and $elObjtProducto->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idproducto'])) {
                $where .= " and idproducto =" . $param['idproducto'];
            }

            if (isset($param['pronombre'])) {
                $where .= " and pronombre ='" . $param['pronombre'] . "'";
            }

            if (isset($param['prodetalle'])) {
                $where .= " and prodetalle ='" . $param['prodetalle'] . "'";
            }

            if (isset($param['procantstock'])) {
                $where .= " and procantstock ='" . $param['procantstock'] . "'";
            }
            if (isset($param['proprecio'])) {
                $where .= " and procanpropreciotstock ='" . $param['proprecio'] . "'";
            }

            if (isset($param['proeditorial'])) {
                $where .= " and proeditorial ='" . $param['proeditorial'] . "'";
            }

            if (isset($param['proautor'])) {
                $where .= " and proautor ='" . $param['proautor'] . "'";
            }

            if (isset($param['proimagen'])) {
                $where .= " and proimagen ='" . $param['proimagen'] . "'";
            }

        }
        $arreglo = Producto::listar($where);
        return $arreglo;
    }

    public function cargarImagen($datos)
    {
        $date = date("Y-m-d H:i:s");
        $filebase = md5($date);
        $nombreArchivoImagen = $filebase . ".jpg";
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/PWD_Tienda/View/images/";

        $arrayRespuesta = array();
        $arrayRespuesta["respCarga"] = "";
        $arrayRespuesta["enlace"] = "";

        $texto = "";
        $error = "";
        $todoOK = true;

        if ($nombreArchivoImagen != "") {
            if ($todoOK && $_FILES['imagen']["error"] <= 0) {
                $todoOK = true;
                $error = "";
            } else {
                $todoOK = false;
                $error = "ERROR: no se pudo cargar la imagen. No se pudo acceder al archivo Temporal";
            }

            $tipoJpeg = strpos(strtoupper($_FILES['imagen']["type"]), "JPEG");

            //tipo
            if ($todoOK && !$tipoJpeg) {
                $error = "ERROR: El archivo seleccionado no es una imagen jpeg.";
                $todoOK = false;
            }

        }
        // Copiar/Guardar
        if ($todoOK) {
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $dir . $nombreArchivoImagen)) {
                #$error = "ERROR: no se pudo cargar el archivo de imagen.";
                $error = $dir . $nombreArchivoImagen;
                $todoOK = false;
            }
        }

        if (!$todoOK) {
            $texto = $error;
            $arrayRespuesta["errorMsg"] = $texto;
        } else {
            $arrayRespuesta["exitoMsg"] = "La imagen fue cargada correctamente";
            $arrayRespuesta["enlace"] = $dir . $nombreArchivoImagen;

            $resp = $this->buscar($datos);
            if (!empty($resp)) {
                $resp[0]->setProimagen($filebase);
                $resp[0]->modificar();
            }


        }
        $arrayRespuesta["respuesta"] = $todoOK;
        return $arrayRespuesta;
    }

}