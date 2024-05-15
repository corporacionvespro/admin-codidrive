<?php
$mysqli = new mysqli('localhost', 'root', '@Vespro', 'chapatutaxi');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
$sTabla = "conductor JOIN persona ON persona.id_persona = conductor.id_persona JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo";
$aColumnas = array(
	'id_conductor',
	'persona.foto',
	'persona.nombres',
	'conductor.id_persona',
	'conductor.id_vehiculo',
	'conductor.id_cuenta',
	'vehiculo.unidad',
	'vehiculo.placa',
	'vehiculo.marca',
	'persona.telefono',
	'conductor.estado',
	'(SELECT 
	 CAST(AVG(opinion.valoracion) AS DECIMAL(10,2)) AS promedio FROM opinion INNER JOIN solicitud ON solicitud.id_solicitud = opinion.id_solicitud WHERE `id_conductor`= conductor.id_conductor AND opinion.valoracion <> 0 GROUP BY id_conductor) 
	AS ranking',
	/*'(SELECT 
	 COUNT(opinion.valoracion) AS conteo FROM opinion INNER JOIN solicitud ON solicitud.id_solicitud = opinion.id_solicitud WHERE `id_conductor`= conductor.id_conductor GROUP BY id_conductor) 
	AS solicitudes'*/
	'(SELECT COUNT(`id_solicitud`) FROM `solicitud` WHERE `id_conductor`= conductor.id_conductor) AS solicitudes'
);
$aColumnas3 = array('id_conductor', 'persona.foto', 'persona.nombres', 'conductor.id_persona', 'conductor.id_vehiculo', 'conductor.id_cuenta', 'vehiculo.unidad', 'vehiculo.placa', 'vehiculo.marca', 'persona.telefono', 'conductor.estado');
$aColumnas2 = array('id_conductor', 'foto', 'nombres', 'id_vehiculo', 'id_persona', 'id_cuenta', 'unidad', 'placa', 'marca', 'telefono', 'estado');
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
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere AND conductor.estado <>'sinaprobar' $sOrder $sLimit";
} else {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere AND conductor.estado <>'sinaprobar' $sOrder $sLimit ";
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
		} elseif ($aColumnas2[$i] == "id_persona") {
			//
		} elseif ($aColumnas2[$i] == "solicitudes") {
			//
		} elseif ($aColumnas2[$i] == "ranking") {
			//
		} elseif ($aColumnas2[$i] == "foto") {
			if ($aRow[$aColumnas2[$i]] == "default.png" || $aRow[$aColumnas2[$i]] == "https://chapatutaxi.com/chapaapi/images/logo.png") {
				$row[] = "<td class='text-center'><img src='https://chapatutaxi.com/admin/assets/img/brand/logo.png' class='circle' style='width: 70px;height: 70px;overflow: hidden;border-radius: 45px;border: none;text-align: center;object-fit: cover;color: transparent;text-indent: 10000px;max-width: 100 !important;'></td>";
			} else {
				$row[] = "<td class='text-center'><img src='https://chapatutaxi.com/chapaapi/images/" . $aRow[$aColumnas2[$i]] . "' class='circle' style='width: 70px;height: 70px;overflow: hidden;border-radius: 45px;border: none;text-align: center;object-fit: cover;color: transparent;text-indent: 10000px;max-width: 100 !important;'></td>";
			}
		} else {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
		}
	}
	$ranking = '';
	if ($aRow['ranking'] == '') {
		$ranking = '';
	} elseif ($aRow['ranking'] == 0) {
		$ranking = '<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
	} elseif ($aRow['ranking'] <= 0) {
		$ranking = '<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
	} elseif ($aRow['ranking'] >= 0.5 && $aRow['ranking'] <= 1) {
		$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
	} elseif ($aRow['ranking'] <= 2) {
		$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
	} elseif ($aRow['ranking'] <= 3) {
		$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
	} elseif ($aRow['ranking'] <= 4.9) {
		$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>';
	} elseif ($aRow['ranking'] == 5) {
		$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>';
	} else {
		$ranking = '<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
	}

	$row[] = "<td class='text-center'><label class='custom-toggle'><input type='checkbox' " . $estadocontrol . "  onclick='cambiarestado({$aRow['id_conductor']}," . "\"{$estadocambio}\"" . ")'" . $estadodisabled . " ><span class='custom-toggle-slider rounded-circle'></span></label></td>";
	$row[] = "<td class='text-center'><button type='button' onclick='documentos({$aRow['id_conductor']});' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;'><i class='fas fa-id-card'></i></button></td>";
	$row[] = "<td class='text-center'><button type='button' onclick='personalesdatos({$aRow['id_persona']},{$aRow['id_cuenta']})' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;'><i class='fas fa-edit'></i></button></td>";
	$row[] = "<td class='text-center'><button type='button' onclick='vehiculodatos({$aRow['id_vehiculo']})' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;'><i class='fas fa-car-alt'></i></button></td>";
	$row[] = "<td class='text-center'><label class='custom-toggle'><input type='checkbox' " . $estadocontrol2 . "  onclick='cambiarestado({$aRow['id_conductor']}," . "\"{$estadocambio2}\"" . ")'><span class='custom-toggle-slider rounded-circle'></span></label></td>";
	$row[] = "<td class='text-center'>{$ranking} <span> {$aRow['ranking']}</span></td>";
	$row[] = "<td class='text-center'><span style='font-size: 19px;font-weight: bold;color: #5f14ba;background: #e9e0f5;padding: 2px 10px 2px 10px;border-radius: 25px;'>{$aRow['solicitudes']}</span></td>";
	$row[] = "<td class='text-center'><button type='button'  onclick='eliminar_conductor(".$aRow['id_persona'].",".$aRow['id_conductor'].")' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;background: #c91717;'><i class='fas fa-user-times'></i></button></td>";
	$row[] = "<td class='text-center'><button type='button' onclick='cambiarestado({$aRow['id_conductor']}," . "\"sinaprobar\"" . ")' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;background: #1d6f2c;'><i class='fas fa-history'></i></button></td>";
	$output['aaData'][] = $row;
}

echo json_encode($output);