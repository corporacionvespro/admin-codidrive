<?php
session_start();
require_once 'conectar.php';
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

function esURL($texto)
{
    return filter_var($texto, FILTER_VALIDATE_URL) !== false;
}

date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$fecha = date("Y-m-d");
$fechahora = $fecha . " " . $hora24;


$nombres = $_POST['nombres'];
$telefono = $_POST['telefono'];
$correo3 = $_POST['correo'];
$fecha_nac = $_POST['fecha_nac'];
//$fecha_nac = date("d/m/Y", strtotime($fecha_nac2));
$correo = forzarMinusculasCorreo($correo3);
$clave = $_POST['clave'];
$cadena = $_POST['placa'];
$placa = transformarCadena($cadena);
$marca = $_POST['marca'];
$color = $_POST['color'];
$anio = $_POST['anio'];

$doc_identidad = $_POST['doc_identidad'];
$doc_img_front = 'https://codidrive.com/admin/assets/img/brand/images.png';
$doc_n = $_POST['doc_n'];
$doc_img_back = 'https://codidrive.com/admin/assets/img/brand/images.png';
$doc_fv = '';
$licencia_img_front = 'https://codidrive.com/admin/assets/img/brand/images.png';
$licencia_n = '';
$licencia_img_back = 'https://codidrive.com/admin/assets/img/brand/images.png';
$licencia_fv = '';
$soat_img = 'https://codidrive.com/admin/assets/img/brand/images.png';
$soat_fv = '';
$tp_img_front = 'https://codidrive.com/admin/assets/img/brand/images.png';
$tp_img_back = 'https://codidrive.com/admin/assets/img/brand/images.png';
$antp_img = 'https://codidrive.com/admin/assets/img/brand/images.png';
$rt_fv = '';
$cert_tipo = 'OTROS';
$cert_fv = '';

$imagenBase64 = $_POST['srcValue'];

// Decodifica la imagen base64 y guárdala en un archivo temporal
$imagenTempPath = tempnam(sys_get_temp_dir(), 'imagen_');
$imagenData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
file_put_contents($imagenTempPath, $imagenData);


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
    if ($response['message'] == 'Conductor creado correctamente') {

        $query_a = $db->query("SELECT conductor.`id_conductor` AS id_conductores, conductor.`id_persona`AS id_personas FROM `conductor` JOIN cuenta ON cuenta.id_cuenta = conductor.id_cuenta JOIN persona ON persona.id_persona = conductor.id_persona WHERE cuenta.correo ='{$correo}' AND persona.correo='{$correo}' AND cuenta.clave='{$clave}'");
        //echo $query_s;
        $idcc = $query_a->fetch_assoc();
        $id = intval($idcc['id_conductores']);
        $id_person = intval($idcc['id_personas']);
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
                if (esURL($imagenBase64)) {
                    //echo "Es una URL: " . $srcValue;
                    header("HTTP/1.1 200 OK");
                    $respuesta['id_persona'] = $id_person;
                    $respuesta['valor'] = 'Es una URL';
                    $respuesta['estado'] = 'ok';
                    $respuesta['mensaje'] = 'Es una URL';
                    $respuesta_json = json_encode($respuesta);
                    echo $respuesta_json;
                } else {
                    // echo "Es una cadena Base64";

                    $curl3 = curl_init();
                    curl_setopt_array($curl3, array(
                        CURLOPT_URL => 'https://codidrive.com/codi/api/driver/updatephoto',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'foto' => new CURLFILE($imagenTempPath),
                            'id_persona' => $id_person
                        ),
                    ));
                    $response9 = json_decode(curl_exec($curl3), true);

                    curl_close($curl3);
                    //echo $response9;
                    if ($response9['message'] == 'Conductor actualizado correctamente') {/**/
                    header("HTTP/1.1 200 OK");
                    $respuesta['id_persona'] = $id_person;
                    $respuesta['valor'] = $response9;
                    $respuesta['estado'] = 'ok';
                    $respuesta['mensaje'] = $response9['message'];
                    $respuesta_json = json_encode($respuesta);
                    echo $respuesta_json;
                    }////
                }
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
                if (esURL($imagenBase64)) {
                    //echo "Es una URL: " . $srcValue;
                    header("HTTP/1.1 200 OK");
                    $respuesta['id_persona'] = $id_person;
                    $respuesta['valor'] = 'Es una URL';
                    $respuesta['estado'] = 'ok';
                    $respuesta['mensaje'] = 'Es una URL';
                    $respuesta_json = json_encode($respuesta);
                    echo $respuesta_json;
                } else {
                    // echo "Es una cadena Base64";

                    $curl3 = curl_init();
                    curl_setopt_array($curl3, array(
                        CURLOPT_URL => 'https://codidrive.com/codi/api/driver/updatephoto',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'foto' => new CURLFILE($imagenTempPath),
                            'id_persona' => $id_person
                        ),
                    ));
                    $response9 = json_decode(curl_exec($curl3), true);

                    curl_close($curl3);
                    //echo $response9;
                    if ($response9['message'] == 'Conductor actualizado correctamente') {
                    header("HTTP/1.1 200 OK");
                    $respuesta['id_persona'] = $id_person;
                    $respuesta['valor'] = $response9;
                    $respuesta['estado'] = 'ok';
                    $respuesta['mensaje'] = $response9['message'];
                    $respuesta_json = json_encode($respuesta);
                    echo $respuesta_json;
                    //curl_close($curl3);
                    }
                }
            } else {
                echo "Error al insertar el registro: ";
            }
        }
    } else {
        # code...
    }
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
