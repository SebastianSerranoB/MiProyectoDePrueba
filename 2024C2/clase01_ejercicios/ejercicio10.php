<?php

/*
Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
*/

//Alumno: Sebastian Serrano
//DNI:42810404




$arregloMultidimensionalIndexado = array( cargarLapicera('azul', 'bic' , 'fino', '200') ,
                                            cargarLapicera('negra', 'lapicerita' , 'grueso', '1000'), 
                                                cargarLapicera('roja', 'argentina' , 'fino', '200') );





$arregloMultidimensionalAsociativo = array('miBic'=>cargarLapicera('azul', 'bic' , 'fino', '200') ,
                                    'miLapicerita'=> cargarLapicera('negra', 'lapicerita' , 'grueso', '1000'), 
                                      'miArgentina'=> cargarLapicera('roja', 'argentina' , 'fino', '200') ); 
                                      



 echo "Muestro mi array multidimensional indexado: ";
for($i=0; $i < count($arregloMultidimensionalIndexado); $i++)
{
    echo "<br/>";
    mostrarLapicera( $arregloMultidimensionalIndexado[$i]);
}



echo "<br/>";
echo "Muestro mi array multidimensional asociativo: ";
foreach($arregloMultidimensionalAsociativo as $key => $value)
{
    echo "<br/>";
    echo "La key $key corresponde a la lapicera: " ;
    mostrarLapicera( $arregloMultidimensionalAsociativo[$key]);

}





                                      
function mostrarLapicera($lapicera)
{
    echo "<br/> Lapicera: <br/>";
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