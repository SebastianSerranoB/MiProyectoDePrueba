<?php

//ALUMNO: SEBASTIAN SERRANO BELLOSO
//DNI 42.810.404

require_once "./Garage.php";
require_once "../ejercicio17_auto/Auto.php";

$miGarage = new Garage("Los Clasicos", "500");

$_ferrari = new Auto("Ferrari", "Rojo", 10000, '1/1/1960');
$_mcClaren = new Auto("McClaren", "Amarillo", 9000, '1/1/1980');
$_astonMartin = new Auto("Aston Martin", "Blanco", 7000, '1/1/1950');


echo "-Mi garage vacio-". PHP_EOL;
$miGarage->MostrarGarage() . PHP_EOL;


echo "-Agregamos tres autos y luego los mostramos por pantalla- ". PHP_EOL;
echo $miGarage->Add($_ferrari) . PHP_EOL;
echo $miGarage->Add($_mcClaren) . PHP_EOL;  
echo $miGarage->Add($_astonMartin) . PHP_EOL;


echo "-Mi garage con tres autos-". PHP_EOL;
$miGarage->MostrarGarage() . PHP_EOL;


echo "-Intento agregar de nuevo el mismo ferrari-" . PHP_EOL;
echo $miGarage->Add($_ferrari) . PHP_EOL;


echo "-Elimino el Aston Martin del garage-" . PHP_EOL;
echo $miGarage->Remove($_astonMartin) . PHP_EOL;


echo "-Mi garage debe tener dos autos-" . PHP_EOL;
$miGarage->MostrarGarage() . PHP_EOL;

echo "-Intento eliminar nuevamente el Aston Martin-" . PHP_EOL;
echo $miGarage->Remove($_astonMartin) . PHP_EOL;










?>