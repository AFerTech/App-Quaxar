<?php


namespace Controllers;

use Classes\Email;
use Model\usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
         
        $alertas =[];
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $usuario = new usuario($_POST);

            $alertas = $usuario->validarSesion();

            if(empty($alertas)){

                $usuario = usuario::where('email', $usuario->email);

                if(!$usuario || !$usuario->confirmado){
                    usuario::setAlerta('error', 'El usuario no existe o no confirmado');
                }else{
                    if(password_verify($_POST['password'], $usuario->password)){
                        

                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // redireccionar al dashboard
                        header('Location: /proyectos');

                        debuguear($_SESSION);

                    }else{
                        usuario::setAlerta('error', 'Contraseña incorrecta');  
                    }

                }
            }
        }
        $alertas = usuario::getAlertas();
        //render
        $router->render('auth/login',[
            'titulo' =>'Iniciar Sesión',
            'alertas'=> $alertas
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
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario = new usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)){
                // buscando el usuario
                $usuario= usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado){
                    
                    $usuario->crearToken();
                    unset ($usuario->password2);

                    $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarCorreoRecuperar();
                    

                    usuario::setAlerta('exito', 'Revisar Correo');

                }else{
                    usuario::setAlerta('error', 'Usuario no existe o no confirmado');
                   
                }
            }

        }
        $alertas = usuario::getAlertas();

        $router->render('auth/recuperar',[
            'titulo'=>'Recuperar cuenta',
            'alertas'=> $alertas
        ]);
    }

    public static function reestablecer(Router $router){

        $token = s($_GET['token']);
        $mostrar = true;

        if(!$token)  header('Location: /');

        $usuario = usuario::where('token', $token);

        if(empty($usuario)){
            usuario::setAlerta('error', 'Error');
            $mostrar=false;
        }
       
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarPassword();

            if(empty($alertas)){


                $usuario->hashPassword();

                $usuario->token=null;

                $resultado = $usuario->guardar();

                if($resultado){
                    header('Location: /');
                }


                debuguear($usuario);
            }
        }

        $alertas = usuario::getAlertas();

        $router->render('auth/reestablecer',[
            'titulo'=>'Reestablecer contraseña',
            'alertas'=> $alertas,
            'mostrar'=> $mostrar
            
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