<?php 
include('../Config/conexion.php');
  class CancionUsuarioModelo
  {    
    var $nick;
    var $titulo;
    var $artista;
    var $album;
    var $genero;
	var $megusta;
    var $ubicacion;
    
    var $artistaModificar;
    var $tituloModificar;
    var $idCancion;
	
	function CancionUsuarioModelo()
    {
      $this->nick;
      $this->titulo;
      $this->artista;
      $this->album;
      $this->genero;
	  $this->megusta;
      $this->ubicacion;
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
	
	function insertarCancion($nick, $titulo, $artista, $album, $genero, $ubicacion)
    {
      conectar();
      $consulta="INSERT INTO canciones_usuario (nick, titulo, artista, album, genero, ubicacion) VALUES ('$nick','$titulo','$artista','$album','$genero', '$ubicacion')";
      mysql_query($consulta) or die(mysql_error());
      desconectar();
    }

/*    
    function insertarCancion()
    {
      conectar();
      $consulta="INSERT INTO canciones_usuario (nick, titulo, artista, album, genero, ubicacion) VALUES ('$this->nick','$this->titulo','$this->artista','$this->album','$this->genero', '$this->ubicacion')";
      mysql_query($consulta) or die(mysql_error());
      desconectar();
    }
	*/
    
    function mostrarCanciones($nick)
    {
      conectar();
      $consulta="SELECT * FROM canciones_usuario WHERE nick = '$nick'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
	function mostrarCancionesSeleccion($nick, $filtro, $busqueda)
	{
		conectar();
		$consulta ="SELECT * FROM canciones_usuario WHERE nick = '$nick' and $filtro like '$busqueda%'";
		$tabla = mysql_query($consulta) or die(mysql_error());
		desconectar();
		
		return $tabla;
	}
	
	function setMeGustaTrue($idcancion)
	{
		conectar();
		$asignarquery = "UPDATE canciones_usuario SET megusta = true WHERE id_cancion_usuario = '$idcancion'";
		mysql_query($asignarquery) or die(mysql_error());
		desconectar();
	}
	
	function setMeGustaFalse($idcancion)
	{
		conectar();
		$asignarquery = "UPDATE canciones_usuario SET megusta = false WHERE id_cancion_usuario = '$idcancion'";
		mysql_query($asignarquery) or die(mysql_error());
		desconectar();
	}
	
	
	function eliminarCancionUsuario($idcancion, $dircancion)
	{
		unlink($dircancion);
		conectar();
		$deletequery = "DELETE FROM canciones_usuario WHERE id_cancion_usuario = '$idcancion'";
		mysql_query($deletequery) or die(mysql_error());
		desconectar();
	}
    
    function mostrarCancionesTitulo($nick, $titulo)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero FROM canciones_usuario WHERE nick = '$nick' and titulo like '$titulo%'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesArtista($nick, $artista)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero FROM canciones_usuario WHERE nick = '$nick' and artista like '$artista%'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesAlbum($nick, $album)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero FROM canciones_usuario WHERE nick = '$nick' and album like '$album%'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesGenero($nick, $genero)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero FROM canciones_usuario WHERE nick = '$nick' and genero like '$genero%'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
    function actualizarCancion($idCancion)
    {
      conectar();
      $consulta="UPDATE canciones_usuario SET titulo = '$tituloModificar', artista = '$artistaModificar', album = '$album', genero = '$genero'  WHERE nick = '$idCancion'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
  }
?>