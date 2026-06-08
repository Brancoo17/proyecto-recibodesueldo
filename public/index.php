<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\EmpleadoController;
use Controllers\ReciboController;
use Controllers\AdminController;
use Controllers\LoginAdminController;

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
$router->get('/empleado/cuenta', [EmpleadoController::class, 'cuenta']);
$router->post('/empleado/cuenta', [EmpleadoController::class, 'cuenta']);

// ── Recibos del EMPLEADO ──
$router->get('/recibos', [ReciboController::class, 'index']);
$router->get('/recibos/descargar', [ReciboController::class, 'descargar']);

// ── Login del ADMINISTRADOR ──
$router->get('/admin/login', [LoginAdminController::class, 'login']);
$router->post('/admin/login', [LoginAdminController::class, 'login']);
$router->get('/admin/logout', [LoginAdminController::class, 'logout']);

// ── Panel del ADMINISTRADOR ──
$router->get('/admin', [AdminController::class, 'index']);
$router->get('/admin/recibos/subir', [AdminController::class, 'subirRecibos']);
$router->post('/admin/recibos/subir', [AdminController::class, 'procesarRecibos']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();