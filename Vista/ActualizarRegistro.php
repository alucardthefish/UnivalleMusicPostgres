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
		<title>¡Actualizar Registro!</title>
		<!-- Bootstrap -->
		<link type="text/css" href="../Assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>body{padding-top:45px;}</style>
		<script src="../Scripts/XHRObjeto.js"></script>
		
		<script>
	
			function actualizarUsuario()
			{
				var objAjax = new objetoAjax();
				
				var accion="actualizarusuario";
				
				var nombre = document.getElementById("nombre").value;
				var apellido = document.getElementById("apellido").value;
				var email = document.getElementById("email").value;
				var password = document.getElementById("password").value;
				var passwordnew = document.getElementById("passwordnew").value;
				var passwordconfirm = document.getElementById("passwordconfirm").value;
				
				objAjax.open("POST", "../Controlador/ActualizarUsuarioControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("accion="+accion+"&nombre="+nombre+"&apellido="+apellido+"&email="+email+"&password="+password+"&passwordnew="+passwordnew+"&passwordconfirm="+passwordconfirm);
				
				objAjax.onreadystatechange=function()
				{
					if (objAjax.readyState==4)
					{
						document.getElementById("mostrar").innerHTML = objAjax.responseText;
					}
				}
				document.getElementById("nombre").value="";
				document.getElementById("apellido").value="";
				document.getElementById("email").value="";
				document.getElementById("password").value="";
				document.getElementById("passwordnew").value="";
				document.getElementById("passwordconfirm").value="";
			}
			
			function loguear()
			{
				var objAjax2 = new objetoAjax();
				
				var accion2 = "loguearse";
				var nick2 = document.getElementById("nicklogin").value;
				var password2 = document.getElementById("passlogin").value;
				
				objAjax2.open("POST", "../Controlador/LoginControlador.php", true);
				
				objAjax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				
				objAjax2.send("accion="+accion2+"&nicklogin="+nick2+"&passlogin="+password2);
				
				objAjax2.onreadystatechange=function()
				{
					if(objAjax2.readyState==4)
					{
						var resp = objAjax2.responseText;
						if(resp == "iraindex")
						{
							//document.location.href="indes.php";
							window.location.replace("indes.php");
						}
						else
						{
							document.getElementById("mostrar").innerHTML = resp;
						}
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
					<a class="brand"><img alt="Univalle-Music"/></a>
					<div class="nav-collapse">
						<ul class="nav">
							<li><a href="#">Inicio</a></li>
							<li><a href="#">Acerca</a></li>
							<li><a href="#">Contactanos</a></li>
						</ul>
						
						
					</div> <!-- .nav-collapse -->
				</div>
			</div>
		</div>
		
	
		
		    
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					
					<div class="row-fluid">
					
						<div class="span3">
							<h3>Registrate </h3>
							<hr />
							
							<form id="registrarusuario">
								<fieldset>
									<label>Nombre:</label>
									<input type="text" name="nombre" id="nombre" />
									<label>Apellido:</label>
									<input type="text" name="apellido" id="apellido" />
									<label>Email:</label>
									<input type="text" name="email" id="email" />
									<label>Contrasena:</label>
									<input type="password" name="password" id="password" />
									<label>Contrasena Nueva:</label>
									<input type="password" name="passwordnew" id="passwordnew" />
									<label>Confirmar Contrasena:</label>
									<input type="password" name="passwordconfirm" id="passwordconfirm" />
									<br />
									<br />
									<button class="btn btn-success" onclick="actualizarUsuario();return false;">Actualizar <i class="icon-ok icon-white"></i></button>
								</fieldset>
							</form>
							
						</div>
						<div class="span9" id="mostrar">
							 
						</div>
						
					</div>
				</div>
			</div>
			<hr />
			<footer>
				<p>&copy; Company 2012</p>
			</footer>
			
		</div>
		
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="../Assets/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
	}
?>