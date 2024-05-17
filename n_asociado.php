<?php
header('Content-Type: application/json');
// Conexión a la base de datos (asegúrate de cambiar los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = 'vespro$2024&';
$database = "codidrive";


$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener la información requerida
$query = "SELECT c.id_categoria_asociados, c.nombre AS nombre_categoria, c.detalle AS detalle_categoria, c.icon AS icono, 
                 a.id_asociados, a.nombre_asociado, a.telefono_asociado, a.direccion, a.latitud, a.longitud, 
                 a.nombre_admin, a.telefono_admin, a.fecha_hora, a.detalle, a.logo AS imagen
          FROM categoria_asociados c 
          LEFT JOIN asociados a ON c.id_categoria_asociados = a.id_categoria_asociados";

$result = $conn->query($query);

// Crear un array asociativo para almacenar la información
$data = array();

while ($row = $result->fetch_assoc()) {
    $categoria_id = $row['id_categoria_asociados'];

    // Agregar la categoría si aún no está en el array
    if (!isset($data[$categoria_id])) {
        $data[$categoria_id] = array(
            'id_categoria_asociados' => $categoria_id,
            'nombre_categoria' => $row['nombre_categoria'],
            'detalle_categoria' => $row['detalle_categoria'],
            'icono' => $row['icono'],
            'negocios' => array(),
        );
    }

    // Agregar información del negocio a la categoría
    $data[$categoria_id]['negocios'][] = array(
        'id_asociados' => $row['id_asociados'],
        'nombre_asociado' => $row['nombre_asociado'],
        'telefono_asociado' => $row['telefono_asociado'],
        'direccion' => $row['direccion'],
        'latitud' => $row['latitud'],
        'longitud' => $row['longitud'],
        'detalle' => $row['detalle'],
        'imagen' => $row['imagen'],
    );
}

// Convertir el array a formato JSON
$json = json_encode(array_values($data), JSON_PRETTY_PRINT);

// Imprimir el JSON
echo $json;

// Cerrar la conexión a la base de datos
$conn->close();
?>