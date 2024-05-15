<?php
session_start();
require_once 'PDO_conectar.php';


date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$fecha = date("Y-m-d");
$fechahora = $fecha . " " . $hora24;

$id = $_POST['id'];
$doc_identidad = $_POST['doc_identidad'];
$doc_img_front = $_POST['doc_img_front'];
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

$sql = "SELECT * FROM documentos_conductor WHERE id_conductor = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $updateSql = "UPDATE `documentos_conductor` SET 
    `dni_foto_frontal`=:doc_img_front, 
    `dni_foto_posterior`=:doc_img_back, 
    `dni_numero`=:doc_n, 
    `dni_fv`=:doc_fv, 
    `dni_tipo`=:doc_identidad, 
    `licencia_foto_frontal`=:licencia_img_front, 
    `licencia_foto_posterior`=:licencia_img_back, 
    `licencia_numero`=:licencia_n, 
    `licencia_fv`=:licencia_fv, 
    `soat_foto`=:soat_img, 
    `soat_fv`=:soat_fv, 
    `tp_foto_frontal`=:tp_img_front, 
    `tp_foto_posterior`=:tp_img_back, 
    `antecedentes_foto`=:antp_img, 
    `revision_tecnica_fv`=:rt_fv, 
    `certificado_gnv_glp_tipo`=:cert_tipo, 
    `certificado_gnv_glp_fv`=:cert_fv,
    `fecha_hora_mod`=:fechahora
    WHERE `id_conductor`=:id";

    $stmt = $pdo->prepare($updateSql);
    $stmt->bindParam(':doc_img_front', $doc_img_front);
    $stmt->bindParam(':doc_img_back', $doc_img_back);
    $stmt->bindParam(':doc_n', $doc_n);
    $stmt->bindParam(':doc_fv', $doc_fv);
    $stmt->bindParam(':doc_identidad', $doc_identidad);
    $stmt->bindParam(':licencia_img_front', $licencia_img_front);
    $stmt->bindParam(':licencia_img_back', $licencia_img_back);
    $stmt->bindParam(':licencia_n', $licencia_n);
    $stmt->bindParam(':licencia_fv', $licencia_fv);
    $stmt->bindParam(':soat_img', $soat_img);
    $stmt->bindParam(':soat_fv', $soat_fv);
    $stmt->bindParam(':tp_img_front', $tp_img_front);
    $stmt->bindParam(':tp_img_back', $tp_img_back);
    $stmt->bindParam(':antp_img', $antp_img);
    $stmt->bindParam(':rt_fv', $rt_fv);
    $stmt->bindParam(':cert_tipo', $cert_tipo);
    $stmt->bindParam(':cert_fv', $cert_fv);
    $stmt->bindParam(':fechahora', $fechahora);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Cadena actualizada correctamente.";
    } else {
        echo "Error al actualizar la cadena: ";
    }
} else {
     $insertSql = "INSERT INTO `documentos_conductor`(
    `id_conductor`, 
    `dni_foto_frontal`, 
    `dni_foto_posterior`, 
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
    :id,
    :doc_img_front,
    :doc_img_back,
    :doc_n,
    :doc_fv,
    :doc_identidad,
    :licencia_img_front,
    :licencia_img_back,
    :licencia_n,
    :licencia_fv,
    :soat_img,
    :soat_fv,
    :tp_img_front,
    :tp_img_back,
    :antp_img,
    :rt_fv,
    :cert_tipo,
    :cert_fv,
    :fechahora)";

    $stmt = $pdo->prepare($insertSql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':doc_img_front', $doc_img_front);
    $stmt->bindParam(':doc_img_back', $doc_img_back);
    $stmt->bindParam(':doc_n', $doc_n);
    $stmt->bindParam(':doc_fv', $doc_fv);
    $stmt->bindParam(':doc_identidad', $doc_identidad);
    $stmt->bindParam(':licencia_img_front', $licencia_img_front);
    $stmt->bindParam(':licencia_img_back', $licencia_img_back);
    $stmt->bindParam(':licencia_n', $licencia_n);
    $stmt->bindParam(':licencia_fv', $licencia_fv);
    $stmt->bindParam(':soat_img', $soat_img);
    $stmt->bindParam(':soat_fv', $soat_fv);
    $stmt->bindParam(':tp_img_front', $tp_img_front);
    $stmt->bindParam(':tp_img_back', $tp_img_back);
    $stmt->bindParam(':antp_img', $antp_img);
    $stmt->bindParam(':rt_fv', $rt_fv);
    $stmt->bindParam(':cert_tipo', $cert_tipo);
    $stmt->bindParam(':cert_fv', $cert_fv);
    $stmt->bindParam(':fechahora', $fechahora);

    if ($stmt->execute()) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: ";
    }
}
