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

$id = $_POST['id'];
$precio = $_POST['precio'];
$concepto = $_POST['concepto'];
$detalleact = $_POST['detalleact'];
$monto = $_POST['monto'];
$importe = $_POST['importe'];
$deuda = $_POST['deuda'];
$f_reg = $_POST['f_reg'] . " " . $hora24;
$metodo_pago = $_POST['metodo_pago'];
$tipo_pago = $_POST['tipo_pago'];
$tipo_opreacion = $_POST['tipo_opreacion'];
$doc = $_POST['doc'];
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

$query = "UPDATE `otrosingresos` SET `estado_deuda` = '0' WHERE `otrosingresos`.`id` = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
if ($stmt->execute()) {
    $query2 = "INSERT INTO `otrosingresos`(`detalle`, `monto`, `fecha_hora`, `fecha_reg`, `monto_anterior`, `deuda`, `aporte`,`precio`, `concepto`, `id_cliente`, `nombre_cliente`, `documento_cliente`, `estado`, `usuario`, `nombre`, `estado_deuda`) 
    VALUES (:detalle, :monto, :fechahora, :f_reg, :monto, :deuda, :importe, :precio, :concepto, 0, :nombrecl, :doc, 1, :userId, :nombre_usuario, :estado_deuda)";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->bindParam(':detalle', $detalle);
    $stmt2->bindParam(':monto', $monto);
    $stmt2->bindParam(':fechahora', $fechahora);
    $stmt2->bindParam(':f_reg', $f_reg);
    $stmt2->bindParam(':monto', $monto);
    $stmt2->bindParam(':deuda', $deuda);
    $stmt2->bindParam(':importe', $importe);
    $stmt2->bindParam(':precio', $precio);
    $stmt2->bindParam(':concepto', $concepto);
    $stmt2->bindParam(':nombrecl', $nombrecl);
    $stmt2->bindParam(':doc', $doc);
    $stmt2->bindParam(':userId', $_SESSION["userId"]);
    $stmt2->bindParam(':nombre_usuario', $_SESSION["nombre_usuario"]);
    $stmt2->bindParam(':estado_deuda', $estado_deuda);

    if ($stmt2->execute()) {
        $query_s = $pdo->query("SELECT id FROM `otrosingresos` ORDER BY `id` DESC LIMIT 1");
        $id_s = $query_s->fetch(PDO::FETCH_ASSOC);
        $id_ss = intval($id_s['id']);
        $complemento2 = array('tabla' => 'otrosingresos', 'id' => $id_ss);
        $complemento = json_encode($complemento2);
        $query4 = "INSERT INTO `operaciones` (`monto`,`concepto`, `tipo_opreacion`, `metodo_pago`, `tipo_caja`,`tipo_pago`, `estado`, `detalle`, `complemento`, `usuario`, `fecha`, `hora`, `ingreso_egreso`) 
        VALUES (:importe, 'Ingreso pago de deuda', :tipo_opreacion, :metodo_pago, :tipo_caja, :tipo_pago, 1, :detalleact, :complemento, :userId, :fecha, :hora24, 'ingreso')";
        $stmt4 = $pdo->prepare($query4);
        $stmt4->bindParam(':importe', $importe);
        $stmt4->bindParam(':tipo_opreacion', $tipo_opreacion);
        $stmt4->bindParam(':metodo_pago', $metodo_pago);
        $stmt4->bindParam(':tipo_caja', $tipo_caja);
        $stmt4->bindParam(':tipo_pago', $tipo_pago);
        $stmt4->bindParam(':detalleact', $detalleact);
        $stmt4->bindParam(':complemento', $complemento);
        $stmt4->bindParam(':userId', $_SESSION["userId"]);
        $stmt4->bindParam(':fecha', $fecha);
        $stmt4->bindParam(':hora24', $hora24);

        if ($stmt4->execute()) {
            echo 'ok';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}
