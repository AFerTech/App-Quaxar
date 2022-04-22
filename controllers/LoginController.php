<?php


namespace Controllers;

use Classes\Email;
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


                // hashear password
                $usuario->hashPassword();
                // eliminar password 2
                unset($usuario->password2);
                // generar token
                $usuario->crearToken();
                
                // debuguear($usuario);

                // Crear el nuevo usuario
               $resultado = $usuario->guardar();

                // Envio de email
                $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                
                $email->enviarCorreoConfirmacion();

               if ($resultado){
                   header('Location: /mensaje');
               }
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
        $token = s($_GET['token']);
        
    
        if(!$token) header('Location: /');

        $usuario = usuario::where('token', $token);
        if(empty($usuario)){
            usuario::setAlerta('error', 'Token no valido');
        }else{
            $usuario->confirmado=1;
            $usuario->token = null;
            unset($usuario->password2);
            
            $usuario->guardar();

            usuario::setAlerta('exito', 'Cuenta creada correctamente');
        }

        $alertas= usuario::getAlertas();
        
        $router->render('auth/confirmar',[
            'titulo'=>'Confirmar cuenta',
            'alertas'=> $alertas
        ]);

        
    }
}