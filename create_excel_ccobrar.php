<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './logica/export_excel/create_excel_ccobrar.php';
} else {
    require_once './view/admin/login-form.php';
}
?>