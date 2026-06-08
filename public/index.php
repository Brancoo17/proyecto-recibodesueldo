<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\EmpleadoController;

$router = new Router();

// Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// AREA PRIVADA

// Empleado
$router->get('/empleado', [EmpleadoController::class, 'index']);
$router->get('/empleado/recibos', [EmpleadoController::class, 'recibos']);
$router->get('/empleado/cuenta', [EmpleadoController::class, 'cuenta']);
$router->post('/empleado/cuenta', [EmpleadoController::class, 'cuenta']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();