<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Una nueva version del sistema Taxi Vespro, simple y eficaz.">
    <meta name="author" content="vespro">
    <title>Codi Drive</title>
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
        max-width: 205px;
        margin: 50px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
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
        color: #01296e;
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
<style>

</style>
<div class="modal fade" id="examplepriv" tabindex="-1" aria-labelledby="examplevehiculoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="">
                <form enctype="multipart/form-data" id="formuploadajax4" method="post">
                    <div class="card-body px-lg-4 py-lg-4" style="padding: 12px;">
                        <h6 class="heading-small text-center mb-4">AVISO DE PRIVACIDAD</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <embed src="./pdf/AVISO_DE_PRIVACIDAD_DE_CHAPA_TU_TAXI_CONDUCTOR.pdf" type="application/pdf" width="100%" height="500px">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto close-modal" style="color:#01296e;border:solid 1px #01296e;width: 100%;" data-dismiss="modal">Salir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="mensaje"></div>
<!-- modal01 -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Recortar la imagen antes de subirla
                </h5>
                <button type="button" class="close close-modal" data-dismiss="modal1" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image1" />
                        </div>
                        <div class="col-md-4">
                            <div id="preview1" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn close-modal" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal1">
                <input type="button" id="crop1" name="crop1" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal01 -->
<!-- modal2 -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Recortar la imagen antes de subirla
                </h5>
                <button type="button" class="close close-modal" data-dismiss="modal2" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image2" />
                        </div>
                        <div class="col-md-4">
                            <div id="preview2" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn close-modal" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal2">
                <input type="button" id="crop2" name="crop2" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal2 -->
<!-- modal3 -->
<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Recortar la imagen antes de subirla
                </h5>
                <button type="button" class="close close-modal" data-dismiss="modal3" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image3" />
                        </div>
                        <div class="col-md-4">
                            <div id="preview3" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn close-modal" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal3">
                <input type="button" id="crop3" name="crop3" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal3 -->
<!-- modal4 -->
<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Recortar la imagen antes de subirla
                </h5>
                <button type="button" class="close close-modal" data-dismiss="modal4" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image4" />
                        </div>
                        <div class="col-md-4">
                            <div id="preview4" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn close-modal" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal4">
                <input type="button" id="crop4" name="crop4" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal4 -->
<!-- modal5 -->
<div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Recortar la imagen antes de subirla
                </h5>
                <button type="button" class="close close-modal" data-dismiss="modal5" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image5" />
                        </div>
                        <div class="col-md-4">
                            <div id="preview5" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn close-modal" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal5">
                <input type="button" id="crop5" name="crop5" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal5 -->
<!-- modal6 -->
<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Recortar la imagen antes de subirla
                </h5>
                <button type="button" class="close close-modal" data-dismiss="modal6" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image6" />
                        </div>
                        <div class="col-md-4">
                            <div id="preview6" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn close-modal" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal6">
                <input type="button" id="crop6" name="crop6" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal6 -->
<!-- modal7 -->
<div class="modal fade" id="modal7" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Recortar la imagen antes de subirla
                </h5>
                <button type="button" class="close close-modal" data-dismiss="modal7" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image7" />
                        </div>
                        <div class="col-md-4">
                            <div id="preview7" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn close-modal" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal7">
                <input type="button" id="crop7" name="crop7" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal7 -->
<!-- modal8 -->
<div class="modal fade" id="modal8" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Recortar la imagen antes de subirla
                </h5>
                <button type="button" class="close close-modal" data-dismiss="modal8" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image8" />
                        </div>
                        <div class="col-md-4">
                            <div id="preview8" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn close-modal" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal8">
                <input type="button" id="crop8" name="crop8" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal8 -->

