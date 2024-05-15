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

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$detalle = $_POST['detalle'];
$icono = $_POST['icono'];
// 	icon	fecha_hora

$updateSql = "UPDATE `categoria_asociados` SET 
`nombre`='{$nombre}', 
`detalle`='{$detalle}',
`icon`='{$icono}'
WHERE `id_categoria_asociados`='{$id}'";
if ($db->query($updateSql) === TRUE) {
    echo 'ok';
} else {
    echo 'error';
}
