<?php
//ALUMNO: SEBASTIAN SERRANO BELLOSO
//DNI: 42810404


class Auto
{
    private $_marca; 
    private $_color; 
    private $_precio; 
    private $_fecha;
    

    
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
            if($propiedad == '_color' && is_string($valor))
            {
                 $this->_color = $valor;
            }
            else if($propiedad == '_fecha' && is_string($valor) && DateTime::createFromFormat("d/m/Y", $valor) != false) 
            {
                 $this->_fecha = $valor;
            }
            else if($propiedad == '_marca' && is_string($valor))
            {
                 $this->_marca =  $valor;
            }
            else if($propiedad == '_precio' && is_numeric($valor)  && $valor > -1)
            {
                 $this->_precio =  $valor;
            }

        }
       
    }
    



    public function __construct($marca, $color, $precio = 1, $fecha = "1/1/2000")
    {
        $this->_marca = $marca;
        $this->_color = $color;
        $this->_precio = $precio;
        $this->_fecha = $fecha;
    }



    public function AgregarImpuestos($impuesto)
    {
        if(is_numeric($impuesto) && $impuesto > 0)
        {
            $this->_precio+= $impuesto;
        }
       
    }

    public static function MostrarAuto($auto)
    {
        echo "Marca: " . $auto->_marca . " Color: ". $auto->_color . " Precio: " . $auto->_precio . " Fecha: " . $auto->_fecha . PHP_EOL;
    }

    public function equals($auto)
    {
        if($this->_marca == $auto->_marca) 
        {
            return true;
        }
    
        return false;
    }

    public static function Add($autoUno, $autoDos)
    {
        if($autoUno->equals($autoDos)  && $autoUno->_color == $autoDos->_color)
        {
            return $autoUno->_precio + $autoDos->_precio;
        }
        else
        {
            return 0;
        }
    }


    public static function guardarAutoEnArchivo($auto, $nombreArchivo)
    {
        $archivo = fopen($nombreArchivo, "a");
        $cadena = $auto->_marca  . " - " . $auto->_color . " - " . $auto->_precio .  " - " . $auto->_fecha ."\n";

        $caracteresEscritos = fwrite($archivo, $cadena);
        
        if($caracteresEscritos > 0)
        {
            echo "<p>¡Auto agregado!</p>";
        }
        else
        {
            echo "<p>¡Algo salió mal!</p>";
        }

        fclose($archivo);
    }

    public static function cargarArchivoDeAutosEnArray($nombreArchivo)
    {
       $listaDeAutos = array();
   
        $archivo = fopen($nombreArchivo, "r");
        while(!feof($archivo))
        {
            $linea = fgets($archivo);
            $elementosDeLaLinea = explode(" - ", $linea);
           
            if(count($elementosDeLaLinea) == 4) 
            {
                $autoLeido = new Auto($elementosDeLaLinea[0], $elementosDeLaLinea[1], (float)$elementosDeLaLinea[2] , $elementosDeLaLinea[3]);
                array_push($listaDeAutos, $autoLeido);
            }
        
          
        }
        fclose($archivo);
        
        return $listaDeAutos;
    }

    public static function leerYMostrarArchivo($nombreArchivo)
     {
        $archivo = fopen($nombreArchivo, "r");

        $lectura = fread($archivo, filesize($nombreArchivo));

        fclose($archivo);


        if($lectura !== false)
        {
            echo $lectura;
        } 
        else 
        {
            echo "<p>Error</p>";
        }

        echo "<br/>";
    }

}




?>