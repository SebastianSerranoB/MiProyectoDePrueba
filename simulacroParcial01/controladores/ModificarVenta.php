<?php

/*
    5- (1 pts.) ModificarVenta.php (por PUT)
Debe recibir el número de pedido, el email del usuario, el nombre, tipo, vaso y cantidad, si existe se modifica , de
lo contrario informar que no existe ese número de pedido.

*/

parse_str(file_get_contents("php://input"), $putData);



if( isset($putData['numeroDePedido'])  && isset($putData['emailUsuario']) && isset($putData['sabor']) && isset($putData['tipo']) && isset($putData['vaso']) && isset($putData['stock']) )
{
    include_once("./modelos/Validador.php");
    if( Validador::validarDatosModificacionVenta($putData['numeroDePedido'], $putData['emailUsuario'], $putData['sabor'], $putData['tipo'], $putData['vaso'], $putData['stock']) )
    {
        include_once("./modelos/Heladeria.php");
        include_once("./modelos/Venta.php");

        $ventaModificada = new Venta($putData['sabor'], $putData['tipo'],  $putData['stock'], $putData['emailUsuario'], date("d-m-Y"), $putData['numeroDePedido']);
        heladeria::modificarVenta($ventaModificada);
    }
    else
    {
        echo "Error al ingresar datos, revise correcciones." . PHP_EOL;
    }

}
else
{
    echo "Complete todos los campos del formulario." . PHP_EOL;
}









/* No se porque pero da siempre false, no entiendo el motivo asi que no llamo a la funcion. 
function isSetModificarVenta()
{
    if(isset($putData['numeroDePedido'])  && isset($putData['emailUsuario']) && isset($putData['sabor']) && isset($putData['tipo']) && isset($putData['vaso']) && isset($putData['stock']) )
    {
        return true;
    }

    return false;
}

*/



?>