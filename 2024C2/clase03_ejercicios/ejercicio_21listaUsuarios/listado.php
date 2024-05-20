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


require_once("./Usuarios.php");

// Verificar si se recibieron los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Verificar si se recibieron todos los datos necesarios
    if (isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['mail']))
     {
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $mail = $_POST['mail'];

        // Crear un objeto Usuario con los datos recibidos
        $usuario = new Usuario($nombre, $clave, $mail);

        // Intentar agregar el usuario y obtener el resultado
        $resultado = $usuario->agregarUsuario();

        // Devolver el resultado como respuesta
        if ($resultado) 
        {
            echo "Usuario agregado exitosamente." . PHP_EOL;
            $usuario->mostrarUsuario();
        } 
        else 
        {
            echo "Error al agregar el usuario.";
        }
    } 
    else 
    {
        echo "Faltan datos.";
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "GET") 
{

    if( isset($_GET["usuarios"]) )
    {
        $listaDeUsuarios  = Usuario::cargarArchivoDeUsuarios("usuarios.csv");

        if(count($listaDeUsuarios) > 0)
        {
            echo PHP_EOL ."Se registrarion ". count($listaDeUsuarios) ." usuarios". PHP_EOL;
            foreach($listaDeUsuarios as $value)
            {
                echo 
                "<ul>
                <li>$value->nombre</li>
                <li>$value->clave</li>
                <li>$value->mail</li>
                </ul>" . PHP_EOL;
            }
        }
        else
        {
            echo "No se registraron usuarios en la lista, ingrese uno." . PHP_EOL;
        }

    }
    else
    {
        echo "Faltan datos." . PHP_EOL;
    }


    


}
else
{
    echo "Metodo no permitido.";
}






?>