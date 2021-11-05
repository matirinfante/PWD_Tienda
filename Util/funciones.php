<?php
function data_submitted()
{
    $_AAux = array();
    if (!empty($_POST))
        $_AAux = $_POST;
    else
        if (!empty($_GET)) {
            $_AAux = $_GET;
        }
    if (count($_AAux)) {
        foreach ($_AAux as $indice => $valor) {
            if ($valor == "")
                $_AAux[$indice] = 'null';
        }
    }
    return $_AAux;

}


function __autoload($class_name)
{
    //echo "class ".$class_name ;
    $directorios = array(
        $GLOBALS['ROOT'] . 'Model/',
        $GLOBALS['ROOT'] . 'Model/connector/',
        $GLOBALS['ROOT'] . 'Controller/',
        $GLOBALS['ROOT'] . 'util/class/',
    );
    //print_object($directorys) ;
    foreach ($directorios as $directory) {
        if (file_exists($directory . $class_name . '.php')) {
            // echo "se incluyo".$directory.$class_name . '.php';
            require_once($directory . $class_name . '.php');
            return;
        }
    }
}

?>
