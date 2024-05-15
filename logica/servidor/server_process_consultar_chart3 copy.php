<?php
require_once './conectar.php';
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$una_hora_menos = date("H:i:s", (strtotime("-5 Hours")));
$fecha = date("Y/m/d");
$fechahora = $fecha . " " . $hora24;
$fechahoramenos = $fecha . " " . $una_hora_menos;
$mes_anterior = date('Y/m/d', strtotime('-1 month'));
function grafica($fecha,$mes_anterior){
    global $db;
    $query = $db->query("SELECT COUNT(DATE_FORMAT(`fechayhora`, '%Y/%m/%d'))as total, DATE_FORMAT(`fechayhora`, '%Y/%m/%d') as fecha FROM `solicitud` WHERE DATE_FORMAT(fechayhora, '%Y/%m/%d') BETWEEN '{$fecha}' AND '{$mes_anterior}' GROUP BY fecha ORDER BY fecha");
    $userData = array();
    while ($result = $db->fetch_assoc($query)) {
        $userData[] = $result;
    }
    return $userData;
}
$datos = grafica($mes_anterior,$fecha);
if (is_null($datos)) {
    $datos2 = 0;
} else {
    $datos2 = $datos;
}
echo json_encode($datos2, JSON_FORCE_OBJECT);




