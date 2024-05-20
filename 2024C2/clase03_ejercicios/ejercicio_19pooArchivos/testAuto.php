<?php

/*

Aplicación No 19 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La marca y el color.

ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto” por
parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo devolverá
TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son de la
misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con la suma de los
precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);

Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos.
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio. ● Crear
un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)



ALUMNO: SEBASTIAN SERRANO BELLOSO
DNI: 42810404
 */




require_once("./Auto.php");


$AutoUno = new Auto("Chevrolet", "blanco");
$AutoDos = new Auto("Chevrolet", "negro");
$AutoTres = new Auto("Toyota", "rojo", 2000);
$AutoCuatro= new Auto("Toyota", "rojo", 6000);
$AutoCinco = new Auto("Ford", "gris", 1000, "1/4/2015");


Auto::guardarAutoEnArchivo($AutoUno, "autos.csv");
Auto::guardarAutoEnArchivo($AutoDos, "autos.csv");
Auto::guardarAutoEnArchivo($AutoTres, "autos.csv");
Auto::guardarAutoEnArchivo($AutoCuatro, "autos.csv");
Auto::guardarAutoEnArchivo($AutoCinco, "autos.csv");

echo PHP_EOL . "Leo y muestro archivo de autos" . PHP_EOL;
Auto::leerYMostrarArchivo("autos.csv");

echo PHP_EOL . "- Leo archivo de autos y los cargo en un array, luego muestro el array -" . PHP_EOL;
$listaDeAutos = array();
$listaDeAutos =  Auto::cargarArchivoDeAutosEnArray("autos.csv");


if(count($listaDeAutos) > 0)
{
    foreach($listaDeAutos as $value)
    {
        Auto::MostrarAuto($value);
        echo PHP_EOL;
    }
}
else
{
    echo "No se cargaron autos en la lista." . PHP_EOL;
}
   




echo PHP_EOL ."AGREGO IMPUESTOS ETC ETC". PHP_EOL;
$AutoTres->AgregarImpuestos(1500);
$AutoCuatro->AgregarImpuestos(1500);
$AutoCinco->AgregarImpuestos(1500);
echo "\nAutos tres, cuatro y cinco luego del impuesto: " . $AutoTres->_precio . "\n" . $AutoCuatro->_precio ."\n" .$AutoCinco->_precio;


echo "\nSumo auto uno y dos: " . Auto::Add($AutoUno, $AutoDos);

if( $AutoUno->equals($AutoDos) )
{
    echo "\nAutoUno es igual a AutoDos";
}
else
{
    echo "\nAutoUno es distinto de autoDos.";
}

if( $AutoUno->equals($AutoCinco) )
{
    echo "\nAutoUno es igual a AutoCinco";
}
else
{
    echo "\nAutoUno es distinto de autoCinco.";
}

echo "Muestro autos uno, tres y cinco respectivamente: " . PHP_EOL;
Auto::MostrarAuto($AutoUno);
Auto::MostrarAuto($AutoTres);
Auto::MostrarAuto($AutoCinco);




?>