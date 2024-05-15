<?php
$mysqli = new mysqli('localhost', 'root', '@Vespro', 'chapatutaxi');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
$sTabla = "pasajero JOIN persona ON persona.id_persona=pasajero.id_persona";
$aColumnas = array(
	'
pasajero.id_pasajero as pasajero',
	'persona.foto',
	'pasajero.id_persona as persona',
	'persona.nombres',
	'persona.correo',
	'persona.telefono',
	'pasajero.estado',
	'(SELECT 
 CAST(AVG(opinion_conductor.valoracion) AS DECIMAL(10,2)) AS promedio FROM opinion_conductor INNER JOIN solicitud ON solicitud.id_solicitud = opinion_conductor.id_solicitud WHERE `id_pasajero`= pasajero.id_pasajero GROUP BY id_pasajero) 
AS ranking',
	'(SELECT 
 COUNT(opinion_conductor.valoracion) AS conteo FROM opinion_conductor INNER JOIN solicitud ON solicitud.id_solicitud = opinion_conductor.id_solicitud WHERE `id_pasajero`= pasajero.id_pasajero GROUP BY id_pasajero) 
AS solicitudes'
);
$aColumnas2 = array('pasajero', 'foto', 'persona', 'nombres', 'correo', 'telefono', 'estado');
$aColumnas3 = array('pasajero.id_pasajero', 'foto', 'pasajero.id_persona', 'nombres', 'correo', 'telefono', 'estado');
$sIndexColumn = "pasajero.id_pasajero";
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
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere $sOrder $sLimit";
} else {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere $sOrder $sLimit ";
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
	for ($i = 0; $i < count($aColumnas2); $i++) {
		if ($aColumnas2[$i] == "persona" || $aColumnas2[$i] == "pasajero") {
			//
		} elseif ($aColumnas2[$i] == "solicitudes") {
			//
		} elseif ($aColumnas2[$i] == "ranking") {
			//
		} elseif ($aColumnas2[$i] == "foto") {
			//$row[] = "<td><img src='https://chapatutaxi.com/chapaapi/images/".$aRow[$aColumnas2[$i]]."' class='circle' style='width: 70px;height: 70px;overflow: hidden;border-radius: 45px;border: none;text-align: center;object-fit: cover;color: transparent;text-indent: 10000px;'></td>";
		} elseif ($aColumnas2[$i] == "estado") {
			if ($aRow[$aColumnas2[$i]] == 'inactivo') {
				$row[] = "<span class='estado_inactivo'>Inactivo</span>";
			} elseif ($aRow[$aColumnas2[$i]] == 'espera') {
				$row[] = "<span class='estado_espera'>Espera</span>";
			} elseif ($aRow[$aColumnas2[$i]] == 'activo') {
				$row[] = "<span class='estado_activo'>Activo</span>";
			} else {
				$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
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

	$row[] = "<td class='text-center'><button type='button' onclick='cargardatos(" . $aRow['pasajero'] . ")' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;'><i class='fas fa-edit'></i></button></td>";
	$row[] = "<td class='text-center'>{$ranking} <span> {$aRow['ranking']}</span></td>";
	$row[] = "<td class='text-center'><span style='font-size: 19px;font-weight: bold;color: #5f14ba;background: #e9e0f5;padding: 2px 10px 2px 10px;border-radius: 25px;'>{$aRow['solicitudes']}</span></td>";
	$row[] = "<td class='text-center'><button type='button' onclick='eliminar_pasajero(".$aRow['persona'].",".$aRow['pasajero'].")' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;background: #c91717;'><i class='fas fa-user-times'></i></button></td>";
	$output['aaData'][] = $row;
}
echo json_encode($output);
