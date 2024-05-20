<?php

/*
    1-
A- (1 pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a qué archivo se debe incluir.
B- (1 pt.) HeladeriaAlta.php: (por POST) se ingresa Sabor, Precio, Tipo (“Agua” o “Crema”), Vaso (“Cucurucho”,
“Plástico”), Stock (unidades).
Se guardan los datos en en el archivo de texto heladeria.json, tomando un id autoincremental como
identificador(emulado) .Sí el nombre y tipo ya existen , se actualiza el precio y se suma al stock existente.
completar el alta con imagen del helado, guardando la imagen con el sabor y tipo como identificación en la
carpeta /ImagenesDeHelados/2024.
    solo cambia tipo y stock nada mas
*/
class Helado implements JsonSerializable
{
    private $sabor;
    private $precio;
    private $tipo;
    private $vaso;
    private $stock;
    private $id;


    public function __construct($saborIngresado, $precioIngresado, $tipoIngresado, $vasoIngresado, $stockIngresado, $idIngresado = -1)
    {
        $this->sabor = $saborIngresado;
        $this->precio = $precioIngresado;
        $this->tipo = $tipoIngresado;
        $this->vaso = $vasoIngresado;
        $this->stock = $stockIngresado;
        $this->id = $idIngresado;
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
            if($propiedad == 'sabor' && is_string($valor))
            {
                 $this->nombre = $valor;
            }
            else if($propiedad == 'precio' && is_numeric($valor)  && $valor > -1)
            {
                 $this->precio =  $valor;
            }
            else if($propiedad == 'tipo' && is_string($valor))
            {
                 $this->tipo =  $valor;
            }
            else if($propiedad == 'vaso' && is_string($valor))
            {
                 $this->vaso =  $valor;
            }
            else if($propiedad == 'stock' && is_numeric($valor)  && $valor > -1)
            {
                 $this->stock =  $valor;
            }
            else if($propiedad == 'id' && is_numeric($valor)  && $valor >= -1)
            {
                 $this->id =  $valor;
            }

        }
       
    }

    /*public function getSabor()
    {
        return $this->sabor;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getVaso()
    {
        return $this->vaso;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function getId()
    {
        return $this->id;
    } */


    public function equals($heladoAComparar)
    {
        if( strcasecmp($this->sabor, $heladoAComparar->sabor )  === 0 && strcasecmp($this->tipo, $heladoAComparar->tipo ) === 0) 
        {
            return true;
        }
    
        return false;
    }


    
    public function equalsSaborYTipo($saborAComparar, $tipoAComparar)
    {
        if( strcasecmp($this->sabor, $saborAComparar )  === 0 && strcasecmp($this->tipo, $tipoAComparar ) === 0)
        {
            return true;
        }

        return false;
    }
    

    // Implementar JsonSerializable para serialización personalizada, es una serializacion manual.
    public function jsonSerialize() 
    {
        return
         [
            'sabor' => $this->sabor,
            'precio' => $this->precio,
            'tipo' => $this->tipo,
            'vaso' => $this->vaso,
            'stock' => $this->stock,
            'id' => $this->id
        ];
    }





    

}


?>