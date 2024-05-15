<?php
header('Content-Type: text/html; charset=utf-8');
header("Content-Type: application/xls; charset=utf-8'");
  
	header("Content-Disposition: attachment; filename=documento_exportado_" . date('Y:m:d:m:s').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	require_once 'conn.php';
	
	$output = "";
	
	if(ISSET($_POST['export'])){
		$output .="
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Direccion</th>
					</tr>
				<tbody>
		";
		//mysqli_set_charset($conn, 'utf8');

		$query = mysqli_query($conn, "SELECT * FROM `otrosegresos`");
		while($fetch = mysqli_fetch_array($query)){
			
		$output .= "
					<tr>
						<td>".$fetch['detalle']."</td>
						<td>".$fetch['monto']."</td>
						<td>".$fetch['fecha_hora']."</td>
						<td>".iconv("UTF-8", "ISO-8859-1//TRANSLIT", $fetch['concepto'])."</td>
					</tr>
		";
		}
		
		$output .="
				</tbody>
				
			</table>
		";
		
		echo $output;
	}
	
?>