<?php

/*
    Aplicación No 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble
por parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);

En testAuto.php:
 Crear dos objetos “Auto” de la misma marca y distinto color.
Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
Crear un objeto “Auto” utilizando la sobrecarga restante.

● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5)

*/

//lo de los tipos es para que hagamos validaciones


require "./Auto.php";

$AutoUno = new Auto("Chevrolet", "Azul");
$AutoDos = new Auto("Chevrolet", "Rojo");

$AutoDoce = new Auto("Toyota", "Verde", 2000);
$AutoTrece= new Auto("Toyota", "Verde", 2000);


$AutoVeinte = new Auto("Ford", "gris", 1000, "1/4/2015");


echo "\nAutos tres, cuatro y cinco antes del impuesto: " . $AutoDoce->_precio . "\n" . $AutoTrece->_precio ."\n" .$AutoVeinte->_precio;
echo "\nAgregar impuestos: ";
$AutoDoce->AgregarImpuestos(1500);
$AutoTrece->AgregarImpuestos(1500);
$AutoVeinte->AgregarImpuestos(1500);

echo "\nAutos tres, cuatro y cinco luego del impuesto: " . $AutoDoce->_precio . "\n" . $AutoTrece->_precio ."\n" .$AutoVeinte->_precio;

echo "\nSumo auto uno y dos: " . Auto::Add($AutoUno, $AutoDos);

if( $autoUno->equals($AutoDos) )
{
    echo "\nAutoUno es igual a AutoDos";
}
else
{
    echo "\nAutoUno es distinto de autoDos.";
}

if( $autoUno->equals($AutoVeinte) )
{
    echo "\nAutoUno es igual a AutoCinco";
}
else
{
    echo "\nAutoUno es distinto de autoCinco.";
}



echo "\nMuestro autos uno, dos y tres respectivamente: " . Auto::MostrarAuto($AutoUno) ."\n". Auto::MostrarAuto($AutoDoce) ."\n".  Auto::MostrarAuto($AutoVeinte);




//realizar test





?>