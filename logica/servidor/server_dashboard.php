<?php
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$una_hora_menos = date("H:i:s", (strtotime("-5 Hours")));
$fecha = date("d-m-Y");
$fechahora = $fecha . " " . $hora24;
$fechahoramenos = $fecha . " " . $una_hora_menos;
$conexion = mysqli_connect('localhost', 'root', '@Vespro', 'chapatutaxi');
///////////////////////////////////////////////////////////////////////////////
$inicio = $_POST["inicio"];
$final = $_POST["final"];
/////////////////////////////////////////////////////////////////////////////// AND  DATE_FORMAT(fecha, '%Y/%m/%d') BETWEEN '{$date1}' AND '{$date2}'

$query_conductores_activo = $conexion->query("SELECT count(*) as conductor_activo from conductor where conductor.estado = 'activo'");
$totalconductores_activo2 = $query_conductores_activo->fetch_assoc();
$totalconductores_activo = $totalconductores_activo2['conductor_activo'];

$query_solicitudes_activo = $conexion->query("SELECT COUNT(id_conductor) AS solicitudes_activo FROM conductor JOIN cuenta c ON conductor.id_cuenta = c.id_cuenta WHERE conductor.`estado` = 'activo' AND  DATE_FORMAT(c.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}' or conductor.`estado` = 'inactivo' AND  DATE_FORMAT(c.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$totalsolicitudes_activo2 = $query_solicitudes_activo->fetch_assoc();
$totalsolicitudes_activo = $totalsolicitudes_activo2['solicitudes_activo'];

$query_solicitudes_conductores = $conexion->query("SELECT COUNT(id_conductor) AS solicitudes_conductores FROM conductor JOIN cuenta c ON conductor.id_cuenta = c.id_cuenta WHERE conductor.`estado` = 'sinaprobar' AND  DATE_FORMAT(c.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$totalsolicitudes_conductores2 = $query_solicitudes_conductores->fetch_assoc();
$totalsolicitudes_conductores = $totalsolicitudes_conductores2['solicitudes_conductores'];

$query_preciototal = $conexion->query("SELECT SUM(precio) AS precio FROM `solicitud` WHERE `estado`='finalizado' AND DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$totalsolicitud2 = $query_preciototal->fetch_assoc();
$totalsolicitud = $totalsolicitud2['precio'];

$query_idtotal_solicitud = $conexion->query("SELECT COUNT(id_solicitud) As id FROM `solicitud` WHERE `estado`='finalizado' AND DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_solicitud2 = $query_idtotal_solicitud->fetch_assoc();
$nsolicitudesF = $idtotal_solicitud2['id'];

$query_cancelado = $conexion->query("SELECT COUNT(id_solicitud) As cancelado FROM `solicitud` WHERE `estado`='cancelado' AND DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_cancelado2 = $query_cancelado->fetch_assoc();
$ncancelado = $idtotal_cancelado2['cancelado'];

$query_abordo = $conexion->query("SELECT COUNT(id_solicitud) As abordo FROM `solicitud` WHERE `estado`='abordo' AND DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_abordo2 = $query_abordo->fetch_assoc();
$nabordo = $idtotal_abordo2['abordo'];

$query_aceptado = $conexion->query("SELECT COUNT(id_solicitud) As aceptado FROM `solicitud` WHERE `estado`='aceptado' AND DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_aceptado2 = $query_aceptado->fetch_assoc();
$naceptado = $idtotal_aceptado2['aceptado'];

$query_pendiente = $conexion->query("SELECT COUNT(id_solicitud) As pendiente FROM `solicitud` WHERE `estado`='pendiente' AND DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_pendiente2 = $query_pendiente->fetch_assoc();
$npendiente = $idtotal_pendiente2['pendiente'];

$query_id_conductor = $conexion->query("SELECT COUNT(id_conductor) AS id_conductor FROM conductor JOIN cuenta c ON conductor.id_cuenta = c.id_cuenta WHERE conductor.`estado` <> 'sinaprobar' AND  DATE_FORMAT(c.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_id_conductor2 = $query_id_conductor->fetch_assoc();
$nid_conductor = $idtotal_id_conductor2['id_conductor'];

$query_id_pasajero = $conexion->query("SELECT COUNT(id_pasajero) AS id_pasajero FROM pasajero JOIN cuenta c ON pasajero.id_cuenta = c.id_cuenta WHERE pasajero.`estado` = 'activo' AND  DATE_FORMAT(c.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}' OR pasajero.`estado` = 'espera' AND  DATE_FORMAT(c.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}' OR pasajero.`estado` = 'inactivo' AND  DATE_FORMAT(c.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_id_pasajero2 = $query_id_pasajero->fetch_assoc();
$nid_pasajero = $idtotal_id_pasajero2['id_pasajero'];

$query_solicitud = $conexion->query("SELECT COUNT(id_solicitud) AS solicitud FROM `solicitud` WHERE DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_solicitud2 = $query_solicitud->fetch_assoc();
$nsolicitud = $idtotal_solicitud2['solicitud'];

$query_app = $conexion->query("SELECT COUNT(id_solicitud) AS app FROM `solicitud` WHERE `tipo`='app' AND DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_app2 = $query_app->fetch_assoc();
$napp = $idtotal_app2['app'];

$query_web = $conexion->query("SELECT COUNT(id_solicitud) AS web FROM `solicitud` WHERE `tipo`='web' AND DATE_FORMAT(solicitud.fechayhora, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}'");
$idtotal_web2 = $query_web->fetch_assoc();
$nweb = $idtotal_web2['web'];

function obtenerPorcentaje($cantidad, $total)
{
    $porcentaje = ((float)$cantidad * 100) / $total;
    $porcentaje = round($porcentaje, 0);
    return $porcentaje . '%';
}
$por_nweb = '<i class="fa fa-arrow-up"></i> ' . obtenerPorcentaje($nweb, $nsolicitud);
$por_napp = '<i class="fa fa-arrow-up"></i> ' . obtenerPorcentaje($napp, $nsolicitud);
//////////////////////////////////////////////////////////////////////////////////////////

$tabla = '<tr>
<th scope="row">Finalizado</th>
<td>' . $nsolicitudesF . '</td>
<td>
<div class="d-flex align-items-center">
<span class="mr-2">' . obtenerPorcentaje($nsolicitudesF, $nsolicitud) . '</span>
<div>
<div class="progress">
<div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="' . substr(obtenerPorcentaje($nsolicitudesF, $nsolicitud), 0, -1) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . obtenerPorcentaje($nsolicitudesF, $nsolicitud) . '"></div>
</div>
</div>
</div>
</td>
</tr>
<tr>
<th scope="row">Cancelado</th>
<td>' . $ncancelado . '</td>
<td><div class="d-flex align-items-center">
<span class="mr-2">' . obtenerPorcentaje($ncancelado, $nsolicitud) . '</span>
<div>
<div class="progress">
<div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="' . substr(obtenerPorcentaje($ncancelado, $nsolicitud), 0, -1) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . obtenerPorcentaje($ncancelado, $nsolicitud) . '"></div>
</div>
</div>
</div>
</td>
</tr>
<tr>
<th scope="row">Aceptado</th>
<td>' . $naceptado . '</td>
<td>
<div class="d-flex align-items-center">
<span class="mr-2">' . obtenerPorcentaje($naceptado, $nsolicitud) . '</span>
<div>
<div class="progress">
<div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="' . substr(obtenerPorcentaje($naceptado, $nsolicitud), 0, -1) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . obtenerPorcentaje($naceptado, $nsolicitud) . '"></div>
</div>
</div>
</div>
</td>
</tr>
<tr>
<th scope="row">Abordo</th>
<td>' . $nabordo . '</td>
<td>
<div class="d-flex align-items-center">
<span class="mr-2">' . obtenerPorcentaje($nabordo, $nsolicitud) . '</span>
<div>
<div class="progress">
<div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="' . substr(obtenerPorcentaje($nabordo, $nsolicitud), 0, -1) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . obtenerPorcentaje($nabordo, $nsolicitud) . '"></div>
</div>
</div>
</div>
</td>
</tr>
<tr>
<th scope="row">Pendiente</th>
<td>' . $npendiente . '</td>
<td>
<div class="d-flex align-items-center">
<span class="mr-2">' . obtenerPorcentaje($npendiente, $nsolicitud) . '</span>
<div>
<div class="progress">
<div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="' . substr(obtenerPorcentaje($npendiente, $nsolicitud), 0, -1) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . obtenerPorcentaje($npendiente, $nsolicitud) . '"></div>
</div>
</div>
</div>
</td>
</tr>
<tr>
<th scope="row" style="font-weight: revert;">Total</th>
<td style="font-weight: revert;">' . $nsolicitud . '</td>
<td>
<div class="d-flex align-items-center">
<span class="mr-2">' . obtenerPorcentaje($nsolicitud, $nsolicitud) . '</span>
<div>
<div class="progress">
<div class="progress-bar bg-teal" role="progressbar" aria-valuenow="' . substr(obtenerPorcentaje($nsolicitud, $nsolicitud), 0, -1) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . obtenerPorcentaje($nsolicitud, $nsolicitud) . '"></div>
</div>
</div>
</div>
</td>
</tr>';
//////////////////////////////////////////////////////////////////////////////////////////
$userData = array();
$userData[] = [
    "nid_conductor" => $nid_conductor,
    "nid_pasajero" => $nid_pasajero,
    "nweb" => $nweb,
    "por_nweb" => $por_nweb,
    "napp" => $napp,
    "por_napp" => $por_napp,
    "totalsolicitudes_conductores" => $totalsolicitudes_conductores,
    "totalsolicitudes_activo" => $totalconductores_activo,
    "tabla" => $tabla
];
echo json_encode($userData, JSON_FORCE_OBJECT);
mysqli_close($conexion);
