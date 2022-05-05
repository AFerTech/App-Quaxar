<?php

namespace Controllers;

use MVC\Router;

class DashboardController{
    public static function index( Router $router){

        session_start();

        isAuth();

        $router->render('dashboard/index', [

            'titulo' =>'Proyectos'
            
        ]);
    }
    public static function crear_proyectos(Router $router){
        session_start();
        $router->render('dashboard/crear_proyectos', [

            'titulo' =>'Crear Proyectos'
            
        ]);
    }
    public static function perfil(Router $router){
        session_start();
        $router->render('dashboard/perfil', [

            'titulo' =>'Perfil'
            
        ]);
    }
}