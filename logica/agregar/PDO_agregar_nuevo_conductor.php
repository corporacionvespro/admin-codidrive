<?php
session_start();
require_once 'PDO_conectar.php';

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

$query_telefono = $pdo->prepare("SELECT COUNT(telefono) as telefono FROM persona WHERE telefono = :telefono");
$query_telefono->bindParam(':telefono', $telefono);
$query_telefono->execute();
$telefono_conductor = $query_telefono->fetch(PDO::FETCH_ASSOC);
$telefonos = $telefono_conductor['telefono'];

$query_correo = $pdo->prepare("SELECT COUNT(correo) as correo FROM persona WHERE correo = :correo");
$query_correo->bindParam(':correo', $correo);
$query_correo->execute();
$correo_conductor = $query_correo->fetch(PDO::FETCH_ASSOC);
$correos = $correo_conductor['correo'];

if ($telefonos == 0 && $correos == 0) {
    // Resto del código
} else {
    $mensaje1 = '';
    $mensaje2 = '';
    $mensaje3 = '';

    if ($telefonos != 0) {
        $mensaje1 = 'El número de teléfono ya se encuentra registrado';
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
?>
