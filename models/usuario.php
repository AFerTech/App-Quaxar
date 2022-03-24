<?php

namespace Model;

class usuario extends ActiveRecord{
    protected static $tabla= 'usuarios';
    protected static $columnasDB=['id','nombre','email','password','token','confirmado'];


    public function __construct($args =[])
    {
        $this->id= $args['id'] ?? null;
        $this->nombre= $args['nombre'] ?? '';
        $this->email= $args['email'] ?? '';
        $this->password= $args['password'] ?? '';
        $this->token= $args['token'] ?? '';
        $this->confirmado= $args['confirmado'] ?? '';
    }

    public function validarCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='Nombre obligatorio';
        }
        if (!$this->email){
            self::$alertas['eror'][]='Correo obligatorio';
        }
        return self::$alertas;


    }
}