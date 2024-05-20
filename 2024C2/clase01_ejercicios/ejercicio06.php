<?php

/*

Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado. 

*/

//Alumno: Serrano Belloso Sebastian
//DNI: 42810404

//in PHP there is no limit of an array. the only limit is Memory_limit, If you have a too big array it will give you an error like: “Out Of Memory.”

//$vec = array(rand(0,15), rand(0,15), rand(0,15), rand(0,15), rand(0,15));

for ($i = 0; $i < 5; $i++)
{
    $vec[$i] = rand(1, 15); // Genera un número aleatorio entre 1 y 10
}


$cantidadDeNumeros = 0;
$acumuladorNumeros = 0;

foreach ($vec as $valor)
{
    $cantidadDeNumeros++;
    $acumuladorNumeros+= $valor;
   
    echo $valor ."\n";
}


if($cantidadDeNumeros > 0 && $acumuladorNumeros > 0)
{
    $promedioNumeros = $acumuladorNumeros / $cantidadDeNumeros;
}

if($promedioNumeros > 6)
{
    echo "El promedio de los numeros es mayor a seis.\n";
}
else if($promedioNumeros < 6)
{
    echo "El promedio de los numeros es menor a seis.\n";
}
else
{
    echo "El promedio de los numeros es igual a seis.\n";
}



/*
$suma = array_sum($array); // Suma de todos los elementos del array
$cantidad = count($array); // Cantidad de elementos en el array
$promedio = $suma / $cantidad; 

*/

echo var_dump($vec);
?>