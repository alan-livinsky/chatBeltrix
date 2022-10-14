<?php
include_once "sesion.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/db/consultas.php";

function inicializarOpcionesMenu()
{
    $menu = "SELECT * FROM  menuOpciones  WHERE idSuperior " . $_SESSION['superior'] . "";
    $opciones = ejecutarConsulta($menu);
    return $opciones;
}


function buscarOpcionesMenu()
{

    if ($_SESSION['nroOpcion'] != "0") {
        $dataOpcion = "SELECT mo.* FROM menuOpciones mo
                            WHERE idSuperior = (SELECT idmenu FROM menuOpciones o
                                                WHERE o.idsuperior " . $_SESSION['superior'] . " AND nroOpcion = " . $_SESSION['nroOpcion'] . ")";
    } else {
        $dataOpcion = "SELECT * FROM menuOpciones WHERE idSuperior is null";
    }

    $opcionesMenu = ejecutarConsulta($dataOpcion);

    return $opcionesMenu;
}

function generarHtmlOpcionesMenu($opcionesMenu)
{
    $htmlOpcionesMenu = "";

    foreach ($opcionesMenu as $opcion) {
        $nroOpcion = $opcion['nroOpcion'];
        $descripcion = $opcion['descripcion'];
        actualizarIDsuperior($opcion['idSuperior']); //funciones sesion.php
        $htmlOpcionesMenu .= "<div class='option'> $nroOpcion  - $descripcion </div>";
        //print_r($opcion);
    }

    $htmlOpcionesMenu .= "<div class='option'> 0 - Menú Principal </div>";

    return $htmlOpcionesMenu;
}

function buscarIdOpcionMenu()
{
    $idMenuOpcion = "SELECT idmenu FROM menuOpciones o
                        WHERE o.idsuperior " . $_SESSION['superior'] . " 
                        AND nroOpcion = " . $_SESSION['nroOpcion'] . "";

    $idOpcionMenu = ejecutarConsulta($idMenuOpcion);

    return $idOpcionMenu;
}


// function obtenerOpcionFinal($idOpcionMenu)
// {
//     $htmlOpcionMenu = "";
//     switch ($idOpcionMenu) {
//         case 35:
//             $htmlOpcionMenu = '<div class="options-wrapper">Ingresá al link, <br> elegí cómo pagar, ¡y listo!<br>
//             <a href= "https://mpago.la/1WiSDNC" style="color:#FF0000">mercadopago</a><br>
//             Sino te pasamos un <br> cbu 59852136984122396<br><br>
//             0- Volver al Menú Principal</div>';
//             return $htmlOpcionMenu;
//         case 36:
//             $htmlOpcionMenu = '<div class="options-wrapper">Lee o Descarga QR, <br> y elegí cómo pagar, ¡y listo!<br>
//             <a href= "./front/generaPDFpago.php" style="color:#FF0000">Descarga ticket de pago</a><br>
//             <a href="./img/qr.png" download="./img/qr.pdf ">
//                     <img src="./img/qr.png" heigh=30% width=30% align="middle" style="max-width:100%;width:auto;height:auto;">
//                     </a><br><br>0- Volver al Menú Principal</div>';
//             return $htmlOpcionMenu;
//         case 23:
//             $htmlOpcionMenu = 'Ingresa los datos con los que <br>te inscribiste en el instituto<br>';
//             include("../front/loginUsuario.php");
//             die();
//         default:
//             // $alert = "<script> 
//             // $(function(){ Swal.fire({ 
//             //     icon: 'error', 
//             //     title: 'Oops...!', 
//             //     text: 'Opción Final', 
//             // })}); </script>"; 
//         //return $alert;
//             $alertFin = "Opcion Final"."<br>"."0 - Volver al Menu Principal";
//         return $alertFin;    
//     }
//}
function obtenerOpcionFinal($idOpcionMenu)
{
    if ($idOpcionMenu == 32) {
        include "../back/resetearAdvertensia.php";
        die();
    } 
    if ($idOpcionMenu == 23) {
        include "../front/loginUsuario.php";
        die();
    } else {
        $idOpcionFinal = "SELECT opcionFinal
    FROM menuopciones  where idMenu = $idOpcionMenu";

        $idOpcionMenu = ejecutarConsulta($idOpcionFinal);
        return $idOpcionMenu;
    }
}
