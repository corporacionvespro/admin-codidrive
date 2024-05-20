<html>

<?php require_once './view/admin/header.php'; ?>
<?php require_once './conectar.php'; ?>
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />

<script src="https://unpkg.com/cropperjs"></script>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<?php $var = "conductores"; ?>
<?php
global $db;
$query_conductores_ = $db->query("SELECT SQL_CALC_FOUND_ROWS COUNT(id_conductor) AS conductor_ FROM conductor JOIN persona ON persona.id_persona = conductor.id_persona JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo  AND conductor.estado <>'sinaprobar'");
$totalconductores_2 = $query_conductores_->fetch_assoc();
$totalconductores_ = $totalconductores_2['conductor_'];

$query_conductores_activo = $db->query("SELECT SQL_CALC_FOUND_ROWS COUNT(id_conductor) AS conductor_activo FROM conductor JOIN persona ON persona.id_persona = conductor.id_persona JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo  AND conductor.estado <>'sinaprobar' WHERE conductor.estado ='activo'");
$totalconductores_activo2 = $query_conductores_activo->fetch_assoc();
$totalconductores_activo = $totalconductores_activo2['conductor_activo'];

$query_conductores_inactivo = $db->query("SELECT SQL_CALC_FOUND_ROWS COUNT(id_conductor) AS conductor_inactivo FROM conductor JOIN persona ON persona.id_persona = conductor.id_persona JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo  AND conductor.estado <>'sinaprobar' WHERE conductor.estado ='inactivo'");
$totalconductores_inactivo2 = $query_conductores_inactivo->fetch_assoc();
$totalconductores_inactivo = $totalconductores_inactivo2['conductor_inactivo'];

