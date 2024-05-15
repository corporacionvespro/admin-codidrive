<?php
require_once './conectar.php';
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$una_hora_menos = date("H:i:s", (strtotime("-5 Hours")));
$fecha = date("d-m-Y");
$fechahora = $fecha . " " . $hora24;
$fechahoramenos = $fecha . " " . $una_hora_menos;

function grafica(){
    global $db;
    $query = $db->query("SELECT SUM(monto) as total, DATE_FORMAT(`fecha`, '%Y/%m/%d') as fecha FROM `operaciones` WHERE `concepto`='Nuevo registro del conductor' OR `concepto`='Recarga de saldo' GROUP BY fecha ORDER BY fecha");
    $userData = array();
    while ($result = $db->fetch_assoc($query)) {
        $userData[] = $result;
    }
    return $userData;
}
$datos = grafica();
if (is_null($datos)) {
    $datos2 = 0;
} else {
    $datos2 = $datos;
}
echo json_encode($datos2, JSON_FORCE_OBJECT);




