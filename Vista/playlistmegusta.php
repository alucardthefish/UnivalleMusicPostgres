<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mi musica Univalle Music</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="../Assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<!--    <script src="../Assets/bootstrap/js/jquery-1.8.3.js"></script> -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../Scripts/XHRObjeto.js"></script>
    <script src="../Scripts/audiojs/audio.min.js"></script>
    
    <script>
      function mostrarplaylist()
      {	
		var objAjax = new objetoAjax();
		
		var opc="mostrarplaylist";
		
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
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">Univalle Music</a>   <!-- <img alt="Univalle-Music"/> -->
					<div class="nav-collapse">
						<ul class="nav">
							<li><a href="#">Inicio</a></li>
							<li><a href="#">Acerca</a></li>
							<li><a href="#">Contactanos</a></li>
						</ul>
						<p class="navbar-text pull-right">Logged in as <a href="#">username</a></p>
					</div> <!-- .nav-collapse -->
				</div>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span3">
					<!-- Sidebar Content -->
					<div class="well sidebar-nav">
						<ul class="nav nav-list">
							<li><a href="#">Agregar Cancion</a></li>
							<li><a href="#">Comprar Cancion</a></li>
							<li><a href="#">Products</a></li>
							<li><a href="#">Services</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</div>	
				</div>
				
				<div class="span9">
					<!-- Body Content -->
						
					<div class="row-fluid">
						<div id="wrapper">
				  <h1 id="titulo_playlist"><em>Mi lista de reproduccion</em></h1>
				  <audio preload></audio>
				  <ol id="lista_playlist">
					
				  </ol>
				</div>
				
				
					</div>
				</div>
				
				
			</div>
		</div>		
		<script src="../Assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
