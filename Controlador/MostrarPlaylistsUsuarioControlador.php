<?php
include('../Config/conexion.php');
include_once("../Modelo/PlaylistModelo.php");
$opc = $_POST["opcion"];
$nick = "fannynick";
$titulo="";
$artista="";
$album="";
$genero="";
  
  switch($opc)
  {
	case "mostrarplaylist":
	
	$modeloplaylist = new PlaylistModelo();
	
	$querymostrar = $modeloplaylist->getPlaylistMeGusta($nick);
	
	$lista = "";
	
	while($row = pg_fetch_array($querymostrar))
	{ 
		$lista = $lista."<li><a href=\"#\" data-src=\"".$row['ubicacion']."\">".$row['titulo']."</a></li>";
	}
	
	
	echo $lista;
	
	break;
	
//------------------------------------------------------------------------------------------------------------------------

	case "reprocompartidas":
	
	$modeloreproductor = new PlaylistModelo();
	$resultconsulta = $modeloreproductor->getPlaylistCompartidas($nick);
	
	$lista = "";
	
	while($row = pg_fetch_array($resultconsulta))
	{
		$lista = $lista."<li><a href=\"#\" data-src=\"".$row['ubicacion']."\">".$row['titulo']." -compartido por: ".$row['nick']."</a></li>";
	}
	
	echo $lista;
	
	break;

//-------------------------------------------------------------------------------------------------------------------------	
	
  }
?>