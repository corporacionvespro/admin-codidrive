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

$logo = $_POST['logo'];
$direccion_actual = $_POST['direccion_actual'];
$latitud_origen = $_POST['latitud_origen'];
$longitud_origen = $_POST['longitud_origen'];
$detalle = $_POST['detalle'];
$categorias = $_POST['categorias'];
$telefono_admin = $_POST['telefono_admin'];
$nombres_admin = $_POST['nombres_admin'];
$nombres_asociado = $_POST['nombres_asociado'];
$telefono_asociado = $_POST['telefono_asociado'];

$query2 = "INSERT INTO `asociados`(`nombre_asociado`, 
`telefono_asociado`, `direccion`, `latitud`, `longitud`, `nombre_admin`, 
`telefono_admin`, `id_categoria_asociados`, `fecha_hora`, `detalle`, `logo`) 
VALUES ('{$nombres_asociado}','{$telefono_asociado}','{$direccion_actual}',
'{$latitud_origen}','{$longitud_origen}','{$nombres_admin}','{$telefono_admin}',
'{$categorias}','{$fechahora}','{$detalle}','{$logo}')";
//echo $query2;
if ($db->query($query2)) {
    echo 'ok';
} else {
    echo 'error';
}
