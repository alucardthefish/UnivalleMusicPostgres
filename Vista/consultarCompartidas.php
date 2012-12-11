<!DOCTYPE html>
<html>
	<head>
		<title>Consultar Compartidas</title>
		<!-- Bootstrap -->
		<link href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../Scripts/XHRObjeto.js"></script>
		<script>
			function mostrartabla()
			{
				var objAjax = new objetoAjax();
				
				var opc="mostrarLoQueMeComparten";
				
				var lista = document.getElementById("opciones");
				var indiceSeleccionado = lista.selectedIndex;
				var opcionSeleccionada = lista.options[indiceSeleccionado];
				var valorSeleccionado = opcionSeleccionada.value;
				
				objAjax.open("POST", "../Controlador/CompartirMusicaControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc+"&nickremitente="+valorSeleccionado);
				
				objAjax.onreadystatechange=function()
				{
					if (objAjax.readyState==4)
					{
						document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
					}
				}
				
			}
			mostrartabla();

			function listarNicks()
			{
				var objAjax = new objetoAjax();
				
				var opc = "mostrarNicks";
				
				objAjax.open("POST", "../Controlador/CompartirMusicaControlador.php", true);
				
				objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
				objAjax.send("opcion="+opc);
				
				objAjax.onreadystatechange=function()
				{
					if (objAjax.readyState==4)
					{
						document.getElementById("opciones").innerHTML = objAjax.responseText;
					}
				}
				mostrartabla();
				
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
	<!-- onload="mostrartabla();"-->
	<body onload="listarNicks();">
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					<h2>Canciones Compartidas</h2>
					<hr />
					<div class="row-fluid">
						<div class="span3">
							<p>
								Consulta o elimina las canciones que te han compartido otros usuarios. 
							</p>
							
							<form id="formulario_filtro">
								<fieldset>
									<label>Busca por nick:</label>
									<select id="opciones">
										<option value="seleccionartodos">Seleccionar todos</option>
									</select>
									<button onclick="mostrartabla();return false;" class="btn btn-primary"><i class="icon-search icon-white"></i> Buscar</button>
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
									
									
									
								</div>
							</div>
						</div>
						<!-- Fin Visualizacion datos -->
					</div>
				</div>
			</div>
			
			
			
		</div>
		
		
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="../Assets/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>