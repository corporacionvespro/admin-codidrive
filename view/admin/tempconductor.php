<html>
<?php // require_once 'conectar.php'; 
?>
<?php require_once './view/admin/header.php'; ?>
<!---->
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />

<script src="https://unpkg.com/cropperjs"></script>
<!---->
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<?php $var = "tempconductor"; ?>
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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="./view/admin/css/tempconductor.css">


<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="error" style="display: none;">
                <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                    <span class="swal2-x-mark">
                        <span class="swal2-x-mark-line-left">
                        </span><span class="swal2-x-mark-line-right"></span>
                    </span>
                </div>
                <div style="text-align: center;margin: 29px;">
                    <h3 id="txterror" style="color: #5f20b6;font-size: 15px;"></h3>
                </div>
                <div class="mt-5 mb-5" style="text-align: center;">
                    <button id="btnguardar" type="button" onclick="revisar();" class="btn ml-auto" style="width: 50%;color:#fff;background: #01296e ;border: #01296e;">Revisar datos</button>
                </div>
            </div>
            <div id="regformulario">
                <form enctype="multipart/form-data" id="formuploadajax" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <h6 class="heading-small text-center mb-4">Datos Personales</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Nombre y Apellido</label>
                                    <input type="text" id="nombres" name="nombres" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Correo</label>
                                    <input type="email" id="correo" name="correo" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Telefono</label>
                                    <input type="number" id="telefono" name="telefono" class="form-control" placeholder="" autocomplete="off">
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
                        <h6 class="heading-small text-center mb-4">Datos del veh&iacute;culo</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Marca y modelo</label>
                                    <input type="text" id="marca" name="marca" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Placa</label>
                                    <input type="text" id="placa" name="placa" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Color</label>
                                    <input type="text" id="color" name="color" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Año</label>
                                    <input type="text" id="anio" name="anio" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#01296e;border:solid 1px #01296e;" data-dismiss="modal">Cancelar</button>
                        <button id="btnguardar" type="submit" class="btn ml-auto" style="color:#fff;background: #01296e;border: #01296e;">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="examplevehiculo" tabindex="-1" aria-labelledby="examplevehiculoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="">
                <form enctype="multipart/form-data" id="formuploadajax4" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <h6 class="heading-small text-center mb-4">Datos del veh&iacute;culo</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Marca</label>
                                    <input type="text" id="marca3" name="marca3" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Placa</label>
                                    <input type="text" id="placa3" name="placa3" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Unidad</label>
                                    <input type="text" id="unidad3" name="unidad3" class="form-control" placeholder="" autocomplete="off" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Color</label>
                                    <input type="text" id="color3" name="color3" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Año</label>
                                    <input type="text" id="anio3" name="anio3" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#01296e;border:solid 1px #01296e;" data-dismiss="modal">Cancelar</button>
                        <button id="editarvehiculo" type="button" class="btn ml-auto" style="color:#fff;background: #01296e;border: #01296e;" onclick="editarvehiculo2()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampledatos" tabindex="-1" aria-labelledby="exampledatosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="">
                <form enctype="multipart/form-data" id="formuploadajax2" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <h1 style="text-align: center;text-transform: uppercase;color: #01296e;">Registrar conductor</h1>
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="foto2" name="foto2" accept=".jpg, .jpeg" />
                                            <label for="foto2"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Datos Personales</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Nombre y Apellido</label>
                                    <input type="text" id="nombres2" name="nombres2" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Correo</label>
                                    <input type="email" id="correo2" name="correo2" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Clave</label>
                                    <input type="text" id="clave2" name="clave2" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Telefono</label>
                                    <input type="number" id="telefono2" name="telefono2" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#01296e;border:solid 1px #01296e;" data-dismiss="modal">Cancelar</button>
                        <button id="editardatos" type="button" class="btn ml-auto" style="color:#fff;background: #01296e;border: #01296e;" onclick="editardatos2()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampledocumentos" tabindex="-1" aria-labelledby="exampledocumentosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow: auto;height: 100%;">
            <div class="">
                <form enctype="multipart/form-data" id="formuploadajax2" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <h6 class="heading-small text-center mb-4">Documentos</h6>
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Doc. Identidad personal</h6>
                        <div class="accordion row" id="accordionExample">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha de nacimiento</label>
                                    <input type="text" id="fecha_nac" name="fecha_nac" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Doc. de identidad</label>
                                    <select class="form-control" id="doc_personal">
                                        <option value="0"></option>
                                        <option value="DNI">DNI</option>
                                        <option value="Carnet de extranjer&iacute;a">Carnet de extranjer&iacute;a</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="card" style="margin: 0 0 0 0;">
                                    <div class="card-header collapsed" id="headingUno" data-toggle="collapse" data-target="#collapseUno" aria-expanded="false" aria-controls="collapseUno" style="padding: 0;background: #01296e;border-radius: 25px;">
                                        <h2 class="mb-0" style="text-align: center;">
                                            <a id="enlaces1" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;"><i class="fas fa-images"></i></a>
                                            <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                Foto parte frontal
                                            </button>
                                            <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen1','uploaded_image1')"><i class="fas fa-trash-alt"></i></button>
                                        </h2>
                                    </div>
                                    <div id="collapseUno" class="collapse" aria-labelledby="headingUno" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <!----->
                                            <input type="hidden" name="imagen1" id="imagen1" class="form-control" placeholder="" value="0">
                                            <div class="image_area">
                                                <label for="upload_image1" style="width: 100%;">
                                                    <img style="border-color: #01296e  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image1" class="img-responsive img-circle" style="border-radius: 50%;border-color: #01296e  !important;border: solid 4px;" />
                                                    <div class="overlay">
                                                        <div class="text">
                                                            Cambiar imagen
                                                        </div>
                                                    </div>
                                                    <input type="file" name="image1" class="image" id="upload_image1" style="display:none" />
                                                </label>
                                            </div>
                                            <!----->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">N° Documento</label>
                                    <input type="text" id="ndni" name="ndni" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="accordion row" id="accordionExample2">
                            <div class="col-md-12 mt-3">
                                <div class="card" style="margin: 0 0 0 0;">
                                    <div class="card-header collapsed" id="headingDos" data-toggle="collapse" data-target="#collapseDos" aria-expanded="false" aria-controls="collapseDos" style="padding: 0;background: #01296e;border-radius: 25px;">
                                        <h2 class="mb-0" style="text-align: center;">
                                            <a id="enlaces2" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;"><i class="fas fa-images"></i></a>
                                            <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                Foto parte posterior
                                            </button>
                                            <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen2','uploaded_image2')"><i class="fas fa-trash-alt"></i></button>
                                        </h2>
                                    </div>
                                    <div id="collapseDos" class="collapse" aria-labelledby="headingDos" data-parent="#accordionExample2">
                                        <div class="card-body">
                                            <!----->
                                            <input type="hidden" name="imagen2" id="imagen2" class="form-control" placeholder="" value="0">
                                            <div class="image_area">
                                                <label for="upload_image2" style="width: 100%;">
                                                    <img style="border-color: #01296e  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image2" class="img-responsive img-circle" style="border-radius: 50%;border-color: #01296e  !important;border: solid 4px;" />
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
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha de vencimiento</label>
                                    <input type="date" id="fvdni" name="fvdni" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Licencia</h6>
                        <div class="accordion row" id="accordionExample3">
                            <div class="col-md-12 mt-3">
                                <div class="card" style="margin: 0 0 0 0;">
                                    <div class="card-header collapsed" id="headingTres" data-toggle="collapse" data-target="#collapseTres" aria-expanded="false" aria-controls="collapseTres" style="padding: 0;background: #01296e;border-radius: 25px;">
                                        <h2 class="mb-0" style="text-align: center;">
                                            <a id="enlaces3" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;"><i class="fas fa-images"></i></a>
                                            <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                Foto parte delantera
                                            </button>
                                            <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen3','uploaded_image3')"><i class="fas fa-trash-alt"></i></button>
                                        </h2>
                                    </div>
                                    <div id="collapseTres" class="collapse" aria-labelledby="headingTres" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <!----->
                                            <input type="hidden" name="imagen3" id="imagen3" class="form-control" placeholder="" value="0">
                                            <div class="image_area">
                                                <label for="upload_image3" style="width: 100%;">
                                                    <img style="border-color: #01296e  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image3" class="img-responsive img-circle" style="border-radius: 50%;border-color: #01296e  !important;border: solid 4px;" />
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
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">N° de la Licencia</label>
                                    <input type="text" id="nlicencia" name="nlicencia" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="accordion row" id="accordionExample4">
                            <div class="col-md-12 mt-3">
                                <div class="card" style="margin: 0 0 0 0;">
                                    <div class="card-header collapsed" id="headingCuatro" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseCuatro" style="padding: 0;background: #01296e;border-radius: 25px;">
                                        <h2 class="mb-0" style="text-align: center;">
                                            <a id="enlaces4" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;"><i class="fas fa-images"></i></a>
                                            <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                Foto parte posterior
                                            </button>
                                            <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen4','uploaded_image4')"><i class="fas fa-trash-alt"></i></button>
                                        </h2>
                                    </div>
                                    <div id="collapseCuatro" class="collapse" aria-labelledby="headingCuatro" data-parent="#accordionExample4">
                                        <div class="card-body">
                                            <!----->
                                            <input type="hidden" name="imagen4" id="imagen4" class="form-control" placeholder="" value="0">
                                            <div class="image_area">
                                                <label for="upload_image4" style="width: 100%;">
                                                    <img style="border-color: #01296e  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image4" class="img-responsive img-circle" style="border-radius: 50%;border-color: #01296e  !important;border: solid 4px;" />
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
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha de vencimiento de la Licencia</label>
                                    <input type="date" id="fvlicencia" name="fvlicencia" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">SOAT</h6>
                        <div class="accordion row" id="accordionExample5">
                            <div class="col-md-12 mt-3">
                                <div class="card" style="margin: 0 0 0 0;">
                                    <div class="card-header collapsed" id="headingCinco" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="false" aria-controls="collapseCinco" style="padding: 0;background: #01296e;border-radius: 25px;">
                                        <h2 class="mb-0" style="text-align: center;">
                                            <a id="enlaces5" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;"><i class="fas fa-images"></i></a>
                                            <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                Foto
                                            </button>
                                            <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen5','uploaded_image5')"><i class="fas fa-trash-alt"></i></button>
                                        </h2>
                                    </div>
                                    <div id="collapseCinco" class="collapse" aria-labelledby="headingCinco" data-parent="#accordionExample5">
                                        <div class="card-body">
                                            <!----->
                                            <input type="hidden" name="imagen5" id="imagen5" class="form-control" placeholder="" value="0">
                                            <div class="image_area">
                                                <label for="upload_image5" style="width: 100%;">
                                                    <img style="border-color: #01296e  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image5" class="img-responsive img-circle" style="border-radius: 50%;border-color: #01296e  !important;border: solid 4px;" />
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
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha de vencimiento de SOAT</label>
                                    <input type="date" id="fvsoat" name="fvsoat" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Tarjeta de propiedad del vehiculo</h6>
                        <div class="accordion row" id="accordionExample6">
                            <div class="col-md-12 mt-3">
                                <div class="card" style="margin: 0 0 0 0;">
                                    <div class="card-header collapsed" id="headingSeis" data-toggle="collapse" data-target="#collapseSeis" aria-expanded="false" aria-controls="collapseSeis" style="padding: 0;background: #01296e;border-radius: 25px;">
                                        <h2 class="mb-0" style="text-align: center;">
                                            <a id="enlaces6" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;"><i class="fas fa-images"></i></a>
                                            <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                Foto parte delantera
                                            </button>
                                            <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen6','uploaded_image6')"><i class="fas fa-trash-alt"></i></button>
                                        </h2>
                                    </div>
                                    <div id="collapseSeis" class="collapse" aria-labelledby="headingSeis" data-parent="#accordionExample6">
                                        <div class="card-body">
                                            <!----->
                                            <input type="hidden" name="imagen6" id="imagen6" class="form-control" placeholder="" value="0">
                                            <div class="image_area">
                                                <label for="upload_image6" style="width: 100%;">
                                                    <img style="border-color: #01296e  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image6" class="img-responsive img-circle" style="border-radius: 50%;border-color: #01296e  !important;border: solid 4px;" />
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
                                            <a id="enlaces7" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;"><i class="fas fa-images"></i></a>
                                            <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                Foto parte posterior
                                            </button>
                                            <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen7','uploaded_image7')"><i class="fas fa-trash-alt"></i></button>
                                        </h2>
                                    </div>
                                    <div id="collapseSiete" class="collapse" aria-labelledby="headingSiete" data-parent="#accordionExample6">
                                        <div class="card-body">
                                            <!----->
                                            <input type="hidden" name="imagen7" id="imagen7" class="form-control" placeholder="" value="0">
                                            <div class="image_area">
                                                <label for="upload_image7" style="width: 100%;">
                                                    <img style="border-color: #01296e  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image7" class="img-responsive img-circle" style="border-radius: 50%;border-color: #01296e  !important;border: solid 4px;" />
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
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Certiadulto</h6>
                        <div class="accordion row" id="accordionExample8">
                            <div class="col-md-12 mt-3">
                                <div class="card" style="margin: 0 0 0 0;">
                                    <div class="card-header collapsed" id="headingOcho" data-toggle="collapse" data-target="#collapseOcho" aria-expanded="false" aria-controls="collapseOcho" style="padding: 0;background: #01296e;border-radius: 25px;">
                                        <h2 class="mb-0" style="text-align: center;">
                                            <a id="enlaces8" class="btn" href="https://iwork.pe/imagenes/imgqr/images.png" target="_blank" aria-expanded="true" style="color: #ffffff;"><i class="fas fa-images"></i></a>
                                            <button class="btn btn-link" type="button" style="color: #ffffff;margin-right: -15px;">
                                                Foto
                                            </button>
                                            <button class="btn" type="button" aria-expanded="true" style="color: #ffffff;" onclick="eliminarimagen('imagen8','uploaded_image8')"><i class="fas fa-trash-alt"></i></button>
                                        </h2>
                                    </div>
                                    <div id="collapseOcho" class="collapse" aria-labelledby="headingOcho" data-parent="#accordionExample8">
                                        <div class="card-body">
                                            <!----->
                                            <input type="hidden" name="imagen8" id="imagen8" class="form-control" placeholder="" value="0">
                                            <div class="image_area">
                                                <label for="upload_image8" style="width: 100%;">
                                                    <img style="border-color: #01296e  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image8" class="img-responsive img-circle" style="border-radius: 50%;border-color: #01296e  !important;border: solid 4px;" />
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
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Revisión técnica</h6>
                        <div class="accordion row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha de vencimiento</label>
                                    <input type="date" id="frev_t" name="frev_t" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Certificado de GLP/GNV</h6>
                        <div class="accordion row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Tipo de Certificado</label>
                                    <select class="form-control" id="glpgnv">
                                        <option value="0"></option>
                                        <option value="GLP">GLP</option>
                                        <option value="GNV">GNV</option>
                                        <option value="OTROS">Otros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha de vencimiento</label>
                                    <input type="date" id="frev_c" name="frev_c" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#01296e;border:solid 1px #01296e;" data-dismiss="modal">Cancelar</button>
                        <button id="editardocumentos" type="button" class="btn ml-auto" style="color:#fff;background: #01296e;border: #01296e;" onclick="documentosfn()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampledesbloquear" tabindex="-1" aria-labelledby="exampledatosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="">
                <form enctype="multipart/form-data" id="" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <h6 class="heading-small text-center mb-4">Activar cuenta del conductor</h6>
                        <div class="row" style="display: flex;flex-wrap: nowrap;flex-direction: row;">
                            <div class="col-md-4">
                                <div class="form-group" style="display: flex;justify-content: center;">
                                    <label class="form-control-label" for="example3cols1Input">Banco</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="display: flex;justify-content: center;">
                                    <label class="custom-toggle">
                                        <input type="checkbox" id="banc_efec" onclick="cambiar_valor()">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="display: flex;justify-content: center;">
                                    <label class="form-control-label" for="example3cols3Input">Efectivo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="tipo_tranf">
                                <div class="form-group">
                                    <label class="form-control-label" for="Deposito">Tipo de transferencia</label>
                                    <select class="form-control" id="Deposito" onchange="mostrarselect(this.value)">
                                        <option value="0"></option>
                                        <option value="Billetera digital">Billeteras digitales</option>
                                        <option value="Banca">Banca</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="banca_div" style="display:none">
                                <div class="form-group">
                                    <label class="form-control-label" for="states">Entidades financieras</label>
                                    <select class="form-control" id="states">
                                        <option value="0"></option>
                                        <optgroup label="Empresas Bancarias">
                                            <option value="Banco de Crédito del Perú (BCP)">Banco de Crédito del Perú (BCP)</option>
                                            <option value="BBVA">BBVA</option>
                                            <option value="Banco Interamericano de Finanzas (BanBif)">Banco Interamericano de Finanzas (BanBif)</option>
                                            <option value="Banco de Comercio">Banco de Comercio</option>
                                            <option value="Banco Pichincha">Banco Pichincha</option>
                                            <option value="Citibank Perú">Citibank Perú</option>
                                            <option value="Interbank">Interbank</option>
                                            <option value="MiBanco">MiBanco</option>
                                            <option value="Scotiabank Perú">Scotiabank Perú</option>
                                            <option value="Banco GNB Perú">Banco GNB Perú</option>
                                            <option value="Banco Falabella">Banco Falabella</option>
                                            <option value="Banco Ripley">Banco Ripley</option>
                                            <option value="Banco Santander Perú">Banco Santander Perú</option>
                                            <option value="Alfin Banco">Alfin Banco</option>
                                            <option value="Bank of China">Bank of China</option>
                                            <option value="Bci Perú">Bci Perú</option>
                                            <option value="ICBC PERU BANK">ICBC PERU BANK</option>
                                        </optgroup>
                                        <optgroup label="Entidades Financieras Estatales">
                                        </optgroup>
                                        <option value="Banco de la Nación">Banco de la Nación</option>
                                        <option value="Agrobanco">Agrobanco</option>
                                        <option value="COFIDE">COFIDE</option>
                                        <option value="Fondo MiVivienda">Fondo MiVivienda</option>
                                        </optgroup>
                                        <optgroup label="Empresas Financieras">
                                            <option value="Amérika">Amérika</option>
                                            <option value="Crediscotia">Crediscotia</option>
                                            <option value="Confianza">Confianza</option>
                                            <option value="Compartamos">Compartamos</option>
                                            <option value="Credinka">Credinka</option>
                                            <option value="Efectiva">Efectiva</option>
                                            <option value="Proempresa">Proempresa</option>
                                            <option value="Mitsui Auto Finance">Mitsui Auto Finance</option>
                                            <option value="Oh!">Oh!</option>
                                            <option value="Qapaq">Qapaq</option>
                                        </optgroup>
                                        <optgroup label="Cajas Municipales de Ahorro y Crédito (CMAC)">
                                            <option value="Arequipa">Arequipa</option>
                                            <option value="Cusco">Cusco</option>
                                            <option value="Del Santa">Del Santa</option>
                                            <option value="Trujillo">Trujillo</option>
                                            <option value="Huancayo">Huancayo</option>
                                            <option value="Ica">Ica</option>
                                            <option value="Maynas">Maynas</option>
                                            <option value="Paita">Paita</option>
                                            <option value="Piura">Piura</option>
                                            <option value="Sullana">Sullana</option>
                                            <option value="Tacna">Tacna</option>
                                        </optgroup>
                                        <optgroup label="Cajas Municipales de Crédito y Popular (CMCP)">
                                            Caja Metropolitana de Lima</option>
                                        </optgroup>
                                        <optgroup label="Cajas Rurales de Ahorro y Crédito (CRAC)">
                                            <option value="Incasur">Incasur</option>
                                            <option value="Los Andes">Los Andes</option>
                                            <option value="Del Centro">Del Centro</option>
                                            <option value="Raíz">Raíz</option>
                                            <option value="Cencosud Scotia">Cencosud Scotia</option>
                                        </optgroup>
                                        <optgroup label="EMPRESAS DE CRÉDITO">
                                            <option value="Acceso Crediticio">Acceso Crediticio</option>
                                            <option value="Alternativa">Alternativa</option>
                                            <option value="Volvo Financial Services">Volvo Financial Services</option>
                                            <option value="Credivisión">Credivisión</option>
                                            <option value="Inversiones La Cruz">Inversiones La Cruz</option>
                                            <option value="Mi Casita">Mi Casita</option>
                                            <option value="Santander Consumer Perú">Santander Consumer Perú</option>
                                            <option value="TOTAL, Servicios Financieros">TOTAL, Servicios Financieros</option>
                                        </optgroup>
                                        <optgroup label="Bancos de Inversión">
                                            <option value="J.P. Morgan Banco de Inversión">J.P. Morgan Banco de Inversión</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <!-- ---------------------------------- -->
                            </div>
                            <div class="col-md-12" id="bille_div" style="display:none">
                                <div class="form-group">
                                    <label class="form-control-label" for="s_bille">Billeteras digitales</label>
                                    <select class="form-control" id="s_bille">
                                        <option value="0"></option>
                                        <option>Yape</option>
                                        <option>Plin</option>
                                        <option>Bim</option>
                                        <option>IzipayYa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Detalle</label>
                                    <input type="text" id="detalleact" name="detalleact" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <!--<div class="row">
                            <div class="col-md-6">
                                <label class="form-control-label" for="example2cols1Input">Promoci&oacute;n</label>
                                <div class="form-group" style="display: flex;justify-content: center;">
                                    <label class="custom-toggle">
                                        <input type="checkbox" id="banc_efec" onclick="cambiar_valor()">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Monto</label>
                                    <input type="number" id="monto" step="0.01" name="monto" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha inicio</label>
                                    <input type="date" id="f_inicio" name="f_inicio" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha final</label>
                                    <div class="input-group mb-3">
                                        <input type="date" id="f_final" name="f_final" class="form-control" onclick="bloqcon();" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="button" id="calcular1" data-toggle="tooltip" data-placement="top" title="Calcular días" onclick="c_dias();"><i class="fas fa-calendar-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Días</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="dias" name="dias" class="form-control" onclick="bloqcon();" autocomplete="off" value="0">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="button" id="calcular2" data-toggle="tooltip" data-placement="top" title="Calcular fecha" onclick="c_fechas();"><i class="fas fa-calendar-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="resuemn_general" style="display: none;">
                            <hr class="my-4">
                            <h6 class="heading-small text-center mb-4">Resumen</h6>
                            <ul>
                                <li class="textomodal">Periodo de pago cada <span id="periodo"></span> días.</li>
                                <li class="textomodal">Fecha de activación: <span id="f_activa"></span></li>
                                <li class="textomodal">Fecha de notificación: <span id="f_not"></span></li>
                                <li class="textomodal">Fecha de bloqueo: <span id="f_bloq"></span></li>
                                <li class="textomodal">Costo total por periodo: <span id="cost"></span></li>
                                <li class="textomodal">Costo por día: <span id="cos"></span></li>
                                <li class="textomodal">Detalle: <span id="detallecos"></span></li>
                            </ul>
                            <hr class="my-4" style="margin: 30px 0 0 0 !important;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#01296e;border:solid 1px #01296e;" data-dismiss="modal">Cancelar</button>
                        <button id="guardarmonto" type="button" class="btn ml-auto" style="display:none;color:#fff;background: #01296e;border: #01296e;" onclick="regsaldo();">Activar cuenta</button>
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
                <button type="button" class="close" data-dismiss="modal1" aria-label="Close">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal1">
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
                <button type="button" class="close" data-dismiss="modal2" aria-label="Close">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal2">
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
                <button type="button" class="close" data-dismiss="modal3" aria-label="Close">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal3">
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
                <button type="button" class="close" data-dismiss="modal4" aria-label="Close">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal4">
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
                <button type="button" class="close" data-dismiss="modal5" aria-label="Close">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal5">
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
                <button type="button" class="close" data-dismiss="modal6" aria-label="Close">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal6">
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
                <button type="button" class="close" data-dismiss="modal7" aria-label="Close">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal7">
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
                <button type="button" class="close" data-dismiss="modal8" aria-label="Close">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;" data-dismiss="modal8">
                <input type="button" id="crop8" name="crop8" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #01296e;border: solid 1px #01296e;">
            </div>
        </div>
    </div>
