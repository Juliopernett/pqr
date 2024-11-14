<?php
session_start();
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Solicitud extends ADOdb_Active_Record{}
 class Seguimiento extends ADOdb_Active_Record{}
 class Documento extends ADOdb_Active_Record{}
 class NotificacionAdmin extends ADOdb_Active_Record{}
class regSolicitud
{
  public $id;
 // public $user = $_SESSION['user_id'];

public function reg_solicitud($id,$tipo,$descripcion, $fecha, $asunto)
    {
       
        $reg              = new Solicitud('solicitud');
        $reg->user_id      = $id;
        $reg->id_tiposolicitud = $tipo;
        $reg->descripcion_solicitud = $descripcion;
        $reg->fecha = $fecha;
        $reg->estado_solicitud = "Activa";
        $reg->asunto = $asunto;
        $reg->Save();
        $this->id = $reg->id_solicitud;
        return $this->id;
    }

    public function reg_seguimiento()
    {
      date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $hora =  date ("h:i:s");
        $currentDateTime=date('m/d/Y H:i:s');
        $newDateTime = date('h:i A', strtotime($currentDateTime));
        $reg              = new Seguimiento('seguimiento_solicitud');
        $reg->id_solicitud      = $this->id;
        $reg->fecha = $fecha;
        $reg->hora = $newDateTime;
        $reg->id_estado = 1;
        $reg->descripcion_estado = 'La solicitud fue recibida con exito, pronto recibira respuesta.';
        $reg->Save();

    }

     public function reg_documento($titulo, $descripcion, $tamanio,$tipo, $nombre, $user_id)
    {
      
        $reg              = new Documento('tbl_documentos');
        $reg->titulo      = $titulo;
        $reg->descripcion = $descripcion;
        $reg->tamanio = $tamanio;
        $reg->tipo = $tipo;
        $reg->nombre_archivo = $nombre;
        $reg->id_usuario = $user_id;
        $reg->id_solicitud = $this->id;
        $reg->Save();


        
    }

     public function reg_seguimientonew($id,$solicitud ,$estado, $descripcion)
    {
      date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $hora =  date ("h:i:s");
        $currentDateTime=date('m/d/Y H:i:s');
        $newDateTime = date('h:i A', strtotime($currentDateTime));
        $reg              = new Seguimiento('seguimiento_solicitud');
       // $reg->load("id_seguimiento = {$id}");
        $reg->id_solicitud      = $solicitud;
        $reg->fecha = $fecha;
        $reg->hora = $newDateTime;
        $reg->id_estado = $estado;
        $reg->descripcion_estado = $descripcion;
        //$reg->Save();

       

        $reg->Save();
        
        if($this->buscarNotificacion($solicitud) != -1)
        {
           $this->editNotificacion($this->buscarNotificacion($solicitud));
        }
    }


    public function editNotificacion($id)
    {
      
        $reg              = new NotificacionAdmin('notificacion');
        $reg->load("id_notificacion = {$id}");
        $reg->estado      = 0;     
        $reg->Save();
        
    }

