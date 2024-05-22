<?php
$mysqli = new mysqli('161.132.54.172', 'root', 'vespro$2024&', 'codidrive');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$una_hora_menos = date("H:i:s", (strtotime("-5 Hours")));
$fecha = date("Y-m-d");
$sTabla = "conductor 
JOIN persona ON persona.id_persona = conductor.id_persona 
JOIN saldo_conductor ON conductor.id_conductor = saldo_conductor.id_conductores
JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo";
$aColumnas = array(
	'id_conductor',
	'persona.foto',
	'persona.nombres',
	'vehiculo.unidad',
	'conductor.id_persona',
	'conductor.id_vehiculo',
	'conductor.id_cuenta',
	'persona.telefono',
	'conductor.estado',
	'saldo_conductor.fecha_final',
	'saldo_conductor.monto',
	'saldo_conductor.cantidad_dias',
	'saldo_conductor.monto_dia'
);
$aColumnas3 = array(
	'id_conductor',
	'persona.foto',
	'persona.nombres',
	'vehiculo.unidad',
	'conductor.id_persona',
	'conductor.id_vehiculo',
	'conductor.id_cuenta',
	'persona.telefono',
	'conductor.estado',
	'saldo_conductor.fecha_final',
	'saldo_conductor.monto',
	'saldo_conductor.cantidad_dias',
	'saldo_conductor.monto_dia'
);
$aColumnas2 = array(
	'id_conductor',
	'foto',
	'nombres',
	'unidad',
	'id_vehiculo',
	'id_persona',
	'id_cuenta',
	'telefono',
	'estado',
	'fecha_final',
	'monto',
	'cantidad_dias',
	'monto_dia'
);
$sIndexColumn = "id_conductor";
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
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere AND conductor.estado <>'sinaprobar' AND saldo_conductor.estado=1 $sOrder $sLimit";
} else {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere AND conductor.estado <>'sinaprobar' AND saldo_conductor.estado=1 $sOrder $sLimit ";
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
		if ($aColumnas2[$i] == "id_conductor") {
			//
		} elseif ($aColumnas2[$i] == "id_vehiculo") {
			//
		} elseif ($aColumnas2[$i] == "id_cuenta") {
			//
		} elseif ($aColumnas2[$i] == "estado") {
			if ($aRow[$aColumnas2[$i]] == 'inactivo') {
				$row[] = "<span class='estado_inactivo'>Inactivo</span>";
				$estadocontrol = "";
				$estadocontrol2 = "";
				$estadocambio = "activo";
				$estadocambio2 = "bloqueado";
				$estadodisabled = "";
			} elseif ($aRow[$aColumnas2[$i]] == 'ocupado') {
				$row[] = "<span class='estado_ocupado'>Ocupado</span>";
				$estadocontrol = "checked";
				$estadocontrol2 = "";
				$estadocambio = "inactivo";
				$estadocambio2 = "bloqueado";
				$estadodisabled = "";
			} elseif ($aRow[$aColumnas2[$i]] == 'bloqueado') {
				$row[] = "<span class='estado_bloqueado'>Bloqueado</span>";
				$estadocontrol = "";
				$estadocontrol2 = "checked";
				$estadocambio = "activo";
				$estadocambio2 = "activo";
				$estadodisabled = " disabled";
			} elseif ($aRow[$aColumnas2[$i]] == 'activo') {
				$row[] = "<span class='estado_activo'>Activo</span>";
				$estadocontrol = "checked";
				$estadocontrol2 = "";
				$estadocambio = "inactivo";
				$estadocambio2 = "bloqueado";
				$estadodisabled = "";
			} else {
				$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
				$estadocontrol = "";
				$estadocontrol2 = "";
				$estadocambio = "activo";
				$estadocambio2 = "bloqueado";
				$estadodisabled = "";
			}
		} elseif ($aColumnas2[$i] == "fecha_final") {

			$estadorecarga = '';
			$fecha_actual = strtotime($fecha);
			$fecha_entrada = strtotime($aRow['fecha_final']);
			$fechasdiferencias = '';
			if ($fecha_actual >= $fecha_entrada) {
				$date1 = new DateTime($aRow['fecha_final']);
				$date2 = new DateTime($fecha);
				$diff = $date1->diff($date2);
				$fechasdiferencias1 = $diff->days;
				if ($fechasdiferencias1 == 0) {
					$fechasdiferencias = "<span class='estado_ocupado'>Venci&oacute; hoy</span>";
				} elseif ($fechasdiferencias1 == 1) {
					$fechasdiferencias = "<span class='estado_bloqueado'>Vencido " . $fechasdiferencias1 . " d&iacute;a</span>";
				} else {
					$fechasdiferencias = "<span class='estado_bloqueado'>Vencido " . $fechasdiferencias1 . " d&iacute;as</span>";
				}
				$estadorecarga =  $fechasdiferencias;
			} else {
				$date2 = new DateTime($aRow['fecha_final']);
				$date1 = new DateTime($fecha);
				$diff = $date1->diff($date2);
				$fechasdiferencias2 = $diff->days;
				//$estadorecarga = "<span class='estado_activo'>Vigente</span>";
				if ($fechasdiferencias2 == 1) {
					$fechasdiferencias = "<span class='estado_inactivo'>Vence ma&ntilde;ana</span>";
				} else {
					$fechasdiferencias = "<span class='estado_activo'>Vence en " . $fechasdiferencias2 . " d&iacute;as</span>";
				}
				$estadorecarga =  $fechasdiferencias;
			}
			$row[] = "<td class='text-center'>" . $estadorecarga . "</td>";
			$fechaf = new DateTime($aRow['fecha_final']);
			$fechaFormateadaf = $fechaf->format('d/m/Y');
			$row[] = "<td class='text-center'>" . $fechaFormateadaf . "</td>";
			/**/
		} elseif ($aColumnas2[$i] == "id_persona") {
			//
		} elseif ($aColumnas2[$i] == "foto") {
			//$row[] = "<td class='text-center'><img src='https://chapatutaxi.com/codiapi/images/" . $aRow[$aColumnas2[$i]] . "' class='circle' style='width: 70px;height: 70px;overflow: hidden;border-radius: 45px;border: none;text-align: center;object-fit: cover;color: transparent;text-indent: 10000px;'></td>";
		} elseif ($aColumnas2[$i] == "monto") {
			$monto_n = $aRow[$aColumnas2[$i]];
			if ($monto_n == 'NaN') {
				$row[] = "<td class='text-center'>" . 'S/ 0.00' . "</td>";
			} else {
				$row[] = "<td class='text-center'>" . 'S/ ' .  number_format($monto_n, 2, '.', ',') . "</td>";
			}
		} elseif ($aColumnas2[$i] == "cantidad_dias") {
			$row[] = "<td class='text-center'><span style='font-size: 19px;font-weight: bold;color: #01296e;background: #ecf7fd;padding: 2px 10px 2px 10px;border-radius: 25px;'>" . $aRow[$aColumnas2[$i]] . "</span></td>";
		} elseif ($aColumnas2[$i] == "monto_dia") {
			$monto_m = $aRow[$aColumnas2[$i]];
			if ($monto_m == 'NaN') {
				$row[] = "<td class='text-center'>" . 'S/ 0.00' . "</td>";
			} else {
				$row[] = "<td class='text-center'>" . 'S/ ' .  number_format($monto_m, 2, '.', ',') . "</td>";
			}
		} else {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
		}
	}
	$monto_n2 = $aRow['monto'];
	if ($monto_n2 == 'NaN') {
		$monto_n2 = 0;
	}
	$monto_n3 = $aRow['cantidad_dias'];
	if ($monto_n3 == 'NaN') {
		$monto_n3 = 0;
	}
	$row[] = "<td class='dt-center'><button type='button' onclick='cambiarestado2({$aRow['id_conductor']},\"activo\",\"{$monto_n2}\",\"{$monto_n3}\",\"{$fecha}\")' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;'><i class='fas fa-dollar-sign'></i></button></td>";

	$output['aaData'][] = $row;
}
echo json_encode($output);