</div>
<!-- modal8 -->
<div class="header bg-primary pb-6" style="background: #01296e !important;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4" style="margin-left: 5px;margin-right: 5px;">
                <div class="col-lg-12 col-12" style="text-align: center;background: none;height: 59px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;border-radius: 50px;">
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">PROSPECTOS DE CONDUCTORES</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="col-md-12" style="display: flex;justify-content: space-between;">
                        <button class="boton-save" style="margin-right: 5px;" onclick="datos();">
                            <i class="fas fa-plus-circle"></i> Registrar conductor
                        </button>
                        <form method="POST" action="create_excel_tempconductor.php">
                            <button class="boton-save" style="margin-right: 5px;">
                                <i class="fas fa-file-excel"></i> Exportar a Excel
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table id="example" class="table table-bordered table-striped dataTable dtr-inline" role="grid">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Telefono</th>
                                    <th>Documentos</th>
                                    <th>Datos Personales</th>
                                    <th>Vehiculo</th>
                                    <th>Aprobar</th>
                                    <th>Rechazar</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Telefono</th>
                                    <th>Documentos</th>
                                    <th>Datos Personales</th>
                                    <th>Vehiculo</th>
                                    <th>Aprobar</th>
                                    <th>Rechazar</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once './view/admin/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.4/api/fnReloadAjax.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script src="./view/admin/js/tempconductor.js"></script>

</html>