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


require_once("./Usuario.php");

//HARDCODE LISTA DE USUARIOS
$listaDeUsuarios = array();
array_push($listaDeUsuarios, new Usuario("sebastian@gmail.com","sebastian123") );
array_push($listaDeUsuarios, new Usuario("romeo@gmail.com","romeo321") );
array_push($listaDeUsuarios, new Usuario("julieta@gmail.com","julieta321") );
//mostrarla cuando se equivocan

// Verificar si se recibieron los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Verificar si se recibieron todos los datos necesarios
    if ( isset($_POST['clave']) && isset($_POST['mail']))
     {
        $clave = $_POST['clave'];
        $mail = $_POST['mail'];

        $usuario = new Usuario($mail, $clave);

       Usuario::verificarUsuarioEnLista($listaDeUsuarios ,$usuario);

    } 
    else 
    {
        echo "Faltan datos.";
    }
}
else
{
    echo "Metodo no permitido." . PHP_EOL;
}

/*
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

*/




?>