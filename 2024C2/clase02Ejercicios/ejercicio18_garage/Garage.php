<?php

/*



Aplicación No 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
$miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
los métodos.
 


DNI: 42810404
ALUMNO: SEBASTIAN SERRANO BELLOSO.

*/


require_once "../ejercicio17_auto/Auto.php";

 class Garage
 {
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos = array();


    public function __construct($razonSocial, $precioPorHora = 1)
    {
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
    }

    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) 
        {
            return $this->$propiedad;
        }
    }

    public function __set($propiedad, $valor)
    {
        if(property_exists($this, $propiedad))
        {
            if($propiedad == '_razonSocial' && is_string($valor))
            {
                 $this->_razonSocial = $valor;
            }
            else if($propiedad == '_precioPorHora' && is_numeric($valor)  && $valor > -1)
            {
                 $this->_precioPorHora =  $valor;
            }

        }
       
    }

    public function MostrarGarage()
    {
        echo "Razon Social: $this->_razonSocial " . PHP_EOL;
        echo "Precio por hora: $this->_precioPorHora " . PHP_EOL;
   
        if(  count($this->_autos) > 0 )
        {
            foreach($this->_autos as $value)
            {
                echo  Auto::MostrarAuto($value) . PHP_EOL;
            }
        }
        else
        {
            echo "No existen autos en el garage." . PHP_EOL;
        }
       
    }

    public function Equals($_auto)
    {
        if(count( $this->_autos) > 0)
        {
            foreach($this->_autos as $value)
            {
                if($value->equals($_auto) )
                {
                    return true;
                }
            }
        }

        return false;
    }

    public function Add($_auto)
    {
        if(!$this->Equals($_auto))
        {
            array_push($this->_autos, $_auto);
            return "Se agrego el auto exitosamente.";
        }
        
        return "El auto ya se encuentra en el garage.";                 
    }


    public function Remove($_auto)
    {
            $indice =  array_search($_auto, $this->_autos, true);
            if($indice !== false)  //el true hace un strict comparison, valida el tipo ademas de el valor
            {
                array_splice($this->_autos, $indice,1); //args1-> el array a modificar, args2 la posicion de salida(indice) args3 la cantidad de elementos que se eliminan a partir del offset(indice), si son mas de un elemento retorna un array con los elementos eliminados
                return "Se elimino de el garage.";
            } 
            
              return  "El auto no se encuentra en el garage.";
    }


 }

?>