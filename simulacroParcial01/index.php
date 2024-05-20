<?php

/*
ALUMNO: SEBASTIAN SERRANO BELLOSO
DNI: 42810404.

1-
A- (1 pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a qué archivo se debe incluir.
B- (1 pt.) HeladeriaAlta.php: (por POST) se ingresa Sabor, Precio, Tipo (“Agua” o “Crema”), Vaso (“Cucurucho”,
“Plástico”), Stock (unidades).
Se guardan los datos en en el archivo de texto heladeria.json, tomando un id autoincremental como
identificador(emulado) .Sí el nombre y tipo ya existen , se actualiza el precio y se suma al stock existente.
completar el alta con imagen del helado, guardando la imagen con el sabor y tipo como identificación en la
carpeta /ImagenesDeHelados/2024.
el nombre del helado es el sabor.
*/

if(isset($_SERVER['REQUEST_METHOD']))
{

    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'POST':
            if(isset($_POST['form_type']))
            {
                switch($_POST['form_type'])
                {
                    case 'altaHelado':
                        include_once("./controladores/HeladeriaAlta.php");
                    break;

                    case 'heladoConsultar':
                        include_once("./controladores/HeladoConsultar.php");
                        break;
                    
                    case 'altaVenta':
                    include_once("./controladores/AltaVenta.php");
                    break;
        
                    default:
                        echo "Tipo de formulario no aceptado." . PHP_EOL;
                        break;
                }
            }
            else
            {
                echo "Indique el tipo de formulario en el input form_type." . PHP_EOL;
            }
            break;
        
        case 'GET':
            if(isset($_GET['form_type']))
            {
                if( $_GET['form_type'] == 'cantidadVentasPorFecha' || $_GET['form_type'] == 'listarVentasPorUsuario'
                    || $_GET['form_type'] == 'listarVentasPorPeriodo' || $_GET['form_type'] == 'listarVentasPorSabor' || $_GET['form_type'] == 'listarVentasPorVaso')
                {
                    include_once("./controladores/ConsultarVentas.php");
                }
                else
                {
                    echo "Tipo de formulario no permitido." . PHP_EOL;
                }
            }
            else
            {
                echo "Indique el tipo de formulario en el input form_type." . PHP_EOL;
            }
            break;

        case 'PUT':
            //php://input es un flujo de sólo lectura que permite acceder al cuerpo de la solicitud HTTP.
            parse_str(file_get_contents("php://input"), $putData);
            if(isset($putData['form_type']))
            {
                if($putData['form_type'] == 'modificarVenta')
                {
                    include_once("./controladores/ModificarVenta.php");
                }
                else
                {
                    echo "Formulario no permitido." . PHP_EOL;
                }
            }
            else
            {
                echo "Indique el tipo de formulario en el input form_type" . PHP_EOL;
            }
            break;

        case 'DELETE':
            if(isset($_GET['form_type']) )
            {

                if($_GET['form_type'] == 'borrarVenta')
                {
                    echo "Hola desde borrar venta";
                    include_once("./controladores/borrarVenta.php");
                }
                else
                {
                    echo "Formulario no permitido." . PHP_EOL;
                }
            }
            else
            {
                echo "Indique el tipo de formulario en el input form_type." . PHP_EOL;
            }

           
            break;


        default:
            echo "Verbo/Metodo HTTP no permitido." . PHP_EOL;
        break;
    }



}
else
{
    echo "Utilize un verbo HTTP para comunicarse." . PHP_EOL;
}




?>