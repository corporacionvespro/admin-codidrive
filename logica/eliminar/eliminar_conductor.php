<?php
$id_persona_a_eliminar = $_POST['id_pe'];
$id_conductors = $_POST['id_pa'];
$servername = 'localhost';
$username = 'root';
$password = 'vespro$2024&';
$database = 'codidrive';
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}
$sql = "SELECT * FROM `solicitud` WHERE `id_conductor`= $id_conductors";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql_select = "SELECT id_solicitud FROM solicitud WHERE id_conductor = $id_conductors";
    $result = $conn->query($sql_select);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $id_solicitud = $row['id_solicitud'];
            $nuevo_id_conductor = 1;
            $sql_update = "UPDATE solicitud SET id_conductor = $nuevo_id_conductor WHERE id_solicitud = $id_solicitud";

            $sql_id_solicitud = "SELECT * FROM `solicitud_temporal` WHERE `id_solicitud`= $id_solicitud";
            $result_id_solicitud = $conn->query($sql_id_solicitud);
            if ($result_id_solicitud->num_rows > 0) {
                $sql_select = "SELECT id FROM solicitud_temporal WHERE `id_solicitud`= $id_solicitud";
                $result = $conn->query($sql_select);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $id_solicitud_tem = $row['id'];
                        $sql_update2 = "UPDATE `solicitud_temporal` SET `id_conductor` = $nuevo_id_conductor WHERE `solicitud_temporal`.`id` = $id_solicitud_tem";
                    }
                }
            }

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

        $sql_conductor = "DELETE FROM conductor WHERE id_persona = $id_persona_a_eliminar";
        $conn->query($sql_conductor);
        $sql_cuenta = "DELETE FROM cuenta WHERE id_cuenta IN (SELECT id_cuenta FROM conductor WHERE id_persona = $id_persona_a_eliminar)";
        $conn->query($sql_cuenta);
        $sql_persona = "DELETE FROM persona WHERE id_persona = $id_persona_a_eliminar";
        $conn->query($sql_persona);

        // Volver a activar la restricción de clave externa
        $sql_enable_constraint = "SET FOREIGN_KEY_CHECKS=1";
        $conn->query($sql_enable_constraint);
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
    echo "Registros eliminados 01.";
} else {
    // Desactivar temporalmente la restricción de clave externa
    $sql_disable_constraint = "SET FOREIGN_KEY_CHECKS=0";
    $conn->query($sql_disable_constraint);

    $sql_conductor = "DELETE FROM conductor WHERE id_persona = $id_persona_a_eliminar";
    $conn->query($sql_conductor);
    $sql_cuenta = "DELETE FROM cuenta WHERE id_cuenta IN (SELECT id_cuenta FROM conductor WHERE id_persona = $id_persona_a_eliminar)";
    $conn->query($sql_cuenta);
    $sql_persona = "DELETE FROM persona WHERE id_persona = $id_persona_a_eliminar";
    $conn->query($sql_persona);

    // Volver a activar la restricción de clave externa
    $sql_enable_constraint = "SET FOREIGN_KEY_CHECKS=1";
    $conn->query($sql_enable_constraint);
    echo "Registros eliminados exitosamente.";
}


$conn->close();
