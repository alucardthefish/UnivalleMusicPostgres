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
		<title>¡Bienvenido a Univalle Musicaaaa!</title>
		<!-- Bootstrap -->
		<link type="text/css" href="../Assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="../Scripts/XHRObjeto.js"></script>
		<script src="../Scripts/manejaSesion.js"></script>
		
	</head>
	<body>		
		
		<!-- Aqui va el navbar del usuario logueado -->
		<?php include('navLogueados.php'); // la barra de navegación ?>
				
		<div class="hero-unit">
			<h2>!Univalle Music!</h2>
			<p>Crea tu cuenta, sube canciones, escuchalas y compartelas</p>
			<p>
				<a class="btn btn-primary btn-large" data-toggle="modal" data-target="#myModal">
					Registrate ya!
				</a>
			</p>
		</div>
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span12">
					
					<div class="row-fluid">
					
						<div class="span3">
							<p>
								Aqui una vez existio un <strong>formulario</strong> hahahahahah!
							</p>
							
						</div>
						<div class="span9" id="mostrar">
							 
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