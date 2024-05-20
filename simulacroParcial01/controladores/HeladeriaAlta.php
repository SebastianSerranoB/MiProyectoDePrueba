<?php

if( issetPost())
{
    include_once("./modelos/Validador.php");
    if( Validador::validarAltaDatosHelado($_POST['sabor'], $_POST['precio'], $_POST['tipo'], $_POST['vaso'], $_POST['stock'], $_FILES['imagen']) )
     {
        include_once("./modelos/Helado.php");
        $heladoNuevo = new Helado($_POST['sabor'], $_POST['precio'], $_POST['tipo'], $_POST['vaso'], $_POST['stock']) ;
       
        include_once("./modelos/Heladeria.php");
        Heladeria::altaHelado($heladoNuevo, $_FILES['imagen']);
     }
     else
     {
        echo "Hubo un error en el ingreso de datos." . PHP_EOL;
     }

}
else
{
    echo "Complete todos los campos del formulario." . PHP_EOL;
}





 function issetPost()
 {
    if( isset($_POST['sabor']) && isset($_POST['precio']) && isset($_POST['tipo']) && isset($_POST['vaso']) && isset($_POST['stock']) && isset($_FILES['imagen']) )
    {
        return true;
    }
    return false;
 }

 
//VALIDADOR::validarAltaDatosHelado($_POST['sabor'], $_POST['precio'], $_POST['tipo'], $_POST['vaso'], $_POST['stock'], isset($_FILES['imagen']);
?>