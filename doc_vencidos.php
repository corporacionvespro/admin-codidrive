<?php
date_default_timezone_set("America/Lima");
header('Content-Type: application/json');
$conn = mysqli_connect('localhost', 'root', 'vespro$2024&', 'codidrive');

global $conn;
$fecha_referencia = date("Y-m-d");
$fecha_actual = date('Y-m-d');
$nueva_fecha = date('Y-m-d', strtotime($fecha_actual . ' +7 days'));
$sql = "SELECT COUNT(documentos_conductor.id) AS total_fechas
FROM documentos_conductor
JOIN conductor ON conductor.id_conductor = documentos_conductor.id_conductor
JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo
JOIN persona ON persona.id_persona = conductor.id_persona
WHERE (dni_fv <= '2023-10-16' OR licencia_fv <= '2023-10-16' OR soat_fv <= '2023-10-16' OR revision_tecnica_fv <= '2023-10-16' OR certificado_gnv_glp_fv <= '2023-10-16')
AND conductor.estado <> 'sinaprobar'";
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
