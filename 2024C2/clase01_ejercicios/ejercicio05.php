<?php

/*
Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.
 */

//Alumno: Sebastian Serrano
//DNI: 42810404








for ($num = 20; $num < 61; $num++)
{
    if(numerosALetras($num) != null)
    {
        echo "El numero es: " . $num ." y escrito como palabra: " . numerosALetras($num);
    }
    else
    {
        echo "Error al formatear numero";
    }

    echo"<br/>";
} 

function numerosALetras($num)
{
    $retorno = null;

    if( is_int($num) && $num >= 20 && $num <= 60)
    {
        
       if(obtener_unidad($num) == 0)
       {
          if(obtener_decena($num) == 2)
          {
            $retorno = "veinte";
          }
          else
          {
            $retorno = decenaALetras(obtener_decena($num));
          }
       }
       else
       {

        if(obtener_decena($num) == 2)  //veinte y cuatro es incorrecto. veinticuatro es la forma. //PREGUNTO DOS VECES por ==2 se podia simplificar en la misma
        {
            $retorno = decenaALetras(obtener_decena($num)) . unidadALetras(obtener_unidad($num));
        }
        else
        {
            $retorno = decenaALetras(obtener_decena($num)) ." y " . unidadALetras(obtener_unidad($num));
        }

       }

        

    }

    return $retorno;
}


function unidadALetras($num)
{
    switch ($num)
    {
        case 0:
            return "cero";
        case 1:
            return "uno";
        case 2:
            return "dos";
        case 3:
            return "tres";
        case 4:
            return "cuatro";
        case 5:
            return "cinco";
        case 6:
            return "seis";
        case 7:
            return "siete";
        case 8:
            return "ocho";
        case 9:
            return "nueve";
        
    }

}

function decenaALetras($num)
{
    switch ($num)
    {
        case 2:
            return "veinti";
        case 3:
            return "treinta";
        case 4:
            return "cuarenta";
        case 5:
            return "cincuenta";
        case 6:
            return "sesenta";
    }
   

}



function obtener_unidad($num) {
    return $num % 10; //el resto de el numero divido 10 es la unidad ->  20 /10 = 2 -> resto = 0(unidad) o   20 % 10 = 0
}

// Función para obtener la decena de un número
function obtener_decena($num) {
    return floor($num / 10) ;  //floor — Redondear fracciones hacia abajo 27 /10 = 2.7 -> floor(2.7) -> 2 redondea para abajo floor, queda solo la decena
}


//is_int($num);


/*for($num = 20; $num < 61; $num++)
{
    $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
    echo $formatterES->format($num);
    echo "<br/>";
}*/   //la clase NumberFormatter no figura porque no tenemos instalado php

?>