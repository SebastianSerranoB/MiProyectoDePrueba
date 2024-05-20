<?php

/*
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach.
*/

//Alumno: Sebastian Serrano Belloso
//DNI: 42.810.404



$vecNumerosImpares = array();
$numero = 1; //evito division por 0


do
{
    if(($numero % 2) != 0)
    {
        $vecNumerosImpares[] = $numero;
    }
    $numero++;

}while(count($vecNumerosImpares) < 10 );   




for($i = 0; $i < count($vecNumerosImpares); $i++)
{
    echo  $vecNumerosImpares[$i] . "<br/>"; 
}


//habia que hacerlo con for, me colgue
// for(  count(numimpares) <10)
 



?>