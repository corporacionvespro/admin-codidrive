<?php
$nombre = $_GET['nombre'];
// Conexión a la base de datos MySQL
$servername ='localhost';
$username ='root';
$password ='vespro$2024&';
$database ='codidrive';

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Consulta SQL para obtener los IDs de las personas a eliminar
$sql = "SELECT id_persona FROM persona WHERE nombres LIKE '%%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Comenzamos una transacción para asegurar la integridad referencial
    $conn->begin_transaction();

    try {
        while ($row = $result->fetch_assoc()) {
            $id_persona_a_eliminar = $row["id_persona"];
            
            // Eliminamos referencias en la tabla "solicitud"
            $sql_solicitud = "DELETE FROM solicitud WHERE id_pasajero IN (SELECT id_pasajero FROM pasajero WHERE id_persona = $id_persona_a_eliminar)";
            $conn->query($sql_solicitud);

            // Eliminamos referencias en la tabla "pasajero"
            $sql_pasajero = "DELETE FROM pasajero WHERE id_persona = $id_persona_a_eliminar";
            $conn->query($sql_pasajero);

            // Eliminamos referencias en la tabla "cuenta"
            $sql_cuenta = "DELETE FROM cuenta WHERE id_cuenta IN (SELECT id_cuenta FROM pasajero WHERE id_persona = $id_persona_a_eliminar)";
            $conn->query($sql_cuenta);

            // Finalmente, eliminamos a la persona en la tabla "persona"
            $sql_persona = "DELETE FROM persona WHERE id_persona = $id_persona_a_eliminar";
            $conn->query($sql_persona);
        }

        // Confirmamos la transacción
        $conn->commit();

        echo "Registros eliminados exitosamente.";
    } catch (Exception $e) {
        // En caso de error, hacemos un rollback para deshacer los cambios
        $conn->rollback();
        echo "Error al eliminar registros: " . $e->getMessage();
    }
} else {
    echo "No se encontraron registros para eliminar.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
