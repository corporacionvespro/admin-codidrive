<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/agregar/agregar_documentos.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>