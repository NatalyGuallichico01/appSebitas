<?php
namespace Controllers;
use Model\Usuario;

class APIClientes{
    public static function index(){
        $clientes= Usuario::all();
        echo json_encode($clientes);
        //debuguear($clientes);
    }
}