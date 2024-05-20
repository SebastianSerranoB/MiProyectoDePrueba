<?php

/*
        Aplicación No 23 (Registro JSON)
    Archivo: registro.php
    método:POST
    Recibe los datos del usuario(nombre, clave,mail )por POST ,
    crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
    fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
    guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
    Usuario/Fotos/.
    retorna si se pudo agregar o no.
    Cada usuario se agrega en un renglón diferente al anterior.
    Hacer los métodos necesarios en la clase usuario.

    ALUMNO: SEBASTIAN SERRANO BELLOSO
    DNI: 42810404

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

    //como referencio luego las fotos a cada usuario, deberia tener un atributo ruta en la clase usuario para esto?
    public function guardarFoto()
    {

        //es correcto acceder desde Usuario a la variable superglobal $_FILES? con que criterio de "privacidad" o seguridad o encapsulamiento debemos manejar estas variables superglobales?

        $tipo_archivo = $_FILES['archivo']['type'];
        $tamano_archivo = $_FILES['archivo']['size'];
       
        // Realizamos las validaciones del archivo
        if (((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000))) //100000 == 100kb
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


    public static function guardarUsuarioEnJson($usuarioAGuardar)
    {
        //YYYY-MM-DD  = ("Y-m-d") ESTE FORMATO ES EL QUE ACEPTA JSON, ojo con los dateformat
        //JSON NO ENTIENDE METODOS MAGICOS NI ACCEDE A ATRIBUTOS PRIVADOS, OJO

        // Convertir el objeto usuario a JSON
        $usuario_json = json_encode($usuarioAGuardar,JSON_PRETTY_PRINT);
        //JSON_PRETTY_PRINT agrega sangrias y saltos de linea, lo que los hace mas legible para los humanos y mas sencillo de debugear.
       

        // Guardar el usuario en un archivo JSON
        $usuarios_Archivo = "usuarios.json";
       
        //File_append para escribir al final del archivo y php_eol para el salto de linea para cada obj
        if( file_put_contents($usuarios_Archivo, $usuario_json . PHP_EOL, FILE_APPEND) )
       {
            return true;
       }

       return false;
    }

    


}

?>