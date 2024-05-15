<?php
header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/xls; charset=utf-8'");
header("Content-Disposition: attachment; filename=OTROS_EGRESOS_" . date('Y:m:d:m:s') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

$mysqli = new mysqli('localhost', 'root', '@Vespro', 'chapatutaxi');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
$sTabla = "otrosegresos";
$aColumnas = array('id', 'id_cliente', 'documento_cliente', 'nombre_cliente', 'concepto', 'precio', 'monto', 'aporte', 'deuda', 'estado_deuda', 'detalle', 'fecha_reg', 'fecha_hora', 'monto_anterior', 'estado', 'usuario', 'nombre', 'comprobante', 't_comprobante');
$aColumnas3 = array('id', 'id_cliente', 'documento_cliente', 'nombre_cliente', 'concepto', 'precio', 'monto', 'aporte', 'deuda', 'estado_deuda', 'detalle', 'fecha_reg', 'fecha_hora', 'monto_anterior', 'estado', 'usuario', 'nombre', 'comprobante', 't_comprobante');
$aColumnas2 = array('id', 'id_cliente', 'documento_cliente', 'nombre_cliente', 'concepto', 'precio', 'monto', 'aporte', 'deuda', 'estado_deuda', 'detalle', 'fecha_reg', 'fecha_hora', 'monto_anterior', 'estado', 'usuario', 'nombre', 'comprobante', 't_comprobante');
$sIndexColumn = "id";
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
	$sLimit = "LIMIT " . $_GET['iDisplayStart'] . ", " . $_GET['iDisplayLength'];
}
if (isset($_GET['iSortCol_0'])) {
	$sOrder = " ORDER BY  ";
	for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
		if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
			$sOrder .= $aColumnas2[intval($_GET['iSortCol_' . $i])] . "
				" . $_GET['sSortDir_' . $i] . ", ";
		}
	}
	$sOrder = substr_replace($sOrder, "", -2);
	if ($sOrder == " ORDER BY") {
		$sOrder = "";
	}
}
$sWhere = "";
if ($_GET['sSearch'] != "") {
	$sWhere = " WHERE (";
	for ($i = 0; $i < count($aColumnas3); $i++) {
		$sWhere .= $aColumnas3[$i] . " LIKE '%" . $_GET['sSearch'] . "%' OR ";
	}
	$sWhere = substr_replace($sWhere, "", -3);
	$sWhere .= ')';
}
for ($i = 0; $i < count($aColumnas2); $i++) {
	if ($_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
		if ($sWhere == "") {
			$sWhere = " WHERE ";
		}
		$sWhere .= $aColumnas2[$i] . " LIKE '%" . $_GET['sSearch_' . $i] . "%' ";
	}
}
$sQuery0 = " SET @i = 0;";

if ($_GET['sSearch'] != "") {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere $sOrder ";
} else {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere $sOrder ";
}

//echo $sQuery;
$rResult0 = $mysqli->query($sQuery0);
$rResult = $mysqli->query($sQuery);
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = $mysqli->query($sQuery);
$aResultFilterTotal = $rResultFilterTotal->fetch_array();
$iFilteredTotal = $aResultFilterTotal[0];
$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTabla";
$rResultTotal = $mysqli->query($sQuery);
$aResultTotal = $rResultTotal->fetch_array();
$iTotal = $aResultTotal[0];
$output = array(
	"sEcho" => intval($_GET['sEcho']),
	"iTotalRecords" => $iTotal,
	"iTotalDisplayRecords" => $iFilteredTotal,
	"aaData" => array()
);
$i = 1;
while ($aRow = $rResult->fetch_array()) {
	$row = array();
	$estadocontrol = '';
	$estadocambio = '';
	for ($i = 0; $i < count($aColumnas2); $i++) {
		if ($aColumnas2[$i] == "id") {
			//
		} elseif ($aColumnas2[$i] == "id_cliente") {
			//
		} elseif ($aColumnas2[$i] == "fecha_hora") {
			//
		} elseif ($aColumnas2[$i] == "monto_anterior") {
			//
		} elseif ($aColumnas2[$i] == "unidad") {
			//
		} elseif ($aColumnas2[$i] == "estado") {
			//
		} elseif ($aColumnas2[$i] == "usuario") {
			//
		} elseif ($aColumnas2[$i] == "nombre") {
			//
		} elseif ($aColumnas2[$i] == "precio") {
			$row[] = "<td class='text-center'>" . 'S/ ' .  number_format($aRow[$aColumnas2[$i]], 2, '.', ',') . "</td>";
			//
		} elseif ($aColumnas2[$i] == "monto") {
			//
		} elseif ($aColumnas2[$i] == "aporte") {
			$row[] = "<td class='text-center'>" . 'S/ ' .  number_format($aRow[$aColumnas2[$i]], 2, '.', ',') . "</td>";
			//
		} elseif ($aColumnas2[$i] == "deuda") {
			//
		} elseif ($aColumnas2[$i] == "comprobante") {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
			//
		} elseif ($aColumnas2[$i] == "t_comprobante") {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
			//
		} elseif ($aColumnas2[$i] == "estado_deuda") {
			//
		} else {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
		}
	}
	$output['aaData'][] = $row;
}

$tabla = "<table>
<thead>
    <tr>
    <th>DOC.CLIENTE</th>
    <th>NOMBRE</th>
    <th>CONCEPTO</th>
    <th>COSTO</th>
    <th>APORTE</th>
    <th>DETALLE</th>
    <th>FECHA HORA</th>
    <th>NUMERO DE COMPROBANTE</th>
    <th>COMPROBANTE</th>
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
