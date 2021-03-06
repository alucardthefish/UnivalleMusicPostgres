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
		<title>Comparte tu musica!</title>
		<!-- Bootstrap -->
		<link href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../Scripts/XHRObjeto.js"></script>
		<script src="../Scripts/manejaSesion.js"></script>
		<script>
						
			function mostrartabla()
			{
				var objAjax = new objetoAjax();
				
				var opc="mostrarconsulta";
				
				objAjax.open("POST", "../Controlador/CompartirMusicaControlador.php", true);
				
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
			
			function mostrarBusquedaCompartir()
			{
				var objAjax = new objetoAjax();
				
				var opc="consultaoptima";
				
				var nick = document.getElementById("nicksearch").value;
				var lista = document.getElementById("opciones");
				var indiceSeleccionado = lista.selectedIndex;
				var opcionSeleccionada = lista.options[indiceSeleccionado];
				var valorSeleccionado = opcionSeleccionada.value;
				
				var busqueda = document.getElementById("busqueda").value;
				
				objAjax.open("POST","../Controlador/CompartirMusicaControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc+"&nick="+nick+"&valorseleccionado="+valorSeleccionado+"&busqueda="+busqueda);
				
				objAjax.onreadystatechange=function()
				{
					if(objAjax.readyState==4)
					{
						document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
					}
				}
				
			}
			
			function compartirCancion(idcancion)
			{
				var objAjax = new objetoAjax();
				var opc="compartircancion";
				
				var nick = document.getElementById("nicksearch").value;
				var lista = document.getElementById("opciones");
				var indiceSeleccionado = lista.selectedIndex;
				var opcionSeleccionada = lista.options[indiceSeleccionado];
				var valorSeleccionado = opcionSeleccionada.value;
				
				var busqueda = document.getElementById("busqueda").value;
				
				objAjax.open("POST","../Controlador/CompartirMusicaControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc+"&nick="+nick+"&idcancion="+idcancion+"&valorseleccionado="+valorSeleccionado+"&busqueda="+busqueda);
				
				objAjax.onreadystatechange=function()
				{
					if(objAjax.readyState==4)
					{
						var msjServidor = objAjax.responseText;
						if(msjServidor == "exitocompartiendo")
						{
							mostrarBusquedaCompartir();
						}
						else
						{
							document.getElementById("tablademuestra").innerHTML = msjServidor;
						}
					}
				}
			}

//-------------------------------------------------------------------------------------------------------------------//	
		</script>
		
		
	</head>
	<!-- onload="mostrartabla();" -->
	<body onload="mostrartabla();">
		
		<!-- Aqui va el navbar del usuario logueado -->
		<?php include('navLogueados.php'); // la barra de navegación ?>
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					<h1>Comparte tu musica</h1>
					<hr />
					<div class="row-fluid">
						<div class="span3">
							<p>
								Especifica el nick de la persona a la que le compartiras tu musica, dale en buscar y selecciona las canciones que tengas disponibles. 
							</p>
							
							<form name="nick_filtro">
								<fieldset>
									<label>Nick:</label>
									<input type="text" name="nicksearch" id="nicksearch" /><br />
									<button type="reset" class="btn btn-primary">Limpiar</button>
								</fieldset>
							</form>
							
							
							
						</div>
						<!-- Visualizacion datos -->
						<div class="span9">
							<div class="row-fluid">
								<div class="span12" id="resultado" name="resultado">
									<form id="formulario_filtro" class="form-inline">
										<label>Busca por:</label>
										<select id="opciones">
										<option value="nada">Seleccionar todas</option>
										<option value="titulo">Titulo</option>
										<option value="artista">Artista</option>
										<option value="album">Album</option>
										<option value="genero">Genero</option>
										</select>
										<label>Busqueda:</label>
										<input type="text" name="busqueda" id="busqueda" />
										<button onclick="mostrarBusquedaCompartir();return false;" class="btn btn-primary"><i class="icon-search icon-white"></i> Buscar</button>
									</form>
								</div>
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