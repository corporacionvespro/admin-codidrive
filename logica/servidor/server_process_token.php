<?php
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$una_hora_menos = date("H:i:s", (strtotime("-5 Hours")));
$fecha = date("d-m-Y");
$fechahora = $fecha . " " . $hora24;
$fechahoramenos = $fecha . " " . $una_hora_menos;
$conexion = mysqli_connect('161.132.54.172', 'root', 'vespro$2024&', 'codidrive');
function ubicar()
{
    global $conexion;
    $query = $conexion->query("SELECT IF(token IS NULL,'',token) AS tokens FROM `conductor` WHERE estado='activo';");
    $userData = array();
    while ($result = mysqli_fetch_array($query)) {
        if (is_null($result['tokens']) || $result['tokens'] == '') {
        } else {
            $userData[] = [
                "token" => $result['tokens']
            ];
        }
    }
    return $userData;
}
$datos = ubicar();
if (is_null($datos)) {
    $datos2 = 0;
} else {
    $datos2 = $datos;
}
echo json_encode($datos2, JSON_FORCE_OBJECT);
mysqli_close($conexion);
