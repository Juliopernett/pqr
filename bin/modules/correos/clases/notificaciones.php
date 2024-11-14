<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Notificacion extends ADOdb_Active_Record{}
class listCorreo
{


public function reg_notificacion($id, $descripcion)  
     
    {
        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $hora =  date ("h:i:s");
            
        $reg              = new Notificacion('notificacion');
        $reg->id_solicitud              =$id;       
        $reg->fecha_notificacion        = $fecha;
        $reg->descripcion_notificacion  = $descripcion;
        $reg->estado  = 1;
        $reg->Save();
        
    }

public function buscar_fechas(){
        $db = App::$base;

        $sql = "SELECT DATEDIFF(NOW(),fecha) as dias,
                        id_estado, 
                        id_solicitud, 
                        para_notificacion,
                        id_seguimiento
                FROM seguimiento_solicitud 
                WHERE id_estado = 1 and id_solicitud not in (SELECT id_solicitud FROM notificacion)";
                $rs = $db->dosql($sql, array());                 
                
                while (!$rs->EOF) 
                   {                      
                                            
                          if($rs->fields['dias'] >= 1) {
                            $this->reg_notificacion($rs->fields['id_solicitud'], 'Alerta la solicitud no ha sido resuelta');
                           // $this->enviarCorreo($rs->fields['id_solicitud']);
                            }
                                                  
  
                 $rs->MoveNext();     
                   }  

}


public function listarNotificacion()
{
  //var_dump($id);
	$con = App::$base;
  $sql = "SELECT DATEDIFF(NOW(),fecha) as dias,
              id_estado, 
              id_solicitud, 
              para_notificacion,
              id_seguimiento
            FROM seguimiento_solicitud 
            WHERE id_estado = 1 and id_solicitud not in (SELECT id_solicitud FROM notificacion)";
   /* $sql = "SELECT 
              id_notificacion,
              CONCAT('PQR #', ' ', id_solicitud) as pqr,
              fecha_notificacion,
              descripcion_notificacion
              FROM notificacion
              WHERE estado = 1";*/

		$rs = $con->dosql($sql, array());
    //var_dump($this->buscarGrado($id));
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Solicitud</th>
                        <th id="yw9_c2">Fecha de Alerta</th>
                        <th id="yw9_c2">Descripcion</th>
                                 
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_notificacion']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['pqr']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['fecha_notificacion']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['descripcion_notificacion']).'
                            </td>';                                                                               
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        //var_dump($tabla);
        return $tabla;

}

 public function buscarCorreoDocente($id)
  {
    $db = App::$base;
        $sql = "SELECT
                 user_email
                 FROM
                 docente
                 WHERE id_docente = ?";
    $rs = $db->dosql($sql, array($id));

    return $rs->fields['user_email'];

  }

public function enviarCorreo($cor){

$asunto = "Alerta PQR#  $cor";
$cuerpo = "No ha solucionado la Solicitud PQR #- $cor , favor revisar, esta es una prueba de recibir correo en el sistema de PQR";
$inicio = nl2br("Administrador \nFavor responder este correo a \n\n$cuerpo");
$mensaje = str_replace("<br />", "", $inicio);
//$correo = "";
//$correo = "";
if($correo == "" || $correo =="NULL" ){
return -1;}
else{

$subject = $asunto;// El valor entre corchetes son los atributos name del formulario html
$msg = $cuerpo;
$from = $correo;
// El from DEBE corresponder a una cuenta de correo real creada en el servidor
$headers = "From: prueba@\r\n"; 
$headers .= "Reply-To: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n"; 
	
if(mail($from, $subject, $msg,$headers)){
	//echo "mail enviado";
	}else{
	//$errorMessage = error_get_last()['msg'];
//	echo $errorMessage;
}

}
}



  public function buscar($id,$r)
  {
    $db = App::$base;    
        $sql = "SELECT 
                   CONCAT(`grado`.`descripcion`,' ',
                  `grado`.`letra`) as curso
                FROM
                  `grado`
                  INNER JOIN `estudiantexgrado` ON (`grado`.`id_grado` = `estudiantexgrado`.`id_grado`)
                  INNER JOIN `estudiante` ON (`estudiantexgrado`.`id_estudiante` = `estudiante`.`id_estudiante`)
                WHERE
                  `estudiantexgrado`.`id_estudiante` = ? AND 
                  `estudiantexgrado`.`estado_grado` = 1
                LIMIT 1";
    $rs = $db->dosql($sql, array($id));
  /*  if($r == 1){
    return $rs->fields['nombres'];
        }
        else{
     return $rs->fields['curso'];
        }*/
return $rs->fields['curso'];
  }

}

?>