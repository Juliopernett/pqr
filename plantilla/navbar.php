
  <?php
  //CAMBIO JULIO PERNETT para quitar el warning
  if(!isset($_SESSION)) { 
      session_start(); 
  }

  include '../../../core.php';
        $db = App::$base;
         $sql = "SELECT count(id_notificacion) as num from notificacion where estado = 1";
         $rs = $db->dosql($sql, array());
         $res = $rs->fields['num'];
         $_SESSION['num'] = $res;
      
		if (isset($title))
		{
	?>


 <!--
   <div class="mx-auto" style="width: 200px;">
      <img src="../../../imagenes/LogoDDL2014.png" >
    </div>
 -->
<!-- Navbar text is dark and background is light -->
 <!-- Navbar text is dark and background is light -->

 <div class="container-fluid">
  <img src="../../../imagenes/LogoDDL2014.png" width="15%"  >
  <img src="../../../imagenes/feedback-logo.png" width="25%"  >
  <nav class="navbar navbar-default " >
    
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"> </span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"> </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
        <li class="nav-item <?php echo $active_sesion;?>"><a href="../inicio/inicio.php"><i class='glyphicon glyphicon-user'></i> <?php echo $_SESSION['user_name'] ?></a></li>
        <?php
        if($_SESSION['perfil'] == 'Administrador')
        {
        ?>
        
         <li class="<?php echo $active_new;?>"><a href="../solicitud/solicitud.php"></i> Realizar PQR</a></li> 

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Solicitudes <b class="caret"></b>
                </a>
                    <ul class="dropdown-menu">
                      <li><a href="../solicitud_admin/admin_solicitud.php">Revisar Solicitudes</a></li>
                    <!--  <li class="divider"></li>
                      <li><a href="../revisarpdf">Revisar Archivos</a></li>-->
                    </ul>

              <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Encuestas <b class="caret"></b>
                </a>
                    <ul class="dropdown-menu">
                      <li><a href ="../encuesta/gestion_encuesta_pregunta.php">Gestionar Encuesta y Preguntas</a></li>                      
                      <li><a href="../encuesta/gestion_opciones.php">Gestionar Opciones</a></li>
                      <li class="divider"></li>
                    </ul>-->

               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Reportes <b class="caret"></b>
                </a>
                    <ul class="dropdown-menu">
                    <li><a href="../Imprimir/imprimirsolicitudes.php">Imprimir Solicitudes</a></li>
                      <li><a href="../solicitud/filtros_reporte.php">Reporte Solicitudes</a></li>
                         <!--JULIO PERNETT <li><a href="../encuesta/filtros_reporte.php">Reporte Encuestas</a></li>-->
                         <li><a href="../graficas/reporte_grafico_solicitudes.php">Graficas Solicitudes</a></li>
                         <!-- <li class="divider"></li>
                      <li><a href="../revisarpdf">Revisar Archivos</a></li>-->
                    </ul>
<!--JULIO PERNETT
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Reportes Graficos <b class="caret"></b>
                </a>
                    <ul class="dropdown-menu">
                      <li><a href="../graficas/reporte_grafico.php">Graficas Encuesta</a></li>
                      <li><a href="../graficas/reporte_grafico_solicitudes.php">Graficas Solicitudes</a></li>
                      <li class="divider"></li>
                      <li><a href="../revisarpdf">Revisar Archivos</a></li>
                    </ul>-->

      <!--  <li class="nav-item <?php //echo $active_new;?>"><a href="../solicitud_admin/admin_solicitud.php"> Revisar Solicitudes <span class="sr-only">(current)</span></a></li>
        <li class="nav-item <?php// echo $active_revisar;?>"><a href="../revisarpdf"></i> Revisar Archivos</a></li>
        <li><a href="../encuesta/gestion_encuesta_pregunta.php"></i> Gestionar encusta y preguntas</a></li>
              <li><a href="../encuesta/gestion_opciones.php"></i> Gestionar opciones</a></li>
              <li><a href="../revisarpdf"></i> Ver Resultados</a></li>

              <li><a href="../solicitud/filtros_reporte.php"></i> Reporte Solicitudes</a></li>
              <li><a href="../encuesta/filtros_reporte.php"></i> Reporte Encuestas</a></li>
              <li><a href="../graficas/reporte_grafico.php"></i> Reporte Grafico</a></li>
              <li><a href="../graficas/reporte_grafico_solicitudes.php"></i> Reporte Grafico Solicitudes</a></li>-->
          <!-- <li class="nav-item <?php //echo $active_usuarios;?>"><a href="../Notificaciones/notificaciones.php">Notificaciones</a></li>       -->
    <li class="nav-item <?php echo $active_usuarios;?>"><a href="../usuarios/usuarios.php">Usuarios</a></li>

        
       <ul class="nav navbar-nav">
          <li class="nav-item <?php echo $active_notificaciones;?>"><a href="../correos/ver_notificacion.php">Notificaciones<?php 
            $var = $_SESSION['num'];
            if($var > 0){
              ?>
            <span class="label label-danger">
            <?php echo $var; }?></span></a></li>
            
      </ul>
      <?php
        }
        if($_SESSION['perfil'] == 'Gerente')
        
        {
        ?>   
        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Reportes <b class="caret"></b>
                </a>
                    <ul class="dropdown-menu">
                      <li><a href="../Imprimir/imprimirsolicitudes.php">Imprimir Solicitudes</a></li>
                      <li><a href="../solicitud/filtros_reporte.php">Reporte Solicitudes</a></li>
                         <!--JULIO PERNETT <li><a href="../encuesta/filtros_reporte.php">Reporte Encuestas</a></li>-->
                         <li><a href="../graficas/reporte_grafico_solicitudes.php">Graficas Solicitudes</a></li>
                         <!-- <li class="divider"></li>
                      <li><a href="../revisarpdf">Revisar Archivos</a></li>-->
                    </ul>

      
          <li class="nav-item <?php echo $active_notificaciones;?>"><a href="../correos/ver_notificacion.php">Notificaciones<?php 
            $var = $_SESSION['num'];
            if($var > 0){
              ?>
            <span class="label label-danger">
            <?php echo $var; }?></span></a></li>
      
        <?php
        }
         /* agregar opciones de empleados*/
        if($_SESSION['perfil'] == 'Usuario')
        {
        ?>
   
        <li class="<?php echo $active_new;?>"><a href="../solicitud/solicitud.php"></i> Realizar PQR</a></li> 
        <li class="<?php echo $active_solicitud;?>"><a href="../historial/ver_historial.php"></i> Seguimiento PQR</a></li>   
       <!-- <li class="<?php echo $active_subir;?>"><a href="../subirpdf/lista.php"></i> Lista Archivos</a></li> -->
        <!-- CAMBIO JULIO PERNETT <li class="<?php echo $active_responder;?>"><a href="../encuesta/responder_encuesta.php"></i> Responder Encuesta</a></li>  -->
        <?php
        }


          /* agregar opciones de empleados*/
          if($_SESSION['perfil'] == 'Empleado')
          {
          ?>
         <li class="<?php echo $active_new;?>"><a href="../solicitud/solicitud.php"></i> Realizar PQR</a></li> 

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Solicitudes <b class="caret"></b>
            </a>
                <ul class="dropdown-menu">
                  <li><a href="../solicitud_admin/admin_solicitud.php">Revisar Solicitudes</a></li>
                <!--  <li class="divider"></li>
                  <li><a href="../revisarpdf">Revisar Archivos</a></li>-->
                </ul>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Reportes <b class="caret"></b>
                </a>
                    <ul class="dropdown-menu">
                      <li><a href="../Imprimir/imprimirsolicitudes.php">Imprimir Solicitudes</a></li>
                      <li><a href="../solicitud/filtros_reporte.php">Reporte Solicitudes</a></li>
                         <!--JULIO PERNETT <li><a href="../encuesta/filtros_reporte.php">Reporte Encuestas</a></li>-->
                         <li><a href="../graficas/reporte_grafico_solicitudes.php">Graficas Solicitudes</a></li>
                         <!-- <li class="divider"></li>
                      <li><a href="../revisarpdf">Revisar Archivos</a></li>-->
                    </ul>

      
          <li class="nav-item <?php echo $active_notificaciones;?>"><a href="../correos/ver_notificacion.php">Notificaciones<?php 
            $var = $_SESSION['num'];
            if($var > 0){
              ?>
            <span class="label label-danger">
            <?php echo $var; }?></span></a></li>
  
          <?php
          }

        ?>
      <li><a href="../../../imagenes/ptd_DDL.pdf" target="_blank" ><i class='glyphicon glyphicon-book'></i> Política de tratamiento de datos</a></li>
       
        <li><a href="../../../login.php?logout"><i class='glyphicon glyphicon-off'></i> Cerrar Sesion</a></li>
      </li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
        
		<!--<li><a href="../../../login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>-->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

    </div>


	<?php
		}
	?>