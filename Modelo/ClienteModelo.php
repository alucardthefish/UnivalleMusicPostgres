<?php 
//include('../Config/conexion.php');
include('UsuarioModelo.php');
  class ClienteModelo extends UsuarioModelo
  {    
    var $nick;
	
	public function __construct()
	{
		parent::__construct();
		$this->nick;
	}
	
	public function insertarCliente()
    {
      conectar();
      $consulta="INSERT INTO cliente (nick, email) VALUES ('$this->nick','$this->email')";
      pg_query($consulta) or die(pg_last_error());
      desconectar();
    }
	
	public function estaRegistrado($nick)
	{
		$estaregistrado = false;
		conectar();
		$consult = "SELECT * FROM cliente WHERE nick = '$nick'";
		$resultado = pg_query($consult) or die (pg_last_error());
		desconectar();
		if(mysql_num_rows($resultado) != 0)
		{
			$estaregistrado = true;
		}
		return $estaregistrado;
	}
	
	public function coincidenPasswordsByNick($nick, $pass)
	{
		$coinciden=false;
		conectar();
		$consult = "SELECT password FROM usuario NATURAL JOIN cliente WHERE cliente.nick = '$nick';";
		$result= pg_query($consult) or die (pg_last_error());
		desconectar();
//		$row = mysql_fetch_array($result);
//		$password = row["password"];
		$password = pg_fetch_result($result,1,0);
		
		if($pass == $password)
		{
			$coinciden = true;
		}
		
		return $coinciden;		
	}
	
	public function getNick()
	{
		return $this->nick;
	}
	
	public function setNick($nick)
	{
		$this->nick = $nick;
	}
    
  }
?>