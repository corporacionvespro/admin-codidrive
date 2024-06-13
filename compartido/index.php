<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha384-6fAfBF0FBzZ1CVmQnHg4PBhT5lbE2c4XFXOY5FOpWeWifwYRY6DQVXos3KXQc7Bp" crossorigin="anonymous">
    <style>
        .header {
            background: #01296e;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            height: 56px; /* Altura similar a la de un navbar */
        }

        .header img {
            height: 100%; /* Hace que las imágenes ocupen toda la altura del navbar */
            max-height: 100%;
        }

        .store-images {
            display: flex;
            gap: 10px;
            align-items: center; /* Alinea las imágenes verticalmente en el centro */
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
    </style>
</head>

<body>
    <div class="container-fluid header">
        <div class="logo">
            <img src="https://codidrive.com/admin/assets/img/brand/logo3.png" class="img-fluid" alt="Logo">
        </div>
        <div class="store-images">
            <div>
                <img src="https://codidrive.com/admin/imagenes/playstore.png" class="img-fluid" alt="Play Store">
            </div>
            <div>
                <img src="https://codidrive.com/admin/imagenes/apple.png" class="img-fluid" alt="Apple Store">
            </div>
        </div>
    </div>

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
            <p><i class="fa-solid fa-location-dot"></i> Urb Santa Rosa</p>
            <p><i class="fa-solid fa-location-dot"></i> Hospital Regional de Lambayeque (Chiclayo)</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
