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
$query = "SELECT c.id_categoria_asociados, c.nombre AS nombre_categoria, c.detalle AS detalle_categoria, c.icon, 
                 a.id_asociados, a.nombre_asociado, a.telefono_asociado, a.direccion, a.latitud, a.longitud, 
                 a.nombre_admin, a.telefono_admin, a.fecha_hora, a.detalle, a.logo 
          FROM categoria_asociados c 
          LEFT JOIN asociados a ON c.id_categoria_asociados = a.id_categoria_asociados";

$result = $conn->query($query);

// Crear un array asociativo para almacenar la información
$data = array();

while ($row = $result->fetch_assoc()) {
    $categoria_id = $row['id_categoria_asociados'];

    // Agregar información del negocio a la categoría
    $data[$categoria_id] = array(
        'nombre_categoria' => $row['nombre_categoria'],
        'imagen' => 'https://codidrive.com/admin/assets/img/brand/logo.png',
    );
}

// Convertir el array a formato JSON
$json = json_encode(array_values($data), JSON_PRETTY_PRINT);

// Imprimir el JSON
echo $json;

// Cerrar la conexión a la base de datos
$conn->close();
?>