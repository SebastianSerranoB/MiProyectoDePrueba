<?php

/*
Aplicación No 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';

*/

 //Alumno: Sebastian Serrano
 //DNI: 42810404

$v = array(1=>90, 30=>7, 'e'=>99, "hola"=> "mundo");

/*
echo $v[1] . "<br/>";
echo $v[30] . "<br/>";
echo $v['e'] . "<br/>";
echo $v["hola"] . "<br/>";*/

foreach( $v as $k => $valor )
{
    echo "key: ". $k ."   value: ". $valor ."<br/>";
}

//los arrays en php son mapas ordenados, parecido a lo que en c# entendemos como diccionarios, un array puede contener como clave-valor  como indice un numero un string o un char


?>