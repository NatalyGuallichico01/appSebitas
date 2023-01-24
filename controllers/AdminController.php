<?php

namespace Controllers;

use Classes\Paginacion;
use Model\AdminCita;
use MVC\Router;

class AdminController{
    public static function index(Router $router){
        //session_start();

        isAdmin();

       //$id=$_GET['id'];
        

        // $paginaActual=$_GET['page'];
        // $paginaActual=filter_var($paginaActual, FILTER_VALIDATE_INT);

        // if(!$paginaActual || $paginaActual<1){
        //     header('Location:/admin?page=1');
        // }

        // //debuguear($paginaActual);

        // //$paginaActual=1;
        // $registrosPagina=5;
        // $total1=AdminCita::total();

        // $paginacion=new Paginacion($paginaActual, $registrosPagina, $total1);
        // //debuguear($paginacion->paginaSiguiente());
    
        // //$citasAdmin=AdminCita::all();
        
        // if($paginacion->totalPaginas() <$paginaActual){
        //     header('Location: /clientes?page=1');
        // }
        
        // //USUARIOS CLIENTES
        // $citas=AdminCita::paginar($registrosPagina, $paginacion->offset());
        // //debuguear($usuarios);

        $fecha=$_GET['fecha'] ?? date('Y-m-d');
        $fecha1=$_GET['fecha'] ?? date('Y-m-d');
        $fechas=explode('-',$fecha);
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('Location:/404');
        }

        $fechas1=explode('-',$fecha1);
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('Location:/404');
        }

        // $nombre=$GEt['cliente'] ?? NULL;
        // debuguear($nombre); 
        
        //debuguear($fecha);
        //CONSULTAR LA BASE DE DATOS
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

        

        $router->render('admin/index', [
            'nombre'=>$_SESSION['nombre'],
            'citas'=>$citas,
            'fecha'=>$fecha,
            //'paginacion'=>$paginacion->paginacion()
        ]);
    }

    //reportes
    public static function reporte(Router $router){
        //session_start();

        isAdmin();

       //$id=$_GET['id'];
        

        // $paginaActual=$_GET['page'];
        // $paginaActual=filter_var($paginaActual, FILTER_VALIDATE_INT);

        // if(!$paginaActual || $paginaActual<1){
        //     header('Location:/admin?page=1');
        // }

        // //debuguear($paginaActual);

        // //$paginaActual=1;
        // $registrosPagina=5;
        // $total1=AdminCita::total();

        // $paginacion=new Paginacion($paginaActual, $registrosPagina, $total1);
        // //debuguear($paginacion->paginaSiguiente());
    
        // //$citasAdmin=AdminCita::all();
        
        // if($paginacion->totalPaginas() <$paginaActual){
        //     header('Location: /clientes?page=1');
        // }
        
        // //USUARIOS CLIENTES
        // $citas=AdminCita::paginar($registrosPagina, $paginacion->offset());
        // //debuguear($usuarios);

        $fecha=$_GET['fecha'] ?? date('Y-m-d');
        $fecha1=$_GET['fecha'] ?? date('Y-m-d');
        $fechas=explode('-',$fecha);
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('Location:/404');
        }

        $fechas1=explode('-',$fecha1);
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('Location:/404');
        }

        // $nombre=$GEt['cliente'] ?? NULL;
        // debuguear($nombre); 
        
        //debuguear($fecha);
        //CONSULTAR LA BASE DE DATOS
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

        

        $router->render('admin/reportes', [
            'nombre'=>$_SESSION['nombre'],
            'citas'=>$citas,
            'fecha'=>$fecha,
            //'paginacion'=>$paginacion->paginacion()
        ]);
    }
   
}