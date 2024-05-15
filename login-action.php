<?php

namespace Phppot;

use \Phppot\Member;

if (!empty($_POST["login"])) {
    session_start();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    require_once(__DIR__ . "/class/Member.php");
    $member = new Member();
    $isLoggedIn = $member->processLogin($username, $password);
    if (!$isLoggedIn) {
        $_SESSION["errorMessage"] = "Usuario invalido";
    }
    $url = './admin';
    $permanent = false;
    if (headers_sent() === false) {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}
