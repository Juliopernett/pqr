<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }
    /*    if($_SESSION['perfil'] != 'Empleado')
        {
          header("location: ../../../login.php");
        }*/

        

  $active_new="active";
  $active_solicitud="";
  $active_clientes="";
  $active_usuarios="";  
  $title="Solicitud";
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include("../../../plantilla/head.php");?>
    <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
    <script src="../../../lib/jquery-ui.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>  
     <script src="../../../lib/jquery/jquery-2.2.3.min.js"></script>      
    <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
    <script src='../../../lib/data_table.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
    
     <script src='js/solicitud.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
      <script src='js/modal_ver.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
      <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
     <style>
             #pre-load-web {
                width:100%;
                position:absolute;
                background:rgba(0,0,0,0.5);
                left:0px;
                top:0px;
                z-index:100000
            }
            #pre-load-web #imagen-load{
                left:50%;
                margin-left:-30px;
                position:absolute
            }
            #content{
                padding-top: 15%;
                padding-left: 20%;
                padding-right: 20%;
                text-align: center;
            }
         
            .dataTables_filter label{
                display:block !important;
            }
            #myTable_paginate{
                text-align: -webkit-center;
            }
            #myTable_info{
                font-weight: bold;
            }
           /* .panel-body {
            height: 500px;
            }*/


            /* Estilos para la ventana modal */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
            }
            .modal-content {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                width: 400px;
                text-align: center;
            }
            .close {
                color: #000;
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

        </style>
  </head>
  <body>
  <?php
  include("../../../plantilla/navbar.php"); //var_dump($_SESSION['user_id']) ;
  ?>  
<div class="container-fluid">
             <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h5>Realizar Peticion Queja, Reclamo o sugerencia</h5></div>
                    <div class="panel-body">
                        <form id="form_solicitud" action="clases/control_solicitud.php">
                           <div class="col-md-6">
                           <label for="asunto">Asunto:</label>
                           <input  class="form-control" type="text"  id="asunto_solicitud"  name="asunto_solicitud" required minlength="4" maxlength="400" size="10">
                           <br> 
                          </div> 
                            <div class="col-md-6">
                              <label for="tipo">Elija el tipo de Solicitud:</label>
                               <select id="id_tiposolicitud" name="id_tiposolicitud" class="form-control">
                                <option value="-1" selected>---Seleccione una Opción---</option>
                                <option value="1">PETICIÓN</option>
                                <option value="2">QUEJA</option>
                                <option value="3">RECLAMO</option>
                                <option value='4'>SUGERENCIA</option>
                                <option value='5'>PQR ANONIMA</option>
                               </select><br>                        
                            </div>  
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <div class="col-md-12">
                              <label for="descripcion_solicitud">Nos gustaria conocer el motivo de su solicitud:</label>
                              <textarea class="form-control" rows="5" id="descripcion_solicitud" name="descripcion_solicitud" required="true"></textarea><br>
                                </div>                                                              
                                  <input id="fecha" name="fecha" type="hidden" value="<?php echo date('Y-m-d');?>" > 

                                  <div class="col-md-6">
                                    <label for="tipo">¿Desea Subir Documentos?</label>
                                     <select id="doc" name="doc" class="form-control">
                                      <option value="-1" selected>---Seleccione una Opción---</option>
                                      <option value="1">Subir PDF</option>                                      
                                     </select><br> 
                                     <input id="sub" name="sub" type="hidden" value="-1" >                       
                                     <br> 
                                    </div>  
                                    <div id="mostrar">
                                 <!--   <div class="col-md-12">
                                       <label for="titulo">Titulo:</label>
                                       <input type="text" name="titulo" class="form-control">                    
                                   </div>  -->
                                     <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                    <!--   <div class="col-md-12">
                                          <label for="descripcion">Descripcion:</label>
                                          <textarea class="form-control" rows="1" id="descripcion1" name="descripcion1" ></textarea><br>
                                     </div>   -->                                                           
                                      
                                  <div class="col-md-6">
                                  <br> <br> 
                                      <input type="file" class="form-control-file" name="archivo"><br>                                     
                                  </div>    
                              </div> 
                          <div class="col-md-12">
                              
                              <!-- <label for="politica">¿Acepta nuestra política de tratamiento de datos?</label>-->
                              
                              <input type="checkbox" name="aceptar_terminos" id="aceptar_terminos" value="aceptar_terminos" required/> He leído y acepto la <a href="../../../imagenes/ptd_DDL.pdf" target="_blank">Política de tratamiento de datos</a> 
                              <br> 
                            </div>  
         
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Enviar Datos</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           <!--    <div class="col-md-8">
                <div class="panel panel-primary">
                   <div class="panel-heading"><h5>Historial PQR</h5></div>
                    <div class="panel-body">
                        <div class="table-responsive"> 
                         <div id="ver_cargas"></div>
                       </div>
                    </div>
                </div>
            </div>-->
</div>

<?php
include 'modal_ver.php';
?>
  <?php
    include '../../../plantilla/footer1.php';
  ?>
  <script src="../../../lib/bootbox.min.js"></script>
  <!-- Modal -->
<div id="anonimaModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="cerrarModal()">&times;</span>
    <h3>ATENCIÓN</h3>
    <p>Si usted registra la solicitud como reservado, declara reserva sobre sus datos personales y de contacto, por lo tanto, debe tener en cuenta que la información a suministrar debe ser clara y completa frente la pretensión o los hechos, lo anterior con el fin de efectuar el trámite a que haya lugar. Así mismo se le Dara seguimiento al caso y recibirá un email de vuelta de su petición.</p>
  </div>
</div>

// Mostrar el modal cuando se seleccione la opción de PQR ANÓNIMA
<script>
document.getElementById('id_tiposolicitud').addEventListener('change', function() {
      if (this.value == '5') {
          document.getElementById('anonimaModal').style.display = 'flex';
      }
  });

  // Función para cerrar el modal
  function cerrarModal() {
      document.getElementById('anonimaModal').style.display = 'none';
  }

  // Cerrar el modal al hacer clic fuera de él
  window.onclick = function(event) {
      var modal = document.getElementById('anonimaModal');
      if (event.target == modal) {
          modal.style.display = 'none';
      }
  }
  </script>
</body>
</html>


