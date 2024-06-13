<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha384-6fAfBF0FBzZ1CVmQnHg4PBhT5lbE2c4XFXOY5FOpWeWifwYRY6DQVXos3KXQc7Bp" crossorigin="anonymous">
    <style>
    .navbar-custom {
        background: #01296e;
        display: flex;
        justify-content: space-between; /* Alineación de ítems */
        align-items: center; /* Alineación vertical */
    }

    .navbar-custom .navbar-brand img {
        height: 30px;
        width: auto;
    }

    .navbar-custom .navbar-collapse {
        justify-content: flex-end;
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
        /* Inicia mostrado */
    }

    .mostar.hidden {
        display: none;
        /* Se oculta cuando tiene la clase 'hidden' */
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid" style="display: flex;flex-wrap: nowrap;align-items: center;">
            <a id='logos' class="navbar-brand" href="#">
                <img src="https://codidrive.com/admin/assets/img/brand/logo3.png" alt="Logo">
            </a>
            <div class="d-flex align-items-center">
                <a id='play' class="navbar-brand me-3" href="#">
                    <img src="https://codidrive.com/admin/imagenes/playstore.png" alt="Play Store">
                </a>
                <a id="apple" class="navbar-brand " href="#" style="margin-right: 0px;">
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
            <div>
                <p><i class="bi bi-pin-map-fill"></i> Urb Santa Rosa</p>
                <p><i class="bi bi-pin-map-fill"></i> Hospital Regional de Lambayeque (Chiclayo)</p>
            </div>
        </div>
    </div>

    <div class="container">
      <button class="btn btn-primary" id="toggleButton" style="background: #e2ecf2;color: #01296e;border: none;border-radius: 0px 0px 50px 50px;height: 30px;">
        <i class="bi bi-arrow-bar-down"></i>
        <!--<i class="bi bi-arrow-bar-up"></i>
        
        <i class="bi bi-chevron-double-down"></i>
        <i class="bi bi-chevron-double-up"></i>
        -->
      </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleButton');
        const mostarDiv = document.querySelector('.mostar');

        toggleButton.addEventListener('click', function() {
            mostarDiv.classList.toggle('hidden');
        });
    });
    </script>
</body>

</html>
