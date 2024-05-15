<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/eliminar/eliminar_asociado.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>