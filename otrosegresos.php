<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './view/admin/otrosegresos.php';
} else {
    require_once './view/admin/login-form.php';
}
?>