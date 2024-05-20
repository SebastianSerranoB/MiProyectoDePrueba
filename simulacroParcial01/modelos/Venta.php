<?php

    include_once("Validador.php");
/*
    3-
        a- (1 pts.) AltaVenta.php: (por POST) se recibe el email del usuario y el Sabor, Tipo y Stock, si el ítem existe en
        heladeria.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) .
        Se debe descontar la cantidad vendida del stock.
        b- (1 pt) Completar el alta de la venta con imagen de la venta (ej:una imagen del usuario), guardando la imagen
        con el sabor+tipo+vaso+mail(solo usuario hasta el @) y fecha de la venta en la carpeta
        /ImagenesDeLaVenta/2024.

*/

class Venta implements JsonSerializable
{
    private $sabor;
    private $tipo;
    private $stock;
    private $fechaVenta;
    private $emailUsuario;
    private $numeroDePedido;
    private $idHelado;
   
   


    public function __construct($saborIngresado, $tipoIngresado, $stockIngresado, $emailIngresado, $fechaIngresada =-1, $numeroDePedido = -1,  $idIngresado = -1)
    {
        $this->sabor = $saborIngresado;
        $this->tipo = $tipoIngresado;
        $this->stock = $stockIngresado;
    
        $this->idHelado = $idIngresado;
        $this->emailUsuario = $emailIngresado;
        $this->numeroDePedido =  $numeroDePedido;
        $this->fechaVenta = $fechaIngresada;
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
                 $this->sabor = $valor;
            }
            else if($propiedad == 'numeroDePedido' && is_numeric($valor))
            {
                 $this->numeroDePedido =  $valor;
            }
            else if($propiedad == 'tipo' && is_string($valor))
            {
                 $this->tipo =  $valor;
            }
            else if($propiedad == 'emailUsuario' && Validador::validarCorreo($valor))
            {
                 $this->emailUsuario =  $valor;
            }
            else if($propiedad == 'stock' && is_numeric($valor)  && $valor > 0)
            {
                 $this->stock =  $valor;
            }
            else if($propiedad == 'idHelado' && is_numeric($valor)  && $valor >= -1)
            {
                 $this->idHelado = $valor;
            }
            else if($propiedad == 'fechaVenta' && Validador::validarFormatoFecha($valor))
            {
                $this->fechaVenta = $valor;
            }

        }
       
    }


    public function mostrarVenta()
    {
        echo "Sabor: " . $this->sabor. PHP_EOL;
        echo "Tipo: " . $this->tipo. PHP_EOL;
        echo "Stock: " . $this->stock. PHP_EOL;
        echo "fecha: " . $this->fechaVenta. PHP_EOL;
        echo "Email usuario: " . $this->emailUsuario. PHP_EOL;
        echo "Numero de pedido: " . $this->numeroDePedido. PHP_EOL;
        echo "ID de Helado: " . $this->idHelado. PHP_EOL;
    }

    public function jsonSerialize() 
    {
        return
         [
            'sabor' => $this->sabor,
            'tipo' => $this->tipo,
            'stock' => $this->stock,
            'fechaVenta' => $this->fechaVenta,
            'emailUsuario' => $this->emailUsuario,
            'numeroDePedido' => $this->numeroDePedido,
            'idHelado' => $this->idHelado
        ];
    }

}



?>