<?php



class Auto
{
    private $_color; //validar String
    private $_precio; //(Double)
    private $_marca; //(String)
    private $_fecha;// (DateTime) o string
    



    
    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) //compara por nombre
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
        return "Color: " . $auto->_color . " precio: ". $auto->_precio . " marca: " . $auto->_marca . " fecha: " . $auto->_fecha ;
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


    //!in_array 



    /*
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
    */



    //familiarizarnos con el stacktrace




}




?>