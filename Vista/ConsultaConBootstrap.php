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
		<title>Vista Consultar Cancion con Bootstrap</title>
		<!-- Bootstrap -->
		<link href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../Scripts/XHRObjeto.js"></script>
		<script>
			function mostrartabla()
			{
				var objAjax = new objetoAjax();
				
				var opc="mostrarconsulta";
				
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
			
			function mostrarTablaPorSeleccion()
			{
				var objAjax = new objetoAjax();
				
				var opc="busquedaseleccion";
				
				var lista = document.getElementById("opciones");
				var indiceSeleccionado = lista.selectedIndex;
				var opcionSeleccionada = lista.options[indiceSeleccionado];
				var valorSeleccionado = opcionSeleccionada.value;
				
				var busqueda = document.getElementById("busqueda").value;
				
				if(valorSeleccionado == "nada")
				{
					opc="mostrarconsulta";
					objAjax.open("POST","../Controlador/MostrarCancionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
					objAjax.send("opcion="+opc);
				
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				}
				else
				{
					objAjax.open("POST","../Controlador/MostrarCancionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					
					objAjax.send("opcion="+opc+"&valorseleccionado="+valorSeleccionado+"&busqueda="+busqueda);
					
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				}
			}
			
			function addToListplayer(idcancion)
			{
				var objAjax = new objetoAjax();
				
				var opc="addlike";
				
				var lista = document.getElementById("opciones");
				var indiceSeleccionado = lista.selectedIndex;
				var opcionSeleccionada = lista.options[indiceSeleccionado];
				var valorSeleccionado = opcionSeleccionada.value;
				
				var busqueda = document.getElementById("busqueda").value;
				
				if(valorSeleccionado == "nada")
				{
					opc="addlike";
					objAjax.open("POST","../Controlador/MostrarCancionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
					objAjax.send("opcion="+opc+"&idcancion="+idcancion+"&valorseleccionado=&busqueda=");
				
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				}
				else
				{
					objAjax.open("POST","../Controlador/MostrarCancionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					
					objAjax.send("opcion="+opc+"&idcancion="+idcancion+"&valorseleccionado="+valorSeleccionado+"&busqueda="+busqueda);
					
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				}
			}			
			
			function removeFromListplayer(idcancion)
			{
				var objAjax = new objetoAjax();
				
				var opc="removelike";
				
				var lista = document.getElementById("opciones");
				var indiceSeleccionado = lista.selectedIndex;
				var opcionSeleccionada = lista.options[indiceSeleccionado];
				var valorSeleccionado = opcionSeleccionada.value;
				
				var busqueda = document.getElementById("busqueda").value;
				
				if(valorSeleccionado == "nada")
				{
					opc="removelike";
					objAjax.open("POST","../Controlador/MostrarCancionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
					objAjax.send("opcion="+opc+"&idcancion="+idcancion+"&valorseleccionado=&busqueda=");
				
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				}
				else
				{
					objAjax.open("POST","../Controlador/MostrarCancionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					
					objAjax.send("opcion="+opc+"&idcancion="+idcancion+"&valorseleccionado="+valorSeleccionado+"&busqueda="+busqueda);
					
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				}
			}
			
			function borrarCancion(idcancion, dircancion)
			{
				var objAjax = new objetoAjax();
				
				var opc="eliminarcancion";
				
				var lista = document.getElementById("opciones");
				var indiceSeleccionado = lista.selectedIndex;
				var opcionSeleccionada = lista.options[indiceSeleccionado];
				var valorSeleccionado = opcionSeleccionada.value;
				
				var busqueda = document.getElementById("busqueda").value;
				
				if(valorSeleccionado == "nada")
				{
					opc="eliminarcancion";
					objAjax.open("POST","../Controlador/MostrarCancionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
					objAjax.send("opcion="+opc+"&idcancion="+idcancion+"&dircancion="+dircancion+"&valorseleccionado=&busqueda=");
				
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				}
				else
				{
					objAjax.open("POST","../Controlador/MostrarCancionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					
					objAjax.send("opcion="+opc+"&idcancion="+idcancion+"&dircancion="+dircancion+"&valorseleccionado="+valorSeleccionado+"&busqueda="+busqueda);
					
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				}
			}
				
		</script>
		
		
	</head>
	<body onload="mostrartabla();">
		
		<!-- Aqui va el navbar del usuario logueado -->
		<?php include('navLogueados.php'); // la barra de navegación ?>
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					<h1>Consulta de Canciones</h1>
					<hr />
					<div class="row-fluid">
						<div class="span3">
							<p>
								Filtra tus canciones por titulo, artista, album o genero. 
							</p>
							
							<form id="formulario_filtro">
								<fieldset>
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
									<br />
									<button onclick="mostrarTablaPorSeleccion();return false;" class="btn btn-primary"><i class="icon-search icon-white"></i> Buscar</button>
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