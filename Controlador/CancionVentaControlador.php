<?php
 
echo "antes de verificar errores del archivo";
  $nick = "admin"; //en el futuro se asignara a esta variable desde la sesion que se registre
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

    if (file_exists("../Usuarios/admin/" . $_FILES["file"]["name"]))
    {
      echo $_FILES["file"]["name"] . " already exists. ";
    
    }
    else
    {
      move_uploaded_file($_FILES["file"]["tmp_name"], "../Usuarios/admin/" . $_FILES["file"]["name"]);
	  move_uploaded_file($_FILES["fileImage"]["tmp_name"], "../Usuarios/admin/" . $_FILES["fileImage"]["name"]);
      //echo "Stored in: " . "../Usuarios/sergionick/" . $_FILES["file"]["name"];
      //echo "<h3>Almacenado en el espacio correspondiente al usuario con nick de prueba: " . "../Usuarios/nickprueba/" . $_FILES["file"]["name"];
	  //echo "antes";
      echo "exactamente antes de incluir y crear el modelo objeto";
      include_once("../Modelo/CancionVentaModelo.php");
	  
      //Aqui va originalmente la creacion del objeto $controller = new CancionUsuarioModelo($nick, $titulo, $artista, $album, $genero, $ubicacion);
	  $controller = new CancionVentaModelo();
	  //$controllerGenero = new CancionVentaModelo();
      echo "se creo el objeto cancionventamodelo";
      //echo "<h2>Despues</h2>";
      $controller->insertarCancion($nick, $titulo, $artista, $album, $genero, $foto,$precio);

	  //$controllerGenero->mostrarCancionesGenero($nick, $genero);
      echo "insertado satisfactoriamente en la base de datos";
      
      echo "<script languaje='Javascript'>parent.document.getElementById('resultado').innerHTML = '".$mensaje."';
                                parent.document.getElementById('titulo').value='';parent.document.getElementById('artista').value='';
                                parent.document.getElementById('album').value='';parent.document.getElementById('genero').value='';
                                parent.document.getElementById('file').value=''; </script>";

	$querymostrar = $controller->mostrarCanciones($nick);
	//$querymostrarGenero = $controllercontrollerGenero->mostrarCancionesGenero($nick, $genero);
//	echo "<script>alert('Despues de recibir los datos de la tabla canciones_usuario');</script>";
	
	//espacio para empezar a crear la tabla
	$tabla = "<table class=\"table table-bordered\"><thead><tr><th>Titulo</th><th>Artista</th><th>Album</th><th>Genero</th><th>Precio</th></tr></thead><tbody>";
//	echo "<script>alert('Acaba de crear la primer parte del string con html para la tabla');</script>";
//	echo "<script>alert('".$tabla."');</script>";
	
	while($row = mysql_fetch_array($querymostrar))
    { 
		$tabla = $tabla."<tr><td>".$row['titulo']."</td><td>".$row['artista']."</td><td>".$row['album']."</td><td>".$row['genero']."</td><td>".$row['precio']."</td></tr>";
	}
//	echo "<script>alert('Justo despues de haber escrito datos en la tabla con el while');</script>";
//	echo "<script>alert('".$tabla."');</script>";
			
	$tabla = $tabla."</tbody></table>";
//		echo "<script>alert('Se ha escrito todo el html en el string tabla');</script>";
//		echo "<script>alert('".$tabla."');</script>";
	
	echo "<script>parent.document.getElementById('tablademuestra').innerHTML = '".$tabla."';</script>";
	

      
      
    }
  }
  
?> 


