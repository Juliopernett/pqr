<?php
extract($_POST);
include_once 'class_solicitud.php';
$disc       = new regSolicitud();	
try
{
	$disc->reg_solicitud($user_id,$id_tiposolicitud, $descripcion_solicitud,$fecha, $asunto_solicitud);
	$disc->reg_seguimiento();

	if ($sub != -1) {
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamanio = $_FILES['archivo']['size'];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "../../subirpdf/archivos/" . $nombre;
    if ($nombre != "") {
        if (copy($ruta, $destino)) {
           /* $titulo= $_POST['titulo'];
            $descri= $_POST['descripcion'];
            $sol = $_POST['id_solicitud'];*/
            
          $disc->reg_documento($titulo, $descripcion1, $tamanio,$tipo, $nombre, $user_id);
           
        } 
    }
}

	echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>