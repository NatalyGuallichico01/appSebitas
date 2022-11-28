<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;
use MVC\Router;

$router = new Router();

//INICIAR SESION
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//RECUPERAR CONTRASEÑA
$router->get('/olvidarPassword', [LoginController::class, 'olvidarPassword']);
$router->post('/olvidarPassword', [LoginController::class, 'olvidarPassword']);
$router->get('/recuperarPassword', [LoginController::class, 'recuperarPassword']);
$router->post('/recuperarPassword', [LoginController::class, 'recuperarPassword']);

//CREAR CUENTA
$router->get('/crearCuenta', [LoginController::class, 'crearCuenta']);
$router->post('/crearCuenta', [LoginController::class, 'crearCuenta']);

//CONFIRMAR CUENTA
$router->get('/confirmarCuenta', [LoginController::class, 'confirmarCuenta']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//AREA PRIVADA
$router->get('/cita', [CitaController::class, 'index']);

//API DE CITAS
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();