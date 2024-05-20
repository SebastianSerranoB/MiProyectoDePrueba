<?php

include_once("Helado.php");
include_once("Venta.php");
include_once("./controladores/HandlerArchivos.php");
class Heladeria
{
    //hago una list static porque pretendo que mi aplicacion maneje una unica heladeria, con una unica lista de helados.
    //PATRON SINGLETON, SOLO NECESARIO SI EN ALGUN MOMENTO NECESITO INSTANCIAR LA CLASE, SINO LO SACO.
    //puedo manejar directamente desde archivos
   // private static $listaHelados = array(); 
// public static function getListaHelados(){  return self::$listaHelados;}

    
    //static ABM lista helados agregar, modificar, eliminar.
    //static guardar//Cargar en formato json y en formato csv o txt
    //static imprimir listaHelados
    //etc



    public static function consultarHelado($saborIngresado, $tipoIngresado)
    {
        $listaHelados = self::cargarListaHeladosDesdeJSON('heladeria.json');
        if($listaHelados != null && count($listaHelados) > 0)
        {
            $flagTipo = false;
            foreach($listaHelados as $helado)
            {
                if(strcasecmp($helado->sabor, $saborIngresado ) === 0 && strcasecmp($helado->tipo, $tipoIngresado ) === 0)
                {
                    return "existe";
                }
                else
                {
                    if(strcasecmp($helado->sabor, $saborIngresado ) === 0)
                    {
                        return "El sabor existe, pero no el tipo ingresado.";
                    }
                    else if( strcasecmp($helado->tipo, $tipoIngresado ) === 0 )
                    {
                        $flagTipo = true;
                    }
                    
                }
            }
        }

        if($flagTipo)
        {
            return "El tipo ingresado existe, pero no el sabor.";
        }

        return "No existen el sabor ni el tipo en la lista.";
    }
        
        
    
    //esta funcion despues con put/modificar posiblmente cambie y sino le tenemos que cambair el nombre porque no es claro
    //ejemplo, modificar Helado, en altaHelado llamamos a consultarHelado -> if ok -> modificarHelado.
    public static function buscarHeladoPorSaborYTipoYModificarlo($heladoAComparar)
    {
        if($heladoAComparar != null)
        {
           $listaHelados = self::cargarListaHeladosDesdeJSON('heladeria.json');
            if($listaHelados != null && count($listaHelados) > 0)
            {
                foreach($listaHelados as $helado)
                {
                    if( $helado->equals($heladoAComparar))
                    {
                        $helado->precio = $heladoAComparar->precio;
                        $helado->stock += $heladoAComparar->stock;
                        return $listaHelados;
                    }
                }

                return null;
            }
        }

        return null;
    }

    public static function altaHelado($heladoNuevo, $imagenHeladoNuevo)
    {
        if($heladoNuevo != null)
        {
            $listaHelados = self::buscarHeladoPorSaborYTipoYModificarlo($heladoNuevo);
            if($listaHelados != null)
            {
                if(HandlerArchivos::escribirArchivoJson('heladeria.json', $listaHelados) )
                {
                    echo "Se ha modificado el precio y stock del PRODUCTO." . PHP_EOL;
                }
                else
                {
                    echo "Error al modificar producto." . PHP_EOL;
                }
            
            }
            else
            {
                $heladoNuevo->id = Heladeria::asignarIdHelado();
                if( Heladeria::agregarHeladoAListaEnJSON($heladoNuevo, 'heladeria.json') )
                {

                    $extensionArchivo = pathinfo($imagenHeladoNuevo['name'], PATHINFO_EXTENSION);  
                    $rutaDeseada = "./media/ImagenesDeHelados/2024/" . $heladoNuevo->sabor . "-" . $heladoNuevo->tipo . "." . $extensionArchivo;
                    if(HandlerArchivos::guardarImagen($imagenHeladoNuevo, $rutaDeseada))
                    {
                        echo "Imagen subida con exito." . PHP_EOL;
                    }
                    else
                    {
                        echo "No pudo subirse la imagen" . PHP_EOL;
                    }

                    echo "El producto se ha dado de alta con exito." . PHP_EOL;
                }
                else
                {
                    echo "Hubo un error en el alta de producto." . PHP_EOL;
                }
        
            }
        }
        else
        {
            echo "No se pudo agregar el producto a la lista." . PHP_EOL;
        }

    }



