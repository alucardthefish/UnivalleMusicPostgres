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
		<title>Crear Lista de reproduccion</title>
		<!-- Bootstrap -->
		<link href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../Scripts/XHRObjeto.js"></script>
		<script src="../Scripts/manejaSesion.js"></script>
		<script>
			function mostrarlistas()
			{
				var objAjax = new objetoAjax();
				
				var opc="mostrarPlaylists";
								
				objAjax.open("POST", "../Controlador/ListasderepControlador.php", true);
				
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
			

			function crearLista()
			{
				var objAjax = new objetoAjax();
				
				var opc = "crearLista";
				
				var nombreDeLista = document.getElementById("nombreplaylist").value;
				
				objAjax.open("POST", "../Controlador/ListasderepControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc+"&nombre_lista="+nombreDeLista);
				
				var msjPositivo = "<div class='alert alert-success'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Lista de reproduccion creada!</h4>Lista de reproduccion: "+nombreDeLista+"</div>";
				
				var msjNegativo = "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Oops dejaste campos vacios!</h4>No se pudo crear la lista por que el campo de nombre no fue especificado</div>";
				
				objAjax.onreadystatechange=function()
				{
					if (objAjax.readyState==4)
					{
						var respServidor = objAjax.responseText;
						if(respServidor == "listacreada")
						{
							document.getElementById("resultado").innerHTML = msjPositivo;
						}
						else
						{
							document.getElementById("resultado").innerHTML = msjNegativo;
						}
						mostrarlistas();
					}
				}				
			}
			
			function borrarCompartida(idcompartida)
			{
				var objAjax = new objetoAjax();
				
				var opc="eliminarcompartida";
				
				objAjax.open("POST","../Controlador/CompartirMusicaControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc+"&idcompartida="+idcompartida);
				
				objAjax.onreadystatechange=function()
				{
					if(objAjax.readyState==4)
					{
						var mensaje = objAjax.responseText;
						if(mensaje == "eliminado")
						{
							mostrartabla();
						}
						else
						{
							document.getElementById("resultado").innerHTML = "<h3>No se pudo eliminar</h3>";
						}
					}
				}
				
			}
				
		</script>
		
		
	</head>
	<!-- onload="mostrartabla(); onload="listarNicks();""-->
	<body onload="mostrarlistas();">
		
		<!-- Aqui va el navbar del usuario logueado -->
		<?php include('navLogueados.php'); // la barra de navegación ?>
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					<h2>Crea tus listas de reproduccion</h2>
					<hr />
					<div class="row-fluid">
						<div class="span3">
							<p>
								Crea tus listas de reproduccion de manera facil, solo asignale un nombre y clickea en crear. 
							</p>
							
							<form id="formulario_filtro">
								<fieldset>
									<label>Nombre de playlist:</label>
									<input type="text" id="nombreplaylist" name="nombreplaylist" />
									<br />
									<button onclick="crearLista();return false;" class="btn btn-primary"><i class="icon-plus icon-white"></i> Crear</button>
								</fieldset>
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
									<div class="row-fluid">
									  <div class="span9 alert alert-block"><h4>Mi rock de los 80 y demas</h4></div>
									</div>
									<div class="row-fluid">
									  <div class="well span9">Lista2</div>
									</div>
									<div class="row-fluid">
									  <div class="well span9">Lista3</div>
									</div>  
									<div class="row-fluid">
									  <div class="well span9">Lista4</div>
									</div>
									<div class="row-fluid">
									  <div class="well span9">Lista4</div>
									</div>
									<div class="row-fluid">
									  <div class="well span9">Lista4</div>
									</div>
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