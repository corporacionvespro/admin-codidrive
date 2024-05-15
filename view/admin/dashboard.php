<html>
<?php require_once 'conectar.php';
?>
<?php require_once './view/admin/header.php'; ?>
<?php $var = "panel"; ?>
<?php
global $db;


$level = $_SESSION["level"];
//$level = 1;
if ($level == 1) {
  require_once './view/admin/menu_user.php';
} else if ($level == 2) {
  require_once './view/admin/menu_user.php';
} else if ($level == 3) {
  require_once './view/admin/menu_colaborador.php';
}

?>
<style>
  .card {
    margin-bottom: 26px;

  }

  .dataTables_length {
    display: none;
  }

  .table-responsive {

    overflow-x: hidden;

  }

  #example3_filter {
    display: none !important;
  }

  #example3_info {
    display: none !important;
  }

  #example3_paginate {
    display: none !important;
  }

  @media only screen and (min-device-width : 320px) and (max-device-width : 568px) {

    .card .table td,
    .card .table th {
      text-align: center;
      padding-right: 0.5rem;
      padding-left: 0.5rem;
    }

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

    .daterangepicker.show-calendar .drp-buttons {
      display: flex;
      justify-content: space-around;
    }

    .daterangepicker.show-calendar .drp-selected {
      text-align: start;
    }
  }
</style>

<?php
if ($level == "2" || $level == "3") {
?>
  <div class="header bg-primary pb-6" style="background: #132e62 !important;">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row">
          <div class="col-xl-12 col-md-12">
            <div class="card card-stats">
              <input type="hidden" id="search" name="search">
              <input type="hidden" name="r_filtro" id="r_filtro" value="0">
              <input type="hidden" name="inicio" id="inicio" value="">
              <input type="hidden" name="final" id="final" value="">
              <div id="reportrange" style="background: none;cursor: pointer;padding: 5px 10px;border: none;width: 100%;border-radius: 7px;text-align: center;">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Conductores</h5>
                    <span class="h2 font-weight-bold mb-0" id="nid_conductor"></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      <i class="ni ni-circle-08"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 100% </span>
                  <span class="text-nowrap">Total de conductores</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Pasajeros</h5>
                    <span class="h2 font-weight-bold mb-0" id="nid_pasajero"></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      <i class="ni ni-single-02"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 100% </span>
                  <span class="text-nowrap">Total de pasajeros</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Solicitudes Web</h5>
                    <span class="h2 font-weight-bold mb-0" id="nweb"></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="ni ni-laptop"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2" id="por_nweb"></span>
                  <span class="text-nowrap">de las solicitudes totales</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Solicitudes App</h5>
                    <span class="h2 font-weight-bold mb-0" id="napp"></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="ni ni-mobile-button"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2" id="por_napp"></span>
                  <span class="text-nowrap">de las solicitudes totales</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-4">
        <div class="row">
          <div class="col-xl-12 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h6 class="card-title text-uppercase text-muted mb-0" style="font-size: 11px;">Solicitudes de conductores</h6>
                    <span class="h2 font-weight-bold mb-0" id="totalsolicitudes_conductores"></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow" style="background: linear-gradient(87deg, #a62dce 0, #5c2dce 100%) !important;">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                </div>
                <p class=" mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>100%</span>
                  <span class="text-nowrap">de las solicitudes totales</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-md-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0" style="font-size: 11px;">conductores activos</h5>
                    <span class="h2 font-weight-bold mb-0" id="totalsolicitudes_activo"></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow" style="background: linear-gradient(87deg, #a6ce2d 0, #62dd43 100%) !important;">
                      <i class="fas fa-taxi"></i>
                    </div>
                  </div>
                </div>
                <p class=" mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>100%</span>
                  <span class="text-nowrap">de las solicitudes totales</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0  text-center">Estado de las solicitudes</h3>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Estado</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Porcentaje</th>
                </tr>
              </thead>
              <tbody id="tb_estado">

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xl-8">
        <div class="card">
          <div class="card-header bg-transparent  text-center">
            <h2>Gr&aacute;fica de Solicitudes</h2>
          </div>
          <div class="card-body">
            <!-- Chart -->
            <div class="chart">
              <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                  <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                  <div class=""></div>
                </div>
              </div>
              <!-- Chart wrapper -->
              <canvas id="chart-sales-dark2" class="chart-canvas chartjs-render-monitor" style="display: block; width: 100%; height: 100%" width="100%" height="100%"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
    </div>
  </footer>
<?php
} else {
?>
  <div class="header pb-6 d-flex align-items-center" style="min-height: 100%;/* background-image: url(https://image.freepik.com/foto-gratis/centro-comercial-grandes-almacenes_74190-6344.jpg); */background-size: cover;background-position: center top;">
    <span class="mask opacity-8" style="background: #132e62 !important;"></span>
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class="col-12">
          <h1 class="display-2 text-white">Bienvenido <?php echo $_SESSION["nombre_usuario"]; ?></h1>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

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
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
  function dash() {
    var inic = $('#inicio').val();
    var fina = $('#final').val();
    var filtr = $('#r_filtro').val();
    $.ajax({
      url: './serverdashboard',
      type: "POST",
      data: {
        inicio: inic,
        final: fina,
      },
      success: function(result2) {
        var json2 = JSON.parse(result2);
        var largo2 = Object.keys(json2[0]).length;
        document.getElementById("napp").innerHTML = json2[0].napp;
        document.getElementById("nid_conductor").innerHTML = json2[0].nid_conductor;
        document.getElementById("nid_pasajero").innerHTML = json2[0].nid_pasajero;
        document.getElementById("nweb").innerHTML = json2[0].nweb;
        document.getElementById("por_napp").innerHTML = json2[0].por_napp;
        document.getElementById("por_nweb").innerHTML = json2[0].por_nweb;
        document.getElementById("totalsolicitudes_activo").innerHTML = json2[0].totalsolicitudes_activo;
        document.getElementById("totalsolicitudes_conductores").innerHTML = json2[0].totalsolicitudes_conductores;
        document.getElementById("tb_estado").innerHTML = json2[0].tabla;
      }
    });
  }
  $.ajax({
    url: 'server_process_consultar_chart3.php',
    type: "POST",
    success: function(result) {
      var json = JSON.parse(result);
      var largo = Object.keys(json).length;
      var total_ordenes = [];
      var fecha_ordenes = [];
      var index = 0;
      while (index < largo) {
        total_ordenes.push(json[index].total);
        fecha_ordenes.push(json[index].fecha);
        index++;
      }

      var ctx = document.getElementById('chart-sales-dark2').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: fecha_ordenes,
          datasets: [{
            label: 'N° Solicitudes',
            data: total_ordenes,
            pointRadius: 8,
            pointHoverRadius: 8,
            showLine: 3,
            backgroundColor: '#5f00be30', // Fondo del gráfico
            borderColor: "#5f00be61", // Lineas que bordean el gráfico
            pointBackgroundColor: "#5F00BE", // Punto del gráfico
            pointBorderColor: "#5F00BE", // Circunferencia que bordean el punto del gráfico 

          }]
        },
        options: {}
      });

      function UpdateChart(lab, dat) {
        chart.data.labels = lab;
        chart.data.datasets[0].data = dat;
        chart.update();
        dash();
      };

      $("#search").click(function() {
        var inic = $('#inicio').val();
        var fina = $('#final').val();
        var filtr = $('#r_filtro').val();
        $.ajax({
          url: 'server_process_consultar_chart_dos.php',
          type: "POST",
          data: {
            inicio: inic,
            final: fina,
          },
          success: function(result2) {
            var json2 = JSON.parse(result2);
            var largo2 = Object.keys(json2).length;
            var total_ordenes2 = [];
            var fecha_ordenes2 = [];
            let index2 = 0;
            while (index2 < largo2) {
              total_ordenes2.push(json2[index2].total);
              fecha_ordenes2.push(json2[index2].fecha);
              index2++;
            }
            var lab = ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var dat = [25, 20, 30, 22, 17, 29];
            UpdateChart(fecha_ordenes2, total_ordenes2);
          }
        });
      });
    }
  });
  $(document).ready(function() {
    $(function() {
      moment.locale('es');
      var start = moment().subtract(29, 'days');
      var end = moment();

      function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        document.getElementById('inicio').value = start.format('YYYY/MM/DD');
        document.getElementById('final').value = end.format('YYYY/MM/DD');
        $("#search").trigger("click");
        dash();
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

  function redirc() {
    window.location.replace('agregar_cliente.php');
  }

  function redirc2() {
    window.location.replace('clientes.php');
  }

  /*
     var _nom = document.getElementById("nomb").value;
    var _cat = document.getElementById("cat").value;
    var _precio = document.getElementById("precio").value;
    var _stock = document.getElementById("stock").value;

    var fila="<tr><td>"+_nom+"</td><td>"+_cat+"</td><td>"+_precio+"</td><td>"+_stock+"</td></tr>";

    var btn = document.createElement("TR");
   	btn.innerHTML=fila;
    document.getElementById("tablita").appendChild(btn);

  */
  
</script>


</html>