$query_conductores_bloqueado = $db->query("SELECT SQL_CALC_FOUND_ROWS COUNT(id_conductor) AS conductor_bloqueado FROM conductor JOIN persona ON persona.id_persona = conductor.id_persona JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo  AND conductor.estado <>'sinaprobar' WHERE conductor.estado ='bloqueado'");
$totalconductores_bloqueado2 = $query_conductores_bloqueado->fetch_assoc();
$totalconductores_bloqueado = $totalconductores_bloqueado2['conductor_bloqueado'];

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
    .dataTables_length {
        display: none;
    }

    @media only screen and (min-device-width : 320px) and (max-device-width : 568px) {
        .modal-body {

            height: 498px;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child,
        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child {

            position: relative;
            padding-left: 72px;

        }

        /*table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
            top: 17px;
            left: 28px;
            height: 14px;
            width: 14px;
            display: block;
            position: absolute;
            color: white;
            border: 2px solid white;
            border-radius: 14px;
            box-shadow: 0 0 3px #444;
            box-sizing: content-box;
            text-align: center;
            text-indent: 0 !important;
            font-family: 'Courier New', Courier, monospace;
            line-height: 14px;
            content: '+';
            background-color: #5F00BE;
        }*/

        .page-item .page-link,
        .page-item span {
            font-size: .875rem;
            display: flex;
            width: 36px;
            height: 36px;
            padding: 3px;
            margin: 0 0px;
            border-radius: 50% !important;
            align-items: center;
            justify-content: center;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 1px -17px;
            white-space: nowrap;
            justify-content: flex-end;
        }

        .dataTables_length,
        .dataTables_info,
        .dt-buttons {
            padding-left: 0.4rem;
            margin-bottom: 18px;
        }
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
        color: #50009f;
        position: absolute;
        top: 7px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
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

    .imagePreview2 {
        background-image: url('https://codidrive.com/admin/assets/img/brand/logo.png');
    }

    .estado_inactivo {
        height: 24px;
        min-width: 22px;
        line-height: 0;
        border-radius: 6px;
        cursor: default;
        -webkit-box-align: center;
        align-items: center;
        white-space: nowrap;
        display: inline-flex;
        -webkit-box-pack: center;
        justify-content: center;
        text-transform: capitalize;
        padding: 0px 8px;
        color: rgb(12, 83, 183);
        font-size: 0.75rem;
        font-family: "Public Sans", sans-serif;
        background-color: rgba(24, 144, 255, 0.16);
        font-weight: 700;
    }

    .estado_ocupado {
        height: 24px;
        min-width: 22px;
        line-height: 0;
        border-radius: 6px;
        cursor: default;
        -webkit-box-align: center;
        align-items: center;
        white-space: nowrap;
        display: inline-flex;
        -webkit-box-pack: center;
        justify-content: center;
        text-transform: capitalize;
        padding: 0px 8px;
        color: rgb(183, 129, 3);
        font-size: 0.75rem;
        font-family: "Public Sans", sans-serif;
        background-color: rgba(255, 193, 7, 0.16);
        font-weight: 700;
    }

    .estado_activo {
        height: 24px;
        min-width: 22px;
        line-height: 0;
        border-radius: 6px;
        cursor: default;
        -webkit-box-align: center;
        align-items: center;
        white-space: nowrap;
        display: inline-flex;
        -webkit-box-pack: center;
        justify-content: center;
        text-transform: capitalize;
        padding: 0px 8px;
        color: rgb(34, 154, 22);
        font-size: 0.75rem;
        font-family: "Public Sans", sans-serif;
        background-color: rgba(84, 214, 44, 0.16);
        font-weight: 700;
    }

    .estado_bloqueado {
        height: 24px;
        min-width: 22px;
        line-height: 0;
        border-radius: 6px;
        cursor: default;
        -webkit-box-align: center;
        align-items: center;
        white-space: nowrap;
        display: inline-flex;
        -webkit-box-pack: center;
        justify-content: center;
        text-transform: capitalize;
        padding: 0px 8px;
        color: rgb(183, 33, 54);
        font-size: 0.75rem;
        font-family: "Public Sans", sans-serif;
        background-color: rgba(255, 72, 66, 0.16);
        font-weight: 700;
    }

    .heading-small {
        color: #5f14ba !important;
        font-size: 0.95rem;
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .checkedstar {
        color: orange;
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

    #message2 {
        display: none;
        background: #f6f3f9;
        color: #5e14b9;
        position: relative;
        padding: 25px;
        margin-top: 9px;
        border-radius: 25px;
    }

    #message2 p {
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
        /*width: 300px;
            height: 300px;*/
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
        /*background: red;*/
        opacity: .8;
    }

    .accordion .card-header[aria-expanded='false']:after {
        color: white !important;
    }

    .accordion .card-header[aria-expanded='true']:after {
        color: white !important;
    }
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="">
                <form enctype="multipart/form-data" id="formuploadajax" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <h1 style="text-align: center;text-transform: uppercase;color: #50009f;">Registrar conductor</h1>
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="foto" name="foto" accept=".jpg, .jpeg" />
                                            <label for="foto"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url(https://codidrive.com/admin/assets/img/brand/logo.png);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
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
                        <button type="button" class="btn mr-auto" style="color:#50009f;border:solid 1px #50009f;" data-dismiss="modal">Cancelar</button>
                        <button id="btnguardar" type="submit" class="btn ml-auto" style="color:#fff;background: #50009f;border: #50009f;">Guardar</button>
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
                <form enctype="multipart/form-data" id="formuploadajax3" method="post">
                    <div class="card-body px-lg-4 py-lg-4">

                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Datos del veh&iacute;culo</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Marca y modelo</label>
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
                        <button type="button" class="btn mr-auto" style="color:#50009f;border:solid 1px #50009f;" data-dismiss="modal">Cancelar</button>
                        <button id="editarvehiculo" type="button" class="btn ml-auto" style="color:#fff;background: #50009f;border: #50009f;" onclick="editarvehiculo2()">Guardar</button>
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
                                    <h1 style="text-align: center;text-transform: uppercase;color: #50009f;">Registrar conductor</h1>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Nombre y Apellido</label>
                                    <input type="text" id="nombres2" name="nombres2" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Correo</label>
                                    <input type="email" id="correo2" name="correo2" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Telefono</label>
                                    <input type="number" id="telefono2" name="telefono2" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Clave</label>
                                    <input type="password" id="clave2" name="clave2" class="form-control" placeholder="" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 8 o más caracteres" required>
                                    <input type="checkbox" onclick="passw2()" style="margin-top: 15px;"> Mostrar contraseña
                                    <div id="message2">
                                        <h3 style="color: #535f7e;text-align: center;">La contraseña debe contener lo siguiente:</h3>
                                        <p id="letter2" class="invalid">Mínimo una <b>Minúscula</b></p>
                                        <p id="capital2" class="invalid">Mínimo una <b>Mayúscula</b></p>
                                        <p id="number2" class="invalid">Mínimo un <b>Número</b></p>
                                        <p id="length2" class="invalid">Mínimo <b>8 caracteres</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#50009f;border:solid 1px #50009f;" data-dismiss="modal">Cancelar</button>
                        <button id="editardatos" type="button" class="btn ml-auto" style="color:#fff;background: #50009f;border: #50009f;" onclick="editardatos2()">Guardar</button>
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
                                    <input type="date" id="f_final" name="f_final" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Días</label>
                                    <input type="number" id="dias" name="dias" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#50009f;border:solid 1px #50009f;" data-dismiss="modal">Cancelar</button>
                        <button id="guardarmonto" type="button" class="btn ml-auto" style="color:#fff;background: #50009f;border: #50009f;" onclick="guardarmontos();">Guardar</button>
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
                                    <div class="card-header collapsed" id="headingUno" data-toggle="collapse" data-target="#collapseUno" aria-expanded="false" aria-controls="collapseUno" style="padding: 0;background: #5f14ba;border-radius: 25px;">
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
                                                    <img style="border-color: #5f1fb6  !important;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image1" class="img-responsive img-circle" style="border-radius: 50%;border-color: #5f1fb6  !important;border: solid 4px;" />
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
                                    <div class="card-header collapsed" id="headingDos" data-toggle="collapse" data-target="#collapseDos" aria-expanded="false" aria-controls="collapseDos" style="padding: 0;background: #5f14ba;border-radius: 25px;">
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
                                    <div class="card-header collapsed" id="headingTres" data-toggle="collapse" data-target="#collapseTres" aria-expanded="false" aria-controls="collapseTres" style="padding: 0;background: #5f14ba;border-radius: 25px;">
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
                                    <div class="card-header collapsed" id="headingCuatro" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseCuatro" style="padding: 0;background: #5f14ba;border-radius: 25px;">
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
                                    <div class="card-header collapsed" id="headingCinco" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="false" aria-controls="collapseCinco" style="padding: 0;background: #5f14ba;border-radius: 25px;">
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
                                    <div class="card-header collapsed" id="headingSeis" data-toggle="collapse" data-target="#collapseSeis" aria-expanded="false" aria-controls="collapseSeis" style="padding: 0;background: #5f14ba;border-radius: 25px;">
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
                                    <div class="card-header collapsed" id="headingSiete" data-toggle="collapse" data-target="#collapseSiete" aria-expanded="false" aria-controls="collapseSiete" style="padding: 0;background: #5f14ba;border-radius: 25px;">
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
                        <hr class="my-4">
                        <h6 class="heading-small text-center mb-4">Certiadulto</h6>
                        <div class="accordion row" id="accordionExample8">
                            <div class="col-md-12 mt-3">
                                <div class="card" style="margin: 0 0 0 0;">
                                    <div class="card-header collapsed" id="headingOcho" data-toggle="collapse" data-target="#collapseOcho" aria-expanded="false" aria-controls="collapseOcho" style="padding: 0;background: #5f14ba;border-radius: 25px;">
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
                        <button type="button" class="btn mr-auto" style="color:#50009f;border:solid 1px #50009f;" data-dismiss="modal">Cancelar</button>
                        <button id="editardocumentos" type="button" class="btn ml-auto" style="color:#fff;background: #50009f;border: #50009f;" onclick="documentosfn()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Header -->

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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;" data-dismiss="modal1">
                <input type="button" id="crop1" name="crop1" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;" data-dismiss="modal2">
                <input type="button" id="crop2" name="crop2" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;" data-dismiss="modal3">
                <input type="button" id="crop3" name="crop3" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;" data-dismiss="modal4">
                <input type="button" id="crop4" name="crop4" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;" data-dismiss="modal5">
                <input type="button" id="crop5" name="crop5" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;" data-dismiss="modal6">
                <input type="button" id="crop6" name="crop6" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;" data-dismiss="modal7">
                <input type="button" id="crop7" name="crop7" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;">
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;" data-dismiss="modal8">
                <input type="button" id="crop8" name="crop8" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #5f14ba;border: solid 1px #5f14ba;">
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
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">CONDUCTORES</h6>
                    <button class="boton-save" style="width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;right: 3px;position: absolute;" onclick="/*notificar()*/">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <style>
                        .boton-save {
                            outline: none;
                            padding-top: 5px;
                            padding-right: 15px;
                            padding-left: 15px;
                            padding-bottom: 5px;
                            border-radius: 26px;
                            background: #5F00BE;
                            color: #fff;
                            border: none;
                            /*margin-left: 7px;*/
                        }

                        .boton-save:hover {
                            color: #fff;
                            text-decoration: none;
                        }
                    </style>

                    <!-- mod -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">TOTAL</h5>
                                            <span class="h2 font-weight-bold mb-0" id="nid_conductor"><?php echo $totalconductores_;  ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                <i class="ni ni-single-02"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Activos</h5>
                                            <span class="h2 font-weight-bold mb-0" id="nid_pasajero"><?php echo $totalconductores_activo;  ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                                <i class="ni ni-single-02"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Inactivos</h5>
                                            <span class="h2 font-weight-bold mb-0" id="nweb"><?php echo $totalconductores_inactivo;  ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="ni ni-single-02"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">bloqueados</h5>
                                            <span class="h2 font-weight-bold mb-0" id="napp"><?php echo $totalconductores_bloqueado;  ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                <i class="ni ni-single-02"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: flex;justify-content: space-between;">
                        
                        <form method="POST" action="create_excel_conductores.php">
                            <button class="boton-save" style="margin-right: 5px;">
                                <i class="fas fa-file-excel"></i> Exportar a Excel
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body pt-0">

                    <div class="table-responsive py-4 pt-0">
                        <style>
                            table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child,
                            table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child {

                                position: relative;
                                padding-left: 72px;

                            }
                        </style>
                        <table id="example" class="table table-bordered table-striped dataTable dtr-inline" role="grid">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Unidad</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Cambiar estado</th>
                                    <th>Documentos</th>
                                    <th>Datos Personales</th>
                                    <th>Vehiculo</th>
                                    <th>Bloquear</th>
                                    <th>Ratings</th>
                                    <th>N° solicitudes</th>
                                    <th>Eliminar</th>
                                    <th>Revertir</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Unidad</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Cambiar estado</th>
                                    <th>Documentos</th>
                                    <th>Datos Personales</th>
                                    <th>Vehiculo</th>
                                    <th>Bloquear</th>
                                    <th>Ratings</th>
                                    <th>N° solicitudes</th>
                                    <th>Eliminar</th>
                                    <th>Revertir</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once './view/admin/footer.php'; ?>
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

    <script>
        var idpersonas = '';
        var idcuentas = '';
        var idvehiculos = '';
        ////////////////////////////////////
        var idconductore = '';
        var valores = '';

        var glob_idconductor = '';
        $(document).ready(function() {
            $(function() {
                $("#example").DataTable({

                    "responsive": true,
                    "autoWidth": false,
                    "order": [0, 'DESC'],
                    "pageLength": 25,

                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        /*"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", */
                        "sInfoEmpty": "No se encontraron registros.",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": ">",
                            /*Siguiente*/
                            "sPrevious": "<" /*Anterior*/
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },

                        "dom": 'lBfrtip',
                        "buttons": [{
                                "extend": 'excelHtml5',
                                "text": '<i class="fas fa-file-excel"></i> ',
                                "titleAttr": 'Exportar a Excel',
                                "className": 'btn btn-success'
                            },
                            {
                                "extend": 'pdfHtml5',
                                "text": '<i class="fas fa-file-pdf"></i> ',
                                "titleAttr": 'Exportar a PDF',
                                "className": 'btn btn-danger'
                            },
                            {
                                "extend": 'print',
                                "text": '<i class="fa fa-print"></i> ',
                                "titleAttr": 'Imprimir',
                                "className": 'btn btn-info'
                            },
                        ]
                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "server_process_conductores.php",
                });

            });
        });

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


        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader2 = new FileReader();
                reader2.onload = function(e) {
                    $('#imagePreview2').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview2').hide();
                    $('#imagePreview2').fadeIn(650);
                }
                reader2.readAsDataURL(input.files[0]);
            }
        }

        $("#foto2").change(function() {
            readURL2(this);
        });

        function datos() {
            $('#exampleModal3').modal('show');
        }
        $("#formuploadajax").on("submit", function(e) {
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            formData.append("dato", "valor");
            $.ajax({
                    url: "https://chapatutaxi.com/admin/newreg",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(res) {
                    window.location.href = './conductores';
                });
        });

        function editardatos2() {
            nombres = $("#nombres2").val();
            correo = $("#correo2").val();
            clave = $("#clave2").val();
            telefono = $("#telefono2").val();
            foto2 = $("#foto2").val();
            var file_data = $('#foto2').prop('files')[0];
            var form = new FormData();
            form.append("clave", clave);
            form.append("correo", correo);
            form.append("id_cuenta", idcuentas);
            form.append("id_persona", idpersonas);
            form.append("nombres", nombres);
            form.append("telefono", telefono);
            form.append("foto", foto2);

            var settings = {
                "url": "https://codidrive.com/codi/api//driver/updatedriver",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                var table2 = $('#example').dataTable();
                if (file_data === undefined) {
                    table2.fnReloadAjax('server_process_conductores.php');
                    table2.fnReloadAjax();
                    $('#exampledatos').modal('hide');
                } else {
                    var form_data = new FormData();
                    form_data.append("foto", file_data);
                    form_data.append("id_persona", idpersonas);
                    var settings = {
                        "url": "https://codidrive.com/codi/api/driver/updatephoto",
                        "method": "POST",
                        "timeout": 0,
                        "processData": false,
                        "mimeType": "multipart/form-data",
                        "contentType": false,
                        "data": form_data
                    };
                    $.ajax(settings).done(function(response2) {
                        table2.fnReloadAjax('server_process_conductores.php');
                        table2.fnReloadAjax();
                        $('#exampledatos').modal('hide');
                    });
                }
            });
        }

        function vehiculodatos(id) {
            idvehiculos = id;
            $("#placa3").val('');
            $("#marca3").val('');
            $("#color3").val('');
            $("#anio3").val('');
            $("#unidad3").val('');
            var form = new FormData();
            form.append("id_vehiculo", id);
            var settings = {
                "url": "https://codidrive.com/codi/api//driver/infovehiculo",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };
            $.ajax(settings).done(function(response) {
                $('#examplevehiculo').modal('show');
                var json2 = JSON.parse(response);
                $("#placa3").val(json2.conductor.placa);
                $("#marca3").val(json2.conductor.marca);
                $("#color3").val(json2.conductor.color);
                $("#anio3").val(json2.conductor.anio);
                $("#unidad3").val(json2.conductor.unidad);
            });
        }

        function personalesdatos(idpersona, idcuenta) {
            idpersonas = idpersona;
            idcuentas = idcuenta;
            $("#nombres2").val('');
            $("#telefono2").val('');
            $('#imagePreview2').css('background-image', 'url(https://codidrive.com/admin/assets/img/brand/logo.png)');
            $('#imagePreview2').hide();
            $('#imagePreview2').fadeIn(650);
            $("#correo2").val('');
            $("#clave2").val('');
            var form = new FormData();
            form.append("id_persona", idpersona);
            var settings = {
                "url": "https://codidrive.com/codi/api//driver/infodriver",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };
            $.ajax(settings).done(function(response) {
                var json2 = JSON.parse(response);
                $("#nombres2").val(json2.conductor.nombres);
                $("#telefono2").val(json2.conductor.telefono);
                if (json2.conductor.foto == 'https://chapatutaxi.com/codiapi/images/logo.png') {
                    var url = 'https://codidrive.com/admin/assets/img/brand/logo.png';
                } else {
                    var url = 'https://chapatutaxi.com/codiapi/images/' + json2.conductor.foto;
                }
                $('#imagePreview2').css('background-image', 'url(' + url + ')');
                $('#imagePreview2').hide();
                $('#imagePreview2').fadeIn(650);
                $("#correo2").val(json2.conductor.correo);
                $("#clave2").val(json2.conductor.clave);
                $('#exampledatos').modal('show');
            });
        }

        function editarvehiculo2() {
            marca = $("#marca3").val();
            placa = $("#placa3").val();
            unidad = $("#unidad3").val();
            color = $("#color3").val();
            anio = $("#anio3").val();
            var form = new FormData();
            form.append("anio", anio);
            form.append("color", color);
            form.append("id_vehiculo", idvehiculos);
            form.append("marca", marca);
            form.append("placa", placa);
            form.append("unidad", unidad);

            var settings = {
                "url": "https://codidrive.com/codi/api//driver/updatevehicle",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                var table2 = $('#example').dataTable();
                table2.fnReloadAjax('server_process_conductores.php');
                table2.fnReloadAjax();
                $('#examplevehiculo').modal('hide');
            });
        }

        function cambiarestado(id, estado) {
            var form = new FormData();
            form.append("estado", estado);
            form.append("id_conductor", id);

            var settings = {
                "url": "https://codidrive.com/codi/api//driver/state",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                var table2 = $('#example').dataTable();
                table2.fnReloadAjax('server_process_conductores.php');
                table2.fnReloadAjax();
            });
        }

        function cambiarestado2(id, estado) {
            idconductore = id;
            valores = estado;
            $('#exampledesbloquear').modal('show');
        }

        function guardarmontos() {

            var form = new FormData();
            form.append("estado", valores);
            form.append("id_conductor", idconductore);

            var settings = {
                "url": "https://codidrive.com/codi/api//driver/state",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                var table2 = $('#example').dataTable();
                table2.fnReloadAjax('server_process_conductores.php');
                table2.fnReloadAjax();
            });
            $('#exampledesbloquear').modal('hide');
        }

        function passw() {
            var x = document.getElementById("clave");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function passw2() {
            var x = document.getElementById("clave2");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        var myInput = document.getElementById("clave");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
        ///////////////////
        var myInput2 = document.getElementById("clave2");
        var letter2 = document.getElementById("letter2");
        var capital2 = document.getElementById("capital2");
        var number2 = document.getElementById("number2");
        var length2 = document.getElementById("length2");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }
        myInput2.onfocus = function() {
            document.getElementById("message2").style.display = "block";
        }
        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }
        myInput2.onblur = function() {
            document.getElementById("message2").style.display = "none";
        } /**/

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
        myInput2.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters2 = /[a-z]/g;
            if (myInput2.value.match(lowerCaseLetters2)) {
                letter2.classList.remove("invalid");
                letter2.classList.add("valid");
            } else {
                letter2.classList.remove("valid");
                letter2.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters2 = /[A-Z]/g;
            if (myInput2.value.match(upperCaseLetters2)) {
                capital2.classList.remove("invalid");
                capital2.classList.add("valid");
            } else {
                capital2.classList.remove("valid");
                capital2.classList.add("invalid");
            }

            // Validate numbers
            var numbers2 = /[0-9]/g;
            if (myInput2.value.match(numbers2)) {
                number2.classList.remove("invalid");
                number2.classList.add("valid");
            } else {
                number2.classList.remove("valid");
                number2.classList.add("invalid");
            }

            // Validate length
            if (myInput2.value.length >= 8) {
                length2.classList.remove("invalid");
                length2.classList.add("valid");
            } else {
                length2.classList.remove("valid");
                length2.classList.add("invalid");
            }
        }
        //////////////////////////////////////////////////////////////////////////////////////
        function documentos(id) {
            glob_idconductor = id;
            $("#fecha_nac").val('');
            $("#doc_personal").val('');
            $("#imagen1").val('https://iwork.pe/imagenes/imgqr/images.png');
            $("#uploaded_image1").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
            $("#enlaces1").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
            $("#headingUno").addClass("collapsed");
            $("#collapseUno").removeClass("show");
            $("#headingUno").attr("aria-expanded", "false");
            $("#ndni").val('');
            $("#imagen2").val('https://iwork.pe/imagenes/imgqr/images.png');
            $("#uploaded_image2").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
            $("#enlaces2").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
            $("#headingDos").addClass("collapsed");
            $("#collapseDos").removeClass("show");
            $("#headingDos").attr("aria-expanded", "false");
            $("#fvdni").val('');
            $("#imagen3").val('https://iwork.pe/imagenes/imgqr/images.png');
            $("#uploaded_image3").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
            $("#enlaces3").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
            $("#headingTres").addClass("collapsed");
            $("#collapseTres").removeClass("show");
            $("#headingTres").attr("aria-expanded", "false");
            $("#nlicencia").val('');
            $("#imagen4").val('https://iwork.pe/imagenes/imgqr/images.png');
            $("#uploaded_image4").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
            $("#enlaces4").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
            $("#headingCuatro").addClass("collapsed");
            $("#collapseCuatro").removeClass("show");
            $("#headingCuatro").attr("aria-expanded", "false");
            $("#fvlicencia").val('');
            $("#imagen5").val('https://iwork.pe/imagenes/imgqr/images.png');
            $("#uploaded_image5").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
            $("#enlaces5").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
            $("#headingCinco").addClass("collapsed");
            $("#collapseCinco").removeClass("show");
            $("#headingCinco").attr("aria-expanded", "false");
            $("#fvsoat").val('');
            $("#imagen6").val('https://iwork.pe/imagenes/imgqr/images.png');
            $("#uploaded_image6").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
            $("#enlaces6").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
            $("#headingSeis").addClass("collapsed");
            $("#collapseSeis").removeClass("show");
            $("#headingSeis").attr("aria-expanded", "false");
            $("#imagen7").val('https://iwork.pe/imagenes/imgqr/images.png');
            $("#uploaded_image7").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
            $("#enlaces7").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
            $("#headingSiete").addClass("collapsed");
            $("#collapseSiete").removeClass("show");
            $("#headingSiete").attr("aria-expanded", "false");
            $("#imagen8").val('https://iwork.pe/imagenes/imgqr/images.png');
            $("#uploaded_image8").attr("src", 'https://iwork.pe/imagenes/imgqr/images.png');
            $("#enlaces8").attr("href", "https://iwork.pe/imagenes/imgqr/images.png");
            $("#headingOcho").addClass("collapsed");
            $("#collapseOcho").removeClass("show");
            $("#headingOcho").attr("aria-expanded", "false");
            $("#frev_t").val('');
            $("#glpgnv").val('');
            $("#frev_c").val('');

            $.ajax({
                url: 'agregar_documento_conductor.php',
                type: "post",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                },
                success: function(data) {
                    var div = document.getElementById('load');
                    div.style.display = 'none';
                    $('#exampledocumentos').modal('show');
                    $("#doc_personal").val(data.dni_tipo);
                    $("#imagen1").val(data.dni_foto_frontal);
                    $("#uploaded_image1").attr("src", data.dni_foto_frontal);
                    $("#enlaces1").attr("href", data.dni_foto_frontal);
                    $("#fecha_nac").val(data.fecha_nacimiento);
                    $("#ndni").val(data.dni_numero);
                    $("#imagen2").val(data.dni_foto_posterior);
                    $("#uploaded_image2").attr("src", data.dni_foto_posterior);
                    $("#enlaces2").attr("href", data.dni_foto_posterior);
                    $("#fvdni").val(data.dni_fv);
                    $("#imagen3").val(data.licencia_foto_frontal);
                    $("#uploaded_image3").attr("src", data.licencia_foto_frontal);
                    $("#enlaces3").attr("href", data.licencia_foto_frontal);
                    $("#nlicencia").val(data.licencia_numero);
                    $("#imagen4").val(data.licencia_foto_posterior);
                    $("#uploaded_image4").attr("src", data.licencia_foto_posterior);
                    $("#enlaces4").attr("href", data.licencia_foto_posterior);
                    $("#fvlicencia").val(data.licencia_fv);
                    $("#imagen5").val(data.soat_foto);
                    $("#uploaded_image5").attr("src", data.soat_foto);
                    $("#enlaces5").attr("href", data.soat_foto);
                    $("#fvsoat").val(data.soat_fv);
                    $("#imagen6").val(data.tp_foto_frontal);
                    $("#uploaded_image6").attr("src", data.tp_foto_frontal);
                    $("#enlaces6").attr("href", data.tp_foto_frontal);
                    $("#imagen7").val(data.tp_foto_posterior);
                    $("#uploaded_image7").attr("src", data.tp_foto_posterior);
                    $("#enlaces7").attr("href", data.tp_foto_posterior);
                    $("#imagen8").val(data.antecedentes_foto);
                    $("#uploaded_image8").attr("src", data.antecedentes_foto);
                    $("#enlaces8").attr("href", data.antecedentes_foto);
                    $("#frev_t").val(data.revision_tecnica_fv);
                    $("#glpgnv").val(data.certificado_gnv_glp_tipo);
                    $("#frev_c").val(data.certificado_gnv_glp_fv);
                }
            });
        }
        var $modal1 = $('#modal1');
        var $modal2 = $('#modal2');
        var $modal3 = $('#modal3');
        var $modal4 = $('#modal4');
        var $modal5 = $('#modal5');
        var $modal6 = $('#modal6');
        var $modal7 = $('#modal7');
        var $modal8 = $('#modal8');
        var image1 = document.getElementById('sample_image1');
        var image2 = document.getElementById('sample_image2');
        var image3 = document.getElementById('sample_image3');
        var image4 = document.getElementById('sample_image4');
        var image5 = document.getElementById('sample_image5');
        var image6 = document.getElementById('sample_image6');
        var image7 = document.getElementById('sample_image7');
        var image8 = document.getElementById('sample_image8');
        var cropper1;
        var cropper2;
        var cropper3;
        var cropper4;
        var cropper5;
        var cropper6;
        var cropper7;
        var cropper8;
        $('#upload_image1').change(function(event) {
            var files1 = event.target.files;

            var done = function(url1) {
                image1.src = url1;
                $modal1.modal('show');
            };

            if (files1 && files1.length > 0) {
                reader1 = new FileReader();
                reader1.onload = function(event) {
                    done(reader1.result);
                };
                reader1.readAsDataURL(files1[0]);
            }
        });
        $('#upload_image2').change(function(event) {
            var files2 = event.target.files;

            var done = function(url2) {
                image2.src = url2;
                $modal2.modal('show');
            };

            if (files2 && files2.length > 0) {
                reader2 = new FileReader();
                reader2.onload = function(event) {
                    done(reader2.result);
                };
                reader2.readAsDataURL(files2[0]);
            }
        });
        $('#upload_image3').change(function(event) {
            var files3 = event.target.files;

            var done = function(url3) {
                image3.src = url3;
                $modal3.modal('show');
            };

            if (files3 && files3.length > 0) {
                reader3 = new FileReader();
                reader3.onload = function(event) {
                    done(reader3.result);
                };
                reader3.readAsDataURL(files3[0]);
            }
        });
        $('#upload_image4').change(function(event) {
            var files4 = event.target.files;

            var done = function(url4) {
                image4.src = url4;
                $modal4.modal('show');
            };

            if (files4 && files4.length > 0) {
                reader4 = new FileReader();
                reader4.onload = function(event) {
                    done(reader4.result);
                };
                reader4.readAsDataURL(files4[0]);
            }
        });
        $('#upload_image5').change(function(event) {
            var files5 = event.target.files;

            var done = function(url5) {
                image5.src = url5;
                $modal5.modal('show');
            };

            if (files5 && files5.length > 0) {
                reader5 = new FileReader();
                reader5.onload = function(event) {
                    done(reader5.result);
                };
                reader5.readAsDataURL(files5[0]);
            }
        });
        $('#upload_image6').change(function(event) {
            var files6 = event.target.files;

            var done = function(url6) {
                image6.src = url6;
                $modal6.modal('show');
            };

            if (files6 && files6.length > 0) {
                reader6 = new FileReader();
                reader6.onload = function(event) {
                    done(reader6.result);
                };
                reader6.readAsDataURL(files6[0]);
            }
        });
        $('#upload_image7').change(function(event) {
            var files7 = event.target.files;

            var done = function(url7) {
                image7.src = url7;
                $modal7.modal('show');
            };

            if (files7 && files7.length > 0) {
                reader7 = new FileReader();
                reader7.onload = function(event) {
                    done(reader7.result);
                };
                reader7.readAsDataURL(files7[0]);
            }
        });
        $('#upload_image8').change(function(event) {
            var files8 = event.target.files;

            var done = function(url8) {
                image8.src = url8;
                $modal8.modal('show');
            };

            if (files8 && files8.length > 0) {
                reader8 = new FileReader();
                reader8.onload = function(event) {
                    done(reader8.result);
                };
                reader8.readAsDataURL(files8[0]);
            }
        });
        $modal1.on('shown.bs.modal', function() {
            cropper1 = new Cropper(image1, {
                aspectRatio: NaN,
                viewMode: 1,
                preview: '#preview1'
            });
        }).on('hidden.bs.modal', function() {
            cropper1.destroy();
            cropper1 = null;
        });
        $modal2.on('shown.bs.modal', function() {
            cropper2 = new Cropper(image2, {
                aspectRatio: NaN,
                viewMode: 1,
                preview: '#preview2'
            });
        }).on('hidden.bs.modal', function() {
            cropper2.destroy();
            cropper2 = null;
        });
        $modal3.on('shown.bs.modal', function() {
            cropper3 = new Cropper(image3, {
                aspectRatio: NaN,
                viewMode: 1,
                preview: '#preview3'
            });
        }).on('hidden.bs.modal', function() {
            cropper3.destroy();
            cropper3 = null;
        });
        $modal4.on('shown.bs.modal', function() {
            cropper4 = new Cropper(image4, {
                aspectRatio: NaN,
                viewMode: 1,
                preview: '#preview4'
            });
        }).on('hidden.bs.modal', function() {
            cropper4.destroy();
            cropper4 = null;
        });
        $modal5.on('shown.bs.modal', function() {
            cropper5 = new Cropper(image5, {
                aspectRatio: NaN,
                viewMode: 1,
                preview: '#preview5'
            });
        }).on('hidden.bs.modal', function() {
            cropper5.destroy();
            cropper5 = null;
        });
        $modal6.on('shown.bs.modal', function() {
            cropper6 = new Cropper(image6, {
                aspectRatio: NaN,
                viewMode: 1,
                preview: '#preview6'
            });
        }).on('hidden.bs.modal', function() {
            cropper6.destroy();
            cropper6 = null;
        });
        $modal7.on('shown.bs.modal', function() {
            cropper7 = new Cropper(image7, {
                aspectRatio: NaN,
                viewMode: 1,
                preview: '#preview7'
            });
        }).on('hidden.bs.modal', function() {
            cropper7.destroy();
            cropper7 = null;
        });
        $modal8.on('shown.bs.modal', function() {
            cropper8 = new Cropper(image8, {
                aspectRatio: NaN,
                viewMode: 1,
                preview: '#preview8'
            });
        }).on('hidden.bs.modal', function() {
            cropper8.destroy();
            cropper8 = null;
        });

        $('#crop1').click(function() {
            canvas1 = cropper1.getCroppedCanvas({
                width: 1920,
                height: 1920
            });

            canvas1.toBlob(function(blob1) {
                url1 = URL.createObjectURL(blob1);
                var reader1 = new FileReader();
                reader1.readAsDataURL(blob1);
                reader1.onloadend = function() {
                    var base64data1 = reader1.result;
                    var tipo1 = 'dni_frontal';
                    var id1 = glob_idconductor;
                    $.ajax({
                        url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                        type: "post",
                        data: {
                            image: base64data1,
                            tipo: tipo1,
                            id: id1,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data1) {
                            var div1 = document.getElementById('load');
                            div1.style.display = 'none';
                            $modal1.modal('hide');
                            $('#uploaded_image1').attr('src', data1);
                            $('#imagen1').val(data1);
                        }
                    });
                };
            });
        });
        $('#crop2').click(function() {
            canvas2 = cropper2.getCroppedCanvas({
                width: 1920,
                height: 1920
            });

            canvas2.toBlob(function(blob2) {
                url2 = URL.createObjectURL(blob2);
                var reader2 = new FileReader();
                reader2.readAsDataURL(blob2);
                reader2.onloadend = function() {
                    var base64data2 = reader2.result;
                    var tipo2 = 'dni_posterior';
                    var id2 = glob_idconductor;
                    $.ajax({
                        url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                        type: "post",
                        data: {
                            image: base64data2,
                            tipo: tipo2,
                            id: id2,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data2) {
                            var div2 = document.getElementById('load');
                            div2.style.display = 'none';
                            $modal2.modal('hide');
                            $('#uploaded_image2').attr('src', data2);
                            $('#imagen2').val(data2);
                        }
                    });
                };
            });
        });
        $('#crop3').click(function() {
            canvas3 = cropper3.getCroppedCanvas({
                width: 1920,
                height: 1920
            });

            canvas3.toBlob(function(blob3) {
                url3 = URL.createObjectURL(blob3);
                var reader3 = new FileReader();
                reader3.readAsDataURL(blob3);
                reader3.onloadend = function() {
                    var base64data3 = reader3.result;
                    var tipo3 = 'licencia_delantera';
                    var id3 = glob_idconductor;
                    $.ajax({
                        url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                        type: "post",
                        data: {
                            image: base64data3,
                            tipo: tipo3,
                            id: id3,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data3) {
                            var div3 = document.getElementById('load');
                            div3.style.display = 'none';
                            $modal3.modal('hide');
                            $('#uploaded_image3').attr('src', data3);
                            $('#imagen3').val(data3);
                        }
                    });
                };
            });
        });
        $('#crop4').click(function() {
            canvas4 = cropper4.getCroppedCanvas({
                width: 1920,
                height: 1920
            });

            canvas4.toBlob(function(blob4) {
                url4 = URL.createObjectURL(blob4);
                var reader4 = new FileReader();
                reader4.readAsDataURL(blob4);
                reader4.onloadend = function() {
                    var base64data4 = reader4.result;
                    var tipo4 = 'licencia_posterior';
                    var id4 = glob_idconductor;
                    $.ajax({
                        url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                        type: "post",
                        data: {
                            image: base64data4,
                            tipo: tipo4,
                            id: id4,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data4) {
                            var div4 = document.getElementById('load');
                            div4.style.display = 'none';
                            $modal4.modal('hide');
                            $('#uploaded_image4').attr('src', data4);
                            $('#imagen4').val(data4);
                        }
                    });
                };
            });
        });
        $('#crop5').click(function() {
            canvas5 = cropper5.getCroppedCanvas({
                width: 1920,
                height: 1920
            });

            canvas5.toBlob(function(blob5) {
                url5 = URL.createObjectURL(blob5);
                var reader5 = new FileReader();
                reader5.readAsDataURL(blob5);
                reader5.onloadend = function() {
                    var base64data5 = reader5.result;
                    var tipo5 = 'soat';
                    var id5 = glob_idconductor;
                    $.ajax({
                        url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                        type: "post",
                        data: {
                            image: base64data5,
                            tipo: tipo5,
                            id: id5,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data5) {
                            var div5 = document.getElementById('load');
                            div5.style.display = 'none';
                            $modal5.modal('hide');
                            $('#uploaded_image5').attr('src', data5);
                            $('#imagen5').val(data5);
                        }
                    });
                };
            });
        });
        $('#crop6').click(function() {
            canvas6 = cropper6.getCroppedCanvas({
                width: 1920,
                height: 1920
            });

            canvas6.toBlob(function(blob6) {
                url6 = URL.createObjectURL(blob6);
                var reader6 = new FileReader();
                reader6.readAsDataURL(blob6);
                reader6.onloadend = function() {
                    var base64data6 = reader6.result;
                    var tipo6 = 't_v_propiedad_delantero';
                    var id6 = glob_idconductor;
                    $.ajax({
                        url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                        type: "post",
                        data: {
                            image: base64data6,
                            tipo: tipo6,
                            id: id6,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data6) {
                            var div6 = document.getElementById('load');
                            div6.style.display = 'none';
                            $modal6.modal('hide');
                            $('#uploaded_image6').attr('src', data6);
                            $('#imagen6').val(data6);
                        }
                    });
                };
            });
        });
        $('#crop7').click(function() {
            canvas7 = cropper7.getCroppedCanvas({
                width: 1920,
                height: 1920
            });

            canvas7.toBlob(function(blob7) {
                url7 = URL.createObjectURL(blob7);
                var reader7 = new FileReader();
                reader7.readAsDataURL(blob7);
                reader7.onloadend = function() {
                    var base64data7 = reader7.result;
                    var tipo7 = 't_v_propiedad_posterior';
                    var id7 = glob_idconductor;
                    $.ajax({
                        url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                        type: "post",
                        data: {
                            image: base64data7,
                            tipo: tipo7,
                            id: id7,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data7) {
                            var div7 = document.getElementById('load');
                            div7.style.display = 'none';
                            $modal7.modal('hide');
                            $('#uploaded_image7').attr('src', data7);
                            $('#imagen7').val(data7);
                        }
                    });
                };
            });
        });
        $('#crop8').click(function() {
            canvas8 = cropper8.getCroppedCanvas({
                width: 1920,
                height: 1920
            });

            canvas8.toBlob(function(blob8) {
                url8 = URL.createObjectURL(blob8);
                var reader8 = new FileReader();
                reader8.readAsDataURL(blob8);
                reader8.onloadend = function() {
                    var base64data8 = reader8.result;
                    var tipo8 = 'antecedentes_penales';
                    var id8 = glob_idconductor;
                    $.ajax({
                        url: 'https://iwork.pe/chapatutaxi/imgchapatutaxi.php',
                        type: "post",
                        data: {
                            image: base64data8,
                            tipo: tipo8,
                            id: id8,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data8) {
                            var div8 = document.getElementById('load');
                            div8.style.display = 'none';
                            $modal8.modal('hide');
                            $('#uploaded_image8').attr('src', data8);
                            $('#imagen8').val(data8);
                        }
                    });
                };
            });
        });

        function eliminarimagen(id_hidden, id_upload) {
            if (confirm("¿Desea eliminar esta imagen?") == true) {
                var hidden = '#' + id_hidden;
                var upload = '#' + id_upload;
                $(hidden).val(0);
                $(upload).attr("src", "https://iwork.pe/imagenes/imgqr/images.png");
            }
        }

        function documentosfn() {
            var id = glob_idconductor;
            var fecha_nac = $("#fecha_nac").val();
            var doc_identidad = $("#doc_personal").val();
            var doc_img_front = $("#imagen1").val();
            var doc_n = $("#ndni").val();
            var doc_img_back = $("#imagen2").val();
            var doc_fv = $("#fvdni").val();
            var licencia_img_front = $("#imagen3").val();
            var licencia_n = $("#nlicencia").val();
            var licencia_img_back = $("#imagen4").val();
            var licencia_fv = $("#fvlicencia").val();
            var soat_img = $("#imagen5").val();
            var soat_fv = $("#fvsoat").val();
            var tp_img_front = $("#imagen6").val();
            var tp_img_back = $("#imagen7").val();
            var antp_img = $("#imagen8").val();
            var rt_fv = $("#frev_t").val();
            var cert_tipo = $("#glpgnv").val();
            var cert_fv = $("#frev_c").val();
            $.ajax({
                url: 'agregar_documentos.php',
                type: "post",
                data: {
                    id: id,
                    fecha_nac:fecha_nac,
                    doc_identidad: doc_identidad,
                    doc_img_front: doc_img_front,
                    doc_n: doc_n,
                    doc_img_back: doc_img_back,
                    doc_fv: doc_fv,
                    licencia_img_front: licencia_img_front,
                    licencia_n: licencia_n,
                    licencia_img_back: licencia_img_back,
                    licencia_fv: licencia_fv,
                    soat_img: soat_img,
                    soat_fv: soat_fv,
                    tp_img_front: tp_img_front,
                    tp_img_back: tp_img_back,
                    antp_img: antp_img,
                    rt_fv: rt_fv,
                    cert_tipo: cert_tipo,
                    cert_fv: cert_fv,
                },
                beforeSend: function() {
                    $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                },
                /* */
                success: function(data) {
                    var div = document.getElementById('load');
                    div.style.display = 'none';
                    $('#exampledocumentos').modal('hide');
                    /* */
                }
            });
        }

        function notificar() {
            let text = "¿Deseas enviar este mensaje?";
            let ti = "prueba";
            let de = "hola";
            let accion = "co";


            if (confirm(text) == true) {
                $.ajax({
                    type: 'POST',
                    url: './server_process_alertas.php',
                    data: {
                        accion: accion,
                        t: ti,
                        d: de,
                    },
                    success: function(response2) {

                        var table3 = $('#example').dataTable();
                        table3.fnReloadAjax('server_process_conductores.php');
                        table3.fnReloadAjax();
                    }
                });
            }
        };

        function eliminar_conductor(id_p, id_pa) {
            let text = "¡Advertencia!\n" +
                "Eliminar este conductor:\n" +
                "1. Sin historial de solicitudes: Se borrarán todos sus datos.\n" +
                "2. Con historial de solicitudes: Los datos se asignarán a 'Vespro Tech' antes de borrarlos.\n" +
                "Nunca modificar o eliminar 'Vespro Tech.'\n" +
                "Si aceptas eliminar al conductor, esta acción será irreversible.'\n" +
                "¿Deseas continuar con la eliminación?";
            if (confirm(text) == true) {
                $.ajax({
                    type: 'POST',
                    url: './eliminar_conductor.php',
                    data: {
                        id_pe: id_p,
                        id_pa: id_pa,
                    },
                    success: function(response2) {

                        var table3 = $('#example').dataTable();
                        table3.fnReloadAjax('server_process_conductores.php');
                        table3.fnReloadAjax();
                    }
                });
            } else {
                //
            }
        }
    </script>

</html>