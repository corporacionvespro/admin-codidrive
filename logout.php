<?php
session_start();
$_SESSION["user_id"] = "";
session_destroy();
$url = 'admin';
$permanent = false;
if (headers_sent() === false) {
    header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
}
exit();
