<?php

/*
Aplicación No 13 ()
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
pertenece a algún elemento del listado.
0 en caso contrario.


ALUMNO: SEBASTIAN SERRANO BELLOSO
DNI: 42810404
*/

function ValidarPalabra($palabra, $max)
{
    
    if( (strlen($palabra) <= $max)  &&  ($palabra === "Recuperatorio" || $palabra === "Parcial" || $palabra === "Programacion" ) )
    {
        return 1;
    }
    
    return 0;
}

echo "Palabras validas: Recuperatorio, Parcial y Programacion. Max caracteres = 13" . "\n";
echo "Donde 1 = exito y 0 = error" . "\n";

echo "Ingreso la palabra recuperatorio: " . "\n";
echo "Salida: " . ValidarPalabra("Recuperatorio", 13) . "\n";

echo "Ingreso la palabra Parcial: " . "\n";
echo "Salida: " . ValidarPalabra("Parcial", 13) . "\n";

echo "Ingreso la palabra Programacion: " . "\n";
echo "Salida: " . ValidarPalabra("Programacion", 13) . "\n";

echo "Ingreso la palabra Vocacion: " . "\n";
echo "Salida: " . ValidarPalabra("Vocacion", 13) . "\n";

echo "Ingreso la palabra Cerradura: " . "\n";
echo "Salida: " . ValidarPalabra("Cerradura", 13) . "\n";



?>