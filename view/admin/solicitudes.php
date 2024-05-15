<html>
<?php // require_once 'conectar.php'; 
?>
<?php require_once './view/admin/header.php'; ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
<?php $var = "solicitudes"; ?>
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

<link rel="stylesheet" type="text/css" href="./view/admin/css/solicitudes.css">

<div id="mensaje"></div>
<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Se requiere su atención</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">¿Desea cancelar el servicio?</h4>
                    <p>La solicitud ya no estará disponible para los conductores.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-link text-white ml-auto" onclick="cancelar2();">continuar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-notificationes" tabindex="-1" role="dialog" aria-labelledby="modal-notificationes" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Se requiere su atención</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">¿Desea finalizar el servicio?</h4>
                    <p>La solicitud ya no estará disponible para los conductores.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-link text-white ml-auto" onclick="finalizarsol2();">continuar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card" style="margin-bottom: 0px !important;">
                <div class="card-body px-lg-4 py-lg-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="display: flex;justify-content: center;">
                                <label class="form-control-label" for="example2cols1Input">Ubicación del pasajero</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display: flex;flex-wrap: nowrap;flex-direction: row;">
                        <div class="col-md-4">
                            <div class="form-group" style="display: flex;justify-content: center;">
                                <label class="form-control-label" for="example3cols1Input">Automatico</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="display: flex;justify-content: center;">
                                <label class="custom-toggle">
                                    <input type="checkbox" id="inputmapa" onclick="cambiar_valor()">
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="display: flex;justify-content: center;">
                                <label class="form-control-label" for="example3cols3Input">Manual</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="mapa2" style="display:block">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-control-label" for="example2cols1Input">Buscar Direcci&oacute;n</label>
                                    <input id="pac-input" type="text" name="pac-input" class="form-control controls" placeholder="" autocomplete="off">
                                </div>
                                <div id="map" width="100%" style="height: 280px;"></div>
                            </div>
                        </div>
                        <div class="col-md-12" id="mapa1" style="display:none">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-control-label" for="example2cols1Input">Buscar Direcci&oacute;n</label>
                                    <input id="input-address-formated" type="text" name="input-address-formated" class="form-control controls" placeholder="" autocomplete="off">
                                </div>
                                <div id="Mapa" width="100%" style="height: 280px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols1Input">Telefono</label>
                                <div class="input-group mb-3">
                                    <input type="number" id="telefono" name="telefono" class="form-control" placeholder="" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" id="buscar_cliente" onclick="buscarpasjero()" style="color: #fff;background: #50009f;border: #50009f;">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols1Input">Nombre y Apellido</label>
                                <input type="text" id="nombres" name="nombres" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols1Input">Precio</label>
                                <input type="text" id="precio" name="precio" class="form-control" placeholder="" autocomplete="off" value="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols1Input">Detalle</label>
                                <input type="text" id="referencia" name="referencia" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mr-auto" style="color:#50009f;border:solid 1px #50009f;" data-dismiss="modal">Cancelar</button>
                    <button id="btnguardar" type="button" class="btn ml-auto" style="color:#fff;background: #50009f;border: #50009f;" onclick="solicitartaxi();">Enviar solicitud</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header -->
<div class="header bg-primary pb-6" style="background: #132e62 !important;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4" style="margin-left: 5px;margin-right: 5px;">
                <div class="col-lg-12 col-12" style="text-align: center;background: none;height: 59px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;border-radius: 50px;">
                    <h6 class="h2 d-inline-block mb-0 text-uppercase " style="color: #ffffff;">Solicitudes</h6>
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
                    
                    <button class="boton-save" style="margin-right: 5px;" onclick="datos();">
                        <i class="fas fa-plus-circle"></i> Nueva solicitud
                    </button>
                </div>
                <div class="card-body">

                    <div class="table-responsive py-4">
                        
                        <table id="example" class="table table-bordered table-striped dataTable dtr-inline" role="grid">
                            <thead>
                                <tr>
                                    <th>Pasajero</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Conductor</th>
                                    <th>Unidad</th>
                                    <th>Ruta</th>
                                    <th>Referencia</th>
                                    <th>precio</th>
                                    <th>Fecha</th>
                                    <th>Mapa</th>
                                    <th>Tipo</th>
                                    <th>Tipo Pago</th>
                                    <th>Detalles</th>
                                    <th>Cancelar</th>
                                    <th>Finalizar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Pasajero</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Conductor</th>
                                    <th>Unidad</th>
                                    <th>Ruta</th>
                                    <th>Referencia</th>
                                    <th>precio</th>
                                    <th>Fecha</th>
                                    <th>Mapa</th>
                                    <th>Tipo</th>
                                    <th>Tipo Pago</th>
                                    <th>Detalles</th>
                                    <th>Cancelar</th>
                                    <th>Finalizar</th>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgaYby7k-uwnMsLF3Du3hfHtWpH789Xdo&callback=iniciar&libraries=places&v=weekly" defer></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.4/api/fnReloadAjax.js"></script>

    <script src="./view/admin/js/solicitudes.js"></script>

</html>