<?php
$id_persona_a_eliminar = $_POST['id_pe'];
$id_pasajeros = $_POST['id_pa'];
$servername = '161.132.54.172';
$username = 'root';
$password = 'vespro$2024&';
$database = 'codidrive';
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}
$query_c_correos = $conn->query("SELECT COUNT(`correo`) AS c_correos FROM `persona` WHERE `id_persona`= $id_persona_a_eliminar");
$c_correos = $query_c_correos->fetch_assoc();
$id_c_correos = $c_correos['c_correos'];
$query_c_id_cuenta = $conn->query("SELECT `id_cuenta` FROM `pasajero` WHERE `id_pasajero`= $id_pasajeros");
$c_id_cuenta = $query_c_id_cuenta->fetch_assoc();
$id_c_id_cuenta = $c_id_cuenta['id_cuenta'];
$id_n_s_correo = '';

if ($id_c_correos > 0) {
    $query_correo = $conn->query("SELECT correo FROM `persona` WHERE `id_persona`= '{$id_persona_a_eliminar}' LIMIT 1");
    $id_n_correo = $query_correo->fetch_assoc();
    $id_n_s_correo = $id_n_correo['correo'];
}

$sql = "SELECT * FROM `solicitud` WHERE `id_pasajero`= $id_pasajeros";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql_select = "SELECT id_solicitud FROM solicitud WHERE id_pasajero = $id_pasajeros";
    $result = $conn->query($sql_select);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $id_solicitud = $row['id_solicitud'];
            $nuevo_id_pasajero = 155;
            $sql_update = "UPDATE solicitud SET id_pasajero = $nuevo_id_pasajero WHERE id_solicitud = $id_solicitud";
            if ($conn->query($sql_update) === TRUE) {
                echo "Se actualizó el registro con ID de solicitud $id_solicitud.<br>";
            } else {
                echo "Error al actualizar el registro con ID de solicitud $id_solicitud: " . $conn->error . "<br>";
            }
        }
        $result->free();
        // Desactivar temporalmente la restricción de clave externa
        $sql_disable_constraint = "SET FOREIGN_KEY_CHECKS=0";
        $conn->query($sql_disable_constraint);

        $sql_pasajero = "DELETE FROM pasajero WHERE id_persona = $id_persona_a_eliminar";
        $conn->query($sql_pasajero);
        $sql_cuenta = "DELETE FROM cuenta WHERE id_cuenta = $id_c_id_cuenta AND cod_rol = 1000";
        $conn->query($sql_cuenta);
        $sql_persona = "DELETE FROM persona WHERE id_persona = $id_persona_a_eliminar";
        $conn->query($sql_persona);

        // Volver a activar la restricción de clave externa
        $sql_enable_constraint = "SET FOREIGN_KEY_CHECKS=1";
        $conn->query($sql_enable_constraint);
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
    echo "Registros eliminados 01";
} else {
    // Desactivar temporalmente la restricción de clave externa
    $sql_disable_constraint = "SET FOREIGN_KEY_CHECKS=0";
    $conn->query($sql_disable_constraint);

    $sql_pasajero = "DELETE FROM pasajero WHERE id_persona = $id_persona_a_eliminar";
    $conn->query($sql_pasajero);
    $sql_cuenta = "DELETE FROM cuenta WHERE id_cuenta = $id_c_id_cuenta AND cod_rol = 1000";
    $conn->query($sql_cuenta);
    $sql_persona = "DELETE FROM persona WHERE id_persona = $id_persona_a_eliminar";
    $conn->query($sql_persona);
    // Volver a activar la restricción de clave externa
    $sql_enable_constraint = "SET FOREIGN_KEY_CHECKS=1";
    $conn->query($sql_enable_constraint);
    echo "Registros eliminados exitosamente.";
}
$conn->close();
