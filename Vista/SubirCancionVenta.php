<!DOCTYPE html>
<html>
	<head>
		<title>Vista Subir Cancion con Bootstrap</title>

		<!-- Bootstrap -->
		<link href="../Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../Scripts/XHRObjeto.js"></script>
		<script>
			function mostrartabla()
			{
				var objAjax = new objetoAjax();
				
				var opc="mostrar";
				
				objAjax.open("POST", "../Controlador/MostrarCancionVentaControlador.php", true);
				
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
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					<h1>Subiendo Canciones En Venta </h1>
					<hr />
					<div class="row-fluid">
						<div class="span3">
							<p>
								Sube canciones en venta y se visualizaran en el carrito de compras. 
							</p>
							 
							<form action="../Controlador/CancionVentaControlador.php" method="post" enctype="multipart/form-data" target="pagina_target">
								<fieldset>
									<label>Titulo:</label>
									<input type="text" name="titulo" id="titulo" />
									<label>Artista:</label>
									<input type="text" name="artista" id="artista" />
									<label>Album:</label>
									<input type="text" name="album" id="album" />
									<label>Genero:</label>
									<input type="text" name="genero" id="genero" />
									<label>Precio:</label>
									<input type="text" name="precio" id="precio" />
									<label>Seleccionar imagen:</label>
									<input type="file" name="fileImage" id="fileImage" />
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
						<div class="well span9">
							<div class="span9" id="resultado" name="resultado"></div>
							<div class="span9" id="tablademuestra" name="tablademuestra">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Titulo</th>
											<th>Artista</th>
											<th>Album</th>
											<th>Genero</th>
											<th>Precio</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
		</div>
		
		
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="../Assets/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>