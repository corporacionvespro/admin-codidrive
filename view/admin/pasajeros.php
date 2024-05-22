<html>
<?php // require_once 'conectar.php'; 
?>
<?php require_once './view/admin/header.php'; ?>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<?php $var = "pasajeros"; ?>
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

    .estado_espera {
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

    .checkedstar {
        color: orange;
    }
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card">
                <form enctype="multipart/form-data" id="formuploadajax" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <h1 style="text-align: center;text-transform: uppercase;color: #01296e;">Registrar PASAJEROS</h1>
                                    <div class="avatar-upload" style="display:none;">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Nombre y Apellido</label>
                                    <input type="text" id="nombres" name="nombres" class="form-control" placeholder="" autocomplete="off">
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
                            <div class="col-md-6" id="div_clave">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Clave</label>
                                    <input type="text" id="clave" name="clave" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Correo</label>
                                    <input type="email" id="correo" name="correo" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#01296e;border:solid 1px #01296e;" data-dismiss="modal">Cancelar</button>
                        <button id="btnguardar" type="button" class="btn ml-auto" style="color:#fff;background: #01296e;border: #01296e;display:none;" onclick="guardarform()">Guardar</button>
                        <button id="btneditar" type="button" class="btn ml-auto" style="color:#fff;background: #01296e;border: #01296e; display:none;" onclick="editarform()">Editar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Header -->
<div class="header bg-primary pb-6" style="background: #01296e !important;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4" style="margin-left: 5px;margin-right: 5px;">
                <div class="col-lg-12 col-12" style="text-align: center;background: none;height: 59px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;border-radius: 50px;">
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">PASAJEROS</h6>
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
                        <button class="boton-save" style="margin-right: 5px;" onclick="datos();">
                            <i class="fas fa-plus-circle"></i> Registrar pasajero
                        </button>
                        <!-- <button class="boton-save" style="width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;" onclick="/*notificar()*/">
                            <i class="fas fa-bell"></i>
                        </button>-->
                        <form method="POST" action="create_excel_pasajeros.php">
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
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Ratings</th>
                                    <th>N° solicitudes</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Ratings</th>
                                    <th>N° solicitudes</th>
                                    <th>Eliminar</th>
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
                            "sPrevious": "<"
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
                    "sAjaxSource": "server_process_pasajero.php",
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
            $("#nombres").val('');
            $('#correo').val('');
            $('#telefono').val('');
            $('#clave').val('');
            $("#div_clave").css("display", "block");
            $("#btnguardar").css("display", "block");
            $("#btneditar").css("display", "none");
            $('#exampleModal3').modal('show');
        }


        var id_pasajero = '';
        var id_cuenta = '';
        var id_persona = '';

        function cargardatos(id) {
            $.ajax({
                type: 'POST',
                url: './server_process_pasajeros.php',
                data: {
                    id: id
                },
                success: function(response2) {
                    var json2 = JSON.parse(response2);
                    $("#nombres").val(json2[0].nombres);
                    $('#correo').val(json2[0].correo);
                    $('#telefono').val(json2[0].telefono);
                    id_pasajero = json2[0].id_pasajero;
                    id_cuenta = json2[0].id_cuenta;
                    id_persona = json2[0].id_persona;
                    $("#div_clave").css("display", "none");
                    $("#btnguardar").css("display", "none");
                    $("#btneditar").css("display", "block");
                    $('#exampleModal3').modal('show');
                }
            });
        }

        function guardarform() {
            var formData = new FormData(document.getElementById("formuploadajax"));
            formData.append("dato", "valor");
            $.ajax({
                    url: "https://codidrive.com/codi/api/passenger/register",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(res) {
                    window.location.href = './pasajeros';
                });
        }

        function editarform() {
            nombres = $("#nombres").val();
            correo = $('#correo').val();
            telefono = $('#telefono').val();

            var form = new FormData();
            form.append("nombres", nombres);
            form.append("correo", correo);
            form.append("telefono", telefono);
            form.append("id_persona", id_persona);
            form.append("id_cuenta", id_cuenta);

            var settings = {
                "url": "https://codidrive.com/codi/api/passenger/update",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function(response) {
                window.location.href = './pasajeros';
            });


        }

        function agregarpasajeroform() {

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
                        accion:accion,
                        t: ti,
                        d: de,
                    },
                    success: function(response2) {

                        var table3 = $('#example').dataTable();
                        table3.fnReloadAjax('server_process_pasajero.php');
                        table3.fnReloadAjax();
                    }
                });
            }
        };

        function eliminar_pasajero(id_p, id_pa) {
            let text = "¡Advertencia!\n" +
                "Eliminar este pasajero:\n" +
                "1. Sin historial de solicitudes: Se borrarán todos sus datos.\n" +
                "2. Con historial de solicitudes: Los datos se asignarán a 'Vespro Technology' antes de borrarlos.\n" +
                "Nunca modificar o eliminar 'Vespro Technology.'\n" +
                "Si aceptas eliminar al pasajero, esta acción será irreversible.'\n" +
                "¿Deseas continuar con la eliminación?";
            if (confirm(text) == true) {
                $.ajax({
                    type: 'POST',
                    url: './eliminar_pasajero.php',
                    data: {
                        id_pe: id_p,
                        id_pa: id_pa,
                    },
                    success: function(response2) {

                        var table3 = $('#example').dataTable();
                        table3.fnReloadAjax('server_process_pasajero.php');
                        table3.fnReloadAjax();
                    }
                });
            } else {
                //
            }
        }
    </script>

</html>