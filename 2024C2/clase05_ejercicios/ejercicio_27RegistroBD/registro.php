<?php

/*
    Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST , crear
un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.

ALUMNO: SEBASTIAN SERRANO BELLOSO
DNI: 42810404

*/
//dsn o conStr connectionString
//Usuario: root@localhost usuario que me figura por defecto en phpmyadmin, root ee el user
//la contraseña por defecto esta desactivada
$dsn = 'mysql:host=localhost;dbname=clase_05ejerciciospdo';
$user = 'root';

try
{
    $pdo = new PDO($dsn, $user);
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}

$conexion = null; //la destruyo, si no, pdo lo hace por defecto



?>