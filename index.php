<?php

include_once("controller/controllerMain.php");
include_once("model/bd.php");

session_start();

$global = new controllerPrincipal();
#$global->Crear_cuenta();

if (empty($_GET['action'])) {
    $global->home();

}elseif (isset($_GET['action']) && !empty($_GET['action'])) {
    # code...
    $action = $_GET['action'];
    switch ($action) {
        case 'crear':
            $global->Crear_cuenta();
            break;
        
        case 'login':
            $global->login();
            break;
        case 'alquilar':
            $global->Palquilar();
            break;
    }
}
