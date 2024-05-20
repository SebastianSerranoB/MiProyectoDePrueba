<?php

//ALUMNO: SERRANO BELLOSO SEBASTIAN
//DNI : 42810404


/*
    Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario
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
else
{
    echo "Método no permitido.";
}



?>