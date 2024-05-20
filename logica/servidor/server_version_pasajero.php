<?php
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
$conexion = mysqli_connect('161.132.54.172', 'root', 'vespro$2024&', 'codidrive');
function ubicar()
{
    global $conexion;
    $query = $conexion->query("SELECT `id`, `category`, `version`, `features` FROM `version` WHERE `category`='passenger';");
    $userData = array();
    while ($result = mysqli_fetch_array($query)) {
			$userData[] = [
                "version" => $result['version'],
                "features" => $result['features']
            ];      
    }
    return $userData[0];
}
$datos = ubicar();
if (is_null($datos)) {
    $datos2 = 0;
} else {
    $datos2 = $datos;
}
echo json_encode($datos2, JSON_FORCE_OBJECT);
mysqli_close($conexion);