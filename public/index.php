<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\DashboardController;
$router = new Router();

//Login
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);


//Crear cuenta

$router->get('/crear',[LoginController::class,'crear']);
$router->post('/crear',[LoginController::class,'crear']);

//Recuperar contraseña

$router->get('/recuperar',[LoginController::class,'recuperar']);
$router->post('/recuperar',[LoginController::class,'recuperar']);

//nueva contraseña
$router->get('/reestablecer',[LoginController::class,'reestablecer']);
$router->post('/reestablecer',[LoginController::class,'reestablecer']);

//confirmar cuenta
$router->get('/mensaje',[LoginController::class,'mensaje']);
$router->get('/confirmar',[LoginController::class,'confirmar']);

// Dashboard
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/crear_proyectos', [DashboardController::class, 'crear_proyecto']);
$router->post('/crear_proyectos', [DashboardController::class, 'crear_proyecto']);
$router->get('/proyectos', [DashboardController::class, 'proyectos']);
$router->get('/perfil', [DashboardController::class, 'perfil']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();