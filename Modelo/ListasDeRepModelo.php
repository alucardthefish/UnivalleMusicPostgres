<?php 
//include('../Config/conexion.php');
  class ListasDeRepModelo
  {    
    var $nombreLista;
	var $nick;
	
	function ListasDeRepModelo()
    {
      $this->nombreLista;
	  $this->nick;
    }

/*    
    function CancionUsuarioModelo($nick, $titulo, $artista, $album, $genero, $ubicacion)
    {
      $this->nick=$nick;
      $this->titulo=$titulo;
      $this->artista=$artista;
      $this->album=$album;
      $this->genero=$genero;
      $this->ubicacion=$ubicacion;
    }
	*/
	
	public function crearListaDeRep($nombreLista, $nick)
    {
      conectar();
      $consulta="INSERT INTO lista_reproduccion (nombre_lista, id_cliente) VALUES ('$nombreLista', '$nick')";
      pg_query($consulta) or die(pg_last_error());
      desconectar();
    }
	
	public function mostrarListasDeRep($nick)
    {
      conectar();
      $consulta="SELECT * FROM lista_reproduccion WHERE id_cliente = '$nick' order by id_lista_reproduccion desc";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      
	  return $datos;      
    }
	
	public function agregarAListaReproduccion($id_list, $id_cancion)
	{
		conectar();
		$consulta="insert into canciones_en_lista (id_lista, id_cancion) VALUES ('$id_list', '$id_cancion')";
		pg_query($consulta) or die(pg_last_error());
		desconectar();
	}
	
	public function yaEstaEnLista($id_list, $id_cancion)
	{
		$estaenlista = false;
		conectar();
		$consulta="select * from canciones_en_lista where id_lista = '$id_list' and id_cancion = '$id_cancion';";
		$resultado = pg_query($consulta) or die(pg_last_error());
		desconectar();
		if(pg_num_rows($resultado) != 0)
		{
			$estaenlista = true;
		}
		return $estaenlista;
	}

//-------------------------------------------De aqui pa abajo no es----------------------------------------------------    
    
	public function mostrarCancionesSeleccion($nick, $filtro, $busqueda)
	{
		conectar();
		$consulta ="SELECT * FROM canciones_usuario WHERE nick = '$nick' and $filtro ilike '$busqueda%' order by titulo";
		$tabla = pg_query($consulta) or die(pg_last_error());
		desconectar();
		
		return $tabla;
	}
	
	public function setMeGustaTrue($idcancion)
	{
		conectar();
		$asignarquery = "UPDATE canciones_usuario SET megusta = true WHERE id_cancion_usuario = '$idcancion'";
		pg_query($asignarquery) or die(pg_last_error());
		desconectar();
	}
	
	public function setMeGustaFalse($idcancion)
	{
		conectar();
		$asignarquery = "UPDATE canciones_usuario SET megusta = false WHERE id_cancion_usuario = '$idcancion'";
		pg_query($asignarquery) or die(pg_last_error());
		desconectar();
	}
	
	
	function eliminarCancionUsuario($idcancion, $dircancion)
	{
		unlink($dircancion);
		conectar();
		$deletequery = "DELETE FROM canciones_usuario WHERE id_cancion_usuario = '$idcancion'";
		pg_query($deletequery) or die(pg_last_error());
		desconectar();
	}
    
    function mostrarCancionesTitulo($nick, $titulo)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero FROM canciones_usuario WHERE nick = '$nick' and titulo like '$titulo%'";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesArtista($nick, $artista)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero FROM canciones_usuario WHERE nick = '$nick' and artista like '$artista%'";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesAlbum($nick, $album)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero FROM canciones_usuario WHERE nick = '$nick' and album like '$album%'";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesGenero($nick, $genero)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero FROM canciones_usuario WHERE nick = '$nick' and genero like '$genero%'";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      
	  return $datos;      
    }
    
    function actualizarCancion($idCancion)
    {
      conectar();
	//mysql
      $consulta="UPDATE canciones_usuario SET titulo = '$tituloModificar', artista = '$artistaModificar', album = '$album', genero = '$genero'  WHERE nick = '$idCancion'";
	  $consulta="UPDATE canciones_usuario SET titulo='$titulo', artista='$artista', album='$album', genero='$genero' WHERE id_cancion_usuario = '$idcancion'";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      
	  return $datos;      
    }
    
  }
?>