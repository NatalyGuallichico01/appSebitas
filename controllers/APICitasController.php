<?php

namespace Controllers;

use Model\Cita;

class APICitasController{
    public static function index(){
        $citas=Cita::all();
        echo json_encode($citas);
    }
}