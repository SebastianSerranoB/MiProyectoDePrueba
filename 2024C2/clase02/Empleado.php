<?php


require_once "./Usuario.php";

class Empleado extends Usuario
{
    public $edad;

    public function __construct($nombre, $apellido, $edad = 0)
    {
        parent::__construct($nombre, $apellido);

        //if(edad > 18)
        $this->edad = $edad;


    }

    public static function mostrarEstatico($empleado)
    {
        return $empleado->mostrarConRetorno() . " - Edad " . $empleado->edad;
    }

}

?>