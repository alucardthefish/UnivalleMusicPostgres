<?php
session_start();
include('../Config/conexion.php');
include_once("../Modelo/CancionUsuarioModelo.php");
include_once("../Modelo/ClienteModelo.php");
include_once("../Modelo/CompartirCancionesModelo.php");
$opc = $_POST["opcion"];
//$nick = $_SESSION['nick'];
$nick = "fannynick";
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
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\"><button class=\"btn btn-success disabled\"><i class=\"icon-share icon-white\"></i> Compartir</button></div></div></div></div>";
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
				$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\"><button class=\"btn btn-success disabled\"><i class=\"icon-share icon-white\"></i> Compartir</button></div></div></div></div>";
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
					$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\"><button class=\"btn btn-success disabled\"><i class=\"icon-share icon-white\"></i> Compartir</button></div></div></div></div>";
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
				echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>No se pudo mostrar la informacion!</h4>Las canciones no se pueden compartir a si mismo por eso no hay una respuesta del servidor, ingresa el nick de una persona diferente</div>";
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
							$datosdiv = $datosdiv."<button class=\"btn btn-success disabled\"><i class=\"icon-share icon-white\"></i> Compartir</button></div></div>";
						}
						else
						{
							$datosdiv = $datosdiv."<button class=\"btn btn-success\" onclick=\"compartirCancion(".$row['id_cancion_usuario'].");\"><i class=\"icon-share icon-white\"></i> Compartir</button></div></div>";
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
								$datosdiv = $datosdiv."<button class=\"btn btn-success disabled\"><i class=\"icon-share icon-white\"></i> Compartir</button></div></div>";
							}
							else
							{
								$datosdiv = $datosdiv."<button class=\"btn btn-success\" onclick=\"compartirCancion(".$row['id_cancion_usuario'].");\"><i class=\"icon-share icon-white\"></i> Compartir</button></div></div>";
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
			echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>No se pudo mostrar la informacion!</h4>El nick suministrado no se encuentra registrado en el sistema, ingresa un nick correcto</div>";
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
			echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>No se pudo compartir la cancion!</h4>No esta permitido que un usuario comparta canciones a si mismo, ingresa un nick registrado de otra persona</div>";
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
				echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Nick de usuario invalido!</h4>El nick suministrado no se encuentra registrado en el sistema, ingresa un nick correcto</div>";
			}
		}
	}
	else
	{
		//Debe de especificarse a que usuario se le compartira la cancion
		echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>No se pudo compartir la cancion!</h4>No se especifica a que nick se le compartira la cancion, llena el campo de nick correctamente</div>";
	}
	
	break;

//---------------------------------------------------------------------------------------------------------------------

	case "mostrarLoQueMeComparten":
	
	$remitente = $_POST['nickremitente'];
	if($remitente == "seleccionartodos")
	{
		$misCompartidas = new CompartirCancionesModelo;
		$shareQuery = $misCompartidas->mostrarLasQueMeCompartieron($nick);
	
		$datosdiv = "";
	
		while($row = pg_fetch_array($shareQuery))
		{
			$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']." <span class=\"label label-info pull-right\"> Compartido por: ".$row['nick']." </span></h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\"><button class=\"btn btn-danger\" onclick=\"borrarCompartida(".$row['id_cancion_compartida'].");\">Borrar</button></div></div></div></div>";
		}	
	
		echo $datosdiv;
	}
	else
	{
		$misCompartidas = new CompartirCancionesModelo;
		$shareQuery = $misCompartidas->compartidasPorNick($nick, $remitente);
		
		$datosdiv = "";
	
		while($row = pg_fetch_array($shareQuery))
		{
			$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']." <span class=\"label label-info pull-right\"> Compartido por: ".$row['nick']." </span></h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\"><button class=\"btn btn-danger\" onclick=\"borrarCompartida(".$row['id_cancion_compartida'].");\">Borrar</button></div></div></div></div>";
		}	
	
		echo $datosdiv;
	}
	
	break;
//---------------------------------------------------------------------------------------------------------------------

	case "mostrarNicks":
	
	$modelo = new CompartirCancionesModelo;
	$datos = $modelo->listarNicksDeCompartidores($nick);
	
	$datosListar = "<option value=\"seleccionartodos\">Seleccionar todos</option>";
	
	while($row = pg_fetch_array($datos))
	{
		$datosListar = $datosListar."<option value=\"".$row['nick']."\">".$row['nick']."</option>";
	}
	
	echo $datosListar;
	
	break;
//-----------------------------------------------------------------------------------------------------------------------

	case "eliminarcompartida":
	$id_compartida = $_POST['idcompartida'];
	
	$modelo = new CompartirCancionesModelo;
	$modelo->eliminarCompartidas($id_compartida);
	
	echo "eliminado";

	break;
  }
?>