<?php
session_start();
require_once 'PDO_conectar.php';
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
VALUES (:detalle, :monto, :fechahora, :f_reg, :monto, :deuda, :importe, :monto, :concepto, 0, :nombrecl, :doc, 1, :userId, :nombre_usuario, :estado_deuda, :comprobante, :t_comprobante)";

$stmt = $pdo->prepare($query2);
$stmt->bindParam(':detalle', $detalle);
$stmt->bindParam(':monto', $monto);
$stmt->bindParam(':fechahora', $fechahora);
$stmt->bindParam(':f_reg', $f_reg);
$stmt->bindParam(':deuda', $deuda);
$stmt->bindParam(':importe', $importe);
$stmt->bindParam(':monto', $monto);
$stmt->bindParam(':concepto', $concepto);
$stmt->bindParam(':nombrecl', $nombrecl);
$stmt->bindParam(':doc', $doc);
$stmt->bindParam(':userId', $_SESSION["userId"]);
$stmt->bindParam(':nombre_usuario', $_SESSION["nombre_usuario"]);
$stmt->bindParam(':estado_deuda', $estado_deuda);
$stmt->bindParam(':comprobante', $comprobante);
$stmt->bindParam(':t_comprobante', $t_comprobante);

if ($stmt->execute()) {
    $id_ss = $pdo->lastInsertId();
    $complemento2 = array('tabla' => 'otrosegresos', 'id' => $id_ss);
    $complemento = json_encode($complemento2);
    $query4 = "INSERT INTO `operaciones`
        (`monto`,`concepto`, `tipo_opreacion`, `metodo_pago`, `tipo_caja`,`tipo_pago`, `estado`, `detalle`, `complemento`, `usuario`, `fecha`, `hora`, `ingreso_egreso`) 
        VALUES (:importe, 'Otro egreso', :tipo_opreacion, :metodo_pago, :tipo_caja, :tipo_pago, 1, :detalleact, :complemento, :userId, :fecha, :hora24, 'egreso')";
    $stmt2 = $pdo->prepare($query4);
    $stmt2->bindParam(':importe', $importe);
    $stmt2->bindParam(':tipo_opreacion', $tipo_opreacion);
    $stmt2->bindParam(':metodo_pago', $metodo_pago);
    $stmt2->bindParam(':tipo_caja', $tipo_caja);
    $stmt2->bindParam(':tipo_pago', $tipo_pago);
    $stmt2->bindParam(':detalleact', $detalleact);
    $stmt2->bindParam(':complemento', $complemento);
    $stmt2->bindParam(':userId', $_SESSION["userId"]);
    $stmt2->bindParam(':fecha', $fecha);
    $stmt2->bindParam(':hora24', $hora24);
    if ($stmt2->execute()) {
        echo 'ok';
    }
} else {
    echo 'error';
}
