<?php
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
$conexion = mysqli_connect('localhost', 'root', '@Vespro', 'chapatutaxi');
function ubicar()
{
    global $conexion;
    $query = $conexion->query("SELECT 
    conductor.estado AS conductor_estado, 
    documentos_conductor.dni_foto_frontal, 
    documentos_conductor.dni_foto_posterior, 
    documentos_conductor.fecha_nacimiento, 
    documentos_conductor.dni_numero, 
    documentos_conductor.dni_fv, 
    documentos_conductor.dni_tipo, 
    documentos_conductor.licencia_foto_frontal, 
    documentos_conductor.licencia_foto_posterior, 
    documentos_conductor.licencia_numero, 
    documentos_conductor.licencia_fv, 
    documentos_conductor.soat_foto, 
    documentos_conductor.soat_fv, 
    documentos_conductor.tp_foto_frontal, 
    documentos_conductor.tp_foto_posterior, 
    documentos_conductor.antecedentes_foto, 
    documentos_conductor.revision_tecnica_fv, 
    documentos_conductor.certificado_gnv_glp_tipo, 
    documentos_conductor.certificado_gnv_glp_fv, 
    documentos_conductor.fecha_hora_reg, 
    documentos_conductor.fecha_hora_mod, 
    persona.nombres, 
    persona.telefono, 
    persona.correo AS persona_correo, 
    persona.foto, 
    vehiculo.placa, 
    vehiculo.marca, 
    vehiculo.unidad, 
    vehiculo.color, 
    vehiculo.anio, 
    cuenta.correo AS cuenta_correo, 
    cuenta.clave, 
    cuenta.estado AS cuenta_estado, 
    cuenta.fechayhora AS cuenta_fechayhora 
    FROM conductor INNER JOIN documentos_conductor ON conductor.id_conductor = documentos_conductor.id_conductor INNER JOIN persona ON conductor.id_persona = persona.id_persona INNER JOIN vehiculo ON conductor.id_vehiculo = vehiculo.id_vehiculo INNER JOIN cuenta ON conductor.id_cuenta = cuenta.id_cuenta");
    $userData = array();
    while ($result = mysqli_fetch_array($query)) {
			$userData[] = [
                "conductor.estado" => $result['conductor_estado'],
                "documentos_conductor.dni_foto_frontal" => $result['dni_foto_frontal'],
                "documentos_conductor.dni_foto_posterior" => $result['dni_foto_posterior'],
                "documentos_conductor.fecha_nacimiento" => $result['fecha_nacimiento'],
               "documentos_conductor.dni_numero" => $result['dni_numero'],
               "documentos_conductor.dni_fv" => $result['dni_fv'],
               "documentos_conductor.dni_tipo" => $result['documentos_conductor.dni_tipo'],
               "documentos_conductor.licencia_foto_frontal" => $result['documentos_conductor.licencia_foto_frontal'],
               "documentos_conductor.licencia_foto_posterior" => $result['documentos_conductor.licencia_foto_posterior'],
               "documentos_conductor.licencia_numero" => $result['licencia_numero'],
               "documentos_conductor.licencia_fv" => $result['licencia_fv'],
               "documentos_conductor.soat_foto" => $result['soat_foto'],
               "documentos_conductor.soat_fv" => $result['soat_fv'],
               "documentos_conductor.tp_foto_frontal" => $result['tp_foto_frontal'],
               "documentos_conductor.tp_foto_posterior" => $result['tp_foto_posterior'],
               "documentos_conductor.antecedentes_foto" => $result['antecedentes_foto'],
               "documentos_conductor.revision_tecnica_fv" => $result['revision_tecnica_fv'],
               "documentos_conductor.certificado_gnv_glp_tipo" => $result['certificado_gnv_glp_tipo'],
               "documentos_conductor.certificado_gnv_glp_fv" => $result['certificado_gnv_glp_fv'],
               "documentos_conductor.fecha_hora_reg" => $result['fecha_hora_reg'],
               "documentos_conductor.fecha_hora_mod" => $result['fecha_hora_mod'],
               "persona.nombres" => $result['nombres'],
               "persona.telefono" => $result['telefono'],
               "persona.correo" => $result['persona_correo'],
               "persona.foto" => "https://chapatutaxi.com/chapaapi/images/".$result['foto'],
               "vehiculo.placa" => $result['placa'],
               "vehiculo.marca" => $result['marca'],
               "vehiculo.unidad" => $result['unidad'],
               "vehiculo.color" => $result['color'],
               "vehiculo.anio" => $result['anio'],
               "cuenta_correo" => $result['cuenta_correo'],
               "cuenta.clave" => $result['clave'],
               "cuenta_estado" => $result['cuenta_estado'],
               "cuenta_fechayhora" => $result['cuenta_fechayhora']

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
