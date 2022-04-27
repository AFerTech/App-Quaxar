<?php

namespace Model;

class usuario extends ActiveRecord{
    protected static $tabla= 'usuario';
    protected static $columnasDB=['id','nombre','email','password','token','confirmado'];


    public function __construct($args =[])
    {
        $this->id= $args['id'] ?? null;
        $this->nombre= $args['nombre'] ?? '';
        $this->email= $args['email'] ?? '';
        $this->password= $args['password'] ?? '';
        $this->password2= $args['password2'] ?? '';
        $this->token= $args['token'] ?? '';
        $this->confirmado= $args['confirmado'] ?? 0;
    }

    public function validarCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='Nombre obligatorio';
        }
        if (!$this->email){
            self::$alertas['error'][]='Correo obligatorio';
        }
        if (!$this->password){
            self::$alertas['error'][]='Escribir contraseña';
        }
        if (strlen($this->password)<8){
            self::$alertas['error'][]='La contraseña debe contener mínimo 8 carácteres';
        }
        if ($this->password!==$this->password2){
            self::$alertas['error'][]='Las contraseñas no son iguales';
        }
        return self::$alertas;


    }
    public function validarEmail(){
        if (!$this->email){
            self::$alertas['error'][]='Correo obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][]='Correo no valido';
        

        }
        return self::$alertas;
    }

    public function validarPassword(){

        if (!$this->password){
            self::$alertas['error'][]='Escribir contraseña';
        }
        if (strlen($this->password)<8){
            self::$alertas['error'][]='La contraseña debe contener mínimo 8 carácteres';
        }
        if ($this->password!==$this->password2){
            self::$alertas['error'][]='Las contraseñas no son iguales';
        }
        return self::$alertas;

    }

    public function hashPassword(){
        $this->password= password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = md5(uniqid() );
    }


}