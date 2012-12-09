<?php
include('../Config/conexion.php');
  $nick = "Admin"; //en el futuro se asignara a esta variable desde la sesion que se registre
  $titulo= $_POST["titulo"];
  $artista= $_POST["artista"];
  $album= $_POST["album"];
  $genero= $_POST["genero"];
  $precio= $_POST["precio"];
  $foto= "../Usuarios/".$nick."/".$_FILES["fileImage"]["name"];
//  $ubicacion= "../Usuarios/sergionick/i wanna fuck you.mp3";
  $ubicacion= "../Usuarios/".$nick."/".$_FILES["file"]["name"];
//  echo "hola: ".$nick." acabas de subir ".$titulo." de ".$artista." en el album ".$album." y genero ".$genero."en la ubicacion: ".$ubicacion;
//  $ubicacion= "../Usuarios/".$nick."/".$_FILES["file"]["name"];
  
  
  
  $mensaje = "<div class=\"alert alert-success\">La Cancion ".$_FILES["file"]["name"] . " Fue Subida Con Exito.</div>";
  
  if ($_FILES["file"]["error"] > 0 || $_FILES["fileImage"]["error"] > 0)
  {
	echo "<script> alert('Error Return Code: " . $_FILES["file"]["error"] . "');</script>";
   // echo "Error Return Code: " . $_FILES["file"]["error"] . "<br />";
  }
  else
  {
    //echo "<h1>Archivo Subido: " . $_FILES["file"]["name"] . "</h1><br />";
    //echo "Type: " . $_FILES["file"]["type"] . "<br />";
    //echo "<h2>Tamaño del archivo: " . ($_FILES["file"]["size"] / 1024) . " Kb</h2><br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("../Usuarios/Admin/" . $_FILES["file"]["name"]))
    {
      echo $_FILES["file"]["name"] . " already exists. ";
    
    }
    else
    {
      move_uploaded_file($_FILES["file"]["tmp_name"], "../Usuarios/Admin/" . $_FILES["file"]["name"]);
	  move_uploaded_file($_FILES["fileImage"]["tmp_name"], "../Usuarios/Admin/" . $_FILES["fileImage"]["name"]);


      include_once("../Modelo/CancionVentaModelo.php");
	
      //Aqui va originalmente la creacion del objeto $controller = new CancionUsuarioModelo($nick, $titulo, $artista, $album, $genero, $ubicacion);
	  $controller = new CancionVentaModelo();
	

      
      $controller->insertarCancion($nick, $titulo, $artista, $album, $genero, $foto,$precio,$ubicacion);

	   
     

	$querymostrar = $controller->mostrarCanciones($nick);


	
	//espacio para empezar a crear la tabla
	$datosdiv = "";
	
	while($row = pg_fetch_array($querymostrar))
	{  
		$datosdiv = $datosdiv."<div class=\"row-fluid\"><div class=\"well span12\"><h4><i class=\"icon-music\"></i> ".$row['titulo']." /Precio: ".$row['precio']."</h4><hr /><div class=\"row-fluid\"><div class=\"span3\"><strong>Artista:</strong> ".$row['artista']."</div><div class=\"span3\"><strong>Album: </strong> ".$row['album']."</div><div class=\"span3\"><strong>Genero: </strong> ".$row['genero']."</div><div class=\"span3\">";
		if ($row['recomendado']==f){
		$datosdiv = $datosdiv."<label>Recomendado</label><input type=\"checkbox\" onclick=\"recomendar(".$row['id_cancion_venta'].")\" name=\"option1\" value=\"Milk\"><br></div></div></div></div>";
		}
		else{
		$datosdiv = $datosdiv."<label>Recomendado</label><input type=\"checkbox\" onclick=\"desrecomendar(".$row['id_cancion_venta'].")\" name=\"option1\" value=\"Milk\" checked><br></div></div></div></div>";
		}
	}
	
	

	
	echo "<script>parent.document.getElementById('tablademuestra').innerHTML = '".$datosdiv."';</script>";
	

      
      
    }
  }
  
?> 



