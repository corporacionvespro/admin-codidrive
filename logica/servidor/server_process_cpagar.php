<?php
$mysqli = new mysqli('localhost', 'root', 'vespro$2024&', 'codidrive');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
$sTabla = "otrosegresos";
$aColumnas = array('id', 'id_cliente', 'documento_cliente', 'nombre_cliente', 'concepto', 'precio', 'monto', 'aporte', 'deuda', 'estado_deuda', 'detalle', 'fecha_reg', 'fecha_hora', 'monto_anterior', 'estado', 'usuario', 'nombre');
$aColumnas3 = array('id', 'id_cliente', 'documento_cliente', 'nombre_cliente', 'concepto', 'precio', 'monto', 'aporte', 'deuda', 'estado_deuda', 'detalle', 'fecha_reg', 'fecha_hora', 'monto_anterior', 'estado', 'usuario', 'nombre');
$aColumnas2 = array('id', 'id_cliente', 'documento_cliente', 'nombre_cliente', 'concepto', 'precio', 'monto', 'aporte', 'deuda', 'estado_deuda', 'detalle', 'fecha_reg', 'fecha_hora', 'monto_anterior', 'estado', 'usuario', 'nombre');
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
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere AND estado_deuda = '1' $sOrder $sLimit";
} else {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere where estado_deuda = '1' $sOrder $sLimit ";
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
		}elseif ($aColumnas2[$i] == "precio") {
			//
		}elseif ($aColumnas2[$i] == "monto") {
			//
		}elseif ($aColumnas2[$i] == "aporte") { 
			//
		}elseif ($aColumnas2[$i] == "deuda") {
			$row[] = "<td class='text-center'>" . 'S/ ' .  number_format($aRow[$aColumnas2[$i]], 2, '.', ','). "</td>";
			//
		} elseif ($aColumnas2[$i] == "estado_deuda") {
			/*if ($aRow[$aColumnas2[$i]] == '0') {
				$row[] = "<span class='estado_bloqueado'></span>";
			} elseif ($aRow[$aColumnas2[$i]] == '1') {
				$row[] = "<span class='estado_activo'>Ocupado</span>";
			}*/
		}else {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
		}
	}
	$row[] = "<td class='text-center'><button type='button' onclick='pagar(\"{$aRow['id']}\",\"{$aRow['precio']}\",\"{$aRow['deuda']}\",\"{$aRow['documento_cliente']}\",\"{$aRow['nombre_cliente']}\",\"{$aRow['concepto']}\",\"{$aRow['detalle']}\")' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;'><i class='fas fa-money-check-edit-alt'></i></button></td>";
	$output['aaData'][] = $row;
}
echo json_encode($output);
