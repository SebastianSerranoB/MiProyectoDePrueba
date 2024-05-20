<?php
//ALUMNO: SERRANO BELLOSO SEBASTIAN
//DNI : 42810404


/*
    Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario
*/



class Usuario 
{
    public $nombre;
    public $clave;
    public $mail;

   
    public function __construct($nombre, $clave, $mail) {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
    }

    
    public function agregarUsuario() 
    {

            /* 
            Si fuera a escribir muchas cosas seria muy poco performante utilizar este metodo, pero en este caso entiedo que esta bien.
                This function is identical to calling fopen(), fwrite() and fclose() successively to write data to a file.
                If filename does not exist, the file is created. Otherwise, the existing file is overwritten, unless the FILE_APPEND flag is set.
                LOCK_EX  adquiere un bloqueo exclusivo en el archivo antes de escribir en él.
                Esto significa que ningún otro proceso o hilo podrá escribir en el archivo hasta que el bloqueo se libere. Evita corrupcion e inconsistencias
            */
        $linea = $this->nombre . ',' . $this->clave . ',' . $this->mail . "\n";
        if (file_put_contents('usuarios.csv', $linea, FILE_APPEND | LOCK_EX) !== false) 
        {
            return true;
        }
        else
        {
            return false;
        }
    
    }

    public function mostrarUsuario()
    {
        echo  "- USUARIO -" . PHP_EOL;
        echo  "- Nombre: $this->nombre, Clave: $this->clave, Mail: $this->mail." . PHP_EOL;
    }

}




?>



