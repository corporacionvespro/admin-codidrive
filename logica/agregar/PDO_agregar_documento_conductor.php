<?php
session_start();
require_once 'PDO_conectar.php';
header('Content-Type: application/json');
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$fecha = date("Y-m-d");
$fechahora = $fecha . " " . $hora24;
$id = $_POST['id'];
$sql = "SELECT * FROM documentos_conductor WHERE id_conductor = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $jsonData = json_encode($result);
    echo $jsonData;
} else {
    $jsonString = '{
        "id_conductor": "'.$id.'",
        "dni_foto_frontal": "https:\/\/codidrive.com\/admin\/assets\/img\/brand\/images.png",
        "dni_foto_posterior": "https:\/\/codidrive.com\/admin\/assets\/img\/brand\/images.png",
        "dni_numero": "",
        "dni_fv": "",
        "dni_tipo": "0",
        "licencia_foto_frontal": "https:\/\/codidrive.com\/admin\/assets\/img\/brand\/images.png",
        "licencia_foto_posterior": "https:\/\/codidrive.com\/admin\/assets\/img\/brand\/images.png",
        "licencia_numero": "",
        "licencia_fv": "",
        "soat_foto": "https:\/\/codidrive.com\/admin\/assets\/img\/brand\/images.png",
        "soat_fv": "",
        "tp_foto_frontal": "https:\/\/codidrive.com\/admin\/assets\/img\/brand\/images.png",
        "tp_foto_posterior": "https:\/\/codidrive.com\/admin\/assets\/img\/brand\/images.png",
        "antecedentes_foto": "https:\/\/codidrive.com\/admin\/assets\/img\/brand\/images.png",
        "revision_tecnica_fv": "",
        "certificado_gnv_glp_tipo": "0",
        "certificado_gnv_glp_fv": ""
    }';
    echo $jsonString;
}
?>
