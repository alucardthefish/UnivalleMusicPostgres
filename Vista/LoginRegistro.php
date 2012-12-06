<?php
	session_start();

	if(@$_SESSION['login']=="ok")
	{
		header("Location: indes.php");
		exit();
	}
	else
	{
?>

<!DOCTYPE html>
<html>
	<head>
		<title>¡Registrate en Univalle Music!</title>
		<!-- Bootstrap -->
		<link type="text/css" href="../Assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="../Scripts/XHRObjeto.js"></script>
		<script src="../Scripts/manejaSesion.js"></script>
		<script>
			function crearUsuario()
			{
				var objAjax = new objetoAjax();
				
				var accion="insertarusuario";
				
				var nombre = document.getElementById("nombre").value;
				var apellido = document.getElementById("apellido").value;
				var email = document.getElementById("email").value;
				var nick = document.getElementById("nick").value;
				var password = document.getElementById("password").value;
				var passwordconfirm = document.getElementById("passwordconfirm").value;
				
				objAjax.open("POST", "../Controlador/UsuarioControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("accion="+accion+"&nombre="+nombre+"&apellido="+apellido+"&email="+email+"&nick="+nick+"&password="+password+"&passwordconfirm="+passwordconfirm);
				
				objAjax.onreadystatechange=function()
				{
					if (objAjax.readyState==4)
					{
						document.getElementById("mostrar").innerHTML = objAjax.responseText;
					}
				}
				
			}
			
		</script>
		
	</head>
	<body>		
		
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="">Univalle-Music</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li><a href="#">Inicio</a></li>
						</ul>
						<form class="navbar-form pull-right" id="formlogin">
							<input class="span2" type="text" id="nicklogin" placeholder="Nick" />
							<input class="span2" type="password" id="passlogin" placeholder="Contraseña" />
							<button class="btn" onclick="loguear();return false;">Entrar</button>
							<!-- Funcion loguear() invocada del archivo manejaSesion.js -->
						</form>
						
					</div> <!-- .nav-collapse -->
				</div>
			</div>
		</div>
		
		<div class="hero-unit">
			<h2>!Univalle Music!</h2>
			<p>Crea tu cuenta, sube canciones, escuchalas y compartelas</p>
			<p>
				<a class="btn btn-primary btn-large" href="#reg">
					Registrate ya!
				</a>
			</p>
		</div>
		
		    
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					
					<div class="row-fluid">
						
						<div class="span9">
							 <div class="row-fluid">
								<div class="span12" id="mostrar">
								</div>
								<div class="span12">
									<div class="row-fluid">
										<div class="span4">
											<img src="audifonos.png" />
										</div>
										<div class="span7">
											<blockquote>
												<h4><em>Univalle Music</em> <i class="icon-headphones"></i></h4>
												<p>
												Es la mejor forma de escuchar y compartir tus canciones preferidas en el formato mp3 en cualquiera de los navegadores principales incluso en <em>firefox.</em>
												</p>
												<br />
												<p>
													Compatible con navegadores web modernos que soporten html5.
												</p>
												<br />
												<p>
													Compatible en dispositivos moviles que soporten html5.
												</p>
												<br />
												<p>
													Navegadores como Mozilla Firefox que no soportan formato mp3 deben tener instalado el plugin de flash.
												</p>
												<br />
												<p>
													Tamaño maximo por cancion subida: 6MB.
												</p>
											</blockquote>
										</div>
									</div>
								</div>
							 </div>
						</div>
						
						<div class="span3">
							<h3 id="reg">Registrate </h3>
							<hr />
							
							<form id="registrarusuario">
								<fieldset>
									<label>Nombre:</label>
									<input type="text" name="nombre" id="nombre" />
									<label>Apellido:</label>
									<input type="text" name="apellido" id="apellido" />
									<label>Email:</label>
									<input type="text" name="email" id="email" />
									<label>Nick:</label>
									<input type="text" name="nick" id="nick" />
									<label>Contraseña:</label>
									<input type="password" name="password" id="password" />
									<label>Confirmar Contraseña:</label>
									<input type="password" name="passwordconfirm" id="passwordconfirm" />
									<br />
									<br />
									<button class="btn btn-success" onclick="crearUsuario();return false;">Registrar <i class="icon-ok icon-white"></i></button>
								</fieldset>
							</form>
							
						</div>
						
						
					</div>
				</div>
			</div>
			
			<!-- Aqui va el footer -->
			<?php include('footer.php');?>
			
		</div>
		
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="../Assets/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
	}
?>