    public function buscarNotificacion($id)
  {
    $db = App::$base;
        $sql = "SELECT 
                  id_solicitud, id_notificacion
                FROM
                  notificacion                  
                  WHERE id_solicitud = ?
                  AND id_solicitud != 0";
                    $rs = $db->dosql($sql, array($id));
                    if($rs->fields["id_solicitud"] == "NULL" || $rs->fields["id_solicitud"] == "")
                  return -1;
                else
                  return $rs->fields["id_notificacion"];

  }


public function listSolicitud()
{
	$con = App::$base;
    $sql = "SELECT 
            `users`.`user_id`,
            `users`.`firstname`,
            `users`.`lastname`,
            `tipo_solicitud`.`descripcion` AS tipo,
            `solicitud`.`fecha`,
            `solicitud`.`estado_solicitud`,
            `solicitud`.`id_solicitud`,
            `seguimiento_solicitud`.`fecha` as fecha1,
            `seguimiento_solicitud`.`hora` as hora,
            `estado`.`descripcion` as estado_descripcion,
             `seguimiento_solicitud`.`id_seguimiento`,        
               \"
              <button type=\'button\' class=\'btn btn-success btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' data-target=\'#myModal\' >
               <span class=\'glyphicon glyphicon-eye-open\'></span></button>
               </div>
                \" 
               as editar                   
            FROM
              `solicitud`
              INNER JOIN `users` ON (`solicitud`.`user_id` = `users`.`user_id`)
              INNER JOIN `tipo_solicitud` ON (`solicitud`.`id_tiposolicitud` = `tipo_solicitud`.`id_tiposolicitud`)
              INNER JOIN `seguimiento_solicitud` ON (`solicitud`.`id_solicitud` = `seguimiento_solicitud`.`id_solicitud`)
              INNER JOIN `estado` ON (`estado`.`id_estado` = `seguimiento_solicitud`.`id_estado`)
              WHERE
             `users`.`user_id` = ?
              AND
             `solicitud`.`estado_solicitud` != ? ";

		$rs = $con->dosql($sql, array($_SESSION['user_id'], 'Inactiva'));
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Nombres</th>
                        <th id="yw9_c2">Apellidos</th>
                        <th id="yw9_c4">Descripcion</th>
                        <th id="yw9_c5">Fecha</th>
                        <th id="yw9_c5">Estado</th>
                        <th id="yw9_c5">Ver</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                    if ($rs->fields['estado_descripcion']=='ENVIADA'){
                          $text_estado="Enviada";
                          $label_class='label-primary';}
                      if($rs->fields['estado_descripcion']=='EN TRAMITE'){
                          $text_estado="En Tramite";
                          $label_class='label-warning';}
                      if($rs->fields['estado_descripcion']=='RESUELTA'){
                          $text_estado="Resuelta";
                          $label_class='label-info';}

                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_seguimiento']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['firstname']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['lastname']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['tipo']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['fecha1']).'
                            </td> 
                            <td align="center">                            
                             <span class="label '.$label_class.'">'.$text_estado.'</span>
                             </td>  
                                                    
                            <td width= "30" onclick="editar('.$rs->fields['id_seguimiento'].','.$rs->fields['id_solicitud'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            ' ;                                                                               
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

/*public function eliminar($id)
{
    $con = App::$base;
    $sql = "DELETE 
    FROM `colegio`.`grado` 
    WHERE `id_grado`= ?";
    $rs = $con->dosql($sql, array($id));
}

public function eliminar($id)
{
    $reg              = new Grado('grado');
    $reg->load("id_grado = {$id}");
    $reg->Delete();
}*/

/*public function editar($id,$desc, $letra, $numero)
  {

        $db = App::$base;
        $sql = "UPDATE `colegio`.`grado`
                SET descripcion = ?, `letra`= ?, numero = ?
                WHERE `id_grado`= ?";
    $rs = $db->dosql($sql, array($desc,$letra,$numero,$id));
       //var_dump($sql);
  }

  public function editar($id,$desc, $letra, $numero)
    {
        $reg              = new Grado('grado');
        $reg->load("id_grado = {$id}");
        $reg->descripcion      = $desc;
         $reg->letra = $letra;
        $reg->numero = $numero;       
        $reg->Save();
        //return $reg->id_grado;
    }*/

  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT 
                  `solicitud`.`descripcion_solicitud`,
                  `seguimiento_solicitud`.`descripcion_estado`,
                  `seguimiento_solicitud`.`id_seguimiento`,
                  `solicitud`.`estado_solicitud`
                FROM
                  `solicitud`
                  INNER JOIN `seguimiento_solicitud` ON (`solicitud`.`id_solicitud` = `seguimiento_solicitud`.`id_solicitud`)
                  WHERE `seguimiento_solicitud`.`id_seguimiento`= ?";
                    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF) 
                   {

                    $res = array( 
                     "descripcion_estado" => $rs->fields['descripcion_estado'],
                     "descripcion_solicitud" => $rs->fields['descripcion_solicitud'],
                     "estado_solicitud" => $rs->fields['estado_solicitud']
                      );

                    $rs->MoveNext();      
                   } 
                   return $res;

  }

  public function estados()
  {
    $db = App::$base;
        $sql = "SELECT 
                  id_estado,
                  descripcion
                FROM
                  estado";
                    $rs = $db->dosql($sql, array());

    while (!$rs->EOF) 
                   {

                    $res[] = array( 
                     "id_estado" => $rs->fields['id_estado'],
                     "descripcion" => $rs->fields['descripcion']
                     );                     

                    $rs->MoveNext();      
                   } 
                   
                   return $res;

  }

}

?>