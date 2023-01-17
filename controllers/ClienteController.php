<?php 
namespace Controllers;

use Model\Servicio;
use Model\Usuario;
use MVC\Router;
use Classes\Email;

class ClienteController{
    public static function index(Router $router){
        isAdmin();

        $usuarios=Usuario::all();

        $router->render('cliente/index', [
            'nombre'=>$_SESSION['nombre'],
            'usuarios'=>$usuarios

        ]);
    }

    public static function crear(Router $router){
        
        isAdmin();

        $usuario=new Usuario;

        //ALERTAS VACIAS
        $alertas=[];
        
        if($_SERVER ['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas=$usuario->validateNewAccount();
            
            //REVISAR QUE ALERTAS ESTE VACIO
            if (empty($alertas)){
                //verificar que el usuario no este registrado
                $resultado=$usuario->userExist();
                if ($resultado->num_rows){
                    $alertas=Usuario::getAlertas();
                }
                else{
                    //hashear el password
                    $usuario->hashPassword();

                    //generar el token  unico
                    $usuario->createToken();
                    //Enviar el Email
                    $email=new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->sendConfirmation();

                    //CREAR EL USUARIO
                    $resultado=$usuario->guardar();
                    if ($resultado){
                        header('Location: /mensaje');
                    }
                    
                    //debuguear($usuario);
                }
            }
        }

         $router->render('cliente/crear', [
             'nombre'=>$_SESSION['nombre'],
             'usuario'=>$usuario,
             'alertas'=>$alertas

        ]);
    }

    public static function actualizar(Router $router){
        isAdmin();

        if(!is_numeric($_GET['id'])) return;
        //debuguear($id);
        $usuario= Usuario::find($_GET['id']);

        //ALERTAS VACIAS
        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas=$usuario->validateNewAccount();

            if(empty($alertas)){
                $resultado=$usuario->guardar();
                header('Location:/clientes');
            }
        }

        $router->render('cliente/actualizar', [
            'nombre'=>$_SESSION['nombre'],
            'usuario'=>$usuario,
            'alertas'=>$alertas

        ]);
    }

    public static function eliminar(){
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id=$_POST['id'];
            $usuario=Usuario::find($id);
            $usuario->eliminar();
            header('Location: /clientes');
        }

        
    }

    

}