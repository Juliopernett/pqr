<?php

//include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
class reporte
{
	public function get_ids_ultimo_seguimiento()
{
    $con = App::$base;
    $sql = "SELECT
    MAX(seguimiento_solicitud.id_seguimiento) as maximo   
FROM
    seguimiento_solicitud
    INNER JOIN estado 
        ON (seguimiento_solicitud.id_estado = estado.id_estado)
    INNER JOIN solicitud 
        ON (seguimiento_solicitud.id_solicitud = solicitud.id_solicitud)
  GROUP BY seguimiento_solicitud.id_solicitud";

        $rs = $con->dosql($sql,'');
        //var_dump($rs);
         while (!$rs->EOF) 
                   {
                    $res[]= $rs->fields['maximo'];           
                   $rs->MoveNext();     
                   }  
            
       
        return $res;

}

/*public function get_solicitudes($estado,$fecha_ini,$fecha_fin)
{   
    $auxsql="";
    if($fecha_ini!="" && $fecha_fin!=""){$array=array($estado,$fecha_ini,$fecha_fin);}else{$array=array($estado);}
    if($fecha_ini!=""){$auxsql="AND DATE(solicitud.fecha) >= ?";$array=array($estado,$fecha_ini);}
    if($fecha_fin!=""){$auxsql.="AND DATE(solicitud.fecha) <= ?";$array=array($estado,$fecha_fin);}
    $con = App::$base;
    $sql = "SELECT
    seguimiento_solicitud.id_seguimiento
    , seguimiento_solicitud.id_solicitud
    , solicitud.sufijo_solicitud
    , solicitud.descripcion_solicitud
    , seguimiento_solicitud.id_estado
    , estado.descripcion AS des_estado
    , seguimiento_solicitud.descripcion_estado 
    , solicitud.estado_solicitud
FROM
    seguimiento_solicitud
    INNER JOIN estado 
        ON (seguimiento_solicitud.id_estado = estado.id_estado)
    INNER JOIN solicitud 
        ON (seguimiento_solicitud.id_solicitud = solicitud.id_solicitud)
    WHERE seguimiento_solicitud.id_estado=? ".$auxsql;
    //var_dump($sql); //AND DATE(solicitud.fecha) >= ? ".$auxsql

    $rs = $con->dosql($sql,$array);
    //var_dump($rs);
        if($rs->fields!=false){
                 while (!$rs->EOF) 
                   {
                    $res[]= array("id_seguimiento"=>$rs->fields['id_seguimiento'],
                                   "id_solicitud"=>$rs->fields['id_solicitud'],
                                   "sufijo_solicitud"=>$rs->fields['sufijo_solicitud'],
                                   "descripcion_solicitud"=>$rs->fields['descripcion_solicitud'],
                                   "id_estado"=>$rs->fields['id_estado'],
                                   "des_estado"=>$rs->fields['des_estado'],
                                    "descripcion_estado"=>$rs->fields['descripcion_estado'],
                                    "estado_solicitud"=>$rs->fields['estado_solicitud']
                                );

                   $rs->MoveNext();     
                   } 
         return $res;   
        }
        else
        {
      return array();
        }      

}*/

public function get_solicitudes($estado,$fecha_ini,$fecha_fin)
{   
   $auxsql="";
  
   
   
    if($fecha_ini!="" && $fecha_fin!=""){$array=array($estado,$fecha_ini,$fecha_fin);
      $auxsql.="AND DATE(solicitud.fecha) >= ?";
      $auxsql.="AND DATE(solicitud.fecha) <= ? ";
    }
    else{
      if($fecha_ini!=""){$auxsql.="AND DATE(solicitud.fecha) >= ? ";$array=array($estado,$fecha_ini);}
      else
      {
       if($fecha_fin!=""){$auxsql.="AND DATE(solicitud.fecha) <= ? ";$array=array($estado,$fecha_fin);}
     else {$array=array($estado);}

      }

    }
    
   $con = App::$base;
   $sql = "SELECT
   seguimiento_solicitud.id_seguimiento
   , seguimiento_solicitud.id_solicitud
   , CONCAT('PQR # ',`solicitud`.`id_solicitud`) AS numero
   , solicitud.descripcion_solicitud
   , seguimiento_solicitud.id_estado
   , estado.descripcion AS des_estado
   , seguimiento_solicitud.descripcion_estado 
   , solicitud.estado_solicitud
FROM
   seguimiento_solicitud
   INNER JOIN estado 
       ON (seguimiento_solicitud.id_estado = estado.id_estado)
   INNER JOIN solicitud 
       ON (seguimiento_solicitud.id_solicitud = solicitud.id_solicitud)
   WHERE seguimiento_solicitud.id_estado=? ".$auxsql;
   //var_dump($sql); //AND DATE(solicitud.fecha) >= ? ".$auxsql

   $rs = $con->dosql($sql,$array);
   //var_dump($rs);
       if($rs->fields!=false){
                while (!$rs->EOF) 
                  {
                   $res[]= array("id_seguimiento"=>$rs->fields['id_seguimiento'],
                                  "id_solicitud"=>$rs->fields['id_solicitud'],
                                  "sufijo_solicitud"=>$rs->fields['numero'],
                                  "descripcion_solicitud"=>$rs->fields['descripcion_solicitud'],
                                  "id_estado"=>$rs->fields['id_estado'],
                                  "des_estado"=>$rs->fields['des_estado'],
                                   "descripcion_estado"=>$rs->fields['descripcion_estado'],
                                   "estado_solicitud"=>$rs->fields['estado_solicitud']
                               );

                  $rs->MoveNext();     
                  } 
        return $res;   
       }
       else
       {
     return array();
       }      

}

}

?>