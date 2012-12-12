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
		<title>Agrega canciones a tus listas!</title>
		<!-- Bootstrap -->
		<link href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../Scripts/XHRObjeto.js"></script>
		<script src="../Scripts/manejaSesion.js"></script>
		<script>
						
			function mostrartabla()
			{
				var objAjax = new objetoAjax();
				
				var opc="mostrarcancionespaagregar";
				
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
			
			function mostrarBusquedaConLista()
			{
				var objAjax = new objetoAjax();
				
				var opc ="consultaconlista";
				
				//Valor tomado del select de tipo de busqueda
				var lista = document.getElementById("opciones");
				var indiceSeleccionado = lista.selectedIndex;
				var opcionSeleccionada = lista.options[indiceSeleccionado];
				var valorSeleccionado = opcionSeleccionada.value;
				
				//Valor tomado del select de listas
				var listas = document.getElementById("listas");
				var indiceSeleccionado2 = listas.selectedIndex;
				var opcionSeleccionada2 = listas.options[indiceSeleccionado2];
				var valorSeleccionado2 = opcionSeleccionada2.value;
				
				var busqueda = document.getElementById("busquedas").value;
				
				objAjax.open("POST","../Controlador/ListasderepControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				
				//alert("opcion="+opc+"&lista="+valorSeleccionado2+"&valorseleccionado="+valorSeleccionado+"&busqueda="+busqueda);
				
				objAjax.send("opcion="+opc+"&lista="+valorSeleccionado2+"&valorseleccionado="+valorSeleccionado+"&busqueda="+busqueda);

				objAjax.onreadystatechange=function()
				{
					if(objAjax.readyState==4)
					{
						var response = objAjax.responseText;
						if(response == "sinseleccionarlosselect")
						{
							mostrartabla();
						}
						else
						{
							document.getElementById("tablademuestra").innerHTML = response;
						}
					}
				}
				
			}
			
			function listarListas()
			{
				var objAjax = new objetoAjax();
				
				var opc = "listarPlaylists";
				
				objAjax.open("POST", "../Controlador/ListasderepControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc);
				
				objAjax.onreadystatechange=function()
				{
					if (objAjax.readyState==4)
					{
						document.getElementById("listas").innerHTML = objAjax.responseText;
					}
				}
				mostrartabla();
				
			}
			
			function agregarCancion(idcancion)
			{
				var objAjax = new objetoAjax();
				
				var opc = "agregarCancion";
				
				var listas = document.getElementById("listas");
				var indiceSeleccionado2 = listas.selectedIndex;
				var opcionSeleccionada2 = listas.options[indiceSeleccionado2];
				var idlista = opcionSeleccionada2.value;
				
				objAjax.open("POST", "../Controlador/ListasderepControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc+"&idlista="+idlista+"&idcancion="+idcancion);
				//objAjax.send("opcion="+opc+"&idlista=3&idcancion=3");
				//alert("opcion="+opc+"&idlista="+idlista+"&idcancion="+idcancion);
				var msjYaEsta = "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>No se adiciono la cancion!</h4>La cancion ya se encuentra adicionada</div>";
				var msjElse = "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>No se selecciono una lista!</h4>Asegurate de seleccionar una lista de reproduccion antes de agregar una cancion</div>";
				
				objAjax.onreadystatechange=function()
				{
					if (objAjax.readyState==4)
					{
						var rspServidor = objAjax.responseText;
						if(rspServidor == "agregada")
						{
							mostrarBusquedaConLista();
						}
						else if(rspServidor == "yaesta")
						{
							document.getElementById("tablademuestra").innerHTML = msjYaEsta;
						}
						else if(rspServidor == "sinlista")
						{
							document.getElementById("tablademuestra").innerHTML = msjElse;
						}
					}
				}
			}

//-------------------------------------------------------------------------------------------------------------------//	
		</script>
		
		
	</head>
	<!-- onload="mostrartabla();" -->
	<body onload="listarListas();">
	
		<!-- Aqui va el navbar del usuario logueado -->
		<?php include('navLogueados.php'); // la barra de navegación ?>
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					<h1>Agrega canciones a tus listas</h1>
					<hr />
					<div class="row-fluid">
						<div class="span3">
							<p>
								Selecciona la lista de reproduccion a la que deseas agregarle musica y clickea de las canciones de la derecha las canciones correspondientes. 
							</p>
							
							<form name="nick_filtro">
								<fieldset>
									<label>Tus Listas de Reproduccion:</label>
									<select id="listas">
										
									</select>
									<br />
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
										<input type="text" name="busqueda" id="busquedas" />
										<button onclick="mostrarBusquedaConLista(); return false;" class="btn btn-primary"><i class="icon-search icon-white"></i> Buscar</button>
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
