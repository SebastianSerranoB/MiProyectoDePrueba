<?php
/*
    Aplicación No 12 (Invertir palabra)
    Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
    de las letras del Array.
    Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.


    //ALUMNO: SERRANO BELLOSO SEBASTIAN
    //DNI : 42810404
*/

function InvertirPalabra($palabra)
{
    return array_reverse($palabra);
}


$palabra = array('h','o','l','a');


print_r($palabra);

$palabraInvertida = InvertirPalabra($palabra);

print_r($palabraInvertida);




?>