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
	
    //Muestra todas las canciones que te han compartido
    function mostrarLasQueMeCompartieron($nick)
    {
      conectar();
      $consulta="SELECT * FROM canciones_usuario WHERE nick = '$nick'";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      
	  return $datos;      
    }
    
	//Por verificar
	function mostrarCancionesSeleccion($nick, $filtro, $busqueda)
	{
		conectar();
		$consulta ="SELECT * FROM canciones_usuario WHERE nick = '$nick' and $filtro like '$busqueda%'";
		$tabla = pg_query($consulta) or die(pg_last_error());
		desconectar();
		
		return $tabla;
	}
    
  }
?>