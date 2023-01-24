<?php

namespace Controllers;

use Model\AdminCita;


class APICitasController{
    public static function index(){

        $consulta = "SELECT citas.id, citas.hora, citas.estado, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '{$fecha}' ";

        $citas=AdminCita::SQL($consulta);
        //debuguear($citas);
        echo json_encode($citasservicios);
    }

    // public static function reporte(){

    //     $consulta = "SELECT citas.id, citas.hora, citas.estado, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
    //     $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
    //     $consulta .= " FROM citas  ";
    //     $consulta .= " LEFT OUTER JOIN usuarios ";
    //     $consulta .= " ON citas.usuarioId=usuarios.id  ";
    //     $consulta .= " LEFT OUTER JOIN citasServicios ";
    //     $consulta .= " ON citasServicios.citaId=citas.id ";
    //     $consulta .= " LEFT OUTER JOIN servicios ";
    //     $consulta .= " ON servicios.id=citasServicios.servicioId ";
    //     $consulta .= " WHERE fecha =  '{$fecha}' ";

    //     $citas=AdminCita::SQL($consulta);
    //     //debuguear($citas);
    //     echo json_encode($citasservicios);
    // }

}

//reporte
