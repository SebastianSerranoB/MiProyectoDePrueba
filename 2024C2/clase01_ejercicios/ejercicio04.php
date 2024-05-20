<?php

/*
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla. 

*/

//Alumno: Sebastian Serrano Belloso
//DNI: 42810404




function calculadora($op1, $op2, $operador)
{
    switch ($operador)
    {
        case '-':
            return $op1 - $op2;
       

        case '*':
            return $op1 * $op2;
            


        case '/':

            if($op1 != 0 && $op2 != 0)
                return $op1 / $op2;
            else
            return "Intento dividir por 0.";
        

        default:
        return $op1 + $op2;
        
    }



} 

echo "10 / 2 es igual a : ";
echo "<br/>";
echo calculadora(10,2,'/');
echo "<br/>";

echo "10 / 0 es igual a : ";
echo "<br/>";
echo calculadora(10,0,'/');
echo "<br/>";

echo "10 + 5 es igual a : ";
echo "<br/>";
echo calculadora(10,5,'/+');
echo "<br/>";

echo "10 - 5 es igual a : ";
echo "<br/>";
echo calculadora(10,5,'-');
echo "<br/>";

echo "10 * 5 es igual a : ";
echo "<br/>";
echo calculadora(10,5,'*');
echo "<br/>";



?>