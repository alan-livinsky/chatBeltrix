<?php

include_once('AccesoDatos.php');

function ejecutarConsulta($consulta){
    $accesoDatos=AccesoDatos::obtenerObjetoAcceso(); 
    $consulta=$accesoDatos->prepararConsulta($consulta);
    $consulta->execute();
    $resultadoConsulta=$consulta->fetchAll();
    return $resultadoConsulta;
}

?>