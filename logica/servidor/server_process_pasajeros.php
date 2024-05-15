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
function ubicar($id)
{
    global $conexion;
    $query = $conexion->query("SELECT pasajero.id_pasajero,pasajero.id_cuenta,pasajero.id_persona, persona.nombres, persona.telefono,persona.correo 
    FROM pasajero INNER JOIN persona ON persona.id_persona = pasajero.id_persona WHERE id_pasajero='{$id}'");
    $userData = array();
    while ($result = mysqli_fetch_array($query)) {
        $userData[] = [
            "id_pasajero" => $result['id_pasajero'],
            "id_cuenta" => $result['id_cuenta'],
            "id_persona" => $result['id_persona'],
            "nombres" => $result['nombres'],
            "telefono" => $result['telefono'],
            "correo" => $result['correo']
        ];
    }
    return $userData;
}
$id = $_POST['id'];
$datos = ubicar($id);
if (is_null($datos)) {
    $datos2 = 0;
} else {
    $datos2 = $datos;
}
echo json_encode($datos2, JSON_FORCE_OBJECT);
mysqli_close($conexion);
