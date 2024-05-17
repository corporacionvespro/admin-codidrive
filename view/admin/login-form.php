<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:description" content="Una nueva version del sistema Taxi Vespro, simple y eficaz." />
    <meta property="twitter:description" content="Una nueva version del sistema Taxi Vespro, simple y eficaz." />
    <meta name="description" content="Una nueva version del sistema Taxi Vespro, simple y eficaz.">

    <meta property="twitter:image:src" content="https://chapatutaxi.com/admin/assets/img/brand/logo.png" />
    <meta property="og:image" content="https://chapatutaxi.com/admin/assets/img/brand/logo.png" />
    <link rel="apple-touch-icon" href="https://chapatutaxi.com/admin/assets/img/brand/logo.png">
    <link rel="icon" href="https://chapatutaxi.com/admin/assets/img/brand/logo.png">

    <meta property="og:title" content="Vespro" />
    <meta property="twitter:title" content="Vespro" />
    <meta name="author" content="vespro">
    <title>Chapa tu taxi</title>
    <!-- Favicon -->
    <!-- Fonts -->
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="./assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="./assets/css/argon.css?v=1.1.0" type="text/css">
</head>
<style>
    @font-face {
        font-family: chapatutaxi;
        src: url('./assets/fonts/Medinah.ttf')
    }

    .chapatutaxi {
        font-family: chapatutaxi !important;
        font-size: 80px;
        font-weight: 100;
        margin-bottom: 0px;
        line-height: 71px;
        transform: rotate(356deg);
    }
</style>

<body class="bg-gradient-primary" style="min-height: 100vh; background: #74c7d0 !important;">
    <!-- Navbar -->

    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-6 py-lg-7" style="background: #74c7d0 !important;">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <div class="contenedor" style="display: flex;justify-content: center;align-items: center;">
                                <img src="https://chapatutaxi.com/admin/imagenes/logochapatutaxi.webp" alt="Imagen centrada" style="max-width: 65%;max-height: 65%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Usuario" type="text" name="username" id="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Contraseña" type="password" name="password" id="password">
                                    <div class="input-group-append" onclick="mostrarpassword()">
                                        <span class="input-group-text"><i class="fa fa-eye-slash iconos"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span class="text-muted">Recordar</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="button" name="login" value="Ingresar" type="button" class="btn btn-primary my-4" style="width: 100%;" onclick="login()">Iniciar sesión</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-2 footer-auto-bottom" id="footer-main">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-xl-12">
                    <div class="copyright text-center text-muted" style="color: white !important;">
                        ©  <a href="https://vespro.io" class="font-weight-bold ml-1" target="_blank" style="color: #dde0e1;">Tecnolog&iacute;a Vespro</a>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="assets/js/argon.js?v=1.1.0"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="assets/js/demo.min.js"></script>
    <script>
        function validate() {
            var $valid = true;
            document.getElementById("user_info").innerHTML = "";
            var userName = document.getElementById("username").value;
            if (userName == "") {
                document.getElementById("user_info").innerHTML = "Campo obligatorio";
                $valid = false;
            }
            if (password == "") {
                document.getElementById("password_info").innerHTML = "Campo obligatorio";
                $valid = false;
            }
            return $valid;
        }
    </script>
    <script>
        $(".input").focus(function() {
            $(this).css({
                "background": "rgb(82, 179, 126)"
            })
        })
        $(".input").blur(function() {
            $(this).css({
                "background": "transparent"
            })
        })

        function mostrarpassword() {
            var cambio = document.getElementById("password");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('.iconos').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('.iconos').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        function login() {
            ids = $('#ids').val();
            username = $('#username').val();
            password = $('#password').val();
            $.ajax({
                type: "POST",
                url: "login-action2.php",
                data: {
                    username: username,
                    password: password
                },
                success: function(result) {
                    window.location.href = result;
                }
            });
        }
    </script>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="./assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="./assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="./assets/js/argon.js?v=1.1.0"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="./assets/js/demo.min.js"></script>




</body>

</html>