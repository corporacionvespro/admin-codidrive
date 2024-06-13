<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .navbar-custom {
            background: #01296e;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-custom .navbar-brand img {
            height: 30px;
            width: auto;
        }

        .content {
            display: flex;
            align-items: center;
            padding: 12px;
            flex-wrap: wrap;
        }

        .content img {
            width: 49px;
        }

        .info {
            margin-left: 12px;
        }

        .info p {
            margin: 0;
            padding: 0;
        }

        .location {
            display: flex;
            padding: 0 23px 18px 23px;
            flex-wrap: wrap;
        }

        .location p {
            margin: 0;
            padding: 0;
        }

        .mostar {
            display: block;
            background: #e2ecf2;
        }

        .mostar.hidden {
            display: none;
        }

        #mapa {
            height: 400px; /* Ajusta la altura según tus necesidades */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://codidrive.com/admin/assets/img/brand/logo3.png" alt="Logo">
            </a>
            <div class="d-flex align-items-center">
                <a class="navbar-brand me-3" href="#">
                    <img src="https://codidrive.com/admin/imagenes/playstore.png" alt="Play Store">
                </a>
                <a class="navbar-brand" href="#">
                    <img src="https://codidrive.com/admin/imagenes/apple.png" alt="Apple Store">
                </a>
            </div>
        </div>
    </nav>

    <div class="mostar">
        <div class="container content">
            <div>
                <img src="https://codidrive.com/admin/assets/img/brand/logo.png" class="img-fluid" alt="Logo">
            </div>
            <div class="info">
                <p>Paulo César 4,87</p>
                <p>plata alto M3L576</p>
            </div>
        </div>

        <div class="container location">
            <div style="font-size: small;">
                <p><i class="bi bi-circle" style="color: #01296e;"></i> Urb Santa Rosa</p>
                <p><i class="bi bi-circle-fill" style="color: #01296e;"></i> Hospital Regional de Lambayeque (Chiclayo)</p>
            </div>
        </div>
    </div>
    <div class=""id="toggleButton" style="display: flex;flex-wrap: nowrap;align-content: flex-start;justify-content: center;align-items: flex-start;background: #01296e;">
        <button class="btn btn-primary" style="background: #01296e;color: #e2ecf2;border: none;height: 50px;width: 50px;">
            <i class="bi bi-chevron-double-up" style="font-size: 25px;font-weight: 200;"></i>
        </button>
    </div>
    <div id='mapa'></div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Agrega la API de Google Maps -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgaYby7k-uwnMsLF3Du3hfHtWpH789Xdo&callback=initMap">
    </script>

    <script>
        // Define la función initMap para inicializar el mapa
        function initMap() {
            // Coordenadas para centrar el mapa (ejemplo)
            var myLatLng = { lat: -12.046374, lng: -77.042793 };

            // Crea un mapa en el div #mapa
            var map = new google.maps.Map(document.getElementById('mapa'), {
                zoom: 15,
                center: myLatLng
            });

            // Ejemplo de marcador
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Ubicación'
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggleButton');
            const mostarDiv = document.querySelector('.mostar');

            toggleButton.addEventListener('click', function () {
                mostarDiv.classList.toggle('hidden');
                toggleButton.querySelector('i').classList.toggle('bi-chevron-double-up');
                toggleButton.querySelector('i').classList.toggle('bi-chevron-double-down');
            });
        });
    </script>
</body>

</html>