<body class="bg-gradient-primary" style="min-height: 100vh;">
    <!-- Navbar -->
    <a href="https://wa.me/51992195100?text=hola" class="whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
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
                        <button id="btnguardar2" type="button" onclick="revisar();" class="btn ml-auto" style="width: 50%;color: #01296e;background: #fff;border: #fff;">Revisar datos</button>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10" id="formulario">
                    <div class="card" id="stepsform">
                        <form enctype="multipart/form-data" id="formuploadajax" method="post">
                            <div class="card-body px-lg-4 py-lg-4">
                                <ul id="progressbar" style="display: flex; flex-direction: row; justify-content: space-around; padding: 0px;text-align: center;">
                                    <li class="active"><i class="fas fa-check-circle" style="width: 50px;height: 50px;line-height: 45px;display: block;font-size: 20px;color: #ffffff;background: lightgray;border-radius: 50%; margin: 0 auto 10px auto;padding: 2px;"></i></li>
                                    <li><i class="fas fa-user" style="width: 50px;height: 50px;line-height: 45px;display: block;font-size: 20px;color: #ffffff;background: lightgray;border-radius: 50%; margin: 0 auto 10px auto;padding: 2px;"></i></li>
                                    <li><i class="fas fa-car" style="width: 50px;height: 50px;line-height: 45px;display: block;font-size: 20px;color: #ffffff;background: lightgray;border-radius: 50%; margin: 0 auto 10px auto;padding: 2px;"></i></li>
                                    <li><i class="fas fa-file-search" style="width: 50px;height: 50px;line-height: 45px;display: block;font-size: 20px;color: #ffffff;background: lightgray;border-radius: 50%; margin: 0 auto 10px auto;padding: 2px;"></i></li>
                                    <li><i class="fas fa-file-user" style="width: 50px;height: 50px;line-height: 45px;display: block;font-size: 20px;color: #ffffff;background: lightgray;border-radius: 50%; margin: 0 auto 10px auto;padding: 2px;"></i></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <br>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h3 style="text-align: center;">Requisitos Previos al Registro</h3>
                                                <p>Antes de proceder con el registro en nuestra app de taxi, es importante que cuentes con los siguientes documentos y datos. Estos requisitos son necesarios para garantizar la seguridad y legalidad en nuestra plataforma. Por favor, asegúrate de tener a mano los siguientes elementos:</p>

                                                <h3>1. Datos Personales:</h3>
                                                <ul>
                                                    <li>Nombre completo.</li>
                                                    <li>Tel&eacute;fono.</li>
                                                    <li>Correo (@gmail, @outlook, @hotmail).</li>
                                                    <li>Clave (Que usará para iniciar el aplicativo).</li>
                                                </ul>

                                                <h3>2. Datos del Veh&iacute;culo:</h3>
                                                <ul>
                                                    <li>Color, Marca, modelo y año del veh&iacute;culo.</li>
                                                    <li>N&uacute;mero de placa.</li>
                                                </ul>

                                                <h3>3. Documento de Identidad Personal:</h3>
                                                <p>Escaneo o foto legible de tu documento de identidad personal (DNI).</p>

                                                <h3>4. Licencia de Conducir:</h3>
                                                <p>Escaneo o foto legible de tu licencia de conducir vigente.</p>

                                                <h3>5. Certificado Único Laboral para Personas Adultas (Certiadulto):</h3>
                                                <p>Certiadulto actualizado <a href="https://www.gob.pe/9377-obtener-tu-certiadulto" target="_blank">clic aqui.</a></p>

                                                <h3>6. SOAT <small>(Seguro Obligatorio de Accidentes de Tránsito)</small>:</h3>
                                                <p>Copia del comprobante del SOAT vigente.</p>

                                                <h3>7. Tarjeta de Propiedad del veh&iacute;culo:</h3>
                                                <p>Escaneo o foto legible de la tarjeta de propiedad del veh&iacute;culo a tu nombre.</p>
                                            </div>
                                            <label for="terminos" style="font-size: 1rem;text-align: center;">Marcar para aceptar los términos y condiciones:</label>
                                            <input type="checkbox" id="terminos" name="terminos">
                                            <a href="#" id="openModalLink">Términos y condiciones</a>
                                        </div>
                                    </div>
                                    <input type="button" name="next" id="primer" class="next action-button btn ml-auto" value="Siguiente" style="width: 30%;color: #fff;background: #01296e;border: #01296e;right: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;">

                                </fieldset>
                                <fieldset>
                                    <h6 class="heading-small text-center mb-4">Datos Personales</h6>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="container">
                                                <div class="avatar-upload" style="margin-top: 0px;display: flex;flex-direction: column;align-content: space-between;align-items: center;justify-content: center;flex-wrap: nowrap;">
                                                    <div class="avatar-edit">
                                                        <label for="foto2"></label>
                                                    </div>

                                                    <div class="avatar-preview">
                                                        <img id="selfieImg" src="https://iwork.pe/chapatutaxi/53/dni_frontal/53-06102023153803.webp" alt="Selfie" style="border-radius: 100%;">
                                                        <video id="video" autoplay style="display: none;"></video>
                                                    </div>
                                                    <input type="file" id="archivoInput" style="display: none;">
                                                    <input type="hidden" id="selfies" value="https://iwork.pe/chapatutaxi/53/dni_frontal/53-06102023153803.webp">
                                                    <canvas id="canvas" style="display: none;"></canvas>
                                                    <div id="resultado" style="display: none;"></div>
                                                    <div class="mt-3" style="display: flex;justify-content: center;flex-direction: row;align-items: center;align-content: center;flex-wrap: nowrap;">
                                                        <input type="button" name="abrirCamara" id="abrirCamara" class="btn " value="Abrir C&aacute;mara" style="color: #fff;background: #01296e;border: #01296e;margin-right: 0px;">
                                                        <input type="button" name="tomarFoto" id="tomarFoto" class=" btn" value="Tomar foto" style="color: #fff;background: #01296e;border: #01296e; display:none;margin-right: 0px;">
                                                        <input type="button" name="borrarFoto" id="borrarFoto" class=" btn" value="Borrar foto" style="color: #fff;background: #01296e;border: #01296e; display:none;margin-right: 0px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="example2cols1Input">Fecha de nacimiento</label>
                                                <input type="date" id="fecha_nac" name="fecha_nac" class="form-control" placeholder="" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                    <input type="button" name="previous" class="previous action-button-previous btn ml-auto" value="Anterior" style="width: 30%;color: #fff;background: #01296e;border: #01296e;left: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;" />
                                    <input type="button" name="next" id="segundo" class="next action-button btn ml-auto" value="Siguiente" style="width: 30%;color: #fff;background: #01296e;border: #01296e;right: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;">

                                </fieldset>
                                <fieldset>
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
                                                <input type="number" id="anio" name="anio" class="form-control" placeholder="" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous btn ml-auto" value="Anterior" style="width: 30%;color: #fff;background: #01296e;border: #01296e;left: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;" />
                                    <input type="button" name="next" id="tercero" class="next action-button btn ml-auto" value="Siguiente" style="width: 30%;color: #fff;background: #01296e;border: #01296e;right: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;" />

                                </fieldset>
                                <fieldset>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-center mb-4">Doc. Identidad personal</h6>
                                    <div class="accordion row" id="accordionExample">
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label class="form-control-label" for="example2cols1Input">Doc. de identidad</label>
                                                <select class="form-control" name="doc_personal" id="doc_personal">
                                                    <option value="0"></option>
                                                    <option value="DNI">DNI</option>
                                                    <option value="Carnet de extranjer&iacute;a">Carnet de extranjer&iacute;a</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label class="form-control-label" for="example2cols1Input">N° de Doc. de identidad</label>
                                                <input type="text" id="ndni" name="ndni" class="form-control" placeholder="" autocomplete="off" onkeyup="cargids();">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="card" style="margin: 0 0 0 0;">
                                                <div class="card-header collapsed" id="headingUno" name="headingUno" data-toggle="collapse" data-target="#collapseUno" aria-expanded="false" aria-controls="collapseUno" style="padding: 0;background: #01296e;border-radius: 25px;">
                                                    <h2 class="mb-0" style="text-align: center;">
                                                        <a id="enlaces1" name="enlaces1" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;margin-right: 0px;padding: 0px;"><i class="fas fa-images"></i></a>
                                                        <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                            Foto parte frontal del DNI
                                                        </button>
                                                        <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen1','uploaded_image1')"><i class="fas fa-trash-alt"></i></button>
                                                    </h2>
                                                </div>
                                                <div id="collapseUno" name="collapseUno" class="collapse" aria-labelledby="headingUno" data-parent="#accordionExample">
                                                    <div class="card-body" style="padding: 1rem 0 0rem 0;">
                                                        <!----->
                                                        <input type="hidden" name="imagen1" id="imagen1" class="form-control" placeholder="" value="0">
                                                        <div class="image_area">
                                                            <label for="upload_image1" style="width: 100%;">
                                                                <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image1" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
                                                                <div class="overlay">
                                                                    <div class="text">
                                                                        Cambiar imagen
                                                                    </div>
                                                                </div>
                                                                <input type="file" name="image1" class="image" name="upload_image1" id="upload_image1" style="display:none" />
                                                            </label>
                                                        </div>
                                                        <!----->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion row" id="accordionExample2">
                                        <div class="col-md-12 mt-3">
                                            <div class="card" style="margin: 0 0 0 0;">
                                                <div class="card-header collapsed" id="headingDos" data-toggle="collapse" data-target="#collapseDos" aria-expanded="false" aria-controls="collapseDos" style="padding: 0;background: #01296e;border-radius: 25px;">
                                                    <h2 class="mb-0" style="text-align: center;">
                                                        <a id="enlaces2" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;margin-right: 0px;padding: 0px;"><i class="fas fa-images"></i></a>
                                                        <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                            Foto parte posterior del DNI
                                                        </button>
                                                        <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen2','uploaded_image2')"><i class="fas fa-trash-alt"></i></button>
                                                    </h2>
                                                </div>
                                                <div id="collapseDos" class="collapse" aria-labelledby="headingDos" data-parent="#accordionExample2">
                                                    <div class="card-body" style="padding: 1rem 0 0rem 0;">
                                                        <!----->
                                                        <input type="hidden" name="imagen2" id="imagen2" class="form-control" placeholder="" value="0">
                                                        <div class="image_area">
                                                            <label for="upload_image2" style="width: 100%;">
                                                                <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image2" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
                                                                <div class="overlay">
                                                                    <div class="text">
                                                                        Cambiar imagen
                                                                    </div>
                                                                </div>
                                                                <input type="file" name="image2" class="image" id="upload_image2" style="display:none" />
                                                            </label>
                                                        </div>
                                                        <!----->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="fvdni" name="fvdni" class="form-control" placeholder="" autocomplete="off">

                                    </div>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-center mb-4">Licencia</h6>
                                    <div class="accordion row" id="accordionExample3">
                                        <div class="col-md-12 mt-3">
                                            <div class="card" style="margin: 0 0 0 0;">
                                                <div class="card-header collapsed" id="headingTres" data-toggle="collapse" data-target="#collapseTres" aria-expanded="false" aria-controls="collapseTres" style="padding: 0;background: #01296e;border-radius: 25px;">
                                                    <h2 class="mb-0" style="text-align: center;">
                                                        <a id="enlaces3" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;margin-right: 0px;padding: 0px;"><i class="fas fa-images"></i></a>
                                                        <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                            Foto parte delantera
                                                        </button>
                                                        <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen3','uploaded_image3')"><i class="fas fa-trash-alt"></i></button>
                                                    </h2>
                                                </div>
                                                <div id="collapseTres" class="collapse" aria-labelledby="headingTres" data-parent="#accordionExample3">
                                                    <div class="card-body" style="padding: 1rem 0 0rem 0;">
                                                        <!----->
                                                        <input type="hidden" name="imagen3" id="imagen3" class="form-control" placeholder="" value="0">
                                                        <div class="image_area">
                                                            <label for="upload_image3" style="width: 100%;">
                                                                <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image3" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
                                                                <div class="overlay">
                                                                    <div class="text">
                                                                        Cambiar imagen
                                                                    </div>
                                                                </div>
                                                                <input type="file" name="image3" class="image" id="upload_image3" style="display:none" />
                                                            </label>
                                                        </div>
                                                        <!----->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="nlicencia" name="nlicencia" class="form-control" placeholder="" autocomplete="off">

                                    </div>
                                    <div class="accordion row" id="accordionExample4">
                                        <div class="col-md-12 mt-3">
                                            <div class="card" style="margin: 0 0 0 0;">
                                                <div class="card-header collapsed" id="headingCuatro" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseCuatro" style="padding: 0;background: #01296e;border-radius: 25px;">
                                                    <h2 class="mb-0" style="text-align: center;">
                                                        <a id="enlaces4" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;margin-right: 0px;padding: 0px;"><i class="fas fa-images"></i></a>
                                                        <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                            Foto parte posterior
                                                        </button>
                                                        <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen4','uploaded_image4')"><i class="fas fa-trash-alt"></i></button>
                                                    </h2>
                                                </div>
                                                <div id="collapseCuatro" class="collapse" aria-labelledby="headingCuatro" data-parent="#accordionExample4">
                                                    <div class="card-body" style="padding: 1rem 0 0rem 0;">
                                                        <!----->
                                                        <input type="hidden" name="imagen4" id="imagen4" class="form-control" placeholder="" value="0">
                                                        <div class="image_area">
                                                            <label for="upload_image4" style="width: 100%;">
                                                                <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image4" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
                                                                <div class="overlay">
                                                                    <div class="text">
                                                                        Cambiar imagen
                                                                    </div>
                                                                </div>
                                                                <input type="file" name="image4" class="image" id="upload_image4" style="display:none" />
                                                            </label>
                                                        </div>
                                                        <!----->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="fvlicencia" name="fvlicencia" class="form-control" placeholder="" autocomplete="off">
                                    </div>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-center mb-4">Certiadulto</h6>
                                    <div class="accordion row" id="accordionExample8" style="padding-bottom: 3rem;">
                                        <div class="col-md-12 mt-3">
                                            <div class="card" style="margin: 0 0 0 0;">
                                                <div class="card-header collapsed" id="headingOcho" data-toggle="collapse" data-target="#collapseOcho" aria-expanded="false" aria-controls="collapseOcho" style="padding: 0;background: #01296e;border-radius: 25px;">
                                                    <h2 class="mb-0" style="text-align: center;">
                                                        <a id="enlaces8" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;margin-right: 0px;padding: 0px;"><i class="fas fa-images"></i></a>
                                                        <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                            Foto
                                                        </button>
                                                        <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen8','uploaded_image8')"><i class="fas fa-trash-alt"></i></button>
                                                    </h2>
                                                </div>
                                                <div id="collapseOcho" class="collapse" aria-labelledby="headingOcho" data-parent="#accordionExample8">
                                                    <div class="card-body" style="padding: 1rem 0 0rem 0;">
                                                        <!----->
                                                        <input type="hidden" name="imagen8" id="imagen8" class="form-control" placeholder="" value="0">
                                                        <div class="image_area">
                                                            <label for="upload_image8" style="width: 100%;">
                                                                <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image8" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
                                                                <div class="overlay">
                                                                    <div class="text">
                                                                        Cambiar imagen
                                                                    </div>
                                                                </div>
                                                                <input type="file" name="image8" class="image" id="upload_image8" style="display:none" />
                                                            </label>
                                                        </div>
                                                        <!----->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous btn ml-auto" value="Anterior" style="width: 30%;color: #fff;background: #01296e;border: #01296e;left: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;" />
                                    <input type="button" name="next" id="cuarto" class="next action-button btn ml-auto" value="Siguiente" style="width: 30%;color: #fff;background: #01296e;border: #01296e;right: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;" />

                                </fieldset>
                                <fieldset>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-center mb-4">SOAT</h6>
                                    <div class="accordion row" id="accordionExample5">
                                        <div class="col-md-12 mt-3">
                                            <div class="card" style="margin: 0 0 0 0;">
                                                <div class="card-header collapsed" id="headingCinco" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="false" aria-controls="collapseCinco" style="padding: 0;background: #01296e;border-radius: 25px;">
                                                    <h2 class="mb-0" style="text-align: center;">
                                                        <a id="enlaces5" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;margin-right: 0px;padding: 0px;"><i class="fas fa-images"></i></a>
                                                        <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                            Foto
                                                        </button>
                                                        <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen5','uploaded_image5')"><i class="fas fa-trash-alt"></i></button>
                                                    </h2>
                                                </div>
                                                <div id="collapseCinco" class="collapse" aria-labelledby="headingCinco" data-parent="#accordionExample5">
                                                    <div class="card-body" style="padding: 1rem 0 0rem 0;">
                                                        <!----->
                                                        <input type="hidden" name="imagen5" id="imagen5" class="form-control" placeholder="" value="0">
                                                        <div class="image_area">
                                                            <label for="upload_image5" style="width: 100%;">
                                                                <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image5" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
                                                                <div class="overlay">
                                                                    <div class="text">
                                                                        Cambiar imagen
                                                                    </div>
                                                                </div>
                                                                <input type="file" name="image5" class="image" id="upload_image5" style="display:none" />
                                                            </label>
                                                        </div>
                                                        <!----->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="fvsoat" name="fvsoat" class="form-control" placeholder="" autocomplete="off">

                                    </div>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-center mb-4">Tarjeta de propiedad del vehiculo</h6>
                                    <div class="accordion row" id="accordionExample6">
                                        <div class="col-md-12 mt-3  mb-4">
                                            <div class="card" style="margin: 0 0 0 0;">
                                                <div class="card-header collapsed" id="headingSeis" data-toggle="collapse" data-target="#collapseSeis" aria-expanded="false" aria-controls="collapseSeis" style="padding: 0;background: #01296e;border-radius: 25px;">
                                                    <h2 class="mb-0" style="text-align: center;">
                                                        <a id="enlaces6" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;margin-right: 0px; padding: 0px;"><i class="fas fa-images"></i></a>
                                                        <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                            Foto parte delantera
                                                        </button>
                                                        <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen6','uploaded_image6')"><i class="fas fa-trash-alt"></i></button>
                                                    </h2>
                                                </div>
                                                <div id="collapseSeis" class="collapse" aria-labelledby="headingSeis" data-parent="#accordionExample6">
                                                    <div class="card-body" style="padding: 1rem 0 0rem 0;">
                                                        <!----->
                                                        <input type="hidden" name="imagen6" id="imagen6" class="form-control" placeholder="" value="0">
                                                        <div class="image_area">
                                                            <label for="upload_image6" style="width: 100%;">
                                                                <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image6" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
                                                                <div class="overlay">
                                                                    <div class="text">
                                                                        Cambiar imagen
                                                                    </div>
                                                                </div>
                                                                <input type="file" name="image6" class="image" id="upload_image6" style="display:none" />
                                                            </label>
                                                        </div>
                                                        <!----->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="card" style="margin: 0 0 0 0;">
                                                <div class="card-header collapsed" id="headingSiete" data-toggle="collapse" data-target="#collapseSiete" aria-expanded="false" aria-controls="collapseSiete" style="padding: 0;background: #01296e;border-radius: 25px;">
                                                    <h2 class="mb-0" style="text-align: center;">
                                                        <a id="enlaces7" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;margin-right: 0px;padding: 0px;"><i class="fas fa-images"></i></a>
                                                        <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                            Foto parte posterior
                                                        </button>
                                                        <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen7','uploaded_image7')"><i class="fas fa-trash-alt"></i></button>
                                                    </h2>
                                                </div>
                                                <div id="collapseSiete" class="collapse" aria-labelledby="headingSiete" data-parent="#accordionExample6">
                                                    <div class="card-body" style="padding: 1rem 0 0rem 0;">
                                                        <!----->
                                                        <input type="hidden" name="imagen7" id="imagen7" class="form-control" placeholder="" value="0">
                                                        <div class="image_area">
                                                            <label for="upload_image7" style="width: 100%;">
                                                                <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image7" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
                                                                <div class="overlay">
                                                                    <div class="text">
                                                                        Cambiar imagen
                                                                    </div>
                                                                </div>
                                                                <input type="file" name="image7" class="image" id="upload_image7" style="display:none" />
                                                            </label>
                                                        </div>
                                                        <!----->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="frev_t" name="frev_t" class="form-control" placeholder="" autocomplete="off">
                                    <input type="hidden" id="glpgnv" name="glpgnv" class="form-control" placeholder="" autocomplete="off">
                                    <input type="hidden" id="frev_c" name="frev_c" class="form-control" placeholder="" autocomplete="off">
                                    <input type="button" name="previous" class="previous action-button-previous btn ml-auto" value="Anterior" style="width: 30%;color: #fff;background: #01296e;border: #01296e;left: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;" />
                                    <button name="next" id="quinto" type="button" class="next action-button btn ml-auto" style="width: 30%;color: #fff;background: #01296e;border: #01296e;right: 0px;position: absolute;padding: 0.5rem 0.5rem 0.5rem 0.5rem;">Enviar</button>
                                </fieldset>
                            </div>
                            <div class="modal-footer "></div>
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
    <script src="./assets/js/argon.js?v=1.1.0"></script>
    <script src="./assets/js/demo.min.js"></script>
    <script src="./view/admin/js/registrosConductor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("terminos");
            const primerButton = document.getElementById("primer");

            checkbox.addEventListener("change", function() {
                primerButton.disabled = !checkbox.checked;
                if (checkbox.checked) {
                    primerButton.style.display = "block";
                } else {
                    primerButton.style.display = "none";
                }
            });
            $("#openModalLink").click(function() {
                $("#examplepriv").modal("show");
            });
            primerButton.disabled = !checkbox.checked;
            primerButton.style.display = checkbox.checked ? "block" : "none";
        });
    </script>
    <script>
        const abrirCamaraButton = document.getElementById('abrirCamara');
        const tomarFotoButton = document.getElementById('tomarFoto');
        const borrarFotoButton = document.getElementById('borrarFoto');
        const archivoInput = document.getElementById('archivoInput');
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const selfieImg = document.getElementById('selfieImg');
        const selfies = document.getElementById('selfies');
        const resultadoDiv = document.getElementById('resultado');
        let stream;

        abrirCamaraButton.addEventListener('click', async () => {
            try {
                const constraints = {
                    video: {
                        width: {
                            ideal: 720
                        },
                        height: {
                            ideal: 720
                        }
                    }
                };

                stream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = stream;
                video.style.display = 'block';
                tomarFotoButton.style.display = 'block';
                abrirCamaraButton.style.display = 'none';
                selfieImg.style.display = 'none';
            } catch (error) {
                console.error('Error al acceder a la cámara: ', error);
            }
        });

        tomarFotoButton.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.scale(-1, 1);
            context.drawImage(video, -canvas.width, 0, canvas.width, canvas.height);
            selfieImg.src = canvas.toDataURL('image/jpeg');
            selfieImg.style.display = 'block';
            convertirAWebP(canvas.toDataURL('image/jpeg'), function(webpDataUrl) {
                selfieImg.src = webpDataUrl;
                $("#selfies").val(webpDataUrl);
            });
            tomarFotoButton.style.display = 'none';
            borrarFotoButton.style.display = 'block';

            if (stream) {
                const tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
                video.style.display = 'none';
            }

            resultadoDiv.style.display = 'block';
        });

        borrarFotoButton.addEventListener('click', () => {

            abrirCamaraButton.style.display = 'none';
            selfieImg.style.display = 'none';
            resultadoDiv.style.display = 'none';
            borrarFotoButton.style.display = 'none';
            tomarFotoButton.style.display = 'block';
            const context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height);
            video.style.display = 'block';
            abrirCamaraButton.click();
        });

        archivoInput.addEventListener('change', function() {
            const archivo = this.files[0];
            if (archivo) {
                subirArchivo(archivo);
            }
        });

        function subirArchivo(archivo) {
            const formData = new FormData();
            formData.append('archivo', archivo);

            $.ajax({
                url: 'subir.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(respuesta) {},
                error: function(error) {
                    console.error('Error al subir el archivo: ', error);
                }
            });
        }

        function subirImagen(base64DataUrl) {
            $.post('subir.php', {
                    foto: base64DataUrl
                })
                .done(function(respuesta) {})
                .fail(function(error) {
                    console.error('Error al subir la imagen: ', error);
                });
        }

        function convertirAWebP(base64DataUrl, callback) {
            const img = new Image();
            img.src = base64DataUrl;
            img.onload = function() {
                const canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                const context = canvas.getContext('2d');
                context.drawImage(img, 0, 0, img.width, img.height);
                canvas.toBlob(function(blob) {
                    const reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        callback(reader.result);
                    };
                }, 'image/webp');
            };
        }
    </script>
</body>

</html>