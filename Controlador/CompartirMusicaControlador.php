<?php
session_start();
include('../Config/conexion.php');
include_once("../Modelo/CancionUsuarioModelo.php");
include_once("../Modelo/ClienteModelo.php");
include_once("../Modelo/CompartirCancionesModelo.php");
$opc = $_POST["opcion"];
//$nick = $_SESSION['nick'];
$nick = "sergionick";
$titulo="";
$artista="";
$album="";
$genero="";
  
  switch($opc)
  {	
	case "mostrarconsulta":
	
	$modelo = new CancionUsuarioModelo();
	
	$querymostrar = $modelo->mostrarCanciones($nick);
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\"><button class=\"btn\">Compartir</button></div></div></div></div>";
	}	
	
	echo $datosdiv;
	
	break;
//---------------------------------------------------------------------------------------------------------------------	
	case "consultaoptima":
	$nickdecompartido = $_POST['nick'];
	$vSeleccion = $_POST['valorseleccionado'];
	$buskeda = $_POST['busqueda'];
	if($nickdecompartido == "")
	{
		$modeloCancionUsuario = new CancionUsuarioModelo();
		if($vSeleccion == "nada")
		{
			$querymostrar = $modeloCancionUsuario->mostrarCanciones($nick);
			$datosdiv = "";
			while($row = pg_fetch_array($querymostrar))
			{
				$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\"><button class=\"btn\">Compartir</button></div></div></div></div>";
			}
			echo $datosdiv;
		}
		else
		{
			if($buskeda == "")
			{
				echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Oops1 dejaste campos vacios!</h4>La busqueda no se realizo satisfactoriamente por que el parametro de busqueda no fue especificado</div>";
			}
			else
			{
				$querymostrar = $modeloCancionUsuario->mostrarCancionesSeleccion($nick, $vSeleccion, $buskeda);
				$datosdiv = "";
				while($row = pg_fetch_array($querymostrar))
				{
					$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\"><button class=\"btn\">Compartir</button></div></div></div></div>";
				}
				echo $datosdiv;
			}
		}
	}
	else
	{
		$instanciaCliente = new ClienteModelo(); //Instancia del objeto Cliente
		$instanciaCompartir = new CompartirCancionesModelo(); //Instancia del objeto CompartirCanciones
		if($instanciaCliente->estaRegistrado($nickdecompartido))
		{
			if($nickdecompartido == $nick) //Si el nick de la persona a compartir es igual al que esta compartiendo
			{
				echo "<h4>No se puede compartir una cancion a si mismo</h4>";
			}
			else
			{
				$modeloCancionUsuario = new CancionUsuarioModelo();
				if($vSeleccion == "nada")
				{
					$querymostrar = $modeloCancionUsuario->mostrarCanciones($nick);
					$datosdiv = "";
					//Aqui va el while
					while($row = pg_fetch_array($querymostrar))
					{
						$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
						
						if($instanciaCompartir->yaSeCompartio($nickdecompartido, $row['id_cancion_usuario']))
						{
							$datosdiv = $datosdiv."<button class=\"btn disabled\">Compartir</button></div></div>";
						}
						else
						{
							$datosdiv = $datosdiv."<button class=\"btn\" onclick=\"compartirCancion(".$row['id_cancion_usuario'].");\">Compartir</button></div></div>";
						}
					
						if($instanciaCompartir->yaSeCompartio($nickdecompartido, $row['id_cancion_usuario']))
						{
							$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"span12\"><span class=\"label label-success\">La cancion ha sido compartida</span></div></div>";
						}
					
						$datosdiv = $datosdiv."</div></div>";
					
					}
				
					echo $datosdiv;
				}
				else
				{
					if($buskeda == "")
					{
						echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Oops2 dejaste campos vacios!</h4>La busqueda no se realizo satisfactoriamente por que el parametro de busqueda no fue especificado</div>";
					}
					else
					{
						$querymostrar = $modeloCancionUsuario->mostrarCancionesSeleccion($nick, $vSeleccion, $buskeda);
						$datosdiv = "";
						//Aqui va el while
						while($row = pg_fetch_array($querymostrar))
						{
							$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
							
							if($instanciaCompartir->yaSeCompartio($nickdecompartido, $row['id_cancion_usuario']))
							{
								$datosdiv = $datosdiv."<button class=\"btn disabled\">Compartir</button></div></div>";
							}
							else
							{
								$datosdiv = $datosdiv."<button class=\"btn\" onclick=\"compartirCancion(".$row['id_cancion_usuario'].");\">Compartir</button></div></div>";
							}
					
							if($instanciaCompartir->yaSeCompartio($nickdecompartido, $row['id_cancion_usuario']))
							{
								$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"span12\"><span class=\"label label-success\">La cancion ha sido compartida</span></div></div>";
							}
					
							$datosdiv = $datosdiv."</div></div>";
					
						}
				
						echo $datosdiv;
					}
				}
			}
		}
		else
		{
			echo "<h4>Usuario no registrado</h4>";
		}
	}
	break;
	
//---------------------------------------------------------------------------------------------------------------------	

	case "compartircancion":
	$nickdecompartido = $_POST['nick'];
	$vSeleccion = $_POST['valorseleccionado'];
	$buskeda = $_POST['busqueda'];
	$id_cancion = $_POST['idcancion'];
	if($nickdecompartido != "")
	{
		if($nickdecompartido == $nick)
		{
			//No se permite compartir canciones a si mismo
		}
		else
		{
			$instanciaCliente = new ClienteModelo(); //Instancia del objeto Cliente
			$instanciaCompartir = new CompartirCancionesModelo(); //Instancia del objeto CompartirCanciones
			if($instanciaCliente->estaRegistrado($nickdecompartido))
			{
				$instanciaCompartir->insertarCancion($nickdecompartido, $id_cancion);
				echo "exitocompartiendo";
			}
			else
			{
				//El nick de usuario no esta registrado en el sistema
			}
		}
	}
	else
	{
		//Debe de especificarse a que usuario se le compartira la cancion
	}
	
	break;

//---------------------------------------------------------------------------------------------------------------------

  }
?>