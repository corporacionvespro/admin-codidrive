<?php
header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/xls; charset=utf-8'");
header("Content-Disposition: attachment; filename=CUMPLE_DE_CONDUCTORES_" . date('Y:m:d:m:s') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

$mysqli = new mysqli('localhost', 'root', 'vespro$2024&', 'codidrive');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
$sTabla = "documentos_conductor 
INNER JOIN conductor ON documentos_conductor.id_conductor = conductor.id_conductor 
INNER JOIN persona ON conductor.id_persona = persona.id_persona 
";
$aColumnas = array(
	"persona.nombres AS nombre", 
	"persona.telefono AS telefonos",
	"persona.correo AS correos", 
	"persona.foto AS fotos", 
	"documentos_conductor.fecha_nacimiento AS fecha_na", 
	"documentos_conductor.dni_numero AS dni_num"
);
$aColumnas3 = array('persona.nombres', 'persona.telefono', 'persona.correo', 'persona.foto', 'documentos_conductor.fecha_nacimiento', 'documentos_conductor.dni_numero');
$aColumnas2 = array('nombre', 'telefonos', 'correos', 'fotos', 'fecha_na', 'dni_num');
$sIndexColumn = "fecha_na";
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
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas))  . " FROM $sTabla $sWhere AND (fecha_nacimiento IS NOT NULL AND STR_TO_DATE(fecha_nacimiento, '%Y-%m-%d') IS NOT NULL AND STR_TO_DATE(fecha_nacimiento, '%Y-%m-%d') BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY))";
} else {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas))  . " FROM $sTabla $sWhere WHERE fecha_nacimiento IS NOT NULL AND STR_TO_DATE(fecha_nacimiento, '%Y-%m-%d') IS NOT NULL AND STR_TO_DATE(fecha_nacimiento, '%Y-%m-%d') BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
}

//echo $sQuery;
$rResult0 = $mysqli->query($sQuery0);
$rResult = $mysqli->query($sQuery);
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = $mysqli->query($sQuery);
$aResultFilterTotal = $rResultFilterTotal->fetch_array();
$iFilteredTotal = $aResultFilterTotal[0];
$sQuery = "SELECT COUNT(`id`) AS total_fechas
FROM documentos_conductor
WHERE fecha_nacimiento IS NOT NULL
  AND STR_TO_DATE(fecha_nacimiento, '%Y-%m-%d') IS NOT NULL
  AND STR_TO_DATE(fecha_nacimiento, '%Y-%m-%d') BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
ORDER BY STR_TO_DATE(fecha_nacimiento, '%Y-%m-%d') DESC";
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
		if ($aColumnas2[$i] == "foto") {
			if ($aRow[$aColumnas2[$i]] == "default.png" || $aRow[$aColumnas2[$i]] == "https://chapatutaxi.com/chapaapi/images/logo.png") {
				$row[] = "<td class='text-center'><img src='https://codidrive.com/admin/assets/img/brand/logo.png' class='circle' style='width: 70px;height: 70px;overflow: hidden;border-radius: 45px;border: none;text-align: center;object-fit: cover;color: transparent;text-indent: 10000px;max-width: 100 !important;'></td>";
			} else {
				$row[] = "<td class='text-center'><img src='https://chapatutaxi.com/chapaapi/images/" . $aRow[$aColumnas2[$i]] . "' class='circle' style='width: 70px;height: 70px;overflow: hidden;border-radius: 45px;border: none;text-align: center;object-fit: cover;color: transparent;text-indent: 10000px;max-width: 100 !important;'></td>";
			}
		} else {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
		}
	}
	$output['aaData'][] = $row;
}

$tabla = "<table>
<thead>
    <tr>
        <th>NOMBRE</th>
        <th>TELEFONO</th>
        <th>CORREO</th>
        <th>FOTOS</th>
        <th>FECHA DE NACIMIENTO	</th>
        <th>DNI</th>
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
