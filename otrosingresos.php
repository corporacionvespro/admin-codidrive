<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './view/admin/otrosingresos.php';
} else {
    require_once './view/admin/login-form.php';
}
?>