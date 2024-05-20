<?php

/*
   Aplicación No 22 ( Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.

    ALUMNO: SEBASTIAN SERRANO BELLOSO
    DNI: 42810404
*/



class Usuario 
{
    public $mail;
    public $clave;
   

   
    public function __construct($mail, $clave) 
    {
        $this->mail = $mail;
        $this->clave = $clave;
    }

    
    public function agregarUsuario() 
    {
        $linea = $this->clave . ',' . $this->mail . "\n";
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
        echo  "- Clave: $this->clave, Mail: $this->mail." . PHP_EOL;
    }

    public static function mostrarListaDeUsuarios($listaDeUsuarios)
    {
        if(count( $listaDeUsuarios) > 0)
        {
            foreach ($listaDeUsuarios as $value)
            {
                $value->mostrarUsuario();
            }

        }
        else
        {
            echo "Lista vacia". PHP_EOL;
        }

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
               
                if(count($elementosDeLaLinea) == 2) 
                {
                    $usuarioLeido = new Usuario($elementosDeLaLinea[0], $elementosDeLaLinea[1]);
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



public static function verificarUsuarioEnLista($listaDeUsuarios, $usuarioIngresado)
{
   
   if($listaDeUsuarios > 0)
   {
        $flagUsuarioEncontrado = false;
        foreach($listaDeUsuarios as $value)
        {
         
            if($value->mail == $usuarioIngresado->mail)
            {
                $flagUsuarioEncontrado = true;
                
                if($value->clave == $usuarioIngresado->clave)
                {
                    echo "Verificado" . PHP_EOL;
                }
                else
                {
                    echo "Error en los datos" . PHP_EOL;
                }
                break;
            }
        }

        if(!$flagUsuarioEncontrado)
        {
            echo "Usuario no registrado." . PHP_EOL;
            echo "- Lista de usuarios registrados  -" . PHP_EOL;
            Usuario::mostrarListaDeUsuarios($listaDeUsuarios);
        }
      

   }
   else
   {
    echo "La lista no contiene usuarios registrados" . PHP_EOL;
   }

}


}

?>