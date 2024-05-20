<?php

//traigo la clase usuario con require


require "./Usuario.php";
require "./Empleado.php";
//   ../ bajo otro nivel


//postamn va por defecto al arrchivo index


$empleadoUno = new Empleado("Franco","Lippi");
$empleadoDos = new Empleado("Sebastian", "Serrano");

$datosUno = Empleado::mostrarEstatico($empleadoUno);
$datosDos= Empleado::mostrarEstatico($empleadoDos);


echo $datosUno;
echo $datosDos;
//shift alt flechita

?>