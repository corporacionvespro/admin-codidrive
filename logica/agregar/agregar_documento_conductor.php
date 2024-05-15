<?php
session_start();
require_once 'conectar.php';
header('Content-Type: application/json');
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$fecha = date("Y-m-d");
$fechahora = $fecha . " " . $hora24;
$id = $_POST['id'];
$sql = "SELECT * FROM documentos_conductor WHERE id_conductor = $id";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $query_s = $db->query("SELECT `fecha_nacimiento`,`id_conductor`, `dni_foto_frontal`, `dni_foto_posterior`, `dni_numero`, `dni_fv`, `dni_tipo`, `licencia_foto_frontal`, `licencia_foto_posterior`, `licencia_numero`, `licencia_fv`, `soat_foto`, `soat_fv`, `tp_foto_frontal`, `tp_foto_posterior`, `antecedentes_foto`, `revision_tecnica_fv`, `certificado_gnv_glp_tipo`, `certificado_gnv_glp_fv` FROM `documentos_conductor` WHERE `id_conductor`= $id");
    $row = $query_s->fetch_assoc();
    $jsonData = json_encode($row);
    echo $jsonData;
} else {
    $jsonString = '{
        "fecha_nacimiento": "Sin registrar",
        "id_conductor": "'.$id.'",
        "dni_foto_frontal": "https:\/\/iwork.pe\/imagenes\/imgqr\/images.png",
        "dni_foto_posterior": "https:\/\/iwork.pe\/imagenes\/imgqr\/images.png",
        "dni_numero": "",
        "dni_fv": "",
        "dni_tipo": "0",
        "licencia_foto_frontal": "https:\/\/iwork.pe\/imagenes\/imgqr\/images.png",
        "licencia_foto_posterior": "https:\/\/iwork.pe\/imagenes\/imgqr\/images.png",
        "licencia_numero": "",
        "licencia_fv": "",
        "soat_foto": "https:\/\/iwork.pe\/imagenes\/imgqr\/images.png",
        "soat_fv": "",
        "tp_foto_frontal": "https:\/\/iwork.pe\/imagenes\/imgqr\/images.png",
        "tp_foto_posterior": "https:\/\/iwork.pe\/imagenes\/imgqr\/images.png",
        "antecedentes_foto": "https:\/\/iwork.pe\/imagenes\/imgqr\/images.png",
        "revision_tecnica_fv": "",
        "certificado_gnv_glp_tipo": "0",
        "certificado_gnv_glp_fv": ""
    }';
    echo $jsonString;
}
