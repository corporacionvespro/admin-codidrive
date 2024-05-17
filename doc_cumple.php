<?php
date_default_timezone_set("America/Lima");
header('Content-Type: application/json');
$conn = mysqli_connect('localhost', 'root', 'vespro$2024&', 'codidrive');

global $conn;
$fecha_referencia = date("Y-m-d");
$fecha_actual = date('Y-m-d');
$nueva_fecha = date('Y-m-d', strtotime($fecha_actual . ' +7 days'));
$sql = "SELECT COUNT(documentos_conductor.`id`) AS total_fechas FROM documentos_conductor INNER JOIN conductor ON documentos_conductor.id_conductor = conductor.id_conductor INNER JOIN persona ON conductor.id_persona = persona.id_persona WHERE (fecha_nacimiento != 'Sin registrar' AND MONTH(fecha_nacimiento) = MONTH(CURDATE()) AND DAY(fecha_nacimiento)) AND DAY(fecha_nacimiento) >= DAY(CURDATE()) AND (conductor.estado <> 'sinaprobar')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $totalFechas = $row["total_fechas"];
  $jsonString = '{"count": "' . $totalFechas . '"}';
  echo $jsonString;
} else {
  $jsonString = '{"count": "0"}';
  echo $jsonString;
}
$conn->close();
