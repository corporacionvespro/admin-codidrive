<?php

$id_persona = $_POST['id_persona'];
$file = $_POST['file'];

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://codidrive.com/codi/api/driver/updatephoto',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('foto' => new CURLFILE($file), 'id_persona' => $id_persona),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
