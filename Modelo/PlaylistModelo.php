<?php 
//include('../Config/conexion.php');
  class PlaylistModelo
  {    
    var $nick;
    
	
	function CancionUsuarioModelo()
    {
      $this->nick;
    }

    //Funcion para devolver las canciones que iran a la lista de reproduccion de canciones seleccionadas con un megusta
    function getPlaylistMeGusta($nick)
    {
      conectar();
	  $consulta="SELECT ubicacion, titulo FROM canciones_usuario WHERE nick = '$nick' and megusta = true";
      $datos = pg_query($consulta) or die(pg_last_error());
      desconectar();
      return $datos;      
    }
    
    function getPlaylistCompartidas($nick)
	{
		conectar();
		$consulta="SELECT canciones_compartidas.id_cancion_compartida, canciones_usuario.ubicacion, canciones_usuario.titulo, canciones_usuario.nick FROM canciones_compartidas, canciones_usuario WHERE canciones_compartidas.id_cancion_user = canciones_usuario.id_cancion_usuario and canciones_compartidas.cliente_key = '$nick'";
		$ejecutar = pg_query($consulta) or die(pg_last_error());
		desconectar();
		return $ejecutar;
	}
	
  }
?>