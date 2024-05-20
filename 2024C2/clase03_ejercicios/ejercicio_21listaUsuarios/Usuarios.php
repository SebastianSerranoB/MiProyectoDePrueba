<?php

/*
    Aplicación No 21 ( Listado CSV y array de usuarios)
    Archivo: listado.php
    método:GET
    Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
    usuarios).
    En el caso de usuarios carga los datos del archivo usuarios.csv.
    se deben cargar los datos en un array de usuarios.
    Retorna los datos que contiene ese array en una lista

    <ul>
    <li>Coffee</li>
    <li>Tea</li>
    <li>Milk</li>
    </ul>
    Hacer los métodos necesarios en la clase usuario


    ALUMNO: SEBASTIAN SERRANO BELLOSO
    DNI: 42810404

*/



class Usuario 
{
    public $nombre;
    public $clave;
    public $mail;

   
    public function __construct($nombre, $clave, $mail) {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
    }

    
    public function agregarUsuario() 
    {
        $linea = $this->nombre . ',' . $this->clave . ',' . $this->mail . "\n";
        if (file_put_contents('usuarios.csv', $linea, FILE_APPEND | LOCK_EX) !== false) 
        {
            return true;
        }
        else
        {
            return false;
        }
    
    }

    public function mostrarUsuario()
    {
        echo  "- USUARIO -" . PHP_EOL;
        echo  "- Nombre: $this->nombre, Clave: $this->clave, Mail: $this->mail." . PHP_EOL;
    }


    public static function cargarArchivoDeUsuarios($nombreArchivo)
    {
        $listaDeUsuarios = array();

        $archivo = fopen($nombreArchivo, "r");
        if($archivo)
        {
            while(!feof($archivo))
            {
                $linea = fgets($archivo);
                $elementosDeLaLinea = explode(",", $linea);
               
                if(count($elementosDeLaLinea) == 3) 
                {
                    $usuarioLeido = new Usuario($elementosDeLaLinea[0], $elementosDeLaLinea[1], $elementosDeLaLinea[2]);
                    array_push($listaDeUsuarios, $usuarioLeido);
                }
            
              
            }
    
            fclose($archivo);
        }
        else
        {
            echo "No se encontro el archivo.";
        }
      


        return $listaDeUsuarios;
    }


}

?>