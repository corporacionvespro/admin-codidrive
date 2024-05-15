<?php
header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/xls; charset=utf-8'");
header("Content-Disposition: attachment; filename=documento_exportado_" . date('Y:m:d:m:s') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");



$tabla = "<table>
<thead>
    <tr>
        <th>Nombre</th>
        <th>Unidad</th>
        <th>Telefono</th>
        <th>Usuario</th>
        <th>Estado</th>
        <th>Fecha de vencimiento</th>
        <th>Monto por periodo</th>
        <th>Periodo en d&iacute;as</th>
        <th>Monto por d&iacute;a</th>
    </tr>
</thead>
<tbody>";

foreach ($output['aaData'] as $fila) {
    $tabla .= "<tr>";

    // Iterar sobre cada elemento en la fila
    foreach ($fila as $columna) {
        $tabla .= iconv("UTF-8", "ISO-8859-1//TRANSLIT", $columna);
    }

    $tabla .= "</tr>";
}

$tabla .= "</tbody>
</table>";

echo $tabla;
