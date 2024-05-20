<?php
/*
Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.
*/ 

// Alumno: Sebastian Serrano Belloso
// DNI: 42810404


date_default_timezone_set('America/Argentina/Buenos_Aires');
echo "La zona horaria es la de Buenos Aires, Argentina.\n";

$format = "F j, Y";
$fecha = date($format);
echo "Fecha actual: " . $fecha . "\n";

/*


Estaciones

Otoño (21 de marzo a 20 de junio). dia 80
Invierno (21 de junio a 20 de septiembre). dia 172
Primavera (21 de septiembre a 20 de diciembre). dia 264
Verano (21 de diciembre a 20 de marzo). dia 355

*/ 

$comienzaOtonio =  80;
$comienzaInvierno = 172;
$comienzaPrimavera = 264;
$comienzaVerano = 355;


$fecha_actual = date('Y-m-d');
echo "Fecha en otro formato: " . $fecha_actual . "\n";
$diaDelAnio = date('z', strtotime($fecha_actual)); //calculo a partir del dia del año 0 a 365
echo "El numero de dia del año pensado de 0 a 365 es : " . $diaDelAnio . "\n";

if($diaDelAnio >= $comienzaOtonio && $diaDelAnio < $comienzaInvierno)
{
    echo "Estamos en Otoño.";
}
else if($diaDelAnio >=$comienzaInvierno && $diaDelAnio < $comienzaPrimavera)
{
    echo "Estamos en Invierno.";
}
else if($diaDelAnio >= $comienzaPrimavera && $diaDelAnio < $comienzaVerano)
{
    echo "Estamos en Primavera.";
}
else
{
    echo "Estamos en Verano.";
}











?>