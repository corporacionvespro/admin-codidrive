<?php
session_start();
require_once 'conectar.php';

function redirect($url, $permanent = false)
{
    if (!headers_sent()) {
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
$metodo_pago = $_POST['metodo_pago'];
$tipo_pago = $_POST['tipo_pago'];
$tipo_caja = '';

if ($tipo_pago == 'banco') {
    $tipo_caja = 'banco';
} else {
    $tipo_caja = 'caja';
}

$tipo_opreacion = $_POST['tipo_opreacion'];
$detalle  = TildesHtml($detalleact);

$query_saldo_conductor = $pdo->prepare("SELECT id_saldo FROM saldo_conductor WHERE id_conductores = :id_conductores AND estado = 1");
$query_saldo_conductor->bindParam(':id_conductores', $id_conductores);
$query_saldo_conductor->execute();
$id_saldo_conductor = $query_saldo_conductor->fetch(PDO::FETCH_ASSOC);
$id_saldo_conductors = $id_saldo_conductor['id_saldo'];

$query = "UPDATE saldo_conductor SET estado = 0 WHERE id_saldo = :id_saldo_conductors";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_saldo_conductors', $id_saldo_conductors);

if ($stmt->execute()) {
    $query2 = "INSERT INTO saldo_conductor (id_conductores, monto, cantidad_dias, monto_dia, fecha_inicio, fecha_final, fecha_registro, fecha_notificar, estado, detalle) VALUES (:id_conductores, :monto, :cantidad_dias, :monto_dia, :fecha_inicio, :fecha_final, :fechahora, :fecha_notificar, 1, :detalle)";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->bindParam(':id_conductores', $id_conductores);
    $stmt2->bindParam(':monto', $monto);
    $stmt2->bindParam(':cantidad_dias', $cantidad_dias);
    $stmt2->bindParam(':monto_dia', $monto_dia);
    $stmt2->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt2->bindParam(':fecha_final', $fecha_final);
    $stmt2->bindParam(':fechahora', $fechahora);
    $stmt2->bindParam(':fecha_notificar', $fecha_notificar);
    $stmt2->bindParam(':detalle', $detalle);

    if ($stmt2->execute()) {
        $query_s = $pdo->query("SELECT id_saldo FROM saldo_conductor ORDER BY id_saldo DESC LIMIT 1");
        $id_s = $query_s->fetch(PDO::FETCH_ASSOC);
        $id_ss = intval($id_s['id_saldo']);
        $complemento2 = array('tabla' => 'saldo_conductor', 'id' => $id_ss);
        $complemento = json_encode($complemento2);

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

        $query4 = "INSERT INTO operaciones (monto, concepto, tipo_opreacion, metodo_pago, tipo_caja, tipo_pago, estado, detalle, complemento, usuario, fecha, hora) VALUES (:monto, 'Recarga de saldo', :tipo_opreacion, :metodo_pago, :tipo_caja, :tipo_pago, 1, :detalleact, :complemento, :userId, :fecha, :hora24)";
        $stmt4 = $pdo->prepare($query4);
        $stmt4->bindParam(':monto', $monto);
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
            echo $response;
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}
?>
