<html>
<?php // require_once 'conectar.php'; 
?>
<?php require_once './view/admin/header.php'; ?>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

<?php $var = "operaciones"; ?>
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

    .daterangepicker .ranges li.active {
        background-color: #01296e;
        color: #fff;
    }

    .daterangepicker td.active,
    .daterangepicker td.active:hover {
        background-color: #01296e;
        border-color: transparent;
        color: #fff;
    }

    .daterangepicker td.in-range {
        background-color: #ecdcff;
        border-color: transparent;
        color: #000;
        border-radius: 0;
    }

    .daterangepicker td.in-range.active.end-date.in-range.available {
        background-color: #01296e;
        border-color: transparent;
        color: #fff;
        border-radius: 0 5px 5px 0;
    }

    .daterangepicker td.available:hover,
    .daterangepicker th.available:hover {
        background-color: #01296e;
        border-color: transparent;
        color: #fff;
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

        .daterangepicker.show-calendar .drp-buttons {
            display: flex;
            justify-content: space-around;
        }

        .daterangepicker.show-calendar .drp-selected {
            text-align: start;
        }
    }

    #map {
        height: 40rem;
    }

    .leaflet-control-attribution {
        display: none;
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
<div id="mensaje"></div>
<!-- Header -->
<div class="header bg-primary pb-6" style="background: #01296e !important;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4" style="margin-left: 5px;margin-right: 5px;">
                <div class="col-lg-12 col-12" style="text-align: center;background: none;height: 59px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;border-radius: 50px;">
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">Operaciones en Línea de tiempo</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow" style="background: linear-gradient(87deg, #5e14ba 0, #5f18ba 100%) !important;">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0 text-white">Cantidad de operaciones: <span id="cantidad"></span></h3>
                </div><!-- -->
                <div class="card-header bg-transparent">
                    <input type="hidden" id="search" name="search">
                    <div id="reportrange" style="background: #fff;cursor: pointer;padding: 5px 10px;border: 1px solid #fff;width: 100%;text-align: center;border-radius: 25px;color: #01296e;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                    <input type="hidden" name="r_filtro" id="r_filtro" value="0">
                    <input type="hidden" name="inicio" id="inicio" value="">
                    <input type="hidden" name="final" id="final" value="">
                </div>
                <div class="card-body" id="tb_line">

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
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
            moment.locale('es');
            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                document.getElementById('inicio').value = start.format('YYYY/MM/DD');
                document.getElementById('final').value = end.format('YYYY/MM/DD');
                $("#search").trigger("click");
            }
            moment.locale('es');
            $('#reportrange').daterangepicker({
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " - ",
                    "applyLabel": "Guardar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "Hasta",
                    "customRangeLabel": "Personalizar",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Setiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                },
                startDate: start,
                endDate: end,
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Los últimos 7 días': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                    'Este mes': [moment().startOf('month'), moment().endOf('month')],
                    'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "opens": "center",
            }, cb);
            cb(start, end);
        })
    })

    function cargartbline() {
        inicio = $("#inicio").val();
        final = $("#final").val();
        $.ajax({
            data: {
                inicio: inicio,
                final: final,
            },
            url: './server_process_tabline.php',
            type: "post",
            beforeSend: function() {
                $("#mensaje").html('<div id="load" class="loader"><div style="width: 100%;height: 100%;display: block;"></div></div>');
            },
            success: function(response) {
                var json2 = JSON.parse(response);
                var div = document.getElementById('load');
                div.style.display = 'none';
                $("#tb_line").html(json2[0].tab);
                $("#cantidad").html(json2[0].count);
            },
        });
    }
    $("#search").click(function() {
        cargartbline();
    });
    cargartbline();
</script>

</html>