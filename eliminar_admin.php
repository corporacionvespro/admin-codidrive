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
$id = $_GET['id'];
$query  = "UPDATE `admin` SET ";
$query .= "estado='0'";
$query .= "WHERE id='{$id}'";
if ($db->query($query)) {
    $query_usuarios = $db->query("SELECT id_usuario FROM `admin` WHERE id='{$id}'");
    $id_usuarios = $query_usuarios->fetch_assoc();
    $id_usuarioss = $id_usuarios['id_usuario'];
    $query2  = "UPDATE `usuarios` SET ";
    $query2 .= "estado='0'";
    $query2 .= "WHERE id='{$id_usuarioss}'";
    if ($db->query($query2)) {
        redirect('administradores.php', false);  
    } else {
        redirect('administradores.php', false);
    }
} else {
    redirect('administradores.php', false);
}
