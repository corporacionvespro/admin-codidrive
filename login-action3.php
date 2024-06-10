<?php
namespace Phppot;
session_start();
$correo = $_POST["correo"];
$estado = $_POST["estado"];
$id_administrador = $_POST["id_administrador"];
$id_cuenta = $_POST["id_cuenta"];
$id_persona = $_POST["id_persona"];
$nombres = $_POST["nombres"];
$telefono = $_POST["telefono"];
$token = $_POST["token"];
$_SESSION["userId"] = $id_administrador;
$_SESSION["level"] = '2';
$_SESSION["empresa"] = 'Codi Drive';
$_SESSION["nombre_usuario"] = $nombres;
$_SESSION["cliente"] = $nombres;
$_SESSION["token"] = $token;
$url = './admin';
echo $url;
