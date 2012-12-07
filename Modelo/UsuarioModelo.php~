<?php 
include('../Config/conexion.php');
  class UsuarioModelo
  {    
    var $nombre;
    var $apellido;
    var $email;
    var $password;
	
	public function __construct()
    {
      $this->nombre;
      $this->apellido;
      $this->email;
      $this->password;
    }
	
	public function insertarUsuario()
    {
      conectar();
      $consulta="INSERT INTO usuario (email, nombre, apellido, password) VALUES ('$this->email','$this->nombre','$this->apellido','$this->password')";
      pg_query($consulta) or die(pg_last_error());
      desconectar();
    }
	
	public function getNombre()
	{
		return $this->nombre;
	}
	
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}
	
	public function getApellido()
	{
		return $this->apellido;
	}
	
	public function setApellido($apellido)
	{
		$this->apellido = $apellido;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}
    
  }
?>