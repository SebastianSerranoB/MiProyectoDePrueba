<?php

/*
Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.
*/ 

// Alumno: Sebastian Serrano Belloso
// DNI: 42810404

$numeros = 0;
$contadorNumeros = 0;
$suma = 0;

while($suma < 1000)
{
    $numeros ++;
   
    if(($suma + $numeros) > 1000) 
    {
        break;
    }
    $contadorNumeros ++;
    echo "<br/>";
    echo "El ultimo numero sumado fue: " . $numeros;
 
    $suma += $numeros;
}



echo "<br/>";
echo "La suma es de: " . $suma;
echo "<br/>";
echo "En total se sumaron " .$contadorNumeros ." numeros.";

?>