<?php
$conn = mysqli_connect('161.132.54.172', 'root', 'vespro$2024&', 'codidrive');

if (!$conn) {
	die("Error: Fallo al conectar con la base de datos");
}
// Configurar la codificación de caracteres
//$conn->set_charset("utf8");
