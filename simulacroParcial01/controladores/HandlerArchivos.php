<?php

    class HandlerArchivos
    {
       
        
        public static function guardarImagen($imagen, $rutaYNombreDeseada)
        {
            if( move_uploaded_file($imagen["tmp_name"], $rutaYNombreDeseada))
            {
                 return true;
            }

            return false;
        }
    
    
        public static function leerArchivoJson($rutaArchivo) 
        {
            if (file_exists($rutaArchivo)) 
            {
                $contenido = file_get_contents($rutaArchivo);
                return json_decode($contenido, true);
            } 
            
            return null;
        }
    
        public static function escribirArchivoJson($rutaArchivo, $datos) 
        {
            $jsonDatos = json_encode($datos, JSON_PRETTY_PRINT);
            if (file_put_contents($rutaArchivo, $jsonDatos))
            {
                return true;
            }
            
            return false;
        }

        





    
    }




?>