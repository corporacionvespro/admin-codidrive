<html>
<?php // require_once 'conectar.php'; 
?>
<?php require_once './view/admin/header.php'; ?>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $var = "estconductores"; ?>
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
hr {
    border-top: 1px solid #01296e;
}

.dataTables_length {
    display: none;
}

.select-items div:hover,
.same-as-selected {
    background-color: #01296e;
}

.custom-toggle-slider {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    cursor: pointer;
    border: 1px solid #01296e;
    border-radius: 34px !important;
    background-color: transparent;
}

.custom-toggle-slider:before {
    position: absolute;
    bottom: 2px;
    left: 2px;
    width: 18px;
    height: 18px;
    content: '';
    transition: all .15s cubic-bezier(.68, -.55, .265, 1.55);
    border-radius: 50% !important;
    background-color: #01296e;
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
            background-color: #01296e;
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

    .textomodal {
        font-size: 14px;
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
    color: #01296e;
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
    color: #01296e !important;
    font-size: 0.95rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
    letter-spacing: .04em;
    text-transform: uppercase;
}

.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('https://codidrive.com/admin/imagenes/loader.gif') 50% 50% no-repeat #e2ecf2;
    opacity: .8;
}


.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #e0e2e9;
    border-radius: 4px;
    height: 51px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #b9c0c7;
    line-height: 28px;
}

.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background-color: #01296e;
    color: white;
}

