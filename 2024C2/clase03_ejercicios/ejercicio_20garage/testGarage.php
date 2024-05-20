<?php

//ALUMNO: SEBASTIAN SERRANO BELLOSO
//DNI 42.810.404

require_once "./Garage.php";
require_once "./Auto.php";

$miGarage = new Garage("Los Clasicos", "500");

$_ferrari = new Auto("Ferrari", "Rojo", 50000, '1/1/1960');
$_mcClaren = new Auto("McClaren", "Amarillo", 30000, '1/1/1980');
$_astonMartin = new Auto("Aston Martin", "Blanco", 30000, '1/1/1950');


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

echo "- Agrego un Mercedes -" . PHP_EOL;
$_mercedesBenz = new Auto("Mercedes Benz", "Blanco", 25000, '1/1/1950');
echo $miGarage->Add($_mercedesBenz) . PHP_EOL;


echo PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL ."--------  PRUEBAS CON ARCHIVOS  --------" . PHP_EOL;
echo "-- GUARDO GARAGE EN ARCHIVO --" . PHP_EOL;
Garage::guardarGarageEnArchivo($miGarage, "garage.csv");

echo "-- MUESTRO EL ARCHIVO --" . PHP_EOL;
Auto::leerYMostrarArchivo("garage.csv");

echo "-- CARGO LOS DATOS DE EL ARCHIVO EN UN GARAGE Y MUESTRO EL GARAGE --" . PHP_EOL;
$miGarage->CargarGarageDesdeArchivo("garage.csv");
$miGarage->MostrarGarage() . PHP_EOL;





















?>