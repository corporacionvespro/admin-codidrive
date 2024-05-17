<html>
<?php require_once './view/admin/header.php'; ?>
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<?php $var = "admin"; ?>
<script src="https://unpkg.com/cropperjs"></script>
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
</style>
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
        /*width: 160px;
        height: 160px;*/
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
        /*width: 300px;
            height: 300px;width: 842,
                height: 312*/
        width: 842px;
        height: 312px;
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
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">campaña</h6>
                </div>
            </div>
        </div>
    </div>
</div>
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
                            <div id="preview" class="preview" style="width: 330px;height: 330px;margin-left: -11px;border: none;/* margin-right: auto; *//* position: relative; */">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #d50000;border: solid 1px #d50000;" data-dismiss="modal">
                <input type="button" id="crop" name="crop" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #d50000;border: solid 1px #d50000;">

            </div>
        </div>
    </div>
</div>
<!-- modal -->
<!-- modal -->
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #d50000;border: solid 1px #d50000;" data-dismiss="modal">
                <input type="button" id="crop2" name="crop2" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #d50000;border: solid 1px #d50000;">
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<!-- modal -->
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
                <input type="button" id="" name="" class="form-control form-control-sm btn" value="Cancelar" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #d50000;border: solid 1px #d50000;" data-dismiss="modal">
                <input type="button" id="crop3" name="crop3" class="form-control form-control-sm btn" value="Guardar cambios" style="height: 51px;background: #f1e0e0;margin-top: 21px;border-radius: 25px;color: #d50000;border: solid 1px #d50000;">

            </div>
        </div>
    </div>
