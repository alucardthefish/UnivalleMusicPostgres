<?php 
include('../Config/conexion.php');
  class PlaylistModelo
  {    
    var $nick;
    
	
	function CancionUsuarioModelo()
    {
      $this->nick;
    }

    
    function getPlaylistMeGusta($nick)
    {
      conectar();
	  $consulta="SELECT ubicacion, titulo FROM canciones_usuario WHERE nick = '$nick' and megusta = true";
      $datos = mysql_query($consulta) or die(mysql_error());
      desconectar();
      return $datos;      
    }
    
    
  }
?>