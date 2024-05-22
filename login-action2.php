<?php
session_start();
$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://codidrive.com/codi/api/admin/auth',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('correo' => $username, 'clave' => $password),
));
$response = json_decode(curl_exec($curl), true);
curl_close($curl);
if ($response['admin']['id_administrador'] == 4) {
    $level = 2;
} else {
    $level = 3;
}
$_SESSION["userId"] = $response['admin']['id_administrador'];
$_SESSION["level"] = $level;
$_SESSION["empresa"] = 'Chapa Tu Taxi';
$_SESSION["nombre_usuario"] = $response['admin']['nombres'];
$_SESSION["cliente"] = $response['admin']['nombres'];
$_SESSION["token"] = $response['token'];
$url = './admin';
//echo $url;
echo $response;