    public static function agregarHeladoAListaEnJSON($heladoAGuardar, $rutaArchivo)
    {
        if($heladoAGuardar != null)
        {
            $listaHelados = self::cargarListaHeladosDesdeJSON($rutaArchivo);

            if($listaHelados === null)
            {
                $listaHelados = array();
            }
            $listaHelados[] = $heladoAGuardar;
          
            if(HandlerArchivos::escribirArchivoJson($rutaArchivo, $listaHelados))
            {
                return true;
            }

        }

        return false;
    }

   


    public static function cargarListaHeladosDesdeJSON($rutaArchivo) 
    {
        
        $jsonData = HandlerArchivos::leerArchivoJson($rutaArchivo);
        if($jsonData != null)
       {
            foreach ($jsonData as $heladoData) 
            {
                $helado = new Helado
                (
                    $heladoData['sabor'],
                    $heladoData['precio'],
                    $heladoData['tipo'],
                    $heladoData['vaso'],
                    $heladoData['stock'],
                    $heladoData['id']
                );

                $listaHelados[] = $helado;
            }

            return $listaHelados;
       } 

       return null;
    }


    /*
    3-
        a- (1 pts.) AltaVenta.php: (por POST) se recibe el email del usuario y el Sabor, Tipo y Stock, si el ítem existe en
        heladeria.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) .
        Se debe descontar la cantidad vendida del stock.
        b- (1 pt) Completar el alta de la venta con imagen de la venta (ej:una imagen del usuario), guardando la imagen
        con el sabor+tipo+vaso+mail(solo usuario hasta el @) y fecha de la venta en la carpeta
        /ImagenesDeLaVenta/2024.

*/


  /*
    //esta manera va a funcionar bien, pero, tiene un defecto,
     si leo una lista puede tener por ejemplo 30 helados, pero el id de alguno es 400, tendrias que hacer flag para poner un id mas grande que el mas grande
      pero bueno, si te pones fino, tampoco sabrias si en otra lista no existe uno que no tenga el id mas grande que ese, asi que nada, mientras valides y controles el  ingreso de id, no pasa nada.
  */
 
 public static function asignarIdHelado()
{
    $listaHelados = Heladeria::cargarListaHeladosDesdeJSON('heladeria.json');
    if($listaHelados != null)
    {
        return count($listaHelados) + 1;
    }
   
    return 1;  
}

public static function asignarNumeroDePedidoVenta()
{
    $listaVentas = Heladeria::cargarListaVentasDesdeJSON('ventas.json');
    if($listaVentas != null)
    {
        return count($listaVentas) + 1;
    }

    return 1;
}

    public static function altaVenta($ventaNueva, $imagenVenta)
    {
        if($ventaNueva != null)
        {
            if(Heladeria::validarStockVenta($ventaNueva))
            {
                if(Heladeria::descontarStock($ventaNueva))
                {
                    $ventaNueva->numeroDePedido = Heladeria::asignarNumeroDePedidoVenta();
                    $heladoVendido = Heladeria::retornoHeladoSiExiste($ventaNueva->sabor, $ventaNueva->tipo);
                    $ventaNueva->idHelado = $heladoVendido->id;

                    if(Heladeria::agregarVentaAListaEnJSON($ventaNueva, 'ventas.json') )
                    {
                        echo "Se ha registrado la venta exitosamente." . PHP_EOL;

                        $emailUsuarioHastaArroba = explode("@", $ventaNueva->emailUsuario);
                        $extensionArchivo = pathinfo($imagenVenta['name'], PATHINFO_EXTENSION);    
                        $rutaYNombreArchivo = "./media/ImagenesDeLaVenta/2024/" . $ventaNueva->sabor . "-" . $ventaNueva->tipo .
                         "-" . $emailUsuarioHastaArroba[0] . "-"  /*$heladoVendido->vaso*/ . $ventaNueva->fechaVenta . "." . $extensionArchivo;
                     
                        if(HandlerArchivos::guardarImagen($imagenVenta, $rutaYNombreArchivo) )
                        {
                            echo "Se ha guardado una imagen asociada a la venta." . PHP_EOL;
                        }
                        else
                        {
                            echo "Error al subir imagen de la venta." . PHP_EOL;
                        }
                    }
                }
            }
            else
            {
                echo "No hay stock disponible para este producto." . PHP_EOL;
            }
        }
        else
        {
            echo "No se ha podido realizar la venta." . PHP_EOL;
        }
        
    }
             
