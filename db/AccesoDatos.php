<?php
date_default_timezone_set("America/Argentina/Buenos_Aires");
$server_time = date ('H:i:s');

class AccesoDatos
{
    private static $objetoAccesoDatos;
    private $objetoPDO;
 
    private function __construct()
    {
        try { 
            $this->objetoPDO = new PDO('mysql:host=localhost;dbname=chatbot;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage();
            die();
        }
    }
 
    public function prepararConsulta($sql){ 
        return $this->objetoPDO->prepare($sql); 
    }

    public function retornarUltimoIdInsertado(){ 
        return $this->objetoPDO->lastInsertId(); 
    }
 
    public static function obtenerObjetoAcceso(){ 
        if (!isset(self::$objetoAccesoDatos)) {          
            self::$objetoAccesoDatos = new AccesoDatos(); 
        } 
        return self::$objetoAccesoDatos;        
    }
 
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }

}

?>