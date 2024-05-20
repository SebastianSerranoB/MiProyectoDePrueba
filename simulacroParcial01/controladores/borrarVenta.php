<?php


if(isset($_GET['numeroDePedido']) &&  is_numeric($_GET['numeroDePedido'] ) && $_GET['numeroDePedido'] > 0)
{
    include_once("./modelos/Heladeria.php");
    Heladeria::bajaVenta($_GET['numeroDePedido']);
}
else
{
    "Error al ingresar datos para la baja, corrobore." . PHP_EOL;
}



?>