<?php
$db = new mysqli('localhost', 'root', 'vespro$2024&', 'codidrive');
if ($db->connect_error) {
    die('Error en la conexion' . $db->connect_error);
}
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$fecha = date("Y-m-d");
function transformarCadena($cadena)
{
    $cadenaLimpia = preg_replace('/[^a-zA-Z0-9]/', '', $cadena);
    $cadenaMayusculas = strtoupper($cadenaLimpia);
    $primerosTresDigitos = substr($cadenaMayusculas, 0, 3);
    $restoCadena = substr($cadenaMayusculas, 3);
    $cadenaConGuion = $primerosTresDigitos . '-' . $restoCadena;
    return $cadenaConGuion;
}
function forzarMinusculasCorreo($correo2)
{
    $correo2 = strtolower($correo2);
    return $correo2;
}

$nombres = $_POST['nombres'];
$telefono = $_POST['telefono'];
$correo3 = $_POST['correo'];
$correo = forzarMinusculasCorreo($correo3);
$clave = $_POST['clave'];
$cadena = $_POST['placa'];
$placa = transformarCadena($cadena);
$marca = $_POST['marca'];
$color = $_POST['color'];
$anio = $_POST['anio'];

$query_telefono = $db->query("SELECT COUNT(`telefono`) as telefono FROM `persona` WHERE `telefono`= '{$telefono}'");
$telefono_conductor = $query_telefono->fetch_assoc();
$telefonos = $telefono_conductor['telefono'];

$query_correo = $db->query("SELECT COUNT(`correo`) as correo FROM `persona` WHERE `correo`='{$correo}'");
$correo_conductor = $query_correo->fetch_assoc();
$correos = $correo_conductor['correo'];

if ($telefonos == 0 && $correos == 0) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://codidrive.com/codi/api/driver/registro',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'nombres' => $nombres,
            'telefono' => $telefono,
            'correo' => $correo,
            'clave' => $clave,
            'placa' => $placa,
            'marca' => $marca,
            'color' => $color,
            'anio' => $anio
        ),
    ));
    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);
    header("HTTP/1.1 200 OK");
    $respuesta['estado'] = 'ok';
    $respuesta['mensaje'] = $response['message'];
    $respuesta_json = json_encode($respuesta);
    echo $respuesta_json;
} else {
    $mensaje1 = '';
    $mensaje2 = '';
    $mensaje3 = '';

    if ($telefonos != 0) {
        $mensaje1 = 'El numero de telefono ya se encuentra registrado';
    }
    if ($correos != 0) {
        $mensaje2 = 'El correo ya se encuentra registrado';
    }

    header("HTTP/1.1 200 error");
    $respuesta['estado'] = 'error';
    $respuesta['mensaje'] = $mensaje1 . '. ' . $mensaje2 . '. ' . $mensaje3;
    $respuesta_json = json_encode($respuesta);
    echo $respuesta_json;
}
