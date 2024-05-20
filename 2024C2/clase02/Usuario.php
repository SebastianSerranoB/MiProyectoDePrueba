<?php

class Usuario
{

    public $nombre;
    public $apellido;

    public function __construct($nombre, $apellido)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function mostrarConRetorno()
    {
        return $this->nombre ." " . $this->apellido;
    }

   

    
}

?>