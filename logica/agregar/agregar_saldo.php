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
$metodo_pago = $_POST['metodo_pago'];
$tipo_pago = $_POST['tipo_pago'];
$porcentajes = $_POST['porcentajes'];
$tipo_caja = '';
if ($tipo_pago == 'banco') {
    $tipo_caja = 'banco';
} else {
    $tipo_caja = 'caja';
}
$estado = '';
if ($fecha_inicio == $fecha) {
    $estado = 'activo';
} elseif ($fecha_inicio > $fecha) {
    $estado = 'bloqueado';
} else {
    $estado = 'inactivo';
}

$tipo_opreacion = $_POST['tipo_opreacion'];
$detalle  = TildesHtml($detalleact);
$query2 = "INSERT INTO `saldo_conductor`(`id_conductores`,`monto`,`porcentaje`,`cantidad_dias`, `monto_dia`, `fecha_inicio`, `fecha_final`, `fecha_registro`, `fecha_notificar`, `estado`, `detalle`)
VALUES ('{$id_conductores}','{$monto}','{$cantidad_dias}','{$monto_dia}','{$porcentajes}','{$fecha_inicio}','{$fecha_final}','{$fechahora}','{$fecha_notificar}','1','{$detalle}')";
if ($db->query($query2)) {
    $query_s = $db->query("SELECT id_saldo FROM `saldo_conductor` ORDER BY `id_saldo` DESC LIMIT 1;");
    $id_s = $query_s->fetch_assoc();
    $id_ss = intval($id_s['id_saldo']);
    $complemento2 = array('tabla' => 'saldo_conductor', 'id' => $id_ss);
    $complemento = json_encode($complemento2);
    $query_vehiculo = $db->query("SELECT vehiculo.`id_vehiculo`AS vehiculo FROM `conductor` INNER JOIN vehiculo ON conductor.id_vehiculo= vehiculo.id_vehiculo WHERE id_conductor='{$id_conductores}';");
    $id_vehiculo = $query_vehiculo->fetch_assoc();
    $id_vehiculos = $id_vehiculo['vehiculo'];
    $query_n_unidad = $db->query("SELECT MAX(CAST(SUBSTRING_INDEX(unidad, '-', -1) AS UNSIGNED)) AS maximo_valor FROM vehiculo WHERE unidad REGEXP '^N-[0-9]+$'");
    $id_n_unidad = $query_n_unidad->fetch_assoc();
    $cadenas3 = $id_n_unidad['maximo_valor'];
    // $id_n_unidades =intval(preg_replace("/[^0-9]/", "", $cadenas3));
    $id_n_unidades = intval($cadenas3);
    $nuevo_numero = $id_n_unidades + 1;
    $nuevo_numero = 'N-' . $nuevo_numero;
    $query3 = "UPDATE `vehiculo` SET `unidad` = '{$nuevo_numero}' WHERE `vehiculo`.`id_vehiculo` = '{$id_vehiculos}';";
    if ($db->query($query3)) {
        $query4 = "INSERT INTO `operaciones`
        (`monto`,`concepto`,`tipo_opreacion`, `metodo_pago`, `tipo_caja`,`tipo_pago`, `estado`, `detalle`, `complemento`, `usuario`, `fecha`, `hora`) 
        VALUES ('{$monto}','Nuevo registro del conductor','{$tipo_opreacion}','{$metodo_pago}','{$tipo_caja}','{$tipo_pago}','1','{$detalleact}','{$complemento}','{$_SESSION["userId"]}','{$fecha}','{$hora24}')";
        if ($db->query($query4)) {
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
                CURLOPT_POSTFIELDS => array('estado' => $estado, 'id_conductor' => $id_conductores),
            ));
            $response = json_decode(curl_exec($curl), true);
            curl_close($curl);
            echo $response;
        }
    }
} else {
    echo 'error';
}
