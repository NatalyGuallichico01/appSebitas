<?php

namespace Model;

class Servicio extends ActiveRecord{
    //base de datos
    protected static $tabla='servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;
    //public $detalle;

    public function __construct($args=[]){
        $this->id= $args['id'] ?? null;
        $this->nombre= $args['nombre'] ?? '';
        $this->precio= $args['precio'] ?? '';
        //$this->detalle= $args['detalle'] ?? '';

    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][]='El campo Nombre del Servicio es obligatorio';
        }
        if(!$this->precio){
            self::$alertas['error'][]='El campo Precio del Servicio es obligatorio';
        }
        if(!is_numeric($this->precio)){
            self::$alertas['error'][]='El Precio del Servicio no es válido';
        }
        // if(!$this->detalle){
        //     self::$alertas['error'][]='El campo Detalle del Servicio es obligatorio';
        // }

        return self::$alertas;
        
    }
}