
<?php
header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/xls; charset=utf-8'");
header("Content-Disposition: attachment; filename=PROSPECTOS_CONDUCTORES_" . date('Y:m:d:m:s') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '@Vespro', 'chapatutaxi');

// Función para obtener datos
function ubicar()
{
    global $conexion;

    // Realizar la consulta SQL
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
        vehiculo.color, 
        vehiculo.anio, 
        cuenta.correo AS cuenta_correo, 
        cuenta.clave, 
        cuenta.estado AS cuenta_estado, 
        cuenta.fechayhora AS cuenta_fechayhora

        FROM conductor 
        INNER JOIN documentos_conductor ON conductor.id_conductor = documentos_conductor.id_conductor 
        INNER JOIN persona ON conductor.id_persona = persona.id_persona 
        INNER JOIN vehiculo ON conductor.id_vehiculo = vehiculo.id_vehiculo 
        INNER JOIN cuenta ON conductor.id_cuenta = cuenta.id_cuenta
        WHERE conductor.estado ='sinaprobar'");

    $userData = array();

    // Recorrer los resultados y almacenar en un array asociativo
    while ($result = mysqli_fetch_array($query)) {
        $userData[] = [
            "Nombres" => $result['nombres'],
            "Telefono" => $result['telefono'],
            "Correo" => $result['persona_correo'],
            "Foto personal" => "https://chapatutaxi.com/chapaapi/images/".$result['foto'],
            "Correo de la cuenta " => $result['cuenta_correo'],
            "Clave de la cuenta" => $result['clave'],
            "Estado del conductor" => $result['conductor_estado'],
            "Tipo de documentos de identidad" => $result['dni_tipo'],
            "N documentos de identidad" => $result['dni_numero'],
            "Fecha de V. documentos de identidad" => $result['dni_fv'],
            "Fecha de N. documentos de identidad" => $result['fecha_nacimiento'],
            "documentos de identidad frontal" => $result['dni_foto_frontal'],
            "documentos de identidad posterior" => $result['dni_foto_posterior'],
            "Placa de vehiculo." => $result['placa'],
            "Marca de vehiculo." => $result['marca'],
            "Color de vehiculo." => $result['color'],
            "Año del vehiculo" => $result['anio'],
            "N de licencia" => $result['licencia_numero'],
            "Fecha de V. de licencia" => $result['licencia_fv'],
            "Foto frontal de licencia" => $result['licencia_foto_frontal'],
            "Foto posterior de licencia" => $result['licencia_foto_posterior'],
            "Fecha de V. de SOAT" => $result['soat_fv'],
            "Foto de SOAT" => $result['soat_foto'],
            "Foto de antecedentes" => $result['antecedentes_foto'],
            "Foto frontal tarjeta de prop." => $result['tp_foto_frontal'],
            "Foto posterior tarjeta de prop." => $result['tp_foto_posterior'],
            "Tipo de certificado (GNV / GLP)" => $result['certificado_gnv_glp_tipo'],
            "Foto de certificado (GNV / GLP)" => $result['certificado_gnv_glp_fv'],
            "Fecha de V. revision tecnica" => $result['revision_tecnica_fv'],
            "Reg. cuenta" => $result['cuenta_fechayhora'],
            "Reg. documentos" => $result['fecha_hora_reg'],
            "Ultima modificacion de los reg." => $result['fecha_hora_mod']
        ];
    }

    return $userData;
}

// Obtener los datos
$datos = ubicar();

// Verificar si hay datos
if (!empty($datos)) {
    // Crear la tabla HTML
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    
    // Crear encabezados de columna basados en las claves del primer elemento del array
    foreach ($datos[0] as $key => $value) {
        echo '<th>' . htmlspecialchars($key) . '</th>';
    }

    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Mostrar datos en filas de la tabla
    foreach ($datos as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . iconv("UTF-8", "ISO-8859-1//TRANSLIT", htmlspecialchars($value)) . '</td>';
        }
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No hay datos para mostrar.</p>';
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>