<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/agregar/agregar_recarga.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>