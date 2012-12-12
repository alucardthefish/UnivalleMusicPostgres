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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mis canciones compartidas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="../Assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<!--    <script src="../Assets/bootstrap/js/jquery-1.8.3.js"></script> -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../Scripts/XHRObjeto.js"></script>
	<script src="../Scripts/manejaSesion.js"></script>
    <script src="../Scripts/audiojs/audio.min.js"></script>
    
	<style type="text/css">
		ol { padding: 0px; margin: 0px; list-style: decimal-leading-zero inside; color: #ccc; width: 460px; border-top: 1px solid #ccc; font-size: 0.9em; }
		ol a { color: #888; text-decoration: none; }
		@media (max-width: 480px) {
			audio {
				width: 100%;
				display: block;
			}
			.audiojs {
				width: 100%;
			}
			.audiojs .playing{
				width: 100%;
			}
			.audiojs .scrubber{
				/*width: 90px;*/
				width:40%;
				display:block;
			}
			.audiojs .scrubber .loaded{
				/*width: 90px;*/
				width:40%;
				display: block;
			}
			.audiojs .time{
				width:20%;
				display:block;
			}
			ol{
				width:100%;
			}
		}
		
		ol li { position: relative; margin: 0px; padding: 9px 2px 10px; border-bottom: 1px solid #ccc; cursor: pointer; }
		ol li a { display: block; text-indent: -3.3ex; padding: 0px 0px 0px 20px; }
		li.playing { color: #aaa; text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.3); }
		li.playing a { color: #000; }
		
	</style>	
	
    <script>
      function mostrarplaylist()
      {	
		var objAjax = new objetoAjax();
		
		var opc="reprocompartidas";
		
		objAjax.open("POST", "../Controlador/MostrarPlaylistsUsuarioControlador.php", true);
		
		objAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		objAjax.send("opcion="+opc);
		
		objAjax.onreadystatechange=function()
		{
			if (objAjax.readyState==4)
			{
				document.getElementById("lista_playlist").innerHTML = objAjax.responseText;
			}
		}
		
	}
    </script>
	
    <script>
      
      mostrarplaylist();
      function jeycuery()
      {
	$(function() {
	// Setup the player to autoplay the next track
	var a = audiojs.createAll({
	  trackEnded: function() {
	  var next = $('ol li.playing').next();
	  if (!next.length) next = $('ol li').first();
	  next.addClass('playing').siblings().removeClass('playing');
	  audio.load($('a', next).attr('data-src'));
	  audio.play();
	  }
	});
	//alert("A escuchar musica se dijo!");
	// Load in the first track
	
//	setTimeout(alert('cargo cargar'), 2000);
	
	var audio = a[0];
	//first = $('ol a').attr('data-src');
	first = $('ol a').attr('data-src');
	//alert("referencia h: "+$('ol li a').attr('href'));
	$('ol li').first().addClass('playing');
	audio.load(first); 
	//audio.load("../Usuarios/sergionick/Akon ft. Snoop_Dogg - I Wanna Love You.mp3");

	// Load in a track on click
	$('ol li').click(function(e) {
	e.preventDefault();
	$(this).addClass('playing').siblings().removeClass('playing');
	audio.load($('a', this).attr('data-src'));
	audio.play();
	});
	
      });
      }
      setTimeout("jeycuery()", 500);
    </script>
    
  </head>
  <body>
	<!-- Esta es la barra que no se mueve -->
		<!-- Aqui va el navbar del usuario logueado -->
		<?php include('navLogueados.php'); // la barra de navegación ?>
		
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span3">
				
					<!-- Sidebar Content -->
					<div class="well sidebar-nav">
						<ul class="nav nav-list">
							<li class="nav-header">
								Manejar Playlist Compartidos
							</li>
							<li class="active">
							<a href="consultarCompartidas.php">Quitar Canciones</a>
							</li>
						</ul>
					</div>
					
				</div>
				
				<div class="span9">
					<!-- Body Content -->
						
					<div class="row-fluid">
						<div id="wrapper">
							<h1 id="titulo_playlist"><em>Mi lista de compartidas</em></h1>
							<audio preload></audio>
							<ol id="lista_playlist">
					
							</ol>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Aqui va el footer -->
			<?php include('footer.php');?>
			
		</div>		
		<script src="../Assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
}
?>