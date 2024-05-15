<?php
header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$una_hora_menos = date("H:i:s", (strtotime("-5 Hours")));
$fecha = date("d-m-Y");
$fechahora = $fecha . " " . $hora24;
$fechahoramenos = $fecha . " " . $una_hora_menos;
$inicio = $_POST['inicio'];
$final = $_POST['final'];
global $conexion;
$conexion = mysqli_connect('localhost', 'root', '@Vespro', 'chapatutaxi');
$query = $conexion->query("SELECT * FROM `operaciones` WHERE DATE_FORMAT(fecha, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}' ORDER BY `operaciones`.`id_operaciones` DESC");

$query2 = $conexion->query("SELECT  COUNT(`id_operaciones`) AS cantidad FROM `operaciones` WHERE DATE_FORMAT(fecha, '%Y/%m/%d') BETWEEN '{$inicio}' AND '{$final}' ORDER BY `operaciones`.`id_operaciones` DESC");
$id_n = $query2->fetch_assoc();
$id_n_s = intval($id_n['cantidad']);

$datos = '<div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">';
$datos2 = '';
while ($result = mysqli_fetch_array($query)) {
    $ie = $result['ingreso_egreso'];
    if ($ie == 'ingreso') {
        $color = 'success';
    } else {
        $color = 'danger';
    }
    $fechaHoras = $result['fecha'] . " " . $result['hora'];
    $datos2 .= ' <div class="timeline-block">
        <span class="timeline-step badge-' . $color . '">
            <i class="ni ni-bell-55"></i>
        </span>
        <div class="timeline-content" style="border-top: dashed 2px white;">
            <small class="text-light font-weight-bold">' . date('d/m/Y H:i:s', strtotime($fechaHoras)) . '</small>
            <h5 class="text-white mt-3 mb-0">' . "Concepto: " . $result['concepto'] . '</h5>
            <p class="text-light text-sm mt-1 mb-0">' . "Detalle: " . $result['detalle'] . '</p>
            <div class="mt-3">
                <span class="badge badge-pill badge-' . $color . '">' . 'S/ ' .  number_format($result['monto'], 2, '.', ',') . '</span>
                <span class="badge badge-pill badge-' . $color . '">' . $result['tipo_pago'] . '</span>
                <span class="badge badge-pill badge-' . $color . ' mt-1">' . $result['metodo_pago'] . '</span>
            </div>
        </div>
    </div>';
}
$datos3 = '</div>';
$result = $datos . $datos2 . $datos3;

$userData = array();
$userData[] = [
    "tab" => $result,
    "count" => $id_n_s
];
echo json_encode($userData, JSON_FORCE_OBJECT);
//echo json_encode($datos2, JSON_FORCE_OBJECT);
//echo $result;
mysqli_close($conexion);