    public static function descontarStock($ventaNueva)
    {
        if($ventaNueva != null)
        {
            $listaHelados = Heladeria::cargarListaHeladosDesdeJSON('heladeria.json');
            if($listaHelados != null && count($listaHelados) > 0)
            {
                foreach($listaHelados as $helado)
                {
                    if(strcasecmp($helado->sabor, $ventaNueva->sabor ) === 0 && strcasecmp($helado->tipo, $ventaNueva->tipo ) === 0 && $helado->stock >= $ventaNueva->stock)
                    {
                        $helado->stock -= $ventaNueva->stock;
                        HandlerArchivos::escribirArchivoJson('heladeria.json', $listaHelados);
                        return true;
                    }
                }

            }
        }

        return false;
    }



 public static function cargarListaVentasDesdeJSON($rutaArchivo) 
 {
     $jsonData = HandlerArchivos::leerArchivoJson($rutaArchivo);
     if($jsonData != null)
    {
         foreach ($jsonData as $ventaData) 
         {
             $venta = new Venta
             (
                 $ventaData['sabor'],
                 $ventaData['tipo'],
                 $ventaData['stock'],
                 $ventaData['emailUsuario'],
                 $ventaData['fechaVenta'],
                 $ventaData['numeroDePedido'],
                 $ventaData['idHelado']
             );

             $listaVentas[] = $venta;
         }

         return $listaVentas;
    } 

    return null;
 }

 public static function agregarVentaAListaEnJSON($ventaAGuardar, $rutaArchivo)
 {
     if($ventaAGuardar != null)
     {
         $listaVentas = self::cargarListaVentasDesdeJSON($rutaArchivo);

         if($listaVentas === null)
         {
             $listaVentas = array();
         }
         $listaVentas[] = $ventaAGuardar;
       
         if(HandlerArchivos::escribirArchivoJson($rutaArchivo, $listaVentas))
         {
             return true;
         }

     }

     return false;
 }

public static function validarStockVenta($ventaNueva)
{
    if($ventaNueva != null)
    {
        $listaHelados = Heladeria::cargarListaHeladosDesdeJSON('heladeria.json');
        if($listaHelados != null && count($listaHelados) > 0 )
        {
            foreach($listaHelados as $helado)
            {
                if(strcasecmp($helado->sabor, $ventaNueva->sabor ) === 0 && strcasecmp($helado->tipo, $ventaNueva->tipo ) === 0 && $helado->stock >= $ventaNueva->stock)
                {
                    return true;
                }
            }

        }

    }

    return false;
}



public static function retornoHeladoSiExiste($sabor, $tipo)
{
    if(Validador::validarNombre($sabor) && Validador::validarNombre($tipo))
    {
        $listaHelados = Heladeria::cargarListaHeladosDesdeJSON('heladeria.json');
        if($listaHelados != null && count($listaHelados) > 0)
        {
            foreach($listaHelados as $helado)
            {
                if($helado->equalsSaborYTipo($sabor, $tipo))
                {
                    return $helado;
                }
            }
        }
    }

    return null;
}



/*
4- (1 pts.)ConsultasVentas.php: (por GET)
Datos a consultar:
a- La cantidad de Helados vendidos en un día en particular(se envía por parámetro), si no se pasa fecha, se
muestran las del día de ayer.
b- El listado de ventas de un usuario ingresado.
c- El listado de ventas entre dos fechas ordenado por nombre.
d- El listado de ventas por sabor ingresado.
e- El listado de ventas por vaso Cucurucho.





5- (1 pts.) ModificarVenta.php (por PUT)
Debe recibir el número de pedido, el email del usuario, el nombre, tipo, vaso y cantidad, si existe se modifica , de
lo contrario informar que no existe ese número de pedido.

CONSULTAS, LISTADOS
*/



 /*
        3ra parte

    6- (2 pts.) DevolverHelado.php (por POST),
    Guardar en el archivo (devoluciones.json y cupones.json):
    a- Se ingresa el número de pedido y la causa de la devolución. El número de pedido debe existir, se ingresa una
    foto del cliente enojado,esto debe generar un cupón de descuento (id, devolucion_id, porcentajeDescuento,
    estado[usado/no usado]) con el 10% de descuento para la próxima compra.



    7- (1 pts.) borrarVenta.php (por DELETE), debe recibir un número de pedido,se borra la venta(soft-delete, no
    físicamente) y la foto relacionada a esa venta debe moverse a la carpeta /ImagenesBackupVentas/2024.
 */

public static function backupImagenPorVentaEliminada($venta)
{
    $emailUsuarioHastaArroba = explode("@", $venta->emailUsuario);
    $nombreImagen = $venta->sabor . "-" . $venta->tipo .
        "-" . $emailUsuarioHastaArroba[0] . "-" . $venta->fechaVenta;

        $origenDirectorio = './media/ImagenesDeLaVenta/2024/';
        $destinoDirectorio = './media/ImagenesBackupVentas/2024/';

        $extensiones = ['jpeg', 'jpg', 'png'];

        $imagenEncontrada = false;
        foreach ($extensiones as $extension) 
        {
            $origenPath = $origenDirectorio . $nombreImagen . '.' . $extension;
            if (file_exists($origenPath))
             {
                $destinoPath = $destinoDirectorio . $nombreImagen . '.' . $extension;
                if (rename($origenPath, $destinoPath))
                 {
                    echo "Imagen movida con éxito: $origenPath a $destinoPath." . PHP_EOL;
                    return true;
                } 
                else 
                {
                    echo "Error al mover la imagen: $origenPath." . PHP_EOL;
                }
                $imagenEncontrada = true;
                break;
            }
        }

        if (!$imagenEncontrada) 
        {
            echo "El numero de pedido no tiene una imagen de venta asociada." . PHP_EOL;
        }


        return false;
}




public static function bajaVenta($numeroDePedido)
{
    if(Validador::validarNumero($numeroDePedido)  && $numeroDePedido > 0)
    {
        $listaVentas = Heladeria::cargarListaVentasDesdeJSON('ventas.json');
        if($listaVentas != null && count($listaVentas) > 0)
        {
            $flagBaja = false;
            foreach($listaVentas as $venta)
            {
                if($venta->numeroDePedido == $numeroDePedido)
                {
                    $flagBaja = true;
                    //identifico la baja como el nro de pedido negativo.
                    $venta->numeroDePedido*= -1;
                    if( HandlerArchivos::escribirArchivoJson('ventas.json', $listaVentas) )
                    {
                        echo  PHP_EOL . "-- Venta eliminada --" . PHP_EOL;
                        $venta->mostrarVenta();
                        Heladeria::backupImagenPorVentaEliminada($venta);
                    }
                    else
                    {
                        echo "Error al eliminar." . PHP_EOL;
                    }
                    
                }
            }

            if(!$flagBaja)
            {
                 echo "No hay venta registrada que coincida con el numero de pedido $numeroDePedido." . PHP_EOL;
            }
        
        
        }
        else
        {
            echo "No se registraron ventas en la lista." . PHP_EOL;
        }

    }
    else
    {
        echo "El numero de pedido ingresado no es valido." . PHP_EOL;
    }

}


public static function modificarVenta($ventaModificada)
{
    if($ventaModificada != null)
    {
        $listaVentas = Heladeria::cargarListaVentasDesdeJSON('ventas.json');
        if($listaVentas != null && count($listaVentas) > 0)
        {
            $flagExiste = false;
            foreach($listaVentas as $venta)
            {
                if($venta->numeroDePedido == $ventaModificada->numeroDePedido)
                {
                    $flagExiste = true;

                    $venta->emailUsuario = $ventaModificada->emailUsuario;
                    $venta->sabor = $ventaModificada->sabor;
                    $venta->tipo = $ventaModificada->tipo;
                    $venta->stock = $ventaModificada->stock;

                    if( HandlerArchivos::escribirArchivoJson('ventas.json', $listaVentas) )
                    {
                        echo  PHP_EOL . "-- Venta modificada --" . PHP_EOL;
                        $venta->mostrarVenta();
                    }
                    else
                    {
                        echo "Error al modificar." . PHP_EOL;
                    }

                }
            }
            
            if(!$flagExiste)
            {
                echo "No existen ventas en lista que coincidan con el numero de pedido $ventaModificada->numeroDePedido." . PHP_EOL;
            }
           
        
        }
        else
        {
            echo "No se registraron ventas en la lista." . PHP_EOL;
        }
       
    }
    else
    {
        echo "Error en venta ingresada." . PHP_EOL;
    }

}




public static function listaHeladosPorVaso($vasoIngresado)
{
    if(Validador::validadorVasoHelado($vasoIngresado))
    {
        $listaHelados = Heladeria::cargarListaHeladosDesdeJSON('heladeria.json');
     
        if($listaHelados != null && count($listaHelados) > 0)
        {
            $listaHeladosPorVaso = array();
          
            foreach($listaHelados as $helado)
            {
                if(strcasecmp($helado->vaso, $vasoIngresado )  === 0)
                {
                    $listaHeladosPorVaso[] = $helado;
                }
            }
        
            if($listaHeladosPorVaso != null && count($listaHeladosPorVaso) > 0)
            {
                return $listaHeladosPorVaso;
            }
            
        }
    
    }
    
    return null;
}


public static function listarVentasPorVaso($vasoIngresado)
{
    if(Validador::validadorVasoHelado($vasoIngresado))
    {
        $listaVentas = Heladeria::cargarListaVentasDesdeJSON('ventas.json');
        if($listaVentas != null && count($listaVentas) > 0)
        {
            $listaHeladosPorVasoIngresado = Heladeria::listaHeladosPorVaso($vasoIngresado);
            if($listaHeladosPorVasoIngresado != null)
            {
                $contadorVentas = 0;
                foreach($listaVentas as $venta)
                {
                    foreach($listaHeladosPorVasoIngresado as $helado)
                    {
                        if($helado->id == $venta->idHelado)
                        {
                            $contadorVentas++;
                            echo PHP_EOL . "-- VENTA --" . PHP_EOL;
                            $venta->mostrarVenta();
                        }
                    }

                }
           
                if($contadorVentas > 0)
                {
                    echo "El total de ventas registradas de $vasoIngresado es de $contadorVentas."  . PHP_EOL;
                }
                else
                {
                    echo "No se encontraron ventas registradas para $vasoIngresado." . PHP_EOL;
                }
            
           
            }
           
           
        }
        else
        {
            echo "No se registraron ventas en la lista." . PHP_EOL;
        }
    }
    else
    {
        echo "Error, tipo de vaso no permitido." . PHP_EOL;
    }

}

public static function listarVentasPorSabor($saborIngresado)
{
    if(Validador::validarNombre($saborIngresado))
    {
        $listaVentas = Heladeria::cargarListaVentasDesdeJSON('ventas.json');
        if($listaVentas != null && count($listaVentas) > 0)
        {
            $contadorVentas = 0;
            foreach($listaVentas as $venta)
            {
                if(strcasecmp($venta->sabor, $saborIngresado )  === 0)
                {
                    $contadorVentas++;
                    echo PHP_EOL . "-- VENTA --" . PHP_EOL;
                    $venta->mostrarVenta();
                }
            }

            if($contadorVentas > 0)
            {
                echo "El total de ventas registradas de $saborIngresado es de $contadorVentas."  . PHP_EOL;
            }
            else
            {
                echo "No se encontraron ventas registradas para $saborIngresado." . PHP_EOL;
            }

        }
        else
        {
            echo "No se registraron ventas en la lista." . PHP_EOL;
        }
    }
    else
    {
        echo "Formato de nombre no permitido." . PHP_EOL;
    }
}


public static function listarVentasPorPeriodo($fechaDesde, $fechaHasta)
{

   if( Validador::validarFormatoFecha($fechaDesde) && Validador::validarFormatoFecha($fechaHasta) )
   {
        $listaVentas = Heladeria::cargarListaVentasDesdeJSON('ventas.json');
        if($listaVentas != null && count($listaVentas) > 0)
        {
            $contadorVentas = 0;
            foreach($listaVentas as $venta)
            {
                if(Validador::formatearFecha($venta->fechaVenta) > Validador::formatearFecha($fechaDesde) && Validador::formatearFecha($venta->fechaVenta) < Validador::formatearFecha($fechaHasta) )
                {
                    $contadorVentas++;
                    echo PHP_EOL . "-- VENTA --" . PHP_EOL;
                    $venta->mostrarVenta();
                }

            }
            
            if($contadorVentas > 0)
            {
                echo "El total de ventas registradas entre $fechaDesde y $fechaHasta "  . " es de $contadorVentas."  . PHP_EOL;
            }
            else
            {
                echo "No se encontraron ventas registradas entre $fechaDesde y $fechaHasta." . PHP_EOL;
            }
        }
        else
        {
            echo "No se registraron ventas en la lista." . PHP_EOL;
        }
   }
   else
   {
        echo "Formato de fecha no permitido. d-m-Y" . PHP_EOL;
   }


}


public static function listarVentasPorUsuario($emailUsuarioIngresado)
{
    if(Validador::validarCorreo($emailUsuarioIngresado))
    {
        $listaVentas = Heladeria::cargarListaVentasDesdeJSON('ventas.json');
        if($listaVentas != null && count($listaVentas) > 0)
        {
            $contadorVentas = 0;
            foreach($listaVentas as $venta)
            {
                if($venta->emailUsuario == $emailUsuarioIngresado)
                {
                    $contadorVentas++;
                    echo PHP_EOL . "-- VENTA --" . PHP_EOL;
                    $venta->mostrarVenta();
                }
            }

            if($contadorVentas > 0)
            {
                echo "El total de ventas registradas por el usuario " . $emailUsuarioIngresado . " es de $contadorVentas."  . PHP_EOL;
            }
            else
            {
                echo "No se encontraron ventas registradas por el usuario " . $emailUsuarioIngresado . PHP_EOL;
            }

        }
        else
        {
            echo "No se registraron ventas en la lista." . PHP_EOL;
        }
    
    }


}


public static function listarCantidadDeHeladosVendidosPorFecha($fechaIngresada)
{
    if(Validador::validarFormatoFecha($fechaIngresada))
    {
        $listaVentas = Heladeria::cargarListaVentasDesdeJSON('ventas.json');
        if($listaVentas != null && count($listaVentas) > 0)
        {
            $cantidadHeladosVendidos = 0;
           
            foreach($listaVentas as $venta)
            {    
                //igualamos tomando como criterio el formato d-m-Y
                if(Validador::formatearFecha($venta->fechaVenta) ==  Validador::formatearFecha($fechaIngresada))
                {
                    $cantidadHeladosVendidos+= $venta->stock;
                }
            }

            if($cantidadHeladosVendidos > 0)
            {
                echo "En la fecha: " . $fechaIngresada . " se registraron $cantidadHeladosVendidos helados vendidos." . PHP_EOL;
            }
            else
            {
                echo "No se registran ventas correspondientes a la fecha: " . $fechaIngresada . PHP_EOL;
            }

        }
        else
        {
            echo "No se registraron ventas, lista vacia." . PHP_EOL;
        }

    }
    else
    {
        echo "Formato de fecha no permitido. Intente con d-m-Y." . PHP_EOL;
    }

}













}




?>