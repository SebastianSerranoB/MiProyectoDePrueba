<?php
    class Validador 
    {
        public static function validarNumero($numero) 
        {
            return is_numeric($numero);
        }
       
        public static function validarNombre($nombre) 
        {
            // Utiliza una expresión regular para validar que el nombre solo contenga letras y espacios
            // y no tenga números
            return preg_match('/^[a-zA-Z\s]+$/', $nombre) && !preg_match('/\d/', $nombre);
        }
    
        public static function validarCorreo($correo)
        {
            return strpos($correo, '@') !== false;
        }
    
        public static function validarPrecio($precio)
        {
            return self::validarNumero($precio) && $precio >= 0;
        }
        
        
    
        public static function validarArchivoImagen($archivo)
        {
            $tipo_archivo = $archivo['type'];
            $tamano_archivo = $archivo['size'];
        
            if (((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < (1024 * 1024)))) //HASTA 1MB.
            {
                return true;
            }

            return false;
        }

        public static function validarArchivoTexto($archivo)
        {
            $tipo_archivo = $archivo['type'];
        
            if (strpos($tipo_archivo, "json") )
            {
                return true;
            }

            return false;
        }

     

       
        public static function validadorTipoHelado($tipoIngresado)
        {
            if( (self::validarNombre($tipoIngresado) ) && ( strcasecmp('agua', $tipoIngresado )  === 0 || strcasecmp('crema', $tipoIngresado ) === 0 ) )
            {
                return true;
            }

            return false;
        }

        public static function validadorVasoHelado($vasoIngresado)
        {
            if( (self::validarNombre($vasoIngresado) ) && ( strcasecmp('plastico', $vasoIngresado )  === 0 || strcasecmp('cucurucho', $vasoIngresado ) === 0 ) )
            {
                return true;
            }

            return false;

        }


        public static function validarAltaDatosHelado($saborIngresado, $precioIngresado, $tipoIngresado, $vasoIngresado, $stockIngresado, $archivoIngresado)
        {
            
            if( self::validarNombre($saborIngresado) && self::validarPrecio($precioIngresado)  && self::validadorTipoHelado($tipoIngresado) && self::validadorVasoHelado($vasoIngresado) && self::validarNumero($stockIngresado) && $stockIngresado > -1 && self::validarArchivoImagen($archivoIngresado) )
            {
                return true;
            }
            
            return false;
        }

        public static function validarDatosVenta($saborIngresado, $emailIngresado, $tipoIngresado, $stockIngresado, $archivoIngresado)
        {
            if( self::validarNombre($saborIngresado) && self::validarCorreo($emailIngresado)  && self::validadorTipoHelado($tipoIngresado) &&  self::validarNumero($stockIngresado) && $stockIngresado > -1 && self::validarArchivoImagen($archivoIngresado) )
            {
                return true;
            }
            
            return false;
        }
       
        public static function validarFormatoFecha($fechaIngresada)
        {
            if($fechaIngresada != null && is_string($fechaIngresada) && ( DateTime::createFromFormat("d/m/Y", $fechaIngresada) != false || DateTime::createFromFormat("d-m-Y", $fechaIngresada) != false ) ) 
            {
                return true;
            }

            return false;
        }


        
        //solo de formato d-m-Y a d/m/Y
        public static function formatearFecha($fechaIngresada)
        {
            $fechaAux = DateTime::createFromFormat('d-m-Y', $fechaIngresada);
            
            if($fechaAux == false)
            {
                $fechaAux = DateTime::createFromFormat('d/m/Y', $fechaIngresada);
                $fechaAux = $fechaAux->format('d-m-Y');
                return $fechaAux;
            }
          
            return $fechaIngresada;
        }

//isset($putData['numeroDePedido'])  && isset($putData['emailUsuario']) && isset($putData['sabor']) && isset($putData['tipo']) && isset($putData['vaso']) && isset($putData['stock'])
        public static function validarDatosModificacionVenta($numeroDePedidoIngresado, $emailUsuarioIngresado, $saborIngresado, $tipoIngresado, $vasoIngresado, $stockIngresado)
        {
            if( self::validarNumero($numeroDePedidoIngresado) && self::validarNumero($stockIngresado) && $stockIngresado > -1  && self::validarCorreo($emailUsuarioIngresado) 
            && self::validarNombre($saborIngresado) && self::validadorTipoHelado($tipoIngresado) && self::validadorVasoHelado($vasoIngresado) )
            {
                return true;
            }

            return false;
        }




    }
    
?>