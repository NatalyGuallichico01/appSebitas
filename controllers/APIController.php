<?php
namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController{
    public static function index(){
        $servicios=Servicio::all();
        //debuguear($servicios);
        echo json_encode($servicios);
       
    }

    public  static function guardar(){
        //ALMACENA LA CITA Y DEVUELVE EL ID
        $cita= new Cita($_POST);
        $resultado=$cita->guardar();

        $id=$resultado['id'];
        
        //almacena las citas y el servicio
        //almacena los servicios con elidde la cita
        $idServicios=explode(",", $_POST['servicios']);
        $resultado=[
            'servicios'=>$idServicios
        ];

        foreach($idServicios as $idServicio){
            $args=[
                'citaId'=>$id,
                'servicioId'=>$idServicio
            ];
            $citaServicio= new CitaServicio($args);
            $citaServicio->guardar();
        }
        // //retornamos una respuesta
        // $respuesta=[
        //     'resultado'=>$resultado
        // ];

        echo json_encode(['resultado'=>$resultado]);
    }

    public static function delete(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $id=$_POST['id'];
            $cita=Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
            
        }
    }
}