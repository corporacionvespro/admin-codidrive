<?php
session_start();
require_once 'conectar.php';
function redirect($url, $permanent = false)
{
    if (headers_sent() === false) {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}
function TildesHtml($cadena)
{
    return str_replace(array("'", "á", "é", "í", "ó", "ú", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ñ"), array("&rsquo;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;"), $cadena);
}

date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$fecha = date("Y-m-d");
$fechahora = $fecha . " " . $hora24;

$id_conductores = $_POST['id_conductores'];
$monto = $_POST['monto'];
$cantidad_dias = $_POST['cantidad_dias'];
$monto_dia = $_POST['monto_dia'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];
$fecha_notificar = $_POST['fecha_notificar'];
$detalleact = $_POST['detalleact'];
$detalle  = TildesHtml($detalleact);

$query2 = "INSERT INTO `saldo_conductor`(`id_conductores`, `monto`,`cantidad_dias`, `monto_dia`, `fecha_inicio`, `fecha_final`, `fecha_registro`, `fecha_notificar`, `estado`, `detalle`) VALUES ('{$id_conductores}','{$monto}','{$cantidad_dias}','{$monto_dia}','{$fecha_inicio}','{$fecha_final}','{$fechahora}','{$fecha_notificar}','1','{$detalle}')";

if ($db->query($query2)) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://codidrive.com/codi/api//driver/state',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('estado' => 'activo', 'id_conductor' => $id_conductores),
    ));
    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);
    echo $response;
} else {
    echo 'error';
}
