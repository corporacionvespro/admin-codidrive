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

function grafica($date1,$date2){
    global $db;
    $query = $db->query("SELECT COUNT(DATE_FORMAT(`fechayhora`, '%Y/%m/%d')) as total, DATE_FORMAT(`fechayhora`, '%Y/%m/%d') as fecha FROM `solicitud` WHERE DATE_FORMAT(fechayhora, '%Y/%m/%d') BETWEEN '{$date1}' AND '{$date2}' GROUP BY fecha ORDER BY fecha");
    $userData = array();
    while ($result = $db->fetch_assoc($query)) {
        $userData[] = $result;
    }
    return $userData;
}
$datos = grafica($_POST["inicio"],$_POST["final"]);
if (is_null($datos)) {
    $datos2 = 0;
} else {
    $datos2 = $datos;
}
echo json_encode($datos2, JSON_FORCE_OBJECT);




