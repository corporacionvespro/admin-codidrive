<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Una nueva version del sistema Taxi Vespro, simple y eficaz.">
    <meta name="author" content="vespro">
    <title>Chapa tu taxi</title>
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <script src="https://unpkg.com/cropperjs"></script>
    <link rel="icon" href="./assets/img/brand/logo.png" type="image/png">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="./assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/argon.css?v=1.1.0" type="text/css">
    <link rel="stylesheet" type="text/css" href="./view/admin/css/registros.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
</head>
<style>
    #heading {
        text-transform: uppercase;
        color: #673AB7;
        font-weight: normal
    }

    #formuploadajax {

        position: relative;
        margin-top: 20px
    }

    #formuploadajax fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #formuploadajax fieldset:not(:first-of-type) {
        display: none
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey;
        padding-left: 0px;
    }

    #progressbar .active {
        color: #673AB7
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 16.4%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #673AB7
    }

    .progress {
        height: 20px
    }

    .progress-bar {
        background-color: #673AB7
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }

    #progressbar .active i {
        color: #ffffff !important;
        background: #01296e !important;
    }

    .avatar-upload {
        position: relative;
        max-width: 250px;/**/
        margin: 0px !important;/**/
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 35px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #ffffff;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input+label:after {
        content: "\f040";
        font-family: "FontAwesome";
        color: #50009f;
        position: absolute;
        top: 7px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 250px;
        height: 250px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #f8f8f8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .image_area {
        position: relative;
    }

    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .overlay {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        background-color: rgb(95 31 182 / 66%);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
        border-radius: 50% 50% 0 0;
    }

    .image_area:hover .overlay {
        height: 50%;
        cursor: pointer;
    }

    .text {
        color: #ffffff;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .cropper-container {
        margin-left: -15px;
    }

    .preview {
        width: 330px;
        height: 330px;
        margin-left: -11px;
        border: none;
    }

    .loader {

        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('https://chapatutaxi.com/admin/imagenes/loader.gif') 50% 50% no-repeat #e2ecf2;
        opacity: .8;
    }

    .accordion .card-header[aria-expanded='false']:after {
        color: white !important;
    }

    .accordion .card-header[aria-expanded='true']:after {
        color: white !important;
    }

    p {
        font-size: 0.9rem;
        font-weight: 300;
        line-height: 1.1rem;
        color: black;
        text-align: justify;
    }

    li {
        font-size: 0.9rem;
        line-height: 1.1rem;
        color: black;
    }

    video {
        width: 100%;
        max-width: 100%;
        height: auto;
        transform: scaleX(-1);
        border-radius: 100%;
    }
</style>

<div id="mensaje"></div>

<body class="bg-gradient-primary" style="min-height: 100vh;">
    <!-- Navbar 
    <a href="https://wa.me/51992195100?text=hola" class="whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
    --><!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-5 py-lg-7">
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
                        <h3 id="txtvali" style="color: white;font-size: 20px;">Foto actualizada</h3>
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
                        <h3 id="txterror" style="color: white;font-size: 15px;">La foto no fue actualizada</h3>
                    </div>
                    <div class="mt-5 mb-5" style="text-align: center;">
                        <button id="btnguardar2" type="button" onclick="revisar();" class="btn ml-auto" style="width: 50%;color: #50009f;background: #fff;border: #fff;">Volver a intentar</button>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10" id="formulario">
                    <div class="card" id="stepsform" style="background: none !important;">
                    <form enctype="multipart/form-data" id="formuploadajax" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container" style="display: flex;align-content: center;justify-content: center;">
                                    <!--<h1 style="text-align: center;text-transform: uppercase;color: #50009f;">Foto</h1>-->
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="foto" name="foto" accept=".jpg, .jpeg" />
                                            <label for="foto"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url(https://chapatutaxi.com/admin/assets/img/brand/logo.png);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12" style="display: flex;justify-content: center;flex-wrap: nowrap;align-items: center;flex-direction: row;">
                        <button id="editardatos" type="button" class="btn" style="color:#50009f;background: #fff;border: #fff; width: 50%;border-radius: 25px;" onclick="editardatos2()">Guardar</button>
                    </div>
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
                        © <a href="https://vespro.io" class="font-weight-bold ml-1" target="_blank" style="color: #dde0e1;">Tecnolog&iacute;a Vespro</a>
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
    <script src="./assets/js/argon.js?v=1.1.0"></script>
    <script src="./assets/js/demo.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.0.7/compressor.min.js"></script>

    <script>
       function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#foto").change(function() {
    readURL(this);
});

function optimizarImagen(file) {
    return new Promise((resolve, reject) => {
        new Compressor(file, {
            quality: 0.6, // Ajusta la calidad de la compresión (de 0 a 1)
            maxWidth: 800, // Ancho máximo de la imagen
            maxHeight: 800, // Altura máxima de la imagen
            success(result) {
                resolve(result);
            },
            error(err) {
                reject(err);
            },
        });
    });
}

function editardatos2() {
    var foto = $("#foto").val();
    var id = '<?php echo $_GET["id"]?>';
    var file_data = $('#foto').prop('files')[0];

    if (file_data === undefined) {
        $("#error").css("display", "block");
        $("#valido").css("display", "none");
        $("#formulario").css("display", "none");
    } else {
        optimizarImagen(file_data)
            .then(compressedFile => {
                var form_data = new FormData();
                form_data.append("foto", compressedFile);
                form_data.append("id_persona", id);
                var settings = {
                    "url": "https://chapatutaxi.com/chapaapi/api/driver/updatephoto",
                    "method": "POST",
                    "timeout": 0,
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form_data
                };
                $.ajax(settings).done(function(response) {
                    if (response.message == 'Conductor actualizado correctamente') {
                        $("#error").css("display", "none");
                        $("#valido").css("display", "block");
                        $("#formulario").css("display", "none");
                    } else {
                        $("#error").css("display", "none");
                        $("#valido").css("display", "block");
                        $("#formulario").css("display", "none");
                    }
                });
            })
            .catch(error => {
                console.error('Error al comprimir la imagen:', error);
            });
    }
}

    </script>
    
</body>

</html>