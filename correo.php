<?php
if(!empty($_POST['correo'])) {
    require_once './view/admin/correo.php';
} else {
    require_once './view/admin/error.php';
}
?>