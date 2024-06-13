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
            padding: 12px;
        }

        .header img {
            width: 100%;
        }

        .content {
            display: flex;
            align-items: center;
            padding: 12px;
        }

        .content img {
            width: 49px;
        }

        .info p {
            margin: 0;
            padding: 0;
        }

        .location p {
            margin: 0;
            padding: 0;
        }

        @media (max-width: 576px) {
            .header {
                flex-direction: column;
                align-items: center;
            }

            .content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .location {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid header">
        <div class="logo">
            <img src="https://codidrive.com/admin/assets/img/brand/logo3.png" class="img-fluid" alt="Logo">
        </div>
        <div class="d-flex align-items-center">
            <div class="me-2">
                <img src="https://codidrive.com/admin/imagenes/playstore.png" class="img-fluid" alt="Play Store" style="width: 100px;">
            </div>
            <div>
                <img src="https://codidrive.com/admin/imagenes/apple.png" class="img-fluid" alt="Apple Store" style="width: 100px;">
            </div>
        </div>
    </div>
    <div class="container content">
        <div>
            <img src="https://codidrive.com/admin/assets/img/brand/logo.png" class="img-fluid" alt="Logo">
        </div>
        <div class="info ms-3">
            <p>Paulo César 4,87</p>
            <p>plata alto M3L576</p>
        </div>
    </div>
    <div class="container location">
        <p><i class="fa-solid fa-location-dot"></i> Urb Santa Rosa</p>
        <p><i class="fa-solid fa-location-dot"></i> Hospital Regional de Lambayeque (Chiclayo)</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
