<?php
$conn = mysqli_connect('localhost', 'root', 'vespro$2024&', 'codidrive');

if (!$conn) {
	die("Error: Fallo al conectar con la base de datos");
}
// Configurar la codificación de caracteres
//$conn->set_charset("utf8");
