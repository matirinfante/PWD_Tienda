<?php

class Session
{

    /**
     * Constructor de la clase que inicia la sesión
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Actualiza las variables de sesión con los valores ingresados
     */
    public function iniciar($usNombre, $psw)
    {
        $ini = false;
        $psw = md5($psw);
        if ($this->validar($usNombre, $psw)) {
            $ini = true;
        }
        return $ini;
    }

    /**
     *  Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar($usNombre, $psw)
    {
        $valido = false;
        $controllerUsuario = new UsuarioController();
        $list = $controllerUsuario->buscar(["usnombre" => $usNombre, "uspass" => $psw]);
        if (count($list) > 0) {
            if ($list[0]->getUsdeshabilitado() == NULL || $list[0]->getUsdeshabilitado() == "0000-00-00 00:00:00") {
                $_SESSION["idUsuario"] = $list[0]->getIdusuario();
                $_SESSION["rolActivo"] = $this->getRol()[0]->getIdrol(); //asigna como rol activo el primer rol del conjunto de roles
                $valido = true;
            }
        }
        return $valido;
    }

    /**
     * Devuelve true o false si la sesión está activa o no.
     */
    public function activa()
    {
        $activa = false;
        if (isset($_SESSION["idUsuario"])) {
            $activa = true;
        }
        return $activa;
    }

    /**
     * Devuelve el usuario logeado
     */
    public function getUsuario()
    {
        $usuario = null;
        $controllerUsuario = new UsuarioController();
        $list = $controllerUsuario->buscar(["idusuario" => $_SESSION["idUsuario"]]);
        if (count($list) > 0) {
            $usuario = $list[0];
        }
        return $usuario;
    }

    /**
     * Devuelve el rol del usuario logeado
     */
    public function getRol()
    {
        $roles = array();
        $controllerUsuarioRol = new UsuarioRolController();
        $controllerRol = new RolController();
        $objUsuario = $this->getUsuario();
        $list = $controllerUsuarioRol->buscar(["idusuario" => $objUsuario->getIdusuario()]);
        if (count($list) > 0) {
            foreach ($list as $objUsuarioRol) {
                $objRol = $controllerRol->buscar(["idrol" => $objUsuarioRol->getObjRol()->getIdrol()]);
                array_push($roles, $objRol[0]);
            }
        }
        return $roles;
    }

    public function getRolActivo()
    {
        return $_SESSION["rolActivo"];
    }

    public function setRolActivo($idrol)
    {
        $ret = false;
        $roles = $this->getRol();
        $i = 0;
        while ($i < count($roles) && !$ret) {
            if ($roles[$i]->getIdrol() == $idrol["idrol"]) {
                $controllerRol = new RolController();
                $objRol = $controllerRol->buscar(["idrol" => $idrol["idrol"]]);
                $_SESSION['rolActivo'] = $objRol[0]->getIdrol();
                $ret = true;
            }
            $i++;
        }
        return $ret;
    }

    /**
     * Cierra la sesión actual
     */
    public function cerrar()
    {
        $close = false;
        if (session_destroy()) {
            $close = true;
            session_unset();
        }
        return $close;
    }

    public function getCarrito()
    {
        $resp = array();
        if (isset($_SESSION['carrito'])) {
            $resp = $_SESSION['carrito'];
        }
        return $resp;
    }

    public function setCarrito($nuevoCarrito)
    {
        $_SESSION['carrito'] = $nuevoCarrito;
    }

    public function eliminarCarrito()
    {
        unset($_SESSION['carrito']);
    }

}
