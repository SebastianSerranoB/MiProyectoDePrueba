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



//var_dump($_FILES);
// var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nombre"]) && isset($_POST["clave"]) && isset($_POST["mail"]) && isset($_FILES["archivo"])) 
    {
        include_once ("./Usuario.php");

        //falta validar inputs.
        $nombre_usuario = $_POST["nombre"];
        $clave_usuario = $_POST["clave"];
        $email_usuario = $_POST["mail"];
        $id_usuario = mt_rand(1, 10000);
        $fecha_registro_usuario = date("Y-m-d");

        $usuarioNuevo = new Usuario($nombre_usuario, $clave_usuario, $email_usuario, $id_usuario, $fecha_registro_usuario);


        if ($usuarioNuevo->guardarFoto()) 
        {
            echo "La foto del usuario se guardo exitosamente." . PHP_EOL;
        } 
        else 
        {
            echo "Hubo un problema al guardar la foto del usuario." . PHP_EOL;
        }


        if (Usuario::guardarUsuarioEnJson($usuarioNuevo)) 
        {
            echo "El usuario se guardo en formato JSON" . PHP_EOL;
        } 
        else 
        {
            echo "Error al guardar el usuario." . PHP_EOL;
        }


    } 
    else 
    {
        echo "Existen parametros vacios en el formulario." . PHP_EOL;
    }




}
else if ($_SERVER['REQUEST_METHOD'] == "GET") 
{
    if ($_GET['listado'] == "usuarios")
     {
        include_once ("./Usuario.php");
         
        $listaUsuarios =  Usuario::cargarUsuariosDesdeJSON('./usuarios.json');

        if( $listaUsuarios != null)
        {
            if(count($listaUsuarios) > 0)
            {
                Usuario::imprimirListaDeUsuarios($listaUsuarios);
            }
            else
            {
                echo "No se registraron usuarios en la lista. Esta vacia." . PHP_EOL;
            }
        }
        else
        {
            echo "Hubo un problema al leer el archivo .." . PHP_EOL;
        }

        /*
        En el caso de usuarios carga los datos del archivo usuarios.json.
        se deben cargar los datos en un array de usuarios.
        Retorna los datos que contiene ese array en una lista.
         */
    } 
    else 
    {
        echo "Parametro no permitido, ingrese 'usuarios'." . PHP_EOL;
    }
}
else 
{
    echo "El servidor solo acepta metodo POST o GET." . PHP_EOL;
}




?>