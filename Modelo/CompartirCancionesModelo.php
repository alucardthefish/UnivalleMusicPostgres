<?php 
//include('../Config/conexion.php');
  class CompartirCancionesModelo
  {    
    var $nick;
    var $id_cancion_compartir;
    
	
	function CompartirCancionesModelo()
    {
      $this->nick;
      $this->id_cancion_compartir;
    }

	
	function insertarCancion($nick, $id_cancion)
    {
      conectar();
      $consulta="INSERT INTO canciones_compartidas (cliente_key, id_cancion_user) VALUES ('$nick','$id_cancion')";
      pg_query($consulta) or die(pg_last_error());
      desconectar();
    }
	
	//Function que devuelve true si la cancion con id_cancion ya fue compartida al usuario con nick especificado
	// y false en el caso contrario
	function yaSeCompartio($nick, $id_cancion)
	{
		$seCompartio = false;
		conectar();
		$query = "SELECT * FROM canciones_compartidas WHERE cliente_key = '$nick' and id_cancion_user = '$id_cancion'";
		$datos = pg_query($query) or die(pg_last_error());
		desconectar();
		if(pg_num_rows($datos) != 0)
		{
			$seCompartio = true;
		}
		return $seCompartio;
	}
	
    //Muestra todas las canciones que le han compartido a un cliente con un nick especificado
	function mostrarLasQueMeCompartieron($nick)
	{
		conectar();
		$consulta="SELECT canciones_compartidas.id_cancion_compartida, canciones_usuario.titulo, canciones_usuario.artista, canciones_usuario.album, canciones_usuario.genero, canciones_usuario.nick FROM canciones_compartidas, canciones_usuario WHERE canciones_compartidas.id_cancion_user = canciones_usuario.id_cancion_usuario and canciones_compartidas.cliente_key = '$nick'";
		$ejecutar = pg_query($consulta) or die(pg_last_error());
		desconectar();
		return $ejecutar;
	}
	
	//Muestra las canciones compartidas al usuario con $nickpropio por parte del usuario con $nickRemitente
	function compartidasPorNick($nickpropio, $nickRemitente)
	{
		conectar();
		$consulta="SELECT canciones_compartidas.id_cancion_compartida, canciones_usuario.titulo, canciones_usuario.artista, canciones_usuario.album, canciones_usuario.genero, canciones_usuario.nick FROM canciones_compartidas, canciones_usuario WHERE canciones_compartidas.id_cancion_user = canciones_usuario.id_cancion_usuario and canciones_compartidas.cliente_key = '$nickpropio' and canciones_usuario.nick = '$nickRemitente'";
		$data = pg_query($consulta) or die(pg_last_error());
		desconectar();
		return $data;
	}

    function listarNicksDeCompartidores($nick)
	{
		conectar();
		$consulta="SELECT distinct canciones_usuario.nick FROM canciones_compartidas, canciones_usuario WHERE canciones_compartidas.id_cancion_user = canciones_usuario.id_cancion_usuario and canciones_compartidas.cliente_key = '$nick'";
		$data = pg_query($consulta) or die(pg_last_error());
		desconectar();
		return $data;
	}
	
	//Elimina una cancion compartida por el id que la identifica
	function eliminarCompartidas($idcompartida)
	{
		conectar();
		$consulta ="delete from canciones_compartidas where id_cancion_compartida = $idcompartida";
		$tabla = pg_query($consulta) or die(pg_last_error());
		desconectar();
		
		return $tabla;
	}
    
  }
?>