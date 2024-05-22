<html>
<?php // require_once 'conectar.php'; 
?>
<?php require_once './view/admin/header.php'; ?>
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />

<script src="https://unpkg.com/cropperjs"></script>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $var = "cumple"; ?>
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
        border-top: 1px solid #501a99;
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
        background-color: #4f119b;
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
        background: url('https://chapatutaxi.com/admin/imagenes/loader.gif') 50% 50% no-repeat #e2ecf2;
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
        background-color: #01296e;
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

<!-- Header -->
<div id="mensaje"></div>

<div class="header bg-primary pb-6" style="background: #01296e !important;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4" style="margin-left: 5px;margin-right: 5px;">
                <div class="col-lg-12 col-12" style="text-align: center;background: none;height: 59px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;border-radius: 50px;">
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">CUMPLEAÑOS DE CONDUCTORES</h6>
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
                        <form method="POST" action="create_excel_cumple.php">
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
                        </style>
                        <table id="example" class="table table-bordered table-striped dataTable dtr-inline" role="grid">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Fotos</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>DNI</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Fotos</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>DNI</th>
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
        $(document).ready(function() {
            $(function() {
                $("#example").DataTable({

                    "responsive": true,
                    "autoWidth": false,
                    "order": [0, 'DESC'],
                    "pageLength": 25,
                    /*"columnDefs": [{
                        "className": "dt-center",
                        "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }],*/
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
                    "sAjaxSource": "server_process_cumple.php",
                });

            });
        });
    </script>

</html>