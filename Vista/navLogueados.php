<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="indes.php">Univalle-Music</a>
					<div class="nav-collapse" style="height: auto;"> <!-- in collapse" style="height: auto;" added to mobile -->
						<ul class="nav">
							<li><a href="subircanciones.php">Subir Canciones</a></li>
							<li class="dropdown">
							  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							    Consutar Coleccion <b class="caret"></b>
							  </a>
							  <ul class="dropdown-menu">
							    <li>
							      <a href="#">Editar Canciones</a>
							    </li>
							    <li>
							      <a href="ConsultaConBootstrap.php">Consultar/Me Gusta</a>
							    </li>
							  </ul>
							</li>
							
							<li class="dropdown">
							  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							    Compartidas <b class="caret"></b>
							  </a>
							  <ul class="dropdown-menu">
							    <li>
							      <a href="consultarCompartidas.php">Consultar/Eliminar</a>
							    </li>
							    <li>
							      <a href="CompartirMusica.php">Compartir Canciones</a>
							    </li>
							  </ul>
							</li>
							
							<li class="dropdown">
							  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							    <i class="icon-headphones icon-white"></i> Escuchar <b class="caret"></b>
							  </a>
							  <ul class="dropdown-menu">
							    <li>
							      <a href="playlistmegusta.php">Mi Musica</a>
							    </li>
							    <li>
							      <a href="playlistcompartidas.php">Canciones Compartidas</a>
							    </li>
							  </ul>
							</li>
							<li><a href="#">Catalogo de Musica</a></li>
						</ul>
						
						<ul class="nav pull-right">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-user icon-white"></i> <?php echo $_SESSION['nick'];?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#"><i class="icon-edit"></i> Editar</a>
									</li>
									<li>
										<a href="javascript:desloguear();"><i class="icon-off"></i> Salir</a>
									</li>
								</ul>
							</li>
						</ul>
						
					</div> <!-- .nav-collapse -->
				</div>
			</div>
		</div>