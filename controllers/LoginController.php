<?php


namespace Controllers;

use Model\usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
         

        if($_SERVER['REQUEST_METHOD']==='post'){

        }
        //render
        $router->render('auth/login',[
            'titulo' =>'Iniciar Sesión'
        ]);
    }

    public static function logout(){
        echo "Desde logout"; 


    }

    public static function crear(Router $router){ 
        $alertas = [];
        $usuario = new usuario;

        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->validarCuenta();

           if(empty($alertas)){
            $existeUsuario= usuario::where('email',$usuario->email);

            if($existeUsuario){
                usuario::setAlerta('error','Usuario ya registrado');
                $alertas= usuario::getAlertas();
            }else{
                
                // Crear el nuevo usuario
            }
           }
        }
        $router->render('auth/crear',[
            'titulo'=> 'Crear cuenta',
            'usuario'=> $usuario,
            'alertas'=> $alertas
        ]);
    }

    public static function recuperar(Router $router){ 
        if($_SERVER['REQUEST_METHOD']==='post'){

        }
        $router ->render('auth/recuperar',[
            'tiutlo'=>'Recuperar contraseña'
        ]);
    }

    public static function reestablecer(Router $router){
        if($_SERVER['REQUEST_METHOD']==='post'){

        }
        $router ->render('auth/reestablecer',[
            'tiutlo'=>'Reestablecer contraseña'
        ]);
    }

    public static function mensaje(Router $router){
        
        $router->render('auth/mensaje',[
            'titulo'=>'Cuenta creada exitosamente'
        ]);

        
    }
    
    public static function confirmar(Router $router){
        
        $router->render('auth/confirmar',[
            'titulo'=>'Confirmar cuenta'
        ]);

        
    }
}