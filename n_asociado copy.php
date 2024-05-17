<?php
header('Content-Type: application/json');
// Conexión a la base de datos (asegúrate de cambiar los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = 'vespro$2024&';
$dbname = "codidrive";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de las tablas relacionadas
$sql = "SELECT a.*, c.nombre as nombre_categoria FROM asociados a
        JOIN categoria_asociados c ON a.id_categoria_asociados = c.id_categoria_asociados";

$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar los datos
    $categorias = array();

    // Iterar a través de los resultados y agregarlos al array
    while ($row = $result->fetch_assoc()) {
        $categoria = array(
            'id_categoria_asociados' => $row['id_categoria_asociados'],
            'nombre' => $row['nombre_categoria'],
            'detalle' => $row['detalle'],
            'icon' => $row['icon'],
            'fecha_hora' => $row['fecha_hora'],
            'asociados' => array(
                'id_asociados' => $row['id_asociados'],
                'nombre_asociado' => $row['nombre_asociado'],
                'telefono_asociado' => $row['telefono_asociado'],
                'direccion' => $row['direccion'],
                'latitud' => $row['latitud'],
                'longitud' => $row['longitud'],
                'nombre_admin' => $row['nombre_admin'],
                'telefono_admin' => $row['telefono_admin'],
                'fecha_hora_asociado' => $row['fecha_hora'],
                'detalle_asociado' => $row['detalle'],
                'logo' => $row['logo']
            )
        );

        // Agregar la categoría al array principal
        $categorias[] = $categoria;
    }

    // Convertir el array a formato JSON
    $json_data = json_encode($categorias, JSON_PRETTY_PRINT);

    // Mostrar o guardar el JSON según tus necesidades
    echo $json_data;

} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión a la base de datos
$conn->close();

?>
