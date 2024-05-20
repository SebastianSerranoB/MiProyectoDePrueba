<?php

 /*
Aplicación No 24 ( Listado JSON y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,etc.),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.json.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista.
Hacer los métodos necesarios en la clase usuario

ALUMNO: SEBASTIAN SERRANO BELLOSO
DNI: 428104404

*/



class Usuario
{
    public $nombre;
    public $clave;
    public $email;
    public $id;
    public $fecha_Registro;


    public function __construct($nombre, $clave, $email, $id, $fecha_Registro)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->email = $email;
        $this->id = $id;
        $this->fecha_Registro = $fecha_Registro;
    }

    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) 
        {
            return $this->$propiedad;
        }
       
    }

    public function __set($propiedad, $valor)
    {
        if(property_exists($this, $propiedad))
        {
            if($propiedad == 'nombre' && is_string($valor))
            {
                 $this->nombre = $valor;
            }
            else if($propiedad == 'fecha_Registro' && is_string($valor) && DateTime::createFromFormat("d/m/Y", $valor) != false) 
            {
                 $this->fecha_Registro = $valor;
            }
            else if($propiedad == 'email' && is_string($valor))
            {
                 $this->email =  $valor;
            }
            else if($propiedad == 'clave' && is_string($valor))
            {
                 $this->clave =  $valor;
            }
            else if($propiedad == 'id' && is_numeric($valor)  && $valor > -1)
            {
                 $this->id =  $valor;
            }

        }
       
    }

  
    public function guardarFoto()
    {
        $tipo_archivo = $_FILES['archivo']['type'];
        $tamano_archivo = $_FILES['archivo']['size'];
       
        // Realizamos las validaciones del archivo
        if (((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 1000000))) //100000 == 100kb
        {
            $rutaFotosUsuarios = "Usuarios/Fotos/" . basename($_FILES["archivo"]["name"]);    //basename quita la ruta y se queda solo con el nombre del archivo
            if( move_uploaded_file($_FILES["archivo"]["tmp_name"], $rutaFotosUsuarios) )
            {
                 return true;
            }
        }
        else
        {
            echo "La extensión o el tamaño de los archivos no es correcta. Se permiten archivos .png o .jpg, se permiten archivos de 100 Kb como máximo" . PHP_EOL;
        }

       return null;
    }






/*
    Para que tu archivo JSON sea válido, necesitas envolver todos los objetos de usuario dentro de un array principal. 
    En JSON, un objeto se define por llaves {} y un array se define por corchetes []. 
    Entonces, necesitas envolver todos tus objetos de usuario dentro de un array. 
*/
    public static function guardarUsuarioEnJson($usuarioAGuardar)
    {
        /*
        
       //Deberia guardar los usuarios en un array, de arrays.
        $usuario_json = json_encode($usuarioAGuardar,JSON_PRETTY_PRINT);
      
        $usuarios_Archivo = "usuarios.json"; */
       
        /*
    // Envolver los usuarios en corchetes si aún no están envueltos
    if (!file_exists($usuarios_Archivo) || filesize($usuarios_Archivo) === 0)
     {
        $usuarios_json = "[" . $usuarios_json . "]";
    }

    Esta forma seria util si recibieras un archivo que no tuviera los corchetes, 
    */
/*
        if( file_put_contents($usuarios_Archivo, $usuario_json . PHP_EOL, FILE_APPEND) )
       {
            return true;
       }

       return false;*/
       

      
       // Cargar usuarios existentes desde el archivo
       $usuarios = self::cargarUsuariosDesdeJSON("usuarios.json");
   
       // Si no hay usuarios existentes, inicializar la lista
       if ($usuarios === null) 
       {
           $usuarios = array();
       }
   
       // Agregar el nuevo usuario a la lista
       $usuarios[] = $usuarioAGuardar;
   
       // Convertir la lista de usuarios a JSON
       $usuarios_json = json_encode($usuarios, JSON_PRETTY_PRINT);
     
       $usuarios_Archivo = "usuarios.json";
   
       // Guardar el JSON en el archivo
       if (file_put_contents($usuarios_Archivo, $usuarios_json . PHP_EOL, LOCK_EX)) 
       {
           return true;
       }
   
       return false;
    }

    public static function cargarUsuariosDesdeJSON($rutaArchivo) 
    {
        
        if(file_exists($rutaArchivo))
        {
            $listaUsuarios = array();

            $json_data = file_get_contents($rutaArchivo);
            //var_dump($json_data);
            $data = json_decode($json_data, true);
            //var_dump($data); //da null
 

            if($data != null)
            {
                foreach ($data as $usuario_data) 
                {
                    $usuario = new Usuario
                    (
                        $usuario_data['nombre'],
                        $usuario_data['clave'],
                        $usuario_data['email'],
                        $usuario_data['id'],
                        $usuario_data['fecha_Registro']
                    );
                    $listaUsuarios[] = $usuario;
                }
    
                 return $listaUsuarios;
            }

        }
       
      
        return null;
    }

    public static function imprimirListaDeUsuarios($listaUsuarios)
    {
        foreach($listaUsuarios as $usuario)
        {
            echo "--  USUARIO  --" . PHP_EOL; 
            echo "Nombre: " . $usuario->nombre . PHP_EOL;
            echo "Clave: " . $usuario->clave . PHP_EOL;
            echo "Email: " . $usuario->email. PHP_EOL;
            echo "ID: " . $usuario->id . PHP_EOL;
            echo "Fecha de registro: " . $usuario->fecha_Registro . PHP_EOL . PHP_EOL;

        }

    }



}



?>