<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/editar/finalizar_solicitud.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>