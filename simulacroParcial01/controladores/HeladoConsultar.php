<?php

if(issetPost())
{
    include_once("./modelos/Validador.php");
    if( Validador::validarNombre( $_POST['sabor']) && Validador::validarNombre($_POST['tipo']) )
    {
        include_once("./modelos/Heladeria.php");
       echo Heladeria::consultarHelado( $_POST['sabor'], $_POST['tipo'] );
    }
}
else
{
  echo "Complete los campos vacios del formulario." . PHP_EOL;
}










function issetPost()
{
   if( isset($_POST['sabor']) && isset($_POST['tipo']))
   {
       return true;
   }
   return false;
}

?>