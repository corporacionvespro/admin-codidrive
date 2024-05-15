<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/editar/editar_asociado.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>