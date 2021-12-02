<?php

class GestorPermisos
{

    public function tienePermiso($rolActivo, $paginaAcceso)
    {
        $controllerMenuRol = new MenuRolController();
        $controllerMenu = new MenuController();
        $resp = false;
        $pagina = $controllerMenu->buscar(['medescripcion' => $paginaAcceso]);

        if (!empty($pagina)) {
            $respuesta = $controllerMenuRol->buscar(['idmenu' => $pagina[0]->getIdmenu(), 'idrol' => $rolActivo]);
            if (!empty($respuesta)) {
                $resp = true;
            }
        }
        return $resp;
    }


}