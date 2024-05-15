<?php
header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/xls; charset=utf-8'");
header("Content-Disposition: attachment; filename=DOCUMENTOS_VENCIDOS_DE_CONDUCTORES_" . date('Y:m:d:m:s') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

$mysqli = new mysqli('localhost', 'root', '@Vespro', 'chapatutaxi');
if ($mysqli->connect_error) {
	die('Error en la conexion' . $mysqli->connect_error);
}
date_default_timezone_set("America/Lima");
$hora12 = date("h:i:s A");
$hora24 = date("H:i:s");
$una_hora_menos = date("H:i:s", (strtotime("-5 Hours")));
$fecha = date("Y-m-d");

$fecha_actual = date('Y-m-d');
$nueva_fecha = date('Y-m-d', strtotime($fecha_actual . ' +7 days'));
$sTabla = "documentos_conductor 
JOIN conductor ON conductor.id_conductor = documentos_conductor.id_conductor 
JOIN vehiculo ON vehiculo.id_vehiculo = conductor.id_vehiculo 
JOIN persona ON persona.id_persona = conductor.id_persona";
$aColumnas = array(
	'documentos_conductor.id',
	'documentos_conductor.id_conductor',
	'conductor.estado',
	'vehiculo.unidad',
	'dni_fv',
	'licencia_fv',
	'soat_fv',
	'revision_tecnica_fv',
	'certificado_gnv_glp_fv',
	'persona.nombres',
	'persona.telefono'
);
$aColumnas3 = array(
	'documentos_conductor.id',
	'documentos_conductor.id_conductor',
	'conductor.estado',
	'vehiculo.unidad',
	'dni_fv',
	'licencia_fv',
	'soat_fv',
	'revision_tecnica_fv',
	'certificado_gnv_glp_fv',
	'persona.nombres',
	'persona.telefono'
);
$aColumnas2 = array(
	'id',
	'id_conductor',
	'estado',
	'unidad',
	'dni_fv',
	'licencia_fv',
	'soat_fv',
	'revision_tecnica_fv',
	'certificado_gnv_glp_fv',
	'nombres',
	'telefono'
);
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
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere AND (dni_fv <= '$nueva_fecha' OR licencia_fv <= '$nueva_fecha' OR soat_fv <= '$nueva_fecha' OR revision_tecnica_fv <= '$nueva_fecha' OR certificado_gnv_glp_fv <= '$nueva_fecha') AND conductor.estado <> 'sinaprobar' $sOrder ";
} else {
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumnas)) . " FROM $sTabla $sWhere WHERE (dni_fv <= '$nueva_fecha' OR licencia_fv <= '$nueva_fecha' OR soat_fv <= '$nueva_fecha' OR revision_tecnica_fv <= '$nueva_fecha' OR certificado_gnv_glp_fv <= '$nueva_fecha') AND conductor.estado <> 'sinaprobar' $sOrder ";
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
		} elseif ($aColumnas2[$i] == "id_conductor") {
			//
		} elseif ($aColumnas2[$i] == "estado") {
			//
		} elseif ($aColumnas2[$i] == "dni_fv") {
			$estadorecarga = '';
			$fecha_actual = strtotime($fecha);
			$fecha_entrada = strtotime($aRow['dni_fv']);
			$fechasdiferencias = '';
			if ($fecha_actual >= $fecha_entrada) {
				$date1 = new DateTime($aRow['dni_fv']);
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
				$date2 = new DateTime($aRow['dni_fv']);
				$date1 = new DateTime($fecha);
				$diff = $date1->diff($date2);
				$fechasdiferencias2 = $diff->days;
				
				if ($fechasdiferencias2 == 1) {
					$fechasdiferencias = "<span class='estado_inactivo'>Vence ma&ntilde;ana</span>";
				} else {
					$fechasdiferencias = "<span class='estado_activo'>Vence en " . $fechasdiferencias2 . " d&iacute;as</span>";
				}
				$estadorecarga =  $fechasdiferencias;
			}
			$row[] = "<td class='text-center'>" . $estadorecarga . "</td>";
			
		} elseif ($aColumnas2[$i] == "licencia_fv") {
			$estadorecarga = '';
			$fecha_actual = strtotime($fecha);
			$fecha_entrada = strtotime($aRow['licencia_fv']);
			$fechasdiferencias = '';
			if ($fecha_actual >= $fecha_entrada) {
				$date1 = new DateTime($aRow['licencia_fv']);
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
				$date2 = new DateTime($aRow['licencia_fv']);
				$date1 = new DateTime($fecha);
				$diff = $date1->diff($date2);
				$fechasdiferencias2 = $diff->days;
				
				if ($fechasdiferencias2 == 1) {
					$fechasdiferencias = "<span class='estado_inactivo'>Vence ma&ntilde;ana</span>";
				} else {
					$fechasdiferencias = "<span class='estado_activo'>Vence en " . $fechasdiferencias2 . " d&iacute;as</span>";
				}
				$estadorecarga =  $fechasdiferencias;
			}
			$row[] = "<td class='text-center'>" . $estadorecarga . "</td>";
			
		} elseif ($aColumnas2[$i] == "soat_fv") {

			$estadorecarga = '';
			$fecha_actual = strtotime($fecha);
			$fecha_entrada = strtotime($aRow['soat_fv']);
			$fechasdiferencias = '';
			if ($fecha_actual >= $fecha_entrada) {
				$date1 = new DateTime($aRow['soat_fv']);
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
				$date2 = new DateTime($aRow['soat_fv']);
				$date1 = new DateTime($fecha);
				$diff = $date1->diff($date2);
				$fechasdiferencias2 = $diff->days;
				
				if ($fechasdiferencias2 == 1) {
					$fechasdiferencias = "<span class='estado_inactivo'>Vence ma&ntilde;ana</span>";
				} else {
					$fechasdiferencias = "<span class='estado_activo'>Vence en " . $fechasdiferencias2 . " d&iacute;as</span>";
				}
				$estadorecarga =  $fechasdiferencias;
			}
			$row[] = "<td class='text-center'>" . $estadorecarga . "</td>";
			
			
		} elseif ($aColumnas2[$i] == "revision_tecnica_fv") {
			$estadorecarga = '';
			$fecha_actual = strtotime($fecha);
			$fecha_entrada = strtotime($aRow['revision_tecnica_fv']);
			$fechasdiferencias = '';
			if ($fecha_actual >= $fecha_entrada) {
				$date1 = new DateTime($aRow['revision_tecnica_fv']);
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
				$date2 = new DateTime($aRow['revision_tecnica_fv']);
				$date1 = new DateTime($fecha);
				$diff = $date1->diff($date2);
				$fechasdiferencias2 = $diff->days;
				
				if ($fechasdiferencias2 == 1) {
					$fechasdiferencias = "<span class='estado_inactivo'>Vence ma&ntilde;ana</span>";
				} else {
					$fechasdiferencias = "<span class='estado_activo'>Vence en " . $fechasdiferencias2 . " d&iacute;as</span>";
				}
				$estadorecarga =  $fechasdiferencias;
			}
			$row[] = "<td class='text-center'>" . $estadorecarga . "</td>";
			
		} elseif ($aColumnas2[$i] == "certificado_gnv_glp_fv") {
			$estadorecarga = '';
			$fecha_actual = strtotime($fecha);
			$fecha_entrada = strtotime($aRow['certificado_gnv_glp_fv']);
			$fechasdiferencias = '';
			if ($fecha_actual >= $fecha_entrada) {
				$date1 = new DateTime($aRow['certificado_gnv_glp_fv']);
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
				$date2 = new DateTime($aRow['certificado_gnv_glp_fv']);
				$date1 = new DateTime($fecha);
				$diff = $date1->diff($date2);
				$fechasdiferencias2 = $diff->days;
				
				if ($fechasdiferencias2 == 1) {
					$fechasdiferencias = "<span class='estado_inactivo'>Vence ma&ntilde;ana</span>";
				} else {
					$fechasdiferencias = "<span class='estado_activo'>Vence en " . $fechasdiferencias2 . " d&iacute;as</span>";
				}
				$estadorecarga =  $fechasdiferencias;
			}
			$row[] = "<td class='text-center'>" . $estadorecarga . "</td>";
			
		} else {
			$row[] = "<td class='text-center'>" . $aRow[$aColumnas2[$i]] . "</td>";
		}
	}
	$output['aaData'][] = $row;
}

$tabla = "<table>
<thead>
    <tr>
        <th>UNIDAD</th>
        <th>DOC. DE IDENTIDAD</th>
        <th>LICENCIA</th>
        <th>SOAT</th>
        <th>REVISI&Oacute;N T&Eacute;CNICA</th>
        <th>CERTIFICADO DE GLP/GNV</th>
        <th>NOMBRE</th>
        <th>TELEFONO</th>
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
