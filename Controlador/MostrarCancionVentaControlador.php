<?php
include('../Config/conexion.php');
include_once("../Modelo/CancionVentaModelo.php");
$opc = $_POST["opcion"];
$nick = "Admin";
$titulo="";
$artista="";
$album="";
$genero="";
  
  switch($opc)
  {
	case "mostrar":

	$modelo = new CancionVentaModelo();
	
	$querymostrar = $modelo->mostrarCanciones($nick);
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{ 
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']." /Precio: ".$row['precio']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
		if ($row['recomendado']==f){
		$datosdiv = $datosdiv."<label>Recomendado</label><input type=\"checkbox\" onclick=\"recomendar(".$row['id_cancion_venta'].")\"  ><br></div></div></div></div>";
		}
		else{
		$datosdiv = $datosdiv."<label>Recomendado</label><input type=\"checkbox\" onclick=\"desrecomendar(".$row['id_cancion_venta'].")\"  checked><br></div></div></div></div>";
		}
		
	}
	
	
	echo $datosdiv;
	
	break;
	
	case "addlike":
	
	$modeloLike = new CancionVentaModelo();
	$modeloLike->setRecomendadoTrue($_POST['idcancion']); //Se modifica el campo megusta a true
	
	
	$querymostrar = $modeloLike->mostrarCanciones($nick);
	
	//original el de abajo borrando la condicion if de arriba
	//$querymostrar = $modeloLike->mostrarCanciones($nick); //se devuelve todos los registros para actualizar con ajax
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']." /Precio: ".$row['precio']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
		
		if ($row['recomendado']==f){
		$datosdiv = $datosdiv."<label>Recomendado</label><input type=\"checkbox\" onclick=\"recomendar(".$row['id_cancion_venta'].")\" name=\"option1\" value=\"Milk\" ><br></div></div></div></div>";
		}
		else{
		$datosdiv = $datosdiv."<label>Recomendado</label><input type=\"checkbox\" onclick=\"desrecomendar(".$row['id_cancion_venta'].")\" name=\"option1\" value=\"Milk\" checked><br></div></div></div></div>";
		}
	}
	
	
	echo $datosdiv;
	
	
	break;
	
		case "removelike":

	$modeloLike = new CancionVentaModelo();
	$modeloLike->setRecomendadoFalse($_POST['idcancion']); //Se modifica el campo megusta a true
	
	
	$querymostrar = $modeloLike->mostrarCanciones($nick);
	
	//original el de abajo borrando la condicion if de arriba
	//$querymostrar = $modeloLike->mostrarCanciones($nick); //se devuelve todos los registros para actualizar con ajax
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']." /Precio: ".$row['precio']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
		
		if ($row['recomendado']==f){
		$datosdiv = $datosdiv."<label>Recomendado</label><input type=\"checkbox\" onclick=\"recomendar(".$row['id_cancion_venta'].")\" name=\"option1\" value=\"Milk\"  ><br></div></div></div></div>";
		}
		else{
		$datosdiv = $datosdiv."<label>Recomendado</label><input type=\"checkbox\" onclick=\"desrecomendar(".$row['id_cancion_venta'].")\" name=\"option1\" value=\"Milk\" checked><br></div></div></div></div>";
		}
	}
	
	
	echo $datosdiv;
	
	break;
	

  }
?>