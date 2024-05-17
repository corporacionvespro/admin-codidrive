<?php
if(isset($_POST['accion'])){
    $accion = $_POST['accion'];
    
    $servername = "localhost";
    $username = "root";
    $password = 'vespro$2024&';
    $dbname = "codidrive";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    $response = array(); // Arreglo para almacenar la respuesta

    if($accion === "co") {
        $sql = "SELECT id_conductor, token FROM conductor WHERE token IS NOT NULL AND token != ''";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Agrega cada fila como un elemento en el arreglo de respuesta
                $response[] = array(
                    "id_conductor" => $row["id_conductor"],
                    "token" => $row["token"]
                );
            }
            
            // Cierra la conexión
            $conn->close();

            // Configura la cabecera para indicar que se envía una respuesta JSON
            header('Content-Type: application/json');

            // Convierte el arreglo de respuesta a JSON
            $json_response = json_encode($response);

            // Envia la respuesta JSON
            echo $json_response;

            // Llamar a la función para enviar solicitud cURL para "co"
            enviarSolicitudCurlConductor($response, $_POST['t'], $_POST['d']);
        } else {
            $response["mensaje"] = "No se encontraron registros.";
            // Cierra la conexión
            $conn->close();

            // Configura la cabecera para indicar que se envía una respuesta JSON
            header('Content-Type: application/json');

            // Convierte el arreglo de respuesta a JSON y lo imprime
            echo json_encode($response);
        }
    } elseif($accion === "pa") {
        $sql = "SELECT token FROM pasajero WHERE token IS NOT NULL AND token != 'BLACKLISTED'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Agrega cada token como un elemento en el arreglo de respuesta
                $response[] = array(
                    "token" => $row["token"]
                );
            }
            
            // Cierra la conexión
            $conn->close();

            // Configura la cabecera para indicar que se envía una respuesta JSON
            header('Content-Type: application/json');

            // Convierte el arreglo de respuesta a JSON
            $json_response = json_encode($response);

            // Envia la respuesta JSON
            echo $json_response;

            // Llamar a la función para enviar solicitud cURL para "pa"
            enviarSolicitudCurlPasajero($response, $_POST['t'], $_POST['d']);
        } else {
            $response["mensaje"] = "No se encontraron registros.";
            // Cierra la conexión
            $conn->close();

            // Configura la cabecera para indicar que se envía una respuesta JSON
            header('Content-Type: application/json');

            // Convierte el arreglo de respuesta a JSON y lo imprime
            echo json_encode($response);
        }
    } else {
        $response["mensaje"] = "Acción no válida.";
        // Cierra la conexión
        $conn->close();

        // Configura la cabecera para indicar que se envía una respuesta JSON
        header('Content-Type: application/json');

        // Convierte el arreglo de respuesta a JSON y lo imprime
        echo json_encode($response);
    }
} else {
    echo "No se especificó ninguna acción por POST.";
}

// Función para enviar solicitud cURL para "co"
function enviarSolicitudCurlConductor($data, $titulo, $descripcion) {
    $url = 'https://chapatutaxi.com/chapaapi/api/token/pushcustomdriver';
    $curl = curl_init();

    foreach ($data as $item) {
        $postData = array(
            'id_conductor' => $item["id_conductor"],
            'titulo' => $titulo,
            'descripcion' => $descripcion
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
        ));

        $response = curl_exec($curl);

        // Puedes manejar la respuesta de la solicitud cURL aquí si es necesario
    }

    // Cerrar la sesión cURL
    curl_close($curl);
}

// Función para enviar solicitud cURL para "pa"
function enviarSolicitudCurlPasajero($data, $titulo, $descripcion) {
    $url = 'https://chapatutaxi.com/chapaapi/api/token/pushpassenger';
    $curl = curl_init();

    foreach ($data as $item) {
        $postData = array(
            'token' => $item["token"],
            'titulo' => $titulo,
            'descripcion' => $descripcion
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
        ));

        $response = curl_exec($curl);

        // Puedes manejar la respuesta de la solicitud cURL aquí si es necesario
    }

    // Cerrar la sesión cURL
    curl_close($curl);
}
?>
