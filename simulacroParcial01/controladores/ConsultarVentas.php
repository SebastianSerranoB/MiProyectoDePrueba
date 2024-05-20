<?php
/*
     if( $_GET['form_type'] == 'cantidadVentasPorFecha' || $_GET['form_type'] == 'listarVentasPorUsuario'
                    || $_GET['form_type'] == 'listarVentasPorPeriodo' || $_GET['form_type'] == 'listarVentasPorSabor' || $_GET['form_type'] == 'listarVentasPorVaso')
                {

*/


include_once("./modelos/Heladeria.php");

switch($_GET['form_type'])
{
    case 'cantidadVentasPorFecha':
        if (isset($_GET['fechaVenta']))
        {
           if(Validador::validarFormatoFecha( $_GET['fechaVenta'])) 
           {
                 Heladeria::listarCantidadDeHeladosVendidosPorFecha($_GET['fechaVenta']);
           }
           else
           {
                echo "Formato de fecha no aceptado. Intente con d-m-Y" . PHP_EOL;
           }
        } 
        else
        {
            echo "No se ingreso una fecha determinada." . PHP_EOL;
            Heladeria::listarCantidadDeHeladosVendidosPorFecha( date('d-m-Y', strtotime('-1 day')) );
        }
        break;
    
    case 'listarVentasPorUsuario':
        if(isset($_GET['emailUsuario']) && Validador::validarCorreo($_GET['emailUsuario']))
        {
            Heladeria::listarVentasPorUsuario($_GET['emailUsuario']);
        }
        else
        {
            echo "Error al ingresar email.". PHP_EOL;
        }
        break;
    
    case 'listarVentasPorPeriodo':
        if(isset($_GET['fechaDesde'])  && isset($_GET['fechaHasta']) && Validador::validarFormatoFecha($_GET['fechaDesde']) && Validador::validarFormatoFecha($_GET['fechaHasta']) )
        {
            Heladeria::listarVentasPorPeriodo($_GET['fechaDesde'], $_GET['fechaHasta']);
        }
        else
        {
            echo "Error al ingresar fechas. Formato no aceptado. Intente con d-m-Y" . PHP_EOL;
        }
        //listarpor();
        break;

    case 'listarVentasPorSabor':
        if(isset($_GET['sabor'])  && Validador::validarNombre($_GET['sabor']))
        {
            Heladeria::listarVentasPorSabor($_GET['sabor']);
        }
        else
        {
            echo "Error al ingresar sabor." . PHP_EOL;
        }
       
    case 'listarVentasPorVaso':
        if(isset($_GET['vaso']) && Validador::validadorVasoHelado($_GET['vaso']))
        {
            Heladeria::listarVentasPorVaso($_GET['vaso']);
        }
        else
        {
            "Error al ingresar vaso." . PHP_EOL;
        }
       
        break;

    default:
        echo "Formulario no aceptado." . PHP_EOL;
        break; 
}




?>