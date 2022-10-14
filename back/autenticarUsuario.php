<?php
include_once "../db/consultas.php";


$pEmail = $_POST['email'];
$pPassword = $_POST['password'];

$consulta =
    "SELECT id,nombre,foto_usuario from usuarios
          where email='" . $pEmail . "' AND password='" . $pPassword . "'";
$usuarioLogin = ejecutarConsulta($consulta);

if ($usuarioLogin) {

    $_SESSION['usuario_id'] = $usuarioLogin[0]['id'];
    $_SESSION['usuario_nombre'] = $usuarioLogin[0]['nombre'];
    $_SESSION['usuario_foto'] = $usuarioLogin[0]['foto_usuario'];

    echo $usuarioLogin[0]['nombre'];
    echo '<br><br><img class="profile-img" src="' . $usuarioLogin[0]['foto_usuario'] . '"
            style="align-items:center;border-radius: 100px;max-width:50%;width:70px;height:70px;">';

    $ArraysResultante = TraerOpcionLogin();

    foreach ($ArraysResultante as $fila) {
        echo "<br>" . $fila[0];
        echo " - ";
        echo $fila[1];
    }
    echo "<br>";
    echo "0- Menú Principal";

} else {
    $_SESSION['usuario_id'] = '';
    $_SESSION['usuario_nombre'] = '';
    echo '';
}
return true;

function fotoLogin($pEmail)
{
    $consulta =
        "SELECT id,foto_usuario FROM usuarios WHERE
   email='" . $pEmail . "'";

    $usuarioFoto = ejecutarConsulta($consulta);
    if ($usuarioFoto) {

        $foto = $_SESSION['usuario_foto'];
        echo '<div class="user-inbox inbox"><div class="icon">
        <img style="align:center;border-radius:100px;max-width:50%;width:38px;height:28px;" src=' . "$foto" . '></div><div class="msg-header"><p></p></div>';
        return $foto;

    }
}

function TraerOpcionLogin()
{
    $consulta =
        "SELECT * FROM opcionesLogin WHERE idSuperior IS NULL";

    $opcionesLogueado = ejecutarConsulta($consulta);

    return $opcionesLogueado;

}