th.dt-center,
td.dt-center {
    text-align: center;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


<div class="modal fade" id="exampledesbloquear" tabindex="-1" aria-labelledby="exampledatosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="">
                <form enctype="multipart/form-data" id="" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <h6 class="heading-small text-center mb-4">Recargar cuenta del conductor</h6>

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
                                            <option value="Banco de Crédito del Perú (BCP)">Banco de Crédito del Perú
                                                (BCP)</option>
                                            <option value="BBVA">BBVA</option>
                                            <option value="Banco Interamericano de Finanzas (BanBif)">Banco
                                                Interamericano de Finanzas (BanBif)</option>
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
                                            <option value="TOTAL, Servicios Financieros">TOTAL, Servicios Financieros
                                            </option>
                                        </optgroup>
                                        <optgroup label="Bancos de Inversión">
                                            <option value="J.P. Morgan Banco de Inversión">J.P. Morgan Banco de
                                                Inversión</option>
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
                                    <input type="text" id="detalleact" name="detalleact" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Monto</label>
                                    <input type="number" id="monto" step="0.01" name="monto" class="form-control"
                                        placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Porcentaje</label>
                                    <input type="number" step="0.01" id="porcentaje" name="porcentaje"
                                        class="form-control" placeholder="" autocomplete="off" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha inicio</label>
                                    <input type="date" id="f_inicio" name="f_inicio" class="form-control" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Días</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="dias" name="dias" class="form-control"
                                            onclick="bloqcon();" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="button" id="calcular2"
                                                data-toggle="tooltip" data-placement="top" title="Calcular fecha"
                                                onclick="c_fechas();"><i class="fas fa-calendar-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Fecha final</label>
                                    <div class="input-group mb-3">
                                        <input type="date" id="f_final" name="f_final" class="form-control"
                                            onclick="bloqcon();" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="button" id="calcular1"
                                                data-toggle="tooltip" data-placement="top" title="Calcular días"
                                                onclick="c_dias();"><i class="fas fa-calendar-alt"></i></button>
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
                        <button type="button" class="btn mr-auto" style="color:#01296e;border:solid 1px #01296e;"
                            data-dismiss="modal">Cancelar</button>
                        <button id="guardarmonto" type="button" class="btn ml-auto"
                            style="display:none;color:#fff;background: #01296e;border: #01296e;"
                            onclick="regsaldo();">Recargar cuenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Header -->
<div id="mensaje"></div>
<div class="header bg-primary pb-6" style="background: #01296e !important;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4" style="margin-left: 5px;margin-right: 5px;">
                <div class="col-lg-12 col-12"
                    style="text-align: center;background: none;height: 59px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;border-radius: 50px;">
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">SALDO DE CONDUCTORES</h6>
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
                        background: #01296e;
                        color: #fff;
                        border: none;
                        /*margin-left: 7px;*/
                    }

                    .boton-save:hover {
                        color: #fff;
                        text-decoration: none;
                    }
                    </style>

                    <div class="col-md-12" style="display: flex;justify-content: space-between;">
                        <!--<button class="boton-save" style="margin-right: 5px;" onclick="datos();">
                            <i class="fas fa-plus-circle"></i> Registrar conductor
                        </button>
                         <button class="boton-save" style="width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;">
                            <i class="fas fa-bell"></i>
                        </button>-->
                        <form method="POST" action="create_excel_sald_cond.php">
                            <button class="boton-save" style="margin-right: 5px;">
                                <i class="fas fa-file-excel"></i> Exportar a Excel
                            </button>
                        </form>
                    </div>


                </div>
                <div class="card-body">

                    <div class="table-responsive py-4">
                        <style>
                        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child,
                        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child {

                            position: relative;
                            padding-left: 72px;

                        }

                        /* table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before,
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
                                background-color: #01296e;
                            }*/
                        </style>
                        <table id="example" class="table table-bordered table-striped dataTable dtr-inline" role="grid">
                            <thead>
                                <tr>
                                    <!--<th>Foto</th>-->
                                    <th>Nombre</th>
                                    <th>Unidad</th>
                                    <th>Telefono</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th>F. Vence</th>
                                    <th>M. periodo</th>
                                    <th>P. d&iacute;as</th>
                                    <th>M. d&iacute;a</th>
                                    <th>Recargar</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <!--<th>Foto</th>-->
                                    <th>Nombre</th>
                                    <th>Unidad</th>
                                    <th>Telefono</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th>F. Vence</th>
                                    <th>M. periodo</th>
                                    <th>P. d&iacute;as</th>
                                    <th>M. d&iacute;a</th>
                                    <th>Recargar</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once './view/admin/footer.php'; ?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
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

    <script>
    var today = new Date();
    var day = ("0" + today.getDate()).slice(-2);
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    var year = today.getFullYear();
    var todayFormatted = year + "-" + month + "-" + day;
    document.getElementById("f_inicio").setAttribute("min", todayFormatted);
    document.getElementById("f_final").setAttribute("min", todayFormatted);

    function validarPorcentaje() {
        var porcentajeInput = document.getElementById("porcentaje");
        if (porcentajeInput.value < 0) {
            porcentajeInput.value = 0;
            $("#calcular1").prop("disabled", false);
            $('#f_final').prop('disabled', false);
            $('#dias').prop('disabled', false);
            $("#dias").val("");
            $('#calcular1').attr('data-original-title', 'Calcular días');
        } else {
            $("#calcular1").prop("disabled", true);
            $("#f_final").prop("disabled", true);
            $("#dias").prop("disabled", true);
            $("#dias").val("365");
            $('#calcular1').attr('data-original-title', 'Bloqueado');
        }
    }

    function validarmonto() {
        var montoInput = document.getElementById("monto");
        if (montoInput.value < 0) {
            montoInput.value = 0;
        }
    }

    function validardias() {
        var diasInput = document.getElementById("dias");
        if (diasInput.value < 0) {
            diasInput.value = 0;
        }
    }

    document.getElementById("porcentaje").addEventListener("keyup", validarPorcentaje);
    document.getElementById("monto").addEventListener("keyup", validarmonto);
    document.getElementById("dias").addEventListener("keyup", validardias);




    var tipo_opreacion = '';
    var metodo_pago = '';
    var tipo_pago = '';
    ////////////////////////////////////
    var idpersonas = '';
    var idcuentas = '';
    var idvehiculos = '';
    ////////////////////////////////////
    var idconductore = '';
    var valores = '';
    var glob_fecha_notf = '';
    var glob_xdias2 = '';
    var glob_monto2 = '';
    var glob_f_final = '';
    var glob_f_inicio = '';
    var glob_dias = '';
    var glob_detalleact = '';

    $(document).ready(function() {
        $(function() {
            $("#example").DataTable({

                "responsive": true,
                "autoWidth": false,
                "order": [0, 'DESC'],
                "pageLength": 25,
                "columnDefs": [{
                    "className": "dt-center",
                    "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9]
                }],
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
                "sAjaxSource": "server_process_estadisconductores.php",
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

    function datos() {
        $('#exampleModal3').modal('show');
    }


    $("#formuploadajax").on("submit", function(e) {
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formuploadajax"));
        formData.append("dato", "valor");
        //formData.append(f.attr("name"), $(this)[0].files[0]);
        $.ajax({
                url: "https://codidrive.com/codi/api/driver",
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

        var form = new FormData();
        form.append("clave", clave);
        form.append("correo", correo);
        form.append("id_cuenta", idcuentas);
        form.append("id_persona", idpersonas);
        form.append("nombres", nombres);
        form.append("telefono", telefono);

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
            table2.fnReloadAjax('server_process_estadisconductores.php');
            table2.fnReloadAjax();
            $('#exampledatos').modal('hide');
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
            var url = 'https://codidrive.com/codiapi/images/' + json2.conductor.foto;
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
            table2.fnReloadAjax('server_process_estadisconductores.php');
            table2.fnReloadAjax();
            $('#examplevehiculo').modal('hide');
        });
    }

    function cambiarestado3(id, estado) {
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
            table2.fnReloadAjax('server_process_estadisconductores.php');
            table2.fnReloadAjax();
        });
    }

    function cambiarestado2(id, estado, monto, periodo, hoy) {
        $("#monto").val(monto);
        $("#f_inicio").val(hoy);
        $("#f_final").val('');
        $("#dias").val(periodo);
        $("#detalleact").val('');
        $("#Deposito").val('');
        $("#states").val('');
        $("#s_bille").val('');
        $("#resuemn_general").css("display", "none");
        idconductore = id;
        valores = estado;
        $("#guardarmonto").css("display", "none");
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
            table2.fnReloadAjax('server_process_estadisconductores.php');
            table2.fnReloadAjax();
        });
        $('#exampledesbloquear').modal('hide');
    }

    function c_fechas() {
        var monto = parseFloat($("#monto").val());
        var fecha1 = $("#f_inicio").val();
        var dias_f = parseInt($("#dias").val());
        $("#f_final").val(moment(fecha1).add(dias_f, 'days').format('YYYY-MM-DD'));
        var fecha_f = $("#f_final").val();
        var not = moment(fecha_f).subtract(1, 'days').format('YYYY-MM-DD');
        var xdias = (monto / dias_f);
        resumen(not, xdias);
    }

    function c_dias() {
        var monto = parseFloat($("#monto").val());
        var fecha1 = $("#f_inicio").val();
        var fecha2 = $("#f_final").val();
        $("#dias").val(moment(fecha2).diff(moment(fecha1), 'days'));
        var dias_f = parseInt($("#dias").val());
        var not = moment(fecha2).subtract(1, 'days').format('YYYY-MM-DD')
        var xdias = (monto / dias_f);
        resumen(not, xdias);
    }

    function resumen(not, xdias) {
        var xdias2 = xdias.toLocaleString("es-PE", {
            style: "currency",
            currency: "PEN"
        });
        var monto = parseFloat($("#monto").val());
        var monto2 = monto.toLocaleString("es-PE", {
            style: "currency",
            currency: "PEN"
        });
        document.getElementById("cos").innerHTML = xdias2;
        document.getElementById("cost").innerHTML = monto2;
        document.getElementById("f_bloq").innerHTML = $("#f_final").val();
        document.getElementById("f_not").innerHTML = not;
        document.getElementById("f_activa").innerHTML = $("#f_inicio").val();
        document.getElementById("periodo").innerHTML = $("#dias").val();
        document.getElementById("detallecos").innerHTML = $("#detalleact").val();
        $("#resuemn_general").css("display", "block");
        $("#guardarmonto").css("display", "block");
        glob_fecha_notf = not;
        var newxdias = xdias2.slice(3)
        var newmonto = monto2.slice(3)
        glob_xdias2 = newxdias.replace(',', '');
        glob_monto2 = newmonto.replace(',', '');
        glob_f_final = $("#f_final").val();
        glob_f_inicio = $("#f_inicio").val();
        glob_dias = $("#dias").val();
        glob_detalleact = $("#detalleact").val();
    }

    function bloqcon() {
        $("#resuemn_general").css("display", "none");
        $("#guardarmonto").css("display", "none");
    }

    function actcon() {
        $("#resuemn_general").css("display", "block");
        $("#guardarmonto").css("display", "block");
    }

    function regsaldo() {
        if ($('#banc_efec').is(':checked')) {
            tipo_pago = 'efectivo';
            tipo_opreacion = 'efectivo';
            metodo_pago = 'efectivo';
        } else {
            tipo_pago = 'banco';
            tipo_opreacion = $("#Deposito").val();
            if (tipo_opreacion == 'Banca') {
                metodo_pago = $("#states").val();
            } else if (tipo_opreacion == '0') {
                metodo_pago = 'indefinido';
            } else {
                metodo_pago = $("#s_bille").val();
            }
        }
        $.ajax({
            type: "POST",
            url: "https://codidrive.com/admin/agregar_recarga.php",
            data: {
                id_conductores: idconductore,
                monto: glob_monto2,
                cantidad_dias: glob_dias,
                monto_dia: glob_xdias2,
                fecha_inicio: glob_f_inicio,
                fecha_final: glob_f_final,
                fecha_notificar: glob_fecha_notf,
                detalleact: glob_detalleact,
                metodo_pago: metodo_pago,
                tipo_pago: tipo_pago,
                tipo_opreacion: tipo_opreacion,
            },
            beforeSend: function() {
                $("#mensaje").html(
                    '<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>'
                );
            },
            success: function(result2) {
                var div = document.getElementById('load');
                div.style.display = 'none';
                var table2 = $('#example').dataTable();
                table2.fnReloadAjax('server_process_estadisconductores.php');
                table2.fnReloadAjax();
                $('#exampledesbloquear').modal('hide');
            }
        });
    }

    $('#states').select2();

    function cambiar_valor() {
        if ($('#banc_efec').is(':checked')) {
            $("#bille_div").css("display", "none");
            $("#banca_div").css("display", "none");
            $("#tipo_tranf").css("display", "none");
            document.getElementById("s_bille").value = "0";
            document.getElementById("Deposito").value = "0";
            document.getElementById("states").value = "0";
        } else {
            $("#tipo_tranf").css("display", "block");
            document.getElementById("s_bille").value = "0";
            document.getElementById("Deposito").value = "0";
            document.getElementById("states").value = "0";
        }
    }

    function mostrarselect(valor) {
        if (valor == 'Banca') {
            $("#bille_div").css("display", "none");
            $("#banca_div").css("display", "block");
            document.getElementById("s_bille").value = "0";
        } else if (valor == '0') {
            document.getElementById("states").value = "0";
            document.getElementById("s_bille").value = "0";
            $("#bille_div").css("display", "none");
            $("#banca_div").css("display", "none");
        } else {
            document.getElementById("states").value = "0";
            $("#bille_div").css("display", "block");
            $("#banca_div").css("display", "none");
        }
    }
    </script>

</html>