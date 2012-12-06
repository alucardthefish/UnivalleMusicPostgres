<?php
include_once("../Modelo/CancionVentaModelo.php");
$opc = $_POST["opcion"];
$nick = "sergionick";
$titulo="";
$artista="";
$album="";
$genero="";
$precio="";  
  switch($opc)
  {
	case "mostrar":

	$modelo = new CancionVentaModelo();
	
	$querymostrar = $modelo->mostrarCanciones($nick);
	
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th><th>Precio</th></tr></thead><tbody>";
	while($row = mysql_fetch_array($querymostrar))
    { 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td><td>".$row['precio']."</td></tr>";
	}
	$tabla = $tabla."</tbody></table>";
	
	echo $tabla;
	
	break;
	
	case "titulo":
	
	$modeloTitulo = new CancionVentaModelo();
	
	$querymostrar = $modeloTitulo->mostrarCancionesTitulo($nick, $titulo);
	
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th><th>Precio</th></tr></thead><tbody>";
	while($row = mysql_fetch_array($querymostrar))
    { 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td><td>".$row['precio']."</td></tr>";
	}
	$tabla = $tabla."</tbody></table>";
	
	echo $tabla;
	
	break;
	
	case "artista":
	
	$modeloArtista = new CancionVentaModelo();
	
	$querymostrar = $modeloArtista->mostrarCancionesArtista($nick, $artista);
	
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th><th>Precio</th></tr></thead><tbody>";
	while($row = mysql_fetch_array($querymostrar))
    { 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td><td>".$row['precio']."</td></tr>";
	}
	$tabla = $tabla."</tbody></table>";
	
	echo $tabla;
	
	break;
	
	case "album":
	
	$modeloAlbum = new CancionVentaModelo();
	
	$querymostrar = $modeloAlbum->mostrarCancionesAlbum($nick, $album);
	
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th><th>Precio</th></tr></thead><tbody>";
	while($row = mysql_fetch_array($querymostrar))
    { 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td><td>".$row['precio']."</td></tr>";
	}
	$tabla = $tabla."</tbody></table>";
	
	echo $tabla;
	
	break;
	
	case "genero":
	
	$modeloGenero = new CancionVentaModelo();
	
	$querymostrar = $modeloGenero->mostrarCancionesGenero($nick, $genero);
	
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th><th>Precio</th></tr></thead><tbody>";
	while($row = mysql_fetch_array($querymostrar))
    { 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td><td>".$row['precio']."</td></tr>";
	}
	$tabla = $tabla."</tbody></table>";
	
	echo $tabla;
	
	break;
  }
?>