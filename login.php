<?php
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {    
    require_once("lib/password_compatibility_library.php");
}
require_once("bin/modules/config/db.php");
require_once("login/Login.php");
$login = new Login();

if ($login->isUserLoggedIn() == true) {    
   header("location: bin/modules/inicio/inicio.php");

} else {
 
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Pqr</title>

	<link rel="stylesheet" href="lib/bootstrap.min.css">
   <link href="css/login2.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   <script src="lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
</head>
<body>

<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
			
				<center><img src="imagenes/LogoDDL2014.png" width="35%"> <img src="imagenes/feedback-logo.png" width="50%"  >
					<!--<h3>Sistema P.Q.R.S</h3>-->
				</center>
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Iniciar sesión</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Regístrate ahora</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" method="post" accept-charset="utf-8" action="login.php" name="login-form" autocomplete="off" role="form" style="display: block;">
			<?php
				// show potential errors / feedback (from login object)
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong></strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong></strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
                <span id="reauth-email" class="reauth-email"></span>
							
									<div class="form-group">
										 <input class="form-control" placeholder="User" name="user_name" maxlength="30" type="text" value="" autofocus="" required>
									</div>
									<div class="form-group">
										 <input class="form-control" placeholder="password" name="user_password" maxlength="30" type="password" value="" autocomplete="off" required>
									</div>
								<!--	<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Recordarme</label>
									</div>-->
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="login" id="submit">Ingresar</button>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
											<!--	<div class="text-center">
													<a href="http://phpoll.com/recover" tabindex="5" class="forgot-password">¿Has olvidado tu contraseña?</a>
												</div>-->
											</div>
										</div>
									</div>
								
							</form>							  
								
									
	<form method="post" id="guardar_usuario" name="guardar_usuario" style="display: none;">
			<div id="resultados_ajax"></div>
				<!--
			<div class="form-group  col-lg-6">
				<label  class="text-muted">Tipo de persona:</label>
			</div>
			<div class="form-group  col-lg-6">
				<input type="radio" id="tipoPersonaRadio" name="tipo_persona" value="N" checked/>
				<label class="text-muted" for="tipo_persona">Natural</label>

				<input type="radio" id="tipoPersonaRadio" name="tipo_persona" value="J" />
				<label  class="text-muted"  for="tipo_persona">Jurídica</label>
			</div>

			<div class="form-group  col-lg-6">
				<label  class="text-muted">Tipo de identificación:</label>
			</div>
			<div  class="form-group col-lg-6" >
				<select name="tipo_identificacion" id="tipoIdSelect" class="text-muted">
				<option  value="-1" disabled selected>-- Seleccionar --</option>
				<option value="NI">Nit</option>
				<option value="CC">Cédula de ciudadanía</option>
				<option value="CE">Cédula de extranjería</option>
				<option value='PA'>Pasaporte</option>
				</select>                      
            </div>  
			-->
			<div  class="form-group col-lg-6" >
			    <label  class="text-muted">Tipo de persona:</label>
			</div>	
			<div id="group" class="form-group col-lg-6">
			</div>

			<div class="form-group  col-lg-6">
				<label  class="text-muted">Tipo de identificación:</label>
			</div>
			<div class="form-group col-lg-6">
				<p id="output"></p>
			</div>
			<script>
				const sizes = ['Natural', 'Juridica'];
				
				// generate the radio groups        
				const group = document.querySelector("#group");
				group.innerHTML = sizes.map((size) => `<div>
						<input type="radio" class="text-muted" name="size" value="${size}" id="${size}" required >
						<label for="${size}">${size}</label>
					</div>`).join(' ');
				
				// add an event listener for the change event
				const radioButtons = document.querySelectorAll('input[name="size"]');

				for(const radioButton of radioButtons){
					radioButton.addEventListener('change', showSelected);
				}        
				
				function showSelected(e) {
					console.log(e);
					if (this.checked) {
						elementoActivo = this.value;
						if (elementoActivo=='Natural'){
							//SI ES NATURAL
							//document.querySelector('#output').innerText = 'Seleccionaste: ' + elementoActivo; 
							$("#divapellido").css("display", "block");
							document.querySelector('#output').innerHTML = '<select name="tipo_identificacion" id="tipoIdSelect" class="text-muted"><option value="CC">Cédula de ciudadanía</option><option value="CE">Cédula de extranjería</option><option value="PA">Pasaporte</option></select>'
						}else 
							{//SI ES JURIDICO
								$("#divapellido").css("display", "none");
								//document.querySelector('#output').innerText = `BLANK`;
								document.querySelector('#output').innerHTML = '<select name="tipo_identificacion" id="tipoIdSelect" class="text-muted"><option value="NI">Nit</option></select>'
							}
					}
				}
			</script>

			  <div class="form-group col-lg-12">
				  <input type="text" class="form-control" id="identificacion" name="identificacion" maxlength="30" placeholder="Número de identificación" required>
			  </div>
			  
			  <div class="form-group col-lg-6">				
				  <input type="text" class="form-control" id="firstname" name="firstname" maxlength="60" placeholder="Nombre o razón social" required>
			  </div>

			  <div id="divapellido" class="form-group col-lg-6" style="display: none" >
				  <input type="text" class="form-control" id="lastname" name="lastname" maxlength="60" placeholder="Apellidos">
			  </div>

			  <div class="form-group col-lg-6">
				  <input type="text" class="form-control" id="direccion" name="direccion" maxlength="50" placeholder="Dirección" required>
			  </div>

			  <div class="form-group col-lg-6">
				
				  <input type="text" class="form-control" id="telefono" name="telefono" maxlength="20" placeholder="Teléfono" required>
			  </div>

			  <div class="form-group col-lg-6">
				  <input type="text" class="form-control" id="user_name" name="user_name" maxlength="30" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>		
			  </div>

			  <div class="form-group col-lg-6">
				  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Correo electrónico" required>	
			  </div>

			  <div class="form-group col-lg-6">
				  <input type="password" class="form-control" id="user_password_new" name="user_password_new" maxlength="50" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>	
			  </div>

			  <div class="form-group col-lg-6">
				  <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat" maxlength="50" placeholder="Repite contraseña" pattern=".{6,}" required>
			  </div>
				
			<input type="hidden" value="Usuario" id="perfil" name="perfil">
					
		
		  	<div class="form-group">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<input type="submit"  id="guardar_datos" class="form-control btn btn-register" value="Crear cuenta"></button>
					</div>
				</div>
			</div>
		  

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

		<?php

include 'plantilla/footer1.php';
?>
  </body>
 

</html>

<script>
 $(document).ready(function(){
    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
	 	$("#guardar_usuario").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#guardar_usuario").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	});

$( "#guardar_usuario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "bin/modules/usuarios/nuevo_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			//location.reload(true)
		  }
	});
  event.preventDefault();
})


   </script>
  
	<?php
}

?>

