<?php
session_start();
require_once 'conectar.php';


date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$fecha = date("Y-m-d");
$fechahora = $fecha . " " . $hora24;

$id = $_POST['id'];
$doc_identidad = $_POST['doc_identidad'];
$doc_img_front = $_POST['doc_img_front'];
$fecha_nac = $_POST['fecha_nac'];
$doc_n = $_POST['doc_n'];
$doc_img_back = $_POST['doc_img_back'];
$doc_fv = $_POST['doc_fv'];
$licencia_img_front = $_POST['licencia_img_front'];
$licencia_n = $_POST['licencia_n'];
$licencia_img_back = $_POST['licencia_img_back'];
$licencia_fv = $_POST['licencia_fv'];
$soat_img = $_POST['soat_img'];
$soat_fv = $_POST['soat_fv'];
$tp_img_front = $_POST['tp_img_front'];
$tp_img_back = $_POST['tp_img_back'];
$antp_img = $_POST['antp_img'];
$rt_fv = $_POST['rt_fv'];
$cert_tipo = $_POST['cert_tipo'];
$cert_fv = $_POST['cert_fv'];

$sql = "SELECT * FROM documentos_conductor WHERE id_conductor = $id";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    // Si el ID existe, actualizar la cadena
    $updateSql = "UPDATE `documentos_conductor` SET 
    `dni_foto_frontal`='{$doc_img_front}', 
    `dni_foto_posterior`='{$doc_img_back}', 
    `fecha_nacimiento`='{$fecha_nac}', 
    `dni_numero`='{$doc_n}', 
    `dni_fv`='{$doc_fv}', 
    `dni_tipo`='{$doc_identidad}', 
    `licencia_foto_frontal`='{$licencia_img_front}', 
    `licencia_foto_posterior`='{$licencia_img_back}', 
    `licencia_numero`='{$licencia_n}', 
    `licencia_fv`='{$licencia_fv}', 
    `soat_foto`='{$soat_img}', 
    `soat_fv`='{$soat_fv}', 
    `tp_foto_frontal`='{$tp_img_front}', 
    `tp_foto_posterior`='{$tp_img_back}', 
    `antecedentes_foto`='{$antp_img}', 
    `revision_tecnica_fv`='{$rt_fv}', 
    `certificado_gnv_glp_tipo`='{$cert_tipo}', 
    `certificado_gnv_glp_fv`='{$cert_fv}',
    `fecha_hora_mod`='{$fechahora}'
    WHERE `id_conductor`='{$id}'";
    if ($db->query($updateSql) === TRUE) {
        echo "Cadena actualizada correctamente.";
    } else {
        echo "Error al actualizar la cadena: ";
    }
} else {
    // Si el ID no existe, insertar en la base de datos
    $insertSql = "INSERT INTO `documentos_conductor`(
    `id_conductor`, 
    `dni_foto_frontal`, 
    `dni_foto_posterior`, 
    `fecha_nacimiento`, 
    `dni_numero`, 
    `dni_fv`, 
    `dni_tipo`, 
    `licencia_foto_frontal`, 
    `licencia_foto_posterior`, 
    `licencia_numero`, 
    `licencia_fv`, 
    `soat_foto`, 
    `soat_fv`, 
    `tp_foto_frontal`, 
    `tp_foto_posterior`, 
    `antecedentes_foto`, 
    `revision_tecnica_fv`, 
    `certificado_gnv_glp_tipo`, 
    `certificado_gnv_glp_fv`,
    `fecha_hora_reg`) 
    VALUES (
    '{$id}',
    '{$doc_img_front}',
    '{$doc_img_back}',
    '{$fecha_nac}',
    '{$doc_n}',
    '{$doc_fv}',
    '{$doc_identidad}',
    '{$licencia_img_front}',
    '{$licencia_img_back}',
    '{$licencia_n}',
    '{$licencia_fv}',
    '{$soat_img}',
    '{$soat_fv}',
    '{$tp_img_front}',
    '{$tp_img_back}',
    '{$antp_img}',
    '{$rt_fv}',
    '{$cert_tipo}',
    '{$cert_fv}',
    '{$fechahora}')";
    if ($db->query($insertSql) === TRUE) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: ";
    }
}
