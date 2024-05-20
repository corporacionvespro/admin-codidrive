<?php
function convertToUTCMinus5($date) {
    $input = DateTime::createFromFormat('Y-m-d H:i:s', $date, new DateTimeZone('UTC'));
    $output = new DateTimeZone('Etc/GMT+5');

    if ($input instanceof DateTime) {
        $input->setTimezone($output);
        return $input->format('Y-m-d H:i:s');
    } else {
        return "";
    }
} 
$mysqli = new mysqli('161.132.54.172', 'root', 'vespro$2024&', 'codidrive');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
$sTabla = "solicitud 
JOIN conductor ON conductor.id_conductor = solicitud.id_conductor 
JOIN pasajero ON pasajero.id_pasajero = solicitud.id_pasajero 
JOIN localizacion ON localizacion.id_localizacion = solicitud.id_localizacion";
$sTabla2 = "solicitud 
JOIN conductor ON conductor.id_conductor = solicitud.id_conductor 
JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo
JOIN pasajero ON pasajero.id_pasajero = solicitud.id_pasajero 
JOIN localizacion ON localizacion.id_localizacion = solicitud.id_localizacion
JOIN persona ON persona.id_persona = pasajero.id_persona";

$aColumnas = array(
	'solicitud.id_solicitud',
	'(SELECT persona.nombres FROM persona WHERE persona.id_persona = pasajero.id_persona) as nombrepasajero',
	'(SELECT persona.telefono FROM persona WHERE persona.id_persona = pasajero.id_persona) as telefonopasajero',
	'(SELECT persona.nombres FROM persona WHERE persona.id_persona = conductor.id_persona) as nombreconductor',
	'(SELECT CONCAT(
		"<br>
		<div style=\'margin-left: 1rem;\'>
			<strong style=\'color: #5f14ba;\'>N°: </strong>",vehiculo.unidad,"
			<strong style=\'color: #5f14ba;\'>  -  Marca: </strong>",vehiculo.marca,"<br>
			<strong style=\'color: #5f14ba;\'>Color: </strong>",vehiculo.color,"
			<strong style=\'color: #5f14ba;\'>  -  Placa: </strong>",vehiculo.placa,"
		</div>"
		) as unidades FROM conductor JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo WHERE id_conductor = solicitud.id_conductor) as unidadconductor',
	'CONCAT(
		"<br>
		<div style=\'margin-left: 1rem;\'>
			<strong style=\'color: #5f14ba;\'>Origen: </strong>
			",
				localizacion.direccion_actual, 
		   "<br>
			<strong style=\'color: #5f14ba;\'>Destino: </strong>
			",
			localizacion.direccion_destino,
			"
		</div>"
		) AS direcciones',
	'localizacion.referencia',
	'solicitud.estado as sestado',
	'solicitud.precio',
	'solicitud.fechayhora',
	'CONCAT("https://www.google.com/maps/dir/",localizacion.latitud_origen, ",",localizacion.longitud_origen, "/",localizacion.latitud_destino, ",",localizacion.longitud_destino) AS rutas',
	'solicitud.tipo',
	'solicitud.tipo_pago',
);
$aColumnas2 = array('id_solicitud', 'nombrepasajero', 'telefonopasajero', 'sestado', 'nombreconductor', 'unidadconductor', 'direcciones', 'referencia', 'precio', 'fechayhora', 'rutas', 'tipo', 'tipo_pago');
$aColumnas3 = array('id_solicitud', 'persona.nombres', 'persona.telefono', 'referencia ', 'localizacion.direccion_actual', 'localizacion.direccion_destino', 'precio', 'fechayhora', 'tipo', 'vehiculo.unidad', 'vehiculo.marca', 'vehiculo.color', 'vehiculo.placa', 'tipo_pago', 'localizacion.direccion_actual');
$sIndexColumn = "id_solicitud";
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
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $aColumnas) . " FROM $sTabla2 $sWhere $sOrder $sLimit";
} else {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $aColumnas) . " FROM $sTabla $sWhere $sOrder $sLimit ";
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
		if ($aColumnas2[$i] == "id_solicitud") {
			//
		} elseif ($aColumnas2[$i] == "rutas") {
			$row[] = "<td class='text-center'><a title='Mapa' href='" . $aRow[$aColumnas2[$i]] . "' target='_blank'><i class='fas fa-map-marked-alt'></i></a></td>";
		} elseif ($aColumnas2[$i] == "nombreconductor") {
			if ($aRow[$aColumnas2[$i]] == 'Vespro Tech') {
				$row[] = "<td class='text-center'><span class='estado_pendiente'>Sin Conductor</span></td>";
			} else {
				$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
			}
		}elseif ($aColumnas2[$i] == "referencia") {
			if ($aRow[$aColumnas2[$i]] == 'undefined'||$aRow[$aColumnas2[$i]] == '') {
				$row[] = "<td class='text-center'><span class='estado_pendiente'>Sin referencia</span></td>";
			} else {
				$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
			}
		} elseif ($aColumnas2[$i] == "unidadconductor") {
			if ($aRow[$aColumnas2[$i]] == 'N°: 0 || Marca: Tesla || Color: Blanco || Placa: ABC-123') {
				$row[] = "<td class='text-center'><span class='estado_pendiente'>Sin unidad</span></td>";
			} else {
				$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
			}
		} elseif ($aColumnas2[$i] == "precio") {
			$row[] = "<td class='text-center'>" . 'S/ ' .  number_format($aRow[$aColumnas2[$i]], 2, '.', ',') . "</td>";
		} elseif ($aColumnas2[$i] == "sestado") {
			if ($aRow[$aColumnas2[$i]] == 'finalizado') {
				$row[] = "<span class='estado_finalizado'>Finalizado</span>";
			} elseif ($aRow[$aColumnas2[$i]] == 'aceptado') {
				$row[] = "<span class='estado_aceptado'>Aceptado</span>";
			} elseif ($aRow[$aColumnas2[$i]] == 'cancelado') {
				$row[] = "<span class='estado_cancelado'>cancelado</span>";
			} elseif ($aRow[$aColumnas2[$i]] == 'abordo') {
				$row[] = "<span class='estado_aceptado'>abordo</span>";
			} elseif ($aRow[$aColumnas2[$i]] == 'pendiente') {
				$row[] = "<span class='estado_pendiente'>pendiente</span>";
			} else {
				$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
			}
		}
		elseif ($aColumnas2[$i] == "fechayhora") {
			$row[] = "<td class='text-center'>".date('d/m/Y H:i:s', strtotime($aRow[$aColumnas2[$i]]))."</td>";
		}  else {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
		}
	}
	//echo "SELECT opinion_conductor.valoracion AS v_pasajero FROM opinion_conductor WHERE opinion_conductor.id_solicitud = '{$aRow['id_solicitud']}'";
	$query_v_pasajero = $mysqli->query("SELECT opinion_conductor.valoracion AS v_pasajero FROM opinion_conductor WHERE opinion_conductor.id_solicitud = '{$aRow['id_solicitud']}'");
	$v_pasajero2 = $query_v_pasajero->fetch_assoc();
	$v_pasajero = $v_pasajero2['v_pasajero'];
	//echo "SELECT opinion_conductor.comentario AS c_pasajero FROM opinion_conductor WHERE opinion_conductor.id_solicitud = '{$aRow['id_solicitud']}'";
	$query_c_pasajero = $mysqli->query("SELECT opinion_conductor.comentario AS c_pasajero FROM opinion_conductor  WHERE opinion_conductor.id_solicitud = '{$aRow['id_solicitud']}'");
	$c_pasajero2 = $query_c_pasajero->fetch_assoc();
	$c_pasajero = $c_pasajero2['c_pasajero'];
	//echo "SELECT opinion.valoracion AS v_conductor FROM opinion WHERE opinion.id_solicitud = '{$aRow['id_solicitud']}'";
	$query_v_conductor = $mysqli->query("SELECT opinion.valoracion AS v_conductor FROM opinion WHERE opinion.id_solicitud = '{$aRow['id_solicitud']}'");
	$v_conductor2 = $query_v_conductor->fetch_assoc();
	$v_conductor = $v_conductor2['v_conductor'];
	//echo "SELECT opinion.comentario AS c_conductor FROM opinion WHERE opinion.id_solicitud = '{$aRow['id_solicitud']}'";
	$query_c_conductor = $mysqli->query("SELECT opinion.comentario AS c_conductor FROM opinion WHERE opinion.id_solicitud = '{$aRow['id_solicitud']}'");
	$c_conductor2 = $query_c_conductor->fetch_assoc();
	$c_conductor = $c_conductor2['c_conductor'];
	if ($aRow['tipo'] == 'app') {
		if ($c_conductor == 'undefined' || $c_conductor == '') {
			$c_conductor = 'Sin comentario';
		}
		if ($c_pasajero == 'undefined' || $c_pasajero == '') {
			$c_pasajero = 'Sin comentario';
		}
		$ranking = '';
		if ($v_pasajero == '') {
			$ranking = 'Sin calificar';
		} elseif ($v_pasajero == 0) {
			$ranking = '<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_pasajero <= 0) {
			$ranking = '<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_pasajero >= 0.5 && $v_pasajero <= 1) {
			$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_pasajero <= 2) {
			$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_pasajero <= 3) {
			$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_pasajero <= 4.9) {
			$ranking = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_pasajero == 5) {
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

		$ranking2 = '';
		if ($v_conductor == '') {
			$ranking2 = 'Sin calificar';
		} elseif ($v_conductor == 0) {
			$ranking2 = '<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_conductor <= 0) {
			$ranking2 = '<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_conductor >= 0.5 && $v_conductor <= 1) {
			$ranking2 = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_conductor <= 2) {
			$ranking2 = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_conductor <= 3) {
			$ranking2 = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_conductor <= 4.9) {
			$ranking2 = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star"></span>';
		} elseif ($v_conductor == 5) {
			$ranking2 = '<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>
		<span class="fa fa-star checkedstar"></span>';
		} else {
			$ranking2 = '<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>';
		}
		
		$row[] = "<div style=\"margin-left: 1rem;\">
			<strong style=\"color: #5f14ba;\">Opini&oacute;n pasajero: </strong> " . $c_conductor . "  " . "<strong style=\"color: #5f14ba;\">Calificaci&oacute;n pasajero: </strong> " . $ranking2 . "<br>
			<strong style=\"color: #5f14ba;\">Opini&oacute;n conductor: </strong> " . $c_pasajero . "  " . "<strong style=\"color: #5f14ba;\">Calificaci&oacute;n conductor: </strong> " . $ranking . "
		</div>";/**/
	} else {
		$row[] = "<div style=\"margin-left: 1rem;\">
			<strong style=\"color: #5f14ba;\">Las solicitudes web no cuentan con esta opci&oacute;n</strong></div>";/**/
	}

	$row[] = "<td class='text-center'><button type='button' onclick='cancelar(" . $aRow['id_solicitud'] . ")' class='boton-save'  data-toggle='modal' data-target='#modal-notification'  style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;'><i class='fas fa-ban'></i></button></td>";
	$output['aaData'][] = $row;
}
echo json_encode($output);
