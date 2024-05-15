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

$concepto = $_POST['concepto'];
$detalleact = $_POST['detalleact'];
$monto = $_POST['monto'];
$importe = $_POST['importe'];
$deuda = $_POST['deuda'];
$f_reg = $_POST['f_reg']. " " . $hora24;
$metodo_pago = $_POST['metodo_pago'];
$tipo_pago = $_POST['tipo_pago'];
$tipo_opreacion = $_POST['tipo_opreacion'];
$doc = $_POST['doc'];
$comprobante = $_POST['comprobante'];
$t_comprobante = $_POST['t_comprobante'];
$nombrecl = $_POST['nombrecl'];
$tipo_pago = $_POST['tipo_pago'];
$tipo_caja = '';
if ($tipo_pago == 'banco') {
    $tipo_caja = 'banco';
} else {
    $tipo_caja = 'caja';
}
if ($deuda == '0' || $deuda == '0.00') {
    $estado_deuda = '0';
} else {
    $estado_deuda = '1';
}

$detalle  = TildesHtml($detalleact);
$query2 = "INSERT INTO `otrosegresos`(`detalle`, `monto`, `fecha_hora`, `fecha_reg`, `monto_anterior`, `deuda`, `aporte`,`precio`, `concepto`, `id_cliente`, `nombre_cliente`, `documento_cliente`, `estado`, `usuario`, `nombre`, `estado_deuda`,`comprobante`,`t_comprobante`) 
VALUES ('{$detalle}','{$monto}','{$fechahora}','{$f_reg}','{$monto}','{$deuda}','{$importe}','{$monto}','{$concepto}',0,'{$nombrecl}','{$doc}',1,'{$_SESSION["userId"]}','{$_SESSION["nombre_usuario"]}','{$estado_deuda}','{$comprobante}','{$t_comprobante}')";
//echo $query2;
if ($db->query($query2)) {
    $query_s = $db->query("SELECT id FROM `otrosegresos` ORDER BY `id` DESC LIMIT 1;");
    //echo $query_s;
    $id_s = $query_s->fetch_assoc();
    $id_ss = intval($id_s['id']);
    $complemento2 = array('tabla' => 'otrosegresos', 'id' => $id_ss);
    $complemento = json_encode($complemento2);
    $query4 = "INSERT INTO `operaciones`
        (`monto`,`concepto`, `tipo_opreacion`, `metodo_pago`, `tipo_caja`,`tipo_pago`, `estado`, `detalle`, `complemento`, `usuario`, `fecha`, `hora`, `ingreso_egreso`) 
        VALUES ('{$importe}','Otro egreso','{$tipo_opreacion}','{$metodo_pago}','{$tipo_caja}','{$tipo_pago}','1','{$detalleact}','{$complemento}','{$_SESSION["userId"]}','{$fecha}','{$hora24}','egreso')";
    //echo $query4;
    if ($db->query($query4)) {
        echo 'ok';
    }
} else {
    echo 'error';
}
