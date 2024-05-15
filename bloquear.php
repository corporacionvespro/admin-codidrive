<?php
//
date_default_timezone_set("America/Lima");
$fecha = date("Y-m-d");

$conexion = mysqli_connect('localhost', 'root', '@Vespro', 'chapatutaxi');

global $conexion;
$query = $conexion->query("SELECT `id_saldo`,`id_conductores`,`fecha_final` FROM `saldo_conductor` WHERE `fecha_final` <= '{$fecha}' AND `estado`=1;");
$curl = '';
$response = '';
while ($result = mysqli_fetch_array($query)) {
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://chapatutaxi.com/chapaapi/api//driver/state',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('estado' => 'bloqueado', 'id_conductor' => $result['id_conductores']),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
}
$curl = '';
$response = '';
