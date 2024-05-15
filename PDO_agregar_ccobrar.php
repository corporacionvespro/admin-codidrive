<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/agregar/PDO_agregar_ccobrar.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>