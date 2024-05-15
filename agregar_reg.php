<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/agregar/agregar_reg.php';
} else {
    require_once './logica/agregar/agregar_reg.php';
}
?>