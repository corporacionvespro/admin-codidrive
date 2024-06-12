<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './view/admin/mapacompartir.php';
} else {
    require_once './view/admin/mapacompartir.php';
}
?>