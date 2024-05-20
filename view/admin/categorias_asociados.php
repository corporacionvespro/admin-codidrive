<html>
<?php // require_once 'conectar.php'; 
?>
<?php require_once './view/admin/header.php'; ?>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $var = "cat_asociados"; ?>
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
    background-color: #50129c;
    color: white;
}

th.dt-center,
td.dt-center {
    text-align: center;
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
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div id="mensaje"></div>
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card">
                <form enctype="multipart/form-data" id="" method="post">
                    <div class="card-body px-lg-4 py-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container">
                                    <h1 style="text-align: center;text-transform: uppercase;color: #50009f;">Registrar
                                    ICONO</h1>
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
                        <h6 class="heading-small text-center mb-4">Registrar Categor&iacute;a</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="example2cols1Input">Detalle</label>
                                    <input type="text" id="detalle" name="detalle" class="form-control" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto" style="color:#50009f;border:solid 1px #50009f;"
                            data-dismiss="modal">Cancelar</button>
                        <button id="guardarmonto" type="button" class="btn ml-auto"
                            style="color:#fff;background: #50009f;border: #50009f;"
                            onclick="regcat();">Registrar</button>
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
                <div class="col-lg-12 col-12"
                    style="text-align: center;background: none;height: 59px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;border-radius: 50px;">
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">CATEGOR&Iacute;AS DE
                        NEGOCIOS ASOCIADOS</h6>
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
                        <button class="boton-save" style="margin-right: 5px;"
                            onclick="datos('agregar',0,0,0,'https:\/\/chapatutaxi.com/admin/assets/img/brand/logo.png');">
                            <i class="fas fa-plus-circle"></i> Registrar categoria de negocio
                        </button>
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
                                    <th>Icono</th>
                                    <th>Nombre</th>
                                    <th>Detalle</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Icono</th>
                                    <th>Nombre</th>
                                    <th>Detalle</th>
                                    <th>Editar</th>
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
                "sAjaxSource": "server_process_categorias_asociados.php",
            });

        });
    });

    ids = '';
    valores = '';

    function regcat() {
        var imagenInput = document.getElementById('foto2');
        var imagen = imagenInput.files[0];

        if (imagen) {
            var lector = new FileReader();
            lector.onload = function(evento) {
                var contenido = evento.target.result;
                var base64 = contenido.split(',')[1]; // Remover "data:image/jpeg;base64,"

                $.ajax({
                    type: "POST",
                    url: "https://iwork.pe/chapatutaxi/categorias_asociados/upbase64.php",
                    data: {
                        imagen_base64: base64
                    },
                    success: function(response) {
                        console.log("Imagen subida correctamente.<br>URL de la imagen: " + response);
                        if (valores == 'agregar') {
                            nombre = $("#nombre").val();
                            detalle = $("#detalle").val();
                            icono = response;
                            $.ajax({
                                type: "POST",
                                url: "agregar_categoria_asociado.php",
                                data: {
                                    nombre: nombre,
                                    detalle: detalle,
                                    icono: icono
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
                                    table2.fnReloadAjax(
                                        'server_process_categorias_asociados.php');
                                    table2.fnReloadAjax(); 
                                    $('#exampleModal3').modal('hide');
                                }
                            });
                        } else {
                            nombre = $("#nombre").val();
                            detalle = $("#detalle").val();
                            icono = response;
                            $.ajax({
                                type: "POST",
                                url: "editar_categoria_asociado.php",
                                data: {
                                    nombre: nombre,
                                    detalle: detalle,
                                    icono: icono,
                                    id: ids
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
                                    table2.fnReloadAjax(
                                        'server_process_categorias_asociados.php');
                                    table2.fnReloadAjax(); /**/
                                    $('#exampleModal3').modal('hide');
                                }
                            });
                        }
                    }
                });
            };
            lector.readAsDataURL(imagen);
        } else {
            if (valores == 'agregar') {
                nombre = $("#nombre").val();
                detalle = $("#detalle").val();
                icono = 'https://codidrive.com/admin/assets/img/brand/logo.png';
                $.ajax({
                    type: "POST",
                    url: "agregar_categoria_asociado.php",
                    data: {
                        nombre: nombre,
                        detalle: detalle,
                        icono: icono
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
                        table2.fnReloadAjax('server_process_categorias_asociados.php');
                        table2.fnReloadAjax(); /**/
                        $('#exampleModal3').modal('hide');
                    }
                });
            } else {
                nombre = $("#nombre").val();
                detalle = $("#detalle").val();
                icono = 'https://codidrive.com/admin/assets/img/brand/logo.png';
                $.ajax({
                    type: "POST",
                    url: "editar_categoria_asociado.php",
                    data: {
                        nombre: nombre,
                        detalle: detalle,
                        icono: icono,
                        id: ids
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
                        table2.fnReloadAjax(
                            'server_process_categorias_asociados.php');
                        table2.fnReloadAjax(); /**/
                        $('#exampleModal3').modal('hide');
                    }
                });
            }
            console.error('Por favor selecciona una imagen.');
        }
    }

    function datos(val, id, nombre, detalle, icon) {
        valores = val;
        if (val == 'agregar') {
            $("#nombre").val('');
            $('#detalle').val('');
            $('#imagePreview2').css('background-image', 'url(https://codidrive.com/admin/assets/img/brand/logo.png)');
            $('#imagePreview2').hide();
            $('#imagePreview2').fadeIn(650);
            $('#exampleModal3').modal('show');
        } else {
            ids = id;
            $("#nombre").val(nombre);
            $('#detalle').val(detalle);
            $('#imagePreview2').css('background-image', 'url(' + icon + ')');
            $('#imagePreview2').hide();
            $('#imagePreview2').fadeIn(650);
            $('#exampleModal3').modal('show');
        }
    }

    function eliminar_cat_asociado(id) {
        let text = "Antes de eliminar la categoria, verificar que no tenga negocios asociados a esta";

        if (confirm(text) == true) {
            $.ajax({
                type: 'POST',
                url: 'eliminar_categoria_asociado.php',
                data: {
                    id: id
                },
                success: function(response2) {

                    var table3 = $('#example').dataTable();
                    table3.fnReloadAjax('server_process_categorias_asociados.php');
                    table3.fnReloadAjax();
                }
            });
        }
    }
    $("#foto2").change(function() {
        readURL2(this);
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
    </script>

</html>