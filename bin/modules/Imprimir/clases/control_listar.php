<?php
include_once 'class_solicitud.php';
$opcion = $_POST['opcion'] ?? null;
$id = $_POST['id']  ?? null ;
$estado = $_POST['estado']  ?? null;
$disc       = new regSolicitud();	
switch ($opcion) {
	case '1':
		//echo $disc->listSolicitud();
		break;
	case '2':
		echo $disc->listSolicitud2();
		break;
	default:
		# code...
		break;
}

?>