<?php

/*



Aplicación No 20 (Auto - Garage)
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

Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un archivo
garages.csv.
Hacer los métodos necesarios en la clase Garage para poder leer el listado desde el archivo
garage.csv
Se deben cargar los datos en un array de garage.
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.
 


DNI: 42810404
ALUMNO: SEBASTIAN SERRANO BELLOSO.

*/


require_once "./Auto.php";

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
        echo "---  GARAGE  ---" . PHP_EOL;
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


    public static function guardarGarageEnArchivo($garage, $nombreArchivo)
    {
        $archivo = fopen($nombreArchivo, "w");
        $cadena = $garage->_razonSocial  . " - " . $garage->_precioPorHora ."\n";

        $caracteresEscritos = fwrite($archivo, $cadena);


        foreach($garage->_autos as $value)
        {
          $cadena = $value->_marca  . " - " . $value->_color . " - " . $value->_precio .  " - " . $value->_fecha ."\n";
          $caracteresEscritos = fwrite($archivo, $cadena);
        }
        
        if( $caracteresEscritos > 0 )
        {
            echo "Archivo guardado con exito!" . PHP_EOL;
        }
        else
        {
            echo " Algo salio mal ..". PHP_EOL;
        }

        fclose($archivo); 
    }

    public function CargarGarageDesdeArchivo($nombreArchivo)
    {
   
        $archivo = fopen($nombreArchivo, "r");
        $linea = fgets($archivo);
        $elementosDeLaLinea = explode(" - ", $linea);
        
        $this->_razonSocial = $elementosDeLaLinea[0];
        $this->_precioPorHora = $elementosDeLaLinea[1];
        if($elementosDeLaLinea > 0)
        {
            echo "Garage cargado con exito." . PHP_EOL;
        }

        array_splice($this->_autos, 0);

        $i = 0;
        while(!feof($archivo))
        {
            $linea = fgets($archivo);
            $elementosDeLaLinea = explode(" - ", $linea);
           
            if(count($elementosDeLaLinea) == 4) 
            {
                $autoLeido = new Auto($elementosDeLaLinea[0], $elementosDeLaLinea[1], (float)$elementosDeLaLinea[2] , $elementosDeLaLinea[3]);
                array_push($this->_autos, $autoLeido);
                $i++;
            }
            
        }

        if($i > 0)
        {
            echo "Existen $i autos en el garage.". PHP_EOL;
        }
        else
        {
            echo "No se registran autos dentro del garage.". PHP_EOL;
        }

        fclose($archivo);
    }

 }

?>