</div>
<!-- modal -->
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card" style="margin: 0 0 0 0;">
                <div class="card-body">
                    <!----->
                    <input type="hidden" name="imagen1" id="imagen1" class="form-control" placeholder="" value="0">
                    <div class="image_area">
                        <label for="upload_image" style="width: 100%;">
                            <img style="border-color: burlywood;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image" class="img-responsive img-circle" style="border-radius: 50%;border-color: burlywood;border: solid 4px;" />
                            <div class="overlay">
                                <div class="text">
                                    Haga clic para cambiar la imagen
                                </div>
                            </div>
                            <input type="file" name="image" class="image" id="upload_image" style="display:none" />
                        </label>
                    </div>
                    <!----->
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card" style="margin: 0 0 0 0;">
                <div class="card-body">
                    <input type="hidden" name="imagen2" id="imagen2" class="form-control" placeholder="" value="0">
                    <div class="image_area">
                        <label for="upload_image2" style="width: 100%;">
                            <img style="border-color: burlywood;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image2" class="img-responsive img-circle" style="border-radius: 50%;border-color: burlywood;border: solid 4px;" />
                            <div class="overlay">
                                <div class="text">
                                    Haga clic para cambiar la imagen
                                </div>
                            </div>
                            <input type="file" name="image2" class="image" id="upload_image2" style="display:none" />
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
            <div class="card" style="margin: 0 0 0 0;">
                <div class="card-body">
                    <input type="hidden" name="imagen3" id="imagen3" class="form-control" placeholder="" value="0">
                    <div class="image_area">
                        <label for="upload_image3" style="width: 100%;">
                            <img style="border-color: burlywood;border: solid 4px;position: relative;margin-left: auto;margin-right: auto;" src="https://iwork.pe/imagenes/imgqr/images.png" id="uploaded_image3" class="img-responsive img-circle" style="border-radius: 50%;border-color: burlywood;border: solid 4px;" />
                            <div class="overlay">
                                <div class="text">
                                    Haga clic para cambiar la imagen
                                </div>
                            </div>
                            <input type="file" name="image3" class="image" id="upload_image3" style="display:none" />
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require_once './view/admin/footer.php'; ?>
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
    <script>
        $(document).ready(function() {
            $(function() {
                $("#example").DataTable({

                    "responsive": true,
                    "autoWidth": false,
                    "order": [0, 'DESC'],
                    "pageLength": 25,

                    language: {
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

                        dom: 'lBfrtip',
                        buttons: [{
                                extend: 'excelHtml5',
                                text: '<i class="fas fa-file-excel"></i> ',
                                titleAttr: 'Exportar a Excel',
                                className: 'btn btn-success'
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fas fa-file-pdf"></i> ',
                                titleAttr: 'Exportar a PDF',
                                className: 'btn btn-danger'
                            },
                            {
                                extend: 'print',
                                text: '<i class="fa fa-print"></i> ',
                                titleAttr: 'Imprimir',
                                className: 'btn btn-info'
                            },
                        ]
                    }
                });

            });
        });
        ///////// imagenes//////////
        var $modal = $('#modal');
        var $modal2 = $('#modal2');
        var $modal3 = $('#modal3');

        var image = document.getElementById('sample_image');
        var image2 = document.getElementById('sample_image2');
        var image3 = document.getElementById('sample_image3');

        var cropper;
        var cropper2;
        var cropper3;

        $('#upload_image').change(function(event) {
            var files = event.target.files;

            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
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

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 16 / 6,
                viewMode: 1,
                preview: '#preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $modal2.on('shown.bs.modal', function() {
            cropper2 = new Cropper(image2, {
                aspectRatio: 16 / 6,
                viewMode: 1,
                preview: '#preview2'
            });
        }).on('hidden.bs.modal', function() {
            cropper2.destroy();
            cropper2 = null;
        });
        $modal3.on('shown.bs.modal', function() {
            cropper3 = new Cropper(image3, {
                aspectRatio: 16 / 6,
                viewMode: 1,
                preview: '#preview3'
            });
        }).on('hidden.bs.modal', function() {
            cropper3.destroy();
            cropper3 = null;
        });

        $('#crop').click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 842,
                height: 312
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    var tipo = 'productos';
                    var id = id_tienda;
                    $.ajax({
                        url: 'https://iwork.pe/imagenes/uploadtienda.php',
                        type: "post",
                        data: {
                            image: base64data,
                            tipo: tipo,
                            id: id,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data) {
                            var div = document.getElementById('load');
                            div.style.display = 'none';
                            $modal.modal('hide');
                            $('#uploaded_image').attr('src', data);
                            $('#imagen1').val(data);
                        }
                    });
                };
            });
        });
        $('#crop2').click(function() {
            canvas2 = cropper2.getCroppedCanvas({
                width: 842,
                height: 312
            });

            canvas2.toBlob(function(blob2) {
                url2 = URL.createObjectURL(blob2);
                var reader2 = new FileReader();
                reader2.readAsDataURL(blob2);
                reader2.onloadend = function() {
                    var base64data2 = reader2.result;
                    var tipo = 'productos';
                    var id = id_tienda;
                    $.ajax({
                        url: 'https://iwork.pe/imagenes/uploadtienda.php',
                        type: "post",
                        /*method:'POST',*/
                        data: {
                            image: base64data2,
                            tipo: tipo,
                            id: id,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data2) {
                            var div = document.getElementById('load');
                            div.style.display = 'none';
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
                width: 842,
                height: 312
            });

            canvas3.toBlob(function(blob3) {
                url3 = URL.createObjectURL(blob3);
                var reader3 = new FileReader();
                reader3.readAsDataURL(blob3);
                reader3.onloadend = function() {
                    var base64data3 = reader3.result;
                    var tipo = 'productos';
                    var id = id_tienda;
                    $.ajax({
                        url: 'https://iwork.pe/imagenes/uploadtienda.php',
                        type: "post",
                        /*method:'POST',*/
                        data: {
                            image: base64data3,

                            tipo: tipo,
                            id: id,
                        },
                        beforeSend: function() {
                            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
                        },
                        success: function(data3) {
                            var div = document.getElementById('load');
                            div.style.display = 'none';
                            $modal3.modal('hide');
                            $('#uploaded_image3').attr('src', data3);
                            $('#imagen3').val(data3);
                        }
                    });
                };
            });
        });
    </script>

</html>