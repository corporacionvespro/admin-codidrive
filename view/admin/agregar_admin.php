<html><?php require_once 'conectar.php'; ?>
<?php require_once './view/admin/header.php'; ?>


<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />

<script src="https://unpkg.com/cropperjs"></script>
<?php $var = "negocio"; ?>
<?php
global $db;
$level = $_SESSION["level"];
if ($level == 1) {
    require_once './view/admin/menu_admin.php';
} else if ($level == 2) {
    require_once './view/admin/menu_user.php';
} else if ($level == 3) {
    require_once './view/admin/menu_colaborador.php';
}
?>

<style>
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
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
    }

    .image_area:hover .overlay {
        height: 50%;
        cursor: pointer;
    }

    .text {
        color: #333;
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
</style>
<!-- Header -->
<div class="header bg-primary pb-6" style="background: #01296e !important;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4" style="margin-left: 5px;margin-right: 5px;">
                <div class="col-lg-12 col-12" style="text-align: center;background: none;height: 59px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;border-radius: 50px;">
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">AGREGAR ADMINISTRADOR</h6>
                </div>
            </div>
            <!-- Card stats -->

        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <!-- modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Recortar la imagen antes de subirla
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="" id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">recortar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h2 style="text-align: center;">DATOS DEL ADMINISTRADOR</h2>
                    <form method="POST" action="agregar_admin2.php" autocomplete="off">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols1Input">DNI</label>
                                <input type="number" id="dni" name="dni" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols2Input">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols2Input">Correo</label>
                                <input type="text" id="correo" name="correo" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols1Input">Celular</label>
                                <input type="number" id="btndestino" name="celular" class="form-control" value="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols2Input">Detalle</label>
                                <input type="text" id="detalle" name="detalle" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h2 style="text-align: center;">CREDENCIALES</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols1Input">USUARIO</label>
                                <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols2Input">CONTRASE&Ntilde;A</label>
                                <div class="input-group">
                                    <input id="txtPassword" type="text" name="Password" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-5">
            <div class="form-group">
                <button type="submit" name="guardar" class="form-control form-control-sm btn" style="height: 51px;background: #e0e9f1;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">Guardar</button>
                </form>
            </div>
        </div>
    </div>

    <?php require_once './view/admin/footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</html>