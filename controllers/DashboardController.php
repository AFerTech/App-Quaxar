<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Proyecto;

class DashboardController{
    public static function index( Router $router){

        session_start();
        isAuth();
        $id= $_SESSION['id'];

        $proyectos = Proyecto::belongsTo('propietarioId', $id);
        
        $router->render('dashboard/proyectos', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
            
        ]);
    }
    public static function crear_proyecto(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            // validación
            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)) {
                // Generar una URL única 
                $hash = md5(uniqid());
                $proyecto->url = $hash;

                // Almacenar el creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];
                // debuguear($proyecto);
                // Guardar el Proyecto
                $proyecto->guardar();

                // Redireccionar
                header('Location: /proyectos?id=' . $proyecto->url);

            }
        }

        $router->render('dashboard/crear_proyectos', [
            'alertas' => $alertas,
            'titulo' => 'Crear Proyecto'
        ]);
    }

    public static function proyectos(Router $router){
        session_start();
        isAuth();
        
        
        $url = $_GET['id'];
        if(!$url) header('Location: /dashboard');
        // Verifica que el usuario que visite el proyecto es el que lo creo
        $proyecto = Proyecto::where('url', $url);
        
        if($proyecto->propietarioId !== $_SESSION['id']){
             header('Location: /dashboard');

        }
        
        $router->render('dashboard/proyectos', [
            'titulo' => $proyecto->proyecto
        ]);
    }
    
    public static function perfil(Router $router){
        session_start();
        $router->render('dashboard/perfil', [

            'titulo' =>'Perfil'
            
        ]);
    }
}