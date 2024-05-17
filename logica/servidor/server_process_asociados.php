<?php
$mysqli = new mysqli('localhost', 'root', 'vespro$2024&', 'codidrive');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
$sTabla = "asociados";
$aColumnas = array('id_asociados', 'logo', 'nombre_asociado', 'telefono_asociado', 'direccion', 'latitud', 'longitud', 'nombre_admin', 'telefono_admin', 'id_categoria_asociados', 'fecha_hora', 'detalle');
$aColumnas3 = array('id_asociados', 'logo', 'nombre_asociado', 'telefono_asociado', 'direccion', 'latitud', 'longitud', 'nombre_admin', 'telefono_admin', 'id_categoria_asociados', 'fecha_hora', 'detalle');
$aColumnas2 = array('id_asociados', 'logo', 'nombre_asociado', 'telefono_asociado', 'direccion', 'latitud', 'longitud', 'nombre_admin', 'telefono_admin', 'id_categoria_asociados', 'fecha_hora', 'detalle');
$sIndexColumn = "id_asociados";
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
	$estadocontrol = '';
	$estadocambio = '';
	for ($i = 0; $i < count($aColumnas2); $i++) {
		if ($aColumnas2[$i] == "id_asociados") {
			//
		} elseif ($aColumnas2[$i] == "logo") {
			$row[] = "<td class='text-center'><img src='" . $aRow[$aColumnas2[$i]] . "' class='circle' style='width: 70px;height: 70px;overflow: hidden;border-radius: 45px;border: none;text-align: center;object-fit: cover;color: transparent;text-indent: 10000px;max-width: 100 !important;'></td>";
		} elseif ($aColumnas2[$i] == "longitud") {
			//
		} elseif ($aColumnas2[$i] == "latitud") {
			//
		} elseif ($aColumnas2[$i] == "id_categoria_asociados") {
			$query_categoria = $mysqli->query("SELECT * FROM `categoria_asociados` WHERE `id_categoria_asociados`= '{$aRow['id_categoria_asociados']}'");
			$v_categoria = $query_categoria->fetch_assoc();
			$nombre_c = $v_categoria['nombre'];
			$row[] = "<td class='text-center'>{$nombre_c}</td>";
		} else {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
		}
	}
	$row[] = "<td class='text-center'><a title='Mapa' href='https://www.google.com/maps/place/{$aRow['latitud']},{$aRow['longitud']}' target='_blank'><i class='fas fa-map-marked-alt'></i></a></td>";
	$row[] = '<td class"text-center"><button type="button" onclick="datos(\'editar\',\''.$aRow['id_asociados'].'\',\''.$aRow['nombre_asociado'].'\',\''.$aRow['telefono_asociado'].'\',\''.$aRow['direccion'].'\',\''.$aRow['latitud'].'\',\''.$aRow['longitud'].'\',\''.$aRow['nombre_admin'].'\',\''.$aRow['telefono_admin'].'\',\''.$aRow['id_categoria_asociados'].'\',\''.$aRow['detalle'].'\',\''.$aRow['logo'].'\')" class="boton-save" style="width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;"><i class="fas fa-edit"></i></button></td>';
	$row[] = "<td class='text-center'><button type='button' onclick='eliminar_asociado({$aRow['id_asociados']})' class='boton-save' style='width: 30px;height: 30px;margin: 0 0 0 0;padding: 0 0 0 0;background: #c91717;'><i class='fas fa-user-times'></i></button></td>";
	$output['aaData'][] = $row;
}
echo json_encode($output);
