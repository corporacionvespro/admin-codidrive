<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Una nueva version del sistema Taxi Vespro, simple y eficaz.">
    <meta name="author" content="vespro">
    <title>Codi Drive</title>
    <!-- Favicon -->
    <link rel="icon" href="./assets/img/brand/logo.png" type="image/png">
    <!-- Fonts -->
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="./assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

    /* --------------------------*/
    @-webkit-keyframes scaleAnimation {
        0% {
            opacity: 0;
            transform: scale(1.5);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes scaleAnimation {
        0% {
            opacity: 0;
            transform: scale(1.5);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @-webkit-keyframes drawCircle {
        0% {
            stroke-dashoffset: 151px;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes drawCircle {
        0% {
            stroke-dashoffset: 151px;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @-webkit-keyframes drawCheck {
        0% {
            stroke-dashoffset: 36px;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes drawCheck {
        0% {
            stroke-dashoffset: 36px;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @-webkit-keyframes fadeOut {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    @-webkit-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    #successAnimationCircle {
        stroke-dasharray: 151px 151px;
        stroke: #FFF;
    }

    #successAnimationCheck {
        stroke-dasharray: 36px 36px;
        stroke: #FFF;
    }

    #successAnimationResult {
        fill: #FFF;
        opacity: 0;
    }

    #successAnimation.animated {
        -webkit-animation: 1s ease-out 0s 1 both scaleAnimation;
        animation: 1s ease-out 0s 1 both scaleAnimation;
    }

    #successAnimation.animated #successAnimationCircle {
        -webkit-animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCircle, 0.3s linear 0.9s 1 both fadeOut;
        animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCircle, 0.3s linear 0.9s 1 both fadeOut;
    }

    #successAnimation.animated #successAnimationCheck {
        -webkit-animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCheck, 0.3s linear 0.9s 1 both fadeOut;
        animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCheck, 0.3s linear 0.9s 1 both fadeOut;
    }

    #successAnimation.animated #successAnimationResult {
        -webkit-animation: 0.3s linear 0.9s both fadeIn;
        animation: 0.3s linear 0.9s both fadeIn;
    }

    #message {
        display: none;
        background: #f6f3f9;
        color: #5e14b9;
        position: relative;
        padding: 25px;
        margin-top: 9px;
        border-radius: 25px;
    }

    #message p {
        padding: 0px 35px;
        font-size: 14px;
        margin-bottom: 0rem;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        left: -35px;
        content: "✔";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        left: -35px;
        content: "✖";
    }

    .whatsapp {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 61px;
        right: 8px;
        background-color: #25d366;
        color: #fff;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        z-index: 100;
        padding: 6px;
    }
</style>

<body class="bg-gradient-primary" style="min-height: 100vh;">

    <!-- Navbar -->
    <a href="https://wa.me/51992195100?text=hola" class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>

    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-6 py-lg-7">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <div class="contenedor" style="display: flex;justify-content: center;align-items: center;">
                                <img src="https://codidrive.com/admin/imagenes/logocodi.webp" alt="Imagen centrada" style="max-width: 65%;max-height: 65%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div id="valido" style="display: none;">
                    <svg id="successAnimation" class="animated" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 70 70">
                        <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z" />
                        <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent" />
                        <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent" />
                    </svg>
                </div>
                <div class="col-lg-5 col-md-7" id="formulario">
                    <div class="card bg-secondary border-0 mb-0">
                        <!-- -->
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Correo registrado" type="text" name="username" id="username" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Nueva contrase&ntilde;a" type="password" name="password" id="password" autocomplete="off">
                                    <div class="input-group-append" onclick="mostrarpassword()">
                                        <span class="input-group-text"><i class="fa fa-eye-slash iconos"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="message">
                                    <h3 style="color: #535f7e;text-align: center;">La contraseña debe contener lo siguiente:</h3>
                                    <p id="letter" class="invalid">Mínimo una <b>Minúscula</b></p>
                                    <p id="capital" class="invalid">Mínimo una <b>Mayúscula</b></p>
                                    <p id="number" class="invalid">Mínimo un <b>Número</b></p>
                                    <p id="length" class="invalid">Mínimo <b>8 caracteres</b></p>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" name="login" value="Ingresar" class="btn btn-primary my-4" style="width: 100%;" onclick="login()">Restablece tu contrase&ntilde;a</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-2 footer-auto-bottom" id="footer-main" style="position: relative;">
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
            username = $('#username').val();
            password = $('#password').val();
            var form = new FormData();
            form.append("correo", username);
            form.append("clave", password);

            var settings = {
                "url": "https://codidrive.com/codi/api/passenger/resetpassword",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                if (JSON.parse(response).msg === 'Contraseña actualizada correctamente') {
                    $("#formulario").css("display", "none");
                    $("#valido").css("display", "block");
                } else {
                    window.location.replace("https://codidrive.com/admin/restorepassword");
                }
            });
        }
        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }
        myInput.onkeyup = function() {
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
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