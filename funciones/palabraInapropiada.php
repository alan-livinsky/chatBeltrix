<?php

function validarPalabraInapropiada($mensaje)
{
    if (strlen($mensaje) >= 4) {
        $consulta = "SELECT insulto FROM lenguajeinapropiado i
        where UPPER(i.Insulto) = '".$mensaje."' ";
        //where UPPER(i.Insulto) like '%$mensaje%'";
        $resultado = ejecutarConsulta($consulta);
        return $resultado;
    }

}


function generarHTMLBloqueo()
{
    $html = '<div style="background-color: red;
    color: white;height:400px;font-size:2rem;display: flex;
    text-align: center;flex-direction: column;
    justify-content: center;align-items: center;"><h1>BLOQUEADO</h1>
    <h3>Por utilizar Lenguaje Inapropiado</h3></div>';
    return $html;
}

function generarHTMLadvertencia()
{
    $html = 'ADVERTENCIA<br>Uso de lenguaje inapropiado<br>Si fue una equivocaión<br>Comuniquese con Ayuda.<br>La próxima vez, será BLOQUEADO<br> 0- Volver Menú Principal';
    return $html;
}

