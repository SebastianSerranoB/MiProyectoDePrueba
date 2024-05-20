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

//var_dump($_FILES);
// var_dump($_POST);
    
// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
   
    if(isset($_POST["nombre"] ) && isset($_POST["clave"] ) && isset($_POST["mail"]) && isset($_FILES["archivo"]))
    {
        //Incluyo archivo con clase usuarios
        include_once("./Usuario.php");
        //Recibir los datos del formulario
        //Falta validar, clase validadora puede ser una buena idea.
        $nombre_usuario = $_POST["nombre"];
        $clave_usuario = $_POST["clave"];
        $email_usuario = $_POST["mail"];
        $id_usuario = mt_rand(1, 10000); // Generar ID autoincremental (emulado)
        $fecha_registro_usuario = date("Y-m-d");  // Obtener la fecha actual (d/m/Y) no lo acepta json, ojo
 
        $usuarioNuevo = new Usuario($nombre_usuario, $clave_usuario, $email_usuario, $id_usuario, $fecha_registro_usuario);
        //var_dump($usuarioNuevo);
        
        
        //guardo el archivo en Usuarios/Fotos
        if($usuarioNuevo->guardarFoto())
        {
            echo "La foto del usuario se guardo exitosamente." . PHP_EOL;
        } 
        else
        {
            echo "Hubo un problema al guardar la foto del usuario." . PHP_EOL;
        }
        
        //guardo obj usuario en archivo usuarios.json
        if(Usuario::guardarUsuarioEnJson($usuarioNuevo) )
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
else
{
    echo "El servidor solo acepta metodo POST." . PHP_EOL;
}




?>