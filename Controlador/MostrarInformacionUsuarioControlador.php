<?php
include('../Config/conexion.php');
include_once("../Modelo/ClienteModelo.php");

$opc = $_POST["opcion"];
$nick = "norreanick";
$titulo="";
$artista="";
$album="";
$genero="";
  
  switch($opc)
  {
	case "mostrar":

	$modelo = new ClienteModelo();
	
	$querymostrar = $modelo->getPasswordByNick($nick);
	
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{ 
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> Informacion Personal</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Nombre:</strong> ".$row['nombre']."</div><div class=\"span3\"><strong>Apellido: </strong> ".$row['apellido']."</div><div class=\"span3\"><strong>Email: </strong> ".$row['email']."<br></div></div></div></div>";				
	}
	$consultaTotalCanciones=$modelo->mostrarTotalCanciones($nick);
	$consultaTotalListas=$modelo->mostrarTotalListasReproduccion($nick);
	$consultaTotalCompartidas=$modelo->mostrarTotalCancionesCompartidas($nick);
	$totalCanciones=pg_fetch_result ($consultaTotalCanciones,0,1);
	$totalListas=pg_fetch_result ($consultaTotalListas,0,1);
	$totalCompartidas=pg_fetch_result ($consultaTotalCompartidas,0,1);
	
	$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> Informacion tu musica</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Total Canciones:</strong> ".$totalCanciones."</div><div class=\"span3\"><strong>Listas de Reproduccion: </strong> ".$totalListas."</div><div class=\"span3\"><strong>Canciones Compartidas: </strong>".$totalCompartidas."<br></div></div></div></div>";				

	
	echo $datosdiv;
	
	break;
	
	case "baja":
	
	$modeloLike = new ClienteModelo();
	$consultaUsuario=$modeloLike->getPasswordByNick($nick);
	$passwordtmp = pg_fetch_result($consultaUsuario,0,'password');
	
	if($passwordtmp==$_POST['numcontrasena'])
	{
		   while($row = pg_fetch_array($consultaUsuario))
		    { 
			$modeloLike->deleteUsuario($row['email']);
			
			$datosdiv="<div class='alert alert-success'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Tu cuenta ha sido eliminada!</h4>Si quieres pertenecer a lafamilia Univalle Music registrate!!</div>";
		    
		    }
	rmdir('../Usuarios/'.$nick);
	}
	else{$datosdiv="<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Error en contrasena!".$passwordtmp."</h4>Porfavor ingresa corecctamente tu contrasena.</div>";
}
	
	echo $datosdiv;
	
	
	break;
		

  }
?>