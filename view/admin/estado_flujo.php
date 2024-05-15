<html>
<?php require_once 'conectar.php';
?>
<?php require_once './view/admin/header.php'; ?>
<?php $var = "estadisticas"; ?>
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
  $query_preciototal = $db->query("SELECT SUM(precio) AS precio FROM `solicitud` WHERE `estado`='finalizado'");
  $totalsolicitud2 = $query_preciototal->fetch_assoc();
  $totalsolicitud = $totalsolicitud2['precio'];

  $query_idtotal_solicitud = $db->query("SELECT COUNT(id_solicitud) As id FROM `solicitud` WHERE `estado`='finalizado'");
  $idtotal_solicitud2 = $query_idtotal_solicitud->fetch_assoc();
  $nsolicitudesF = $idtotal_solicitud2['id'];

  $query_cancelado = $db->query("SELECT COUNT(id_solicitud) As cancelado FROM `solicitud` WHERE `estado`='cancelado'");
  $idtotal_cancelado2 = $query_cancelado->fetch_assoc();
  $ncancelado = $idtotal_cancelado2['cancelado'];

  $query_abordo = $db->query("SELECT COUNT(id_solicitud) As abordo FROM `solicitud` WHERE `estado`='abordo'");
  $idtotal_abordo2 = $query_abordo->fetch_assoc();
  $nabordo = $idtotal_abordo2['abordo'];

  $query_aceptado = $db->query("SELECT COUNT(id_solicitud) As aceptado FROM `solicitud` WHERE `estado`='aceptado'");
  $idtotal_aceptado2 = $query_aceptado->fetch_assoc();
  $naceptado = $idtotal_aceptado2['aceptado'];

  $query_pendiente = $db->query("SELECT COUNT(id_solicitud) As pendiente FROM `solicitud` WHERE `estado`='pendiente'");
  $idtotal_pendiente2 = $query_pendiente->fetch_assoc();
  $npendiente = $idtotal_pendiente2['pendiente'];

  $query_id_conductor = $db->query("SELECT SUM(`monto`) AS id_conductor FROM `operaciones` WHERE `tipo_caja`='banco'");
  $idtotal_id_conductor2 = $query_id_conductor->fetch_assoc();
  $nid_conductor = $idtotal_id_conductor2['id_conductor'];

  $query_id_pasajero = $db->query("SELECT SUM(`monto`) AS id_pasajero FROM `operaciones` WHERE `tipo_caja`='caja'");
  $idtotal_id_pasajero2 = $query_id_pasajero->fetch_assoc();
  $nid_pasajero = $idtotal_id_pasajero2['id_pasajero'];



  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  $query_operingresosbanco = $db->query("SELECT SUM(`monto`) AS operingresosbanco FROM `operaciones` WHERE `ingreso_egreso`='ingreso' AND `tipo_caja`='banco'");
  $idtotal_operingresosbanco2 = $query_operingresosbanco->fetch_assoc();
  $nid_operingresosbanco = $idtotal_operingresosbanco2['operingresosbanco'];

  $query_operegresosbanco = $db->query("SELECT SUM(`monto`) AS operegresosbanco FROM `operaciones` WHERE `ingreso_egreso`='egreso' AND `tipo_caja`='banco'");
  $idtotal_operegresosbanco2 = $query_operegresosbanco->fetch_assoc();
  $nid_operegresosbanco = $idtotal_operegresosbanco2['operegresosbanco'];

  $resumen_banco_actual = $nid_operingresosbanco - $nid_operegresosbanco;
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $query_operingresoscaja = $db->query("SELECT SUM(`monto`) AS operingresoscaja FROM `operaciones` WHERE `ingreso_egreso`='ingreso' AND `tipo_caja`='caja'");
    $idtotal_operingresoscaja2 = $query_operingresoscaja->fetch_assoc();
    $nid_operingresoscaja = $idtotal_operingresoscaja2['operingresoscaja'];
  
    $query_operegresoscaja = $db->query("SELECT SUM(`monto`) AS operegresoscaja FROM `operaciones` WHERE `ingreso_egreso`='egreso' AND `tipo_caja`='caja'");
    $idtotal_operegresoscaja2 = $query_operegresoscaja->fetch_assoc();
    $nid_operegresoscaja = $idtotal_operegresoscaja2['operegresoscaja'];

    $resumen_caja_actual = $nid_operingresoscaja - $nid_operegresoscaja;
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  $query_solicitud = $db->query("SELECT COUNT(id_solicitud) AS solicitud FROM `solicitud`;");
  $idtotal_solicitud2 = $query_solicitud->fetch_assoc();
  $nsolicitud = $idtotal_solicitud2['solicitud'];

  $query_app = $db->query("SELECT SUM(`monto`) AS app FROM `operaciones` WHERE `ingreso_egreso`='egreso';");
  $idtotal_app2 = $query_app->fetch_assoc();
  $napp = $idtotal_app2['app'];

  $query_web = $db->query("SELECT SUM(`monto`) AS web FROM `operaciones` WHERE `ingreso_egreso`='ingreso';");
  $idtotal_web2 = $query_web->fetch_assoc();
  $nweb = $idtotal_web2['web'];

  function obtenerPorcentaje($cantidad, $total)
  {
    $porcentaje = ((float)$cantidad * 100) / $total; // Regla de tres
    $porcentaje = round($porcentaje, 0);  // Quitar los decimales
    return $porcentaje . '%';
  }

?>
  <div class="header bg-primary pb-6" style="background: #132e62 !important;">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">INGRESOS</h5>
                    <span class="h2 font-weight-bold mb-0"><?php echo 'S/ ' .  number_format($nweb, 2, '.', ','); ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="fas fa-hand-holding-usd"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span class="text-nowrap">Total</span>
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
                    <h5 class="card-title text-uppercase text-muted mb-0">EGRESOS</h5>
                    <span class="h2 font-weight-bold mb-0"><?php echo 'S/ ' .  number_format($napp, 2, '.', ','); ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="fas fa-hands-usd"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span class="text-nowrap">Total</span>
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
                    <h5 class="card-title text-uppercase text-muted mb-0">BANCO</h5>
                    <span class="h2 font-weight-bold mb-0"><?php echo 'S/ ' .  number_format($resumen_banco_actual, 2, '.', ','); ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      <i class="fas fa-credit-card-front"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span class="text-nowrap">Total</span>
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
                    <h5 class="card-title text-uppercase text-muted mb-0">CAJA</h5>
                    <span class="h2 font-weight-bold mb-0"><?php echo 'S/ ' .  number_format($resumen_caja_actual, 2, '.', ','); ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      <i class="fas fa-wallet"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span class="text-nowrap">Total</span>
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
      <!--<div class="col-xl-4">
        <div class="card">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0  text-center">Estado de las solicitudes</h3>
              </div>
            </div>
          </div>
          <div class="table-responsive">
           
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Estado</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Porcentaje</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">
                    Finalizado
                  </th>
                  <td>
                    <?php // echo $nsolicitudesF; 
                    ?>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2"><?php //echo obtenerPorcentaje($nsolicitudesF, $nsolicitud); 
                                          ?></span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="<?php //echo substr(obtenerPorcentaje($nsolicitudesF, $nsolicitud), 0, -1); 
                                                                                                          ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php // echo obtenerPorcentaje($nsolicitudesF, $nsolicitud); 
                                                                                                                                                                  ?>;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    Cancelado
                  </th>
                  <td>
                    <?php //echo $ncancelado; 
                    ?>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2"><?php //echo obtenerPorcentaje($ncancelado, $nsolicitud); 
                                          ?></span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="<?php //echo substr(obtenerPorcentaje($ncancelado, $nsolicitud), 0, -1); 
                                                                                                          ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php //echo obtenerPorcentaje($ncancelado, $nsolicitud); 
                                                                                                                                                                  ?>;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    Aceptado
                  </th>
                  <td>
                    <?php //echo $naceptado; 
                    ?>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2"><?php //echo obtenerPorcentaje($naceptado, $nsolicitud); 
                                          ?></span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="<?php //echo substr(obtenerPorcentaje($naceptado, $nsolicitud), 0, -1); 
                                                                                                          ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php //echo obtenerPorcentaje($naceptado, $nsolicitud); 
                                                                                                                                                                  ?>;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    Abordo
                  </th>
                  <td>
                    <?php //echo $nabordo; 
                    ?>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2"><?php //echo obtenerPorcentaje($nabordo, $nsolicitud); 
                                          ?></span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="<?php //echo substr(obtenerPorcentaje($nabordo, $nsolicitud), 0, -1); 
                                                                                                        ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php //echo obtenerPorcentaje($nabordo, $nsolicitud); 
                                                                                                                                                                ?>;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    Pendiente
                  </th>
                  <td>
                    <?php //echo $npendiente; 
                    ?>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2"><?php //echo obtenerPorcentaje($npendiente, $nsolicitud); 
                                          ?></span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="<?php //echo substr(obtenerPorcentaje($npendiente, $nsolicitud), 0, -1); 
                                                                                                          ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php // echo obtenerPorcentaje($npendiente, $nsolicitud); 
                                                                                                                                                                  ?>;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row" style="font-weight: revert;">Total</th>
                  <td style="font-weight: revert;">
                    <?php //echo $nsolicitud 
                    ?>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2"><?php //echo obtenerPorcentaje($nsolicitud, $nsolicitud); 
                                          ?></span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="<?php //echo substr(obtenerPorcentaje($nsolicitud, $nsolicitud), 0, -1); 
                                                                                              ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php //echo obtenerPorcentaje($nsolicitud, $nsolicitud); 
                                                                                                                                                      ?>;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>-->
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent  text-center">
            <h2>Gr&aacute;fica de ingresos por conductores (recargas y aprobados)</h2>
            <br>
            <input type="hidden" id="search" name="search">
            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
              <i class="fa fa-calendar"></i>&nbsp;
              <span></span> <i class="fa fa-caret-down"></i>
            </div>
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
              <input type="hidden" name="r_filtro" id="r_filtro" value="0">

              <input type="hidden" name="inicio" id="inicio" value="">
              <input type="hidden" name="final" id="final" value="">
              <canvas id="chart-sales-dark2" class="chart-canvas chartjs-render-monitor" style="display: block; width: 100%; height: 100%" width="100%" height="100%"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent  text-center">
            <h2>Gr&aacute;ficas de ingresos por metodos de pago</h2>
            <br>
            <input type="hidden" id="search2" name="search2">
            <div id="reportrange2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
              <i class="fa fa-calendar"></i>&nbsp;
              <span></span> <i class="fa fa-caret-down"></i>
            </div>
          </div>
          <div class="card-body">
            <!-- Chart -->
            <div class="chart">
              <!-- Chart wrapper -->
              <input type="hidden" name="r_filtro2" id="r_filtro2" value="0">

              <input type="hidden" name="inicio2" id="inicio2" value="">
              <input type="hidden" name="final2" id="final2" value="">
              <canvas id="myChart" class="chart-canvas chartjs-render-monitor" style="display: block; width: 100%; height: 100%" width="100%" height="100%"></canvas>
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
  $.ajax({
    url: 'server_process_consultar_chart_caja1.php',
    type: "POST",
    success: function(result) {
      var json = JSON.parse(result);
      var largo = Object.keys(json).length;
      var total_ordenes = [];
      var fecha_ordenes = [];
      let index = 0;
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
            label: 'Monto total',
            data: total_ordenes,
            pointRadius: 8,
            pointHoverRadius: 8,
            showLine: 3,
            backgroundColor: '#5f00be30',
            borderColor: "#5f00be61",
            pointBackgroundColor: "#5F00BE",
            pointBorderColor: "#5F00BE",

          }]
        },
        options: {}
      });

      function UpdateChart(lab, dat) {
        chart.data.labels = lab;
        chart.data.datasets[0].data = dat;
        chart.update();
      };
      $("#search").click(function() {
        var inic = $('#inicio').val();
        var fina = $('#final').val();
        var filtr = $('#r_filtro').val();
        $.ajax({
          url: 'server_process_consultar_chart_caja2.php',
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
</script>
<script>
  function grafico2() {
    $.ajax({
      url: 'server_process_consultar_chart4.php',
      type: "POST",
      success: function(result) {
        var json = JSON.parse(result);
        var largo = Object.keys(json.fecha).length;
        var total_efectivo = [];
        var total_billetera = [];
        var total_banca = [];
        var fecha_ordenes = [];
        let index = 0;
        while (index < largo) {
          total_efectivo.push(json.datos[index][0]);
          total_billetera.push(json.datos[index][1]);
          total_banca.push(json.datos[index][2]);
          fecha_ordenes.push(json.fecha[index]);
          index++;
        }
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: fecha_ordenes,
            datasets: [{
                label: 'EFECTIVO',
                data: total_efectivo,
                borderWidth: 3,
                backgroundColor: 'rgba(52, 201, 69, 0.2)',
                borderColor: "rgba(52, 201, 69, 0.54)",
                pointBackgroundColor: "rgba(52, 201, 69, 0.74)",
                pointBorderColor: "rgba(52, 201, 69, 0.74)",
                pointRadius: 8,
                pointHoverRadius: 8,
                showLine: 3,
              },
              {
                label: 'BANCA',
                data: total_banca,
                borderWidth: 3,
                backgroundColor: '#6d18c92b',
                borderColor: "#5f00be61",
                pointBackgroundColor: "#5F00BE",
                pointBorderColor: "#5F00BE",
                pointRadius: 8,
                pointHoverRadius: 8,
                showLine: 3,
              },
              {
                label: 'BILLETERAS DIGITALES',
                data: total_billetera,
                borderWidth: 3,
                backgroundColor: 'rgba(212, 207, 55, 0.2)',
                borderColor: "rgba(212, 207, 55, 0.54)",
                pointBackgroundColor: "rgba(212, 207, 55, 0.74)",
                pointBorderColor: "rgba(212, 207, 55, 0.74)",
                pointRadius: 8,
                pointHoverRadius: 8,
                showLine: 3,
              }
            ]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          }
        });
        /////////////////////
        function UpdateChart2(fecha_o, total_e, total_b, total_ba) {
          myChart.data.labels = fecha_o;
          myChart.data.datasets[0].data = total_e;
          myChart.data.datasets[1].data = total_ba;
          myChart.data.datasets[2].data = total_b;
          myChart.update();
        };
        $("#search2").click(function() {
          var inic = $('#inicio2').val();
          var fina = $('#final2').val();
          var filtr = $('#r_filtro2').val();
          $.ajax({
            url: 'server_process_consultar_chart5.php',
            type: "POST",
            data: {
              inicio: inic,
              final: fina,
            },
            success: function(result2) {
              var json = JSON.parse(result2);
              var largo = Object.keys(json.fecha).length;
              var total_efectivo = [];
              var total_billetera = [];
              var total_banca = [];
              var fecha_ordenes = [];
              let index2 = 0;
              while (index2 < largo) {
                total_efectivo.push(json.datos[index2][0]);
                total_billetera.push(json.datos[index2][1]);
                total_banca.push(json.datos[index2][2]);
                fecha_ordenes.push(json.fecha[index2]);
                index2++;
              }
              var lab = ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
              var dat = [25, 20, 30, 22, 17, 29];
              UpdateChart2(fecha_ordenes, total_efectivo, total_billetera, total_banca);
            }
          });
        });

      }
    });
  }
  $(document).ready(function() {
    $(function() {
      moment.locale('es');
      var start = moment().subtract(29, 'days');
      var end = moment();

      function cb2(start, end) {
        $('#reportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        document.getElementById('inicio2').value = start.format('YYYY/MM/DD');
        document.getElementById('final2').value = end.format('YYYY/MM/DD');
        $("#search2").trigger("click");
      }
      moment.locale('es');
      $('#reportrange2').daterangepicker({

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
      }, cb2);
      cb2(start, end);
    })
  })
  grafico2();
</script>

</html>