<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/servidor/server_process_consultar_chart.php';
} else {
    require_once './view/admin/login-form.php';
    
}
?>