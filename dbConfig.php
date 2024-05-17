<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'vespro$2024&';
$dbName = 'codidrive';
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$db->set_charset("utf8");
if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}
