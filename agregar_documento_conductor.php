<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/agregar/agregar_documento_conductor.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>