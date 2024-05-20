<?php


/*
    3-
        a- (1 pts.) AltaVenta.php: (por POST) se recibe el email del usuario y el Sabor, Tipo y Stock, si el ítem existe en
        heladeria.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) .
        Se debe descontar la cantidad vendida del stock.
       
        b- (1 pt) Completar el alta de la venta con imagen de la venta (ej:una imagen del usuario), guardando la imagen
        con el sabor+tipo+vaso+mail(solo usuario hasta el @) y fecha de la venta en la carpeta
        /ImagenesDeLaVenta/2024.

*/

if(issetPostVenta())
{
   include_once("./modelos/Validador.php");
   if(Validador::validarDatosVenta($_POST['sabor'], $_POST['email'], $_POST['tipo'], $_POST['stock'], $_FILES['imagen'])) 
   {
  
    include_once("./modelos/Venta.php");
    include_once("./modelos/Heladeria.php");    

    $ventaNueva = new Venta($_POST['sabor'], $_POST['tipo'], $_POST['stock'], $_POST['email'], date("d-m-Y"));
    Heladeria::altaVenta($ventaNueva, $_FILES['imagen']);
    
   }
   else
   {
        echo "Hubo un error en el ingreso de datos." . PHP_EOL;
   }
    
}
else
{
    echo "Complete todos los campos del formulario." . PHP_EOL;
}
















function issetPostVenta()
 {
    if( isset($_POST['sabor']) && isset($_POST['email']) && isset($_POST['tipo'])  && isset($_POST['stock']) && isset($_FILES['imagen']) )
    {
        return true;
    }

    return false;
 }


?>