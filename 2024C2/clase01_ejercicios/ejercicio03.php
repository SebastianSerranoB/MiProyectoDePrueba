<?php

/*
Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido. Ejemplo 1: $a
= 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
*/ 

//Alumno: Serrano Belloso Sebastian
//DNI: 42810404


/*
Pruebas para el número del medio:

1   5   3     el 3 es del medio
5   1   5   no hay numero del medio
3  5   1     el 3 es del medio
3   1   5    el 3 es del medio
5   3   1    el 3 es del medio
1  5  1    no hay numero del medio

*/




echo "Valor del medio (1,5,3): " .obtenerValorDelMedio($a=1, $b=5, $c=3);

echo "<br/>";
echo "Valor del medio (5,1,5): " .obtenerValorDelMedio($a=5, $b=1, $c=5);

echo "<br/>";
echo "Valor del medio (3,5,1): " .obtenerValorDelMedio($a=3, $b=5, $c=1);

echo "<br/>";
echo "Valor del medio (3,1,5): " .obtenerValorDelMedio($a=3, $b=1, $c=5);

echo "<br/>";
echo "Valor del medio (5,3,1): " .obtenerValorDelMedio($a=5, $b=3, $c=1);

echo "<br/>";
echo "Valor del medio (1,5,1): " .obtenerValorDelMedio($a=1, $b=5, $c=1);







function obtenerValorDelMedio($a, $b, $c) 
{
    
    if($a == $b || $b == $c || $a == $c)
    {
        return "No hay valor del medio";
    }
    else if( ($a > $b && $a < $c) || ($a < $b && $a > $c) )
    {
        return $a;
    }
    else if( ($b > $a && $b < $c)  || ($b < $a && $b > $c) )
   {
        return $b;
   }
   else
   {
        return $c;
   }

}
 
?>