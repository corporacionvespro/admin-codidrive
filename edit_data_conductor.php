<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/editar/edit_data_conductor.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>