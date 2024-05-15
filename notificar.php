<?php
date_default_timezone_set("America/Lima");
$fecha = date("Y-m-d");
$conexion = mysqli_connect('localhost', 'root', '@Vespro', 'chapatutaxi');
global $conexion;
$query = $conexion->query("SELECT `id_saldo`,`id_conductores`,`fecha_final`,saldo_conductor.fecha_final,persona.nombres AS nombresc,conductor.id_conductor,conductor.id_persona FROM `saldo_conductor` 
INNER JOIN conductor ON saldo_conductor.id_conductores = conductor.id_conductor
INNER JOIN persona ON conductor.id_persona = persona.id_persona
WHERE saldo_conductor.fecha_notificar = '{$fecha}' AND saldo_conductor.`estado`=1;");
$curl = '';
$response = '';
while ($result = mysqli_fetch_array($query)) {
  $id_conductores = $result['id_conductores'];
  $nombres = 'Hola ' . $result["nombresc"];
  $originalDate = $result["fecha_final"];
  $fecha_notificar = 'Verificamos que tu recarga vence el ' . date("d/m/Y", strtotime($originalDate)) . ', Recuerda que puedes recargar a través de nuestras plataformas digitales o desde nuestras oficinas.';
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://chapatutaxi.com/chapaapi/api/token/pushcustomdriver',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('id_conductor' => $id_conductores, 'titulo' => $nombres, 'descripcion' => $fecha_notificar),
  ));

  $response = curl_exec($curl);
  curl_close($curl);
  $id_conductores = '';
  $nombres = '';
  $fecha_notificar = '';
}
$curl = '';
$response = '';
