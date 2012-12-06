<?php
	session_start();

	if($_SESSION['login']!="ok")	//si la variable de sesion login es diferente a "ok"
	{
		header("Location: LoginRegistro.php"); 	//redirgimos al login.php
	}
	else	//si la variable es igual a "ok" mostramos el contenido..
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Vista Subir Cancion con Bootstrap</title>
		<!-- Bootstrap -->
		<link href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../Scripts/XHRObjeto.js"></script>
		<script src="../Scripts/manejaSesion.js"></script>
		<script>
			function mostrartabla()
			{
				var objAjax = new objetoAjax();
				
				var opc="mostrar";
				
				objAjax.open("POST", "../Controlador/MostrarCancionUsuarioControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc);
				
				objAjax.onreadystatechange=function()
				{
					if (objAjax.readyState==4)
					{
						document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
					}
				}
				
			}
		</script>
		
		
	</head>
	<body onload="mostrartabla()">
		
		<!-- Aqui va el navbar del usuario logueado -->
		<?php include('navLogueados.php'); // la barra de navegación ?>
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					<h1>Subiendo Canciones... </h1>
					<hr />
					<div class="row-fluid">
						<div class="span3">
							<p>
								Sube tus canciones y reproducelas desde tu lista de reproduccion. 
							</p>
							
							<form action="../Controlador/CancionUsuarioControlador.php" method="post" enctype="multipart/form-data" target="pagina_target">
								<fieldset>
									<label>Titulo:</label>
									<input type="text" name="titulo" id="titulo" />
									<label>Artista:</label>
									<input type="text" name="artista" id="artista" />
									<label>Album:</label>
									<input type="text" name="album" id="album" />
									<label>Genero:</label>
									<input type="text" name="genero" id="genero" />
									<label>Seleccionar archivo .mp3:</label>
									<input type="file" name="file" id="file" />
									<br />
									<br />
									<button type="submit" class="btn btn-danger">Subir</button>
									<button type="reset" class="btn">Limpiar</button>
								</fieldset>
								<iframe id="pagina_target" name="pagina_target" style="display:none"></iframe>
							</form>
						</div>
						<!-- Visualizacion datos -->
						<div class="span9">
						  <div class="row-fluid">
							<div class="span12" id="resultado" name="resultado"></div>
						  </div>
						  <div class="row-fluid">
						    <div class="span12" id="tablademuestra" name="tablademuestra">
								<!-- Aqui se cargara las canciones del usuario -->
							</div>
						  </div>
						</div>
						<!-- Fin Visualizacion datos -->
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