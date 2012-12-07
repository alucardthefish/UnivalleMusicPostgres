<?php 
include('../Config/conexion.php');
  class CancionVentaModelo
  {    
    var $nick;
    var $titulo;
    var $artista;
    var $album;
    var $genero;
	var $precio;
    var $ubicacion;
	
	function CancionVentaModelo()
    {
      $this->nick="";
      $this->titulo="";
      $this->artista="";
      $this->album="";
      $this->genero="";
	  $this->precio="";
      $this->ubicacion="";
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
	
	function insertarCancion($nick, $titulo, $artista, $album, $genero, $foto,$precio)
    {
      conectar();
      $consulta="INSERT INTO cancionesenventa (nick, titulo, artista, album, genero,foto, precio) VALUES ('$nick','$titulo','$artista','$album','$genero','$foto', '$precio')";
      mysql_query($consulta) or die(mysql_error());
      desconectar();
    }


    
    function mostrarCanciones($nick)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero,precio FROM cancionesenventa WHERE nick = '$nick'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesTitulo($nick, $titulo)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero,precio FROM cancionesenventa WHERE nick = '$nick' and titulo like '$titulo%'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesArtista($nick, $artista)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero, precio FROM cancionesenventa WHERE nick = '$nick' and artista like '$artista%'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesAlbum($nick, $album)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero, precio FROM cancionesenventa WHERE nick = '$nick' and album like '$album%'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
    function mostrarCancionesGenero($nick, $genero)
    {
      conectar();
      $consulta="SELECT titulo, artista, album, genero, precio FROM cancionesenventa WHERE nick = '$nick' and genero like '$genero%'";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      
	  return $datos;      
    }
    
  }
?>