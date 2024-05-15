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
$inicio = $_POST['inicio'];
$final = $_POST['final'];
global $db;
$query = $db->query("SELECT `fecha` FROM `operaciones` WHERE DATE_FORMAT(fecha, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}' GROUP by fecha ORDER BY `operaciones`.`fecha` DESC");
$fecha_array = array();
$efectivo = array();
$billetera = array();
$banca = array();

$global_datos = array();
$datos = array();
$i = 0;
while ($result = $db->fetch_assoc($query)) {
$fecha_array[] = $result["fecha"];
    $query_n = $db->query("SELECT SUM(`monto`) as monto FROM `operaciones`WHERE `fecha`='{$result["fecha"]}' AND `tipo_opreacion`='efectivo';");
    $id_n = $query_n->fetch_assoc();
    $id_n_s = $id_n['monto'];
    if (is_null($id_n_s)) {
        $id_n_s = 0;
    } else {
        $id_n_s = $id_n_s;
    }
    $datos[$i][0] = $id_n_s;
    $query_billetera = $db->query("SELECT SUM(`monto`) as monto FROM `operaciones`WHERE `fecha`='{$result["fecha"]}' AND `tipo_opreacion`='Billetera digital';");
    $id_billetera = $query_billetera->fetch_assoc();
    $id_billetera_s = $id_billetera['monto'];
    if (is_null($id_billetera_s)) {
        $id_billetera_s = 0;
    } else {
        $id_billetera_s = $id_billetera_s;
    }
    $datos[$i][1] = $id_billetera_s;
    $query_banca = $db->query("SELECT SUM(`monto`) as monto FROM `operaciones`WHERE `fecha`='{$result["fecha"]}' AND `tipo_opreacion`='Banca';");
    $id_banca = $query_banca->fetch_assoc();
    $id_banca_s = $id_banca['monto'];
    if (is_null($id_banca_s)) {
        $id_banca_s = 0;
    } else {
        $id_banca_s = $id_banca_s;
    }
    $datos[$i][2] = $id_banca_s;
    $i = $i + 1;
}
$global_datos = array("fecha" => $fecha_array, "datos" => $datos);
echo json_encode($global_datos, JSON_FORCE_OBJECT);