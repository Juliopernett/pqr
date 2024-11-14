<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }
     
  $active_new="";
  $active_solicitud="";
  $active_sesion="active";
  $active_clientes="";
  $active_usuarios="";  
  $title="Inicio";
  

  require_once ("../../../config/db.php");
  require_once ("../../../config/conexion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include("../../../plantilla/head.php");?>
     <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
    <script src="../../../lib/jquery-ui.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>  
     <script src="../../../lib/jquery/jquery-2.2.3.min.js"></script> 
  
    </head>
  <body>
  
  <?php
  include("../../../plantilla/navbar.php");
  ?>  

    </div>
 <div class="col-md-12">

      <div class="panel panel-primary">

          <div class="panel-heading"><h4>Bienvenido <?php echo $_SESSION['user_name'].', su perfil: '.$_SESSION['perfil'] ?></h4></div>

              <div class="panel-body">
              <center><h2>Sistema de peticiones, quejas, reclamos y sugerencias</h2></center>
  
              <div class="col-md-3 ">
                <div class="panel-heading">
                <h3>Petición</h3>
                <p>Es el derecho que tiene toda persona natural o jurídica a presentar peticiones respetuosas ante la autoridades competentes, por motivos de interés general o particular, de manera verbal o escrita y a obtener pronta respuesta y  pronta resolución, completa y de fondo en los asusto de su competencia.</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel-heading">
                <h3>Queja</h3>
                <p>Es la manifestación, protesta, censura, descontento o inconformidad que eleva un ciudadano con relación a la conducta irregular de uno o varios servidores públicos en el desarrollo de sus funciones.</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel-heading">
                <h3>Reclamo</h3>
                <p>Es toda manifestación particular o general de inconformidad frente a la prestación de un servicio o a la no atención de una solicitud por parte de la entidad y que el ciudadano reclamante considera lo perjudica, es injusta o ilegal.</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="panel-heading">
                <h3>Sugerencia / Vivencia</h3>
                <p>Manifestación verbal, escrita o a través de un medio electrónico que realiza un ciudadano, con el fin de contribuir al mejoramiento del servicio que presta cada una de las dependencias de la entidad y hacer más participativa la gestión publica.</p>
                </div>
              </div>
              <div class="col-md-12">
                  <center>
                  <a class="btn btn-success" href="../solicitud/solicitud.php"><i class="glyphicon glyphicon-plus"></i> Realizar nueva solicitud</a> 
                  </center>
                </div>
                    <!--       <div class="col-md-6">
                              <label>Tipo Documento</label>
                               <select class="form-control" name="id_tipodocumento">
                                <option value ="1">CEDULA DE CIUDADANIA</option>
                                <option value ="2">TARJETA DE IDENTIDAD</option>
                                <option value ="3">CEDULA EXTRANJERO</option>
                                <option value ="4">NIT</option>
                                <option value ="5">RUT</option>
                               </select><br>
                             </div>

                              <div class="col-md-6">

                              <input class="form-control" id="documento" name="documento" placeholder="No de documento" type="text" required><br>
                              </div>
                              <div class="col-md-12">
                               <input class="form-control" id="codigo" name="codigo" placeholder="Digita el codigo" type="text" ><br>
                             </div>

                                  <div class="col-md-12">
                              <input class="form-control" required="true" id="primer_nombre" name="primer_nombre" placeholder="Digite Primer Nombre" type="text" ><br>
                              </div>

                              <div class="col-md-12">
                              <input class="form-control" id="segundo_nombre" name="segundo_nombre" placeholder="Digite Segundo Nombre" type="text" ><br>
                              </div>

                              <div class="col-md-12">
                              <input class="form-control" required="true" id="primer_apellido" name="primer_apellido" placeholder="Digite Primer Apellido" type="text" ><br>
                              </div>

                              <div class="col-md-12">
                              <input class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Digite Segundo Apellido" type="text" ><br>
                              </div>-->






                    </div>
                </div>
            </div>


<?php

  include '../../../plantilla/footer1.php';
  ?>


</body>
</html>


