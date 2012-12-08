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

	
	function insertarCancion($nick, $titulo, $artista, $album, $genero, $foto,$precio,$ubicacion)
    {
      conectar();
   
      $consulta="INSERT INTO cancionesenventa (nick, titulo, artista, album, genero,foto, precio, ubicacion_cancion) VALUES ('$nick','$titulo','$artista','$album','$genero','$foto', '$precio','$ubicacion')";
       
      pg_query($consulta) or die(pg_last_error());
    
      desconectar();
    }

    function setRecomendadoTrue($idcancion)
	{
		conectar();
		$asignarquery = "UPDATE cancionesenventa SET recomendado = true WHERE id_cancion_venta = '$idcancion'";
		pg_query($asignarquery) or die(pg_last_error());
		desconectar();
	}
	
	function setRecomendadoFalse($idcancion)
	{
		conectar();
		$asignarquery = "UPDATE cancionesenventa SET recomendado = false WHERE id_cancion_venta = '$idcancion'";
		pg_query($asignarquery) or die(pg_last_error());
		desconectar();
	}
    
    function mostrarCanciones($nick)
    {
      conectar();
      $consulta="SELECT * FROM cancionesenventa WHERE nick = '$nick' order by titulo";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      
	  return $datos;      
    }
    
    
    
  }
?>