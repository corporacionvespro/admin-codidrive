<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Una nueva version del sistema Taxi Vespro, simple y eficaz.">
    <meta name="author" content="vespro">
    <title>Codi Drive</title>
    <!-- Favicon 
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">-->
    <link rel="icon" href="./assets/img/brand/logo.png" type="image/png">
    <!-- Fonts -->
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="./assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="./assets/css/argon.css?v=1.1.0" type="text/css">
    <link rel="stylesheet" type="text/css" href="./view/admin/css/registros.css">
</head>

<body class="bg-gradient-primary" style="min-height: 100vh;">
    <!-- Navbar -->
    <a href="https://wa.me/51967075303?text=hola" class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>
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
                    <div style="display: flex;justify-content: center;">
                        <svg id="successAnimation" class="animated" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 70 70">
                            <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z" />
                            <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent" />
                            <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent" />
                        </svg>
                    </div>
                    <div style=" text-align: center;">
                        <h3 id="txtvali" style="color: white;font-size: 20px;"></h3>
                    </div>
                </div>
                <div id="error" style="display: none;">
                    <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                        <span class="swal2-x-mark">
                            <span class="swal2-x-mark-line-left">
                            </span><span class="swal2-x-mark-line-right"></span>
                        </span>
                    </div>
                    <div style="text-align: center;margin: 29px;">
                        <h3 id="txterror" style="color: white;font-size: 15px;"></h3>
                    </div>
                    <div class="mt-5 mb-5" style="text-align: center;">
                        <button id="btnguardar" type="button" onclick="revisar();" class="btn ml-auto" style="width: 50%;color: #01296e;background: #fff;border: #fff;">Revisar datos</button>
                    </div>
                </div>
                <div class="col-lg-5 col-md-7" id="formulario">
                    <div class="card">
                        <form enctype="multipart/form-data" id="formuploadajax" method="post">
                            <div class="card-body px-lg-4 py-lg-4">

                                <h6 class="heading-small text-center mb-4">Datos Personales</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example2cols1Input">Nombres y Apellidos</label>
                                            <input type="text" id="nombres" name="nombres" class="form-control" placeholder="" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example2cols1Input">Telefono</label>
                                            <input type="number" id="telefono" name="telefono" class="form-control" placeholder="" autocomplete="off" required pattern="[0-9]{9}" title="Ingresar solo 9 dígitos">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example2cols1Input">Correo</label>
                                            <input type="email" id="correo" name="correo" class="form-control" placeholder="" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example2cols1Input">Clave</label>
                                            <input type="password" id="clave" name="clave" class="form-control" placeholder="" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 8 o más caracteres" required>
                                            <input type="checkbox" onclick="passw()" style="margin-top: 15px;"> Mostrar contraseña
                                            <div id="message">
                                                <h3 style="color: #535f7e;text-align: center;">La contraseña debe contener lo siguiente:</h3>
                                                <p id="letter" class="invalid">Mínimo una <b>Minúscula</b></p>
                                                <p id="capital" class="invalid">Mínimo una <b>Mayúscula</b></p>
                                                <p id="number" class="invalid">Mínimo un <b>Número</b></p>
                                                <p id="length" class="invalid">Mínimo <b>8 caracteres</b></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr class="my-4">
                                <h6 class="heading-small text-center mb-4">Datos del Veh&iacute;culo</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example2cols1Input">Placa</label>
                                            <input type="text" id="placa" name="placa" class="form-control" placeholder="" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example2cols1Input">Marca y modelo</label>
                                            <input type="text" id="marca" name="marca" class="form-control" placeholder="" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example2cols1Input">Color</label>
                                            <input type="text" id="color" name="color" class="form-control" placeholder="" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example2cols1Input">Año</label>
                                            <input type="text" id="anio" name="anio" class="form-control" placeholder="" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button id="btnguardar" type="submit" class="btn ml-auto" style="width: 100%;color:#fff;background: #01296e;border: #01296e;">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-2 " id="footer-main" style="position: relative;">
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
    <script src="./view/admin/js/registros.js"></script>
</body>

</html>