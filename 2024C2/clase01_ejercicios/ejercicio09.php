<?php

/*
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
 */

 //Alumno: Sebastian Serrano Belloso
 //DNI: 42810404


mostrarLapicera( cargarLapicera('azul', 'bic' , 'fino', '200') );

mostrarLapicera( cargarLapicera('negra', 'lapicerita' , 'grueso', '1000') );

mostrarLapicera( cargarLapicera('roja', 'bic' , 'fino', '200') );



function mostrarLapicera($lapicera)
{
    echo "Lapicera: <br/>";
    echo "color: " . $lapicera['color'] . "<br/>";
    echo "marca: " . $lapicera['marca'] . "<br/>";
    echo "trazo: " . $lapicera['trazo'] . "<br/>";
    echo "precio: " . $lapicera['precio'] . "<br/>";
}


function cargarLapicera( $color, $marca, $trazo, $precio) 
{
    $lapicera = array('color'=>'','marca'=>'', 'trazo'=>'', 'precio'=>'');
   
    $lapicera['color'] = $color;
    $lapicera['marca'] = $marca;
    $lapicera['trazo'] = $trazo;
    $lapicera['precio'] = $precio;

    return $lapicera;
}


?>