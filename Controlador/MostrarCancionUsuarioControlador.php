<?php
session_start();
include('../Config/conexion.php');
include_once("../Modelo/CancionUsuarioModelo.php");
$opc = $_POST["opcion"];
$nick = $_SESSION['nick'];
//$nick = "sergionick";
$titulo="";
$artista="";
$album="";
$genero="";
  
  switch($opc)
  {
	case "mostrar":
	
	$modelo = new CancionUsuarioModelo();
	
	$querymostrar = $modelo->mostrarCanciones($nick);
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{ 
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span4\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span4\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span4\"><strong>Genero: </strong> ".$row['genero']."</div></div></div></div>";
	}
	
	
	echo $datosdiv;
	
	break;
	
	case "mostrarconsulta":
	
	$modelo = new CancionUsuarioModelo();
	
	$querymostrar = $modelo->mostrarCanciones($nick);
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
		if($row['megusta'] == @f)
		{
			$datosdiv = $datosdiv."<button onclick=\"javascript:addToListplayer(".$row['id_cancion_usuario'].")\" class=\"btn btn-success\"><i class=\"icon-thumbs-up icon-white\"></i> Me Gusta</button> ";
		}
		else
		{
			$datosdiv = $datosdiv."<button onclick=\"javascript:removeFromListplayer(".$row['id_cancion_usuario'].")\" class=\"btn btn-warning\"><i class=\"icon-thumbs-down icon-white\"></i> Desmarcar</button> ";
		}
		$datosdiv = $datosdiv."<button onclick=\"borrarCancion(".$row['id_cancion_usuario'].", '".$row['ubicacion']."')\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i> Borrar</button></div></div></div></div>";
		
	}
	
	
	echo $datosdiv;
	
	break;
	
	case "mostrarseleccion":
	
	$modelo = new CancionUsuarioModelo();
	
	$querymostrar = $modelo->mostrarCanciones($nick);
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";

		$datosdiv = $datosdiv."<button onclick=\"darclick('".$row['id_cancion_usuario']."', '".$row['titulo']."', '".$row['artista']."', '".$row['album']."', '".$row['genero']."')\" class=\"btn btn-success\"> Seleccionar</button></div></div></div></div>";
	}
	
	
	echo $datosdiv;
	
	break;
	
	case "busquedaseleccion":
	
	if($_POST['valorseleccionado']=="" || $_POST['busqueda']=="")
	{
		echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Oops dejaste campos vacios!</h4>La busqueda no se realizo satisfactoriamente por que el parametro de busqueda no fue especificado</div>";
	}
	else
	{
		$filtro = $_POST['valorseleccionado'];
		$busqueda = $_POST['busqueda'];
		
		$modeloCancionUsuario = new CancionUsuarioModelo();
	
		$querymostrar = $modeloCancionUsuario->mostrarCancionesSeleccion($nick, $filtro, $busqueda);
	
		$datosdiv = "";
	
		while($row = pg_fetch_array($querymostrar))
		{
			$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
			if($row['megusta'] == @f)
			{
				$datosdiv = $datosdiv."<button onclick=\"addToListplayer(".$row['id_cancion_usuario'].");mostrarTablaPorSeleccion();\" class=\"btn btn-success\"><i class=\"icon-thumbs-up icon-white\"></i> Me Gusta</button> ";
			}
			else
			{
				$datosdiv = $datosdiv."<button onclick=\"javascript:removeFromListplayer(".$row['id_cancion_usuario'].")\" class=\"btn btn-warning\"><i class=\"icon-thumbs-down icon-white\"></i> Desmarcar</button> ";
			}
			$datosdiv = $datosdiv."<button onclick=\"borrarCancion(".$row['id_cancion_usuario'].", '".$row['ubicacion']."')\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i> Borrar</button></div></div></div></div>";
			
		}
	
	
	echo $datosdiv;
	}
	
	break;
	
	case "addlike":
	
	$modeloLike = new CancionUsuarioModelo();
	$modeloLike->setMeGustaTrue($_POST['idcancion']); //Se modifica el campo megusta a true
	
	if($_POST['valorseleccionado'] != "" && $_POST['busqueda'] != "")
	{
		$querymostrar = $modeloLike->mostrarCancionesSeleccion($nick, $_POST['valorseleccionado'], $_POST['busqueda']);
	}
	else
	{
		$querymostrar = $modeloLike->mostrarCanciones($nick);
	}
	//original el de abajo borrando la condicion if de arriba
	//$querymostrar = $modeloLike->mostrarCanciones($nick); //se devuelve todos los registros para actualizar con ajax
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
		if($row['megusta'] == @f)
		{
			$datosdiv = $datosdiv."<button onclick=\"addToListplayer(".$row['id_cancion_usuario'].");\" class=\"btn btn-success\"><i class=\"icon-thumbs-up icon-white\"></i> Me Gusta</button> ";
		}
		else
		{
			$datosdiv = $datosdiv."<button onclick=\"removeFromListplayer(".$row['id_cancion_usuario'].")\" class=\"btn btn-warning\"><i class=\"icon-thumbs-down icon-white\"></i> Desmarcar</button> ";
		}
		$datosdiv = $datosdiv."<button onclick=\"borrarCancion(".$row['id_cancion_usuario'].", '".$row['ubicacion']."')\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i> Borrar</button></div></div></div></div>";
		
	}
	
	
	echo $datosdiv;
	
//------------------------------------------------------------------	
	
	break;
	
	case "removelike":
	
	$modeloLike = new CancionUsuarioModelo();
	$modeloLike->setMeGustaFalse($_POST['idcancion']); //Se modifica el campo megusta a false
	
	if($_POST['valorseleccionado'] != "" && $_POST['busqueda'] != "")
	{
		$querymostrar = $modeloLike->mostrarCancionesSeleccion($nick, $_POST['valorseleccionado'], $_POST['busqueda']);
	}
	else
	{
		$querymostrar = $modeloLike->mostrarCanciones($nick);
	}
	
	//original el de abajo borrando la condicion if de arriba
	//$querymostrar = $modeloLike->mostrarCanciones($nick); //se devuelve todos los registros para actualizar con ajax

	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
		if($row['megusta'] == @f)
		{
			$datosdiv = $datosdiv."<button onclick=\"addToListplayer(".$row['id_cancion_usuario'].")\" class=\"btn btn-success\"><i class=\"icon-thumbs-up icon-white\"></i> Me Gusta</button> ";
		}
		else
		{
			$datosdiv = $datosdiv."<button onclick=\"removeFromListplayer(".$row['id_cancion_usuario'].")\" class=\"btn btn-warning\"><i class=\"icon-thumbs-down icon-white\"></i> Desmarcar</button> ";
		}
		$datosdiv = $datosdiv."<button onclick=\"borrarCancion(".$row['id_cancion_usuario'].", '".$row['ubicacion']."')\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i> Borrar</button></div></div></div></div>";
		
	}
	
	
	echo $datosdiv;
	
	break;
//------------------------------------------------------------------------------------------	
	
	case "eliminarcancion":
	
	$modeloCancion = new CancionUsuarioModelo();
	$modeloCancion->eliminarCancionUsuario($_POST['idcancion'], $_POST['dircancion']); //Se modifica el campo megusta a false
	
	if($_POST['valorseleccionado'] != "" && $_POST['busqueda'] != "")
	{
		$querymostrar = $modeloCancion->mostrarCancionesSeleccion($nick, $_POST['valorseleccionado'], $_POST['busqueda']);
	}
	else
	{
		$querymostrar = $modeloCancion->mostrarCanciones($nick);
	}
	
	//original el de abajo borrando la condicion if de arriba
	//$querymostrar = $modeloCancion->mostrarCanciones($nick); //se devuelve todos los registros para actualizar con ajax

	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
		if($row['megusta'] == @f)
		{
			$datosdiv = $datosdiv."<button onclick=\"addToListplayer(".$row['id_cancion_usuario'].")\" class=\"btn btn-success\"><i class=\"icon-thumbs-up icon-white\"></i> Me Gusta</button> ";
		}
		else
		{
			$datosdiv = $datosdiv."<button onclick=\"removeFromListplayer(".$row['id_cancion_usuario'].")\" class=\"btn btn-warning\"><i class=\"icon-thumbs-down icon-white\"></i> Desmarcar</button> ";
		}
		$datosdiv = $datosdiv."<button onclick=\"borrarCancion(".$row['id_cancion_usuario'].", '".$row['ubicacion']."')\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i> Borrar</button></div></div></div></div>";
		
	}
	
	
	echo $datosdiv;
	
	break;
//--------------------------------------------------------------------------
	case "artista":
	
	$modeloArtista = new CancionUsuarioModelo();
	
	$querymostrar = $modeloArtista->mostrarCancionesArtista($nick, $artista);
	
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th></tr></thead><tbody>";
	while($row = pg_fetch_array($querymostrar))
	{ 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td></tr>";
	}
	$tabla = $tabla."</tbody></table>";
	
	echo $tabla;
	
	break;
	
	case "album":
	
	$modeloAlbum = new CancionUsuarioModelo();
	
	$querymostrar = $modeloAlbum->mostrarCancionesAlbum($nick, $album);
	
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th></tr></thead><tbody>";
	while($row = pg_fetch_array($querymostrar))
    { 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td></tr>";
	}
	$tabla = $tabla."</tbody></table>";
	
	echo $tabla;
	
	break;
	
	case "genero":
	
	$modeloGenero = new CancionUsuarioModelo();
	
	$querymostrar = $modeloGenero->mostrarCancionesGenero($nick, $genero);
	
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th></tr></thead><tbody>";
	while($row = pg_fetch_array($querymostrar))
    { 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td></tr>";
	}
	$tabla = $tabla."</tbody></table>";
	
	echo $tabla;
	
	break;
  }
?>