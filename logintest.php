<?php
$url = "https://codidrive.com/codi/api/admin/auth";
$data = array(
    "correo" => "vesprodemo@gmail.com",
    "clave" => "admin"
);
$ch = curl_init($url);
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
echo $res = json_encode((string)$result);
echo $res['nombres'];
