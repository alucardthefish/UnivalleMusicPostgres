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
				
				objAjax.open("POST", "../Controlador/MostrarInformacionUsuarioControlador.php", true);
				
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
			
			function baja()
			{	
				var objAjax = new objetoAjax();
				
				var opc="baja";
				var numcontrasena = document.getElementById("contrasena").value;
					objAjax.open("POST","../Controlador/MostrarInformacionUsuarioControlador.php", true);
				
					objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					
				
					objAjax.send("opcion="+opc+"&numcontrasena="+numcontrasena);
				
					objAjax.onreadystatechange=function()
					{
						if(objAjax.readyState==4)
						{
							document.getElementById("tablademuestra").innerHTML = objAjax.responseText;
						}
					}
				$('#myModal').modal('hide');
				desloguear();
			}
			
			
		</script>
		
		
	</head>
	<body onload="mostrartabla()">
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					<h1>Darse de Baja</h1>
					<hr />
					<div class="row-fluid">
						<div class="span3">
							<h3>Contrato</h3>
							<p>
								Al darse de baja en la cuenta Univalle Music se eliminara tu perfil y se borrará toda tu informacion personal,
								tus Canciones, canciones compartidas y listas de reproduccion seran eliminadas. Univalle Music no se hara responsable de el mal manejo de este evento. 
							</p>
							
							<a class="btn btn-primary btn-large" data-toggle="modal" data-target="#myModal">
							  Darse de baja!
							</a>
							
				<div class="modal hide fade in" id="myModal" style="display: none;">
					<div class="modal-header">
						<a class="close" data-dismiss="modal">×</a>
						<h3>Darse de baja</h3>
					</div>
					<div class="modal-body">
					   <form>
						<fieldset>
							<label>Contrasena:</label>
							<input type="text" name="contrasena" id="contrasena" />
							<br />
							<br />
							<button class="btn btn-success" onclick="baja();return false;">Darse de Baja <i class="icon-ok icon-white"></i></button>
							<button type="reset" class="btn">Limpiar</button>
						</fieldset>
					  </form>

					  </div>
						<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Close</a>
					  </div>
				</div>
							
							
						</div>
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
					</div>
				</div>
			</div>
			
			
			
		</div>
		
		
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="../Assets/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>