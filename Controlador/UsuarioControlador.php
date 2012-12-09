<?php
include('../Config/conexion.php');
$accion = $_POST["accion"];

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$nick = $_POST['nick'];
$password = $_POST['password'];
$passwordconfirm = $_POST['passwordconfirm'];
  
  if($_POST['accion']=="insertarusuario")
  {
	if($_POST['nombre']=="" || $_POST['apellido']=="" || $_POST['email']=="" || $_POST['nick']=="" || $_POST['password']=="" || $_POST['passwordconfirm']=="")
	{
		echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Campos vacios!</h4>Asegurate de rellenar todos los campos del formulario</div>";
		//mostramos error
	}
	else
	{
		if($_POST['password']!=$_POST['passwordconfirm'])
		{
			echo "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Error de contraseñas!</h4>Las contraseñas nos coinciden. <strong>Asegurate sean iguales</strong></div>";
			//mostramos mensaje de error
		}
		else
		{
			if(!file_exists("../Usuarios/".$_POST['nick']))
			{
				mkdir("../Usuarios/".$_POST['nick'], 0777) or die("no se pudo crear el usuario "); //creamos una carpeta para el usuario
				
				include_once("../Modelo/ClienteModelo.php");
				
				$objcliente = new ClienteModelo();
				
				$objcliente->setNombre($nombre);
				$objcliente->setApellido($apellido);
				$objcliente->setEmail($email);
				$objcliente->setNick($nick);
				$objcliente->setPassword($password);
				
				$objcliente->insertarUsuario();
				$objcliente->insertarCliente();
				
				echo "<div class='alert alert-success'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Tu cuenta ha sido creada!</h4>Compruebalo iniciando sesion logeandote con tu nick y constraseña</div>";
				
			}
			else
			{
				echo "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Tu cuenta no se ha podido crear!</h4>El nick de usuario: ".$_POST['nick']." ya esta registrado</div>";
			}
		}
	}
  }

?>