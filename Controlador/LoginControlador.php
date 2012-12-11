<?php
	session_start();
	include('../Config/conexion.php');
	include_once("../Modelo/ClienteModelo.php");
	$accion = $_POST["accion"];

	$nick = $_POST['nicklogin'];
	$password = $_POST['passlogin'];

	$objcliente = new ClienteModelo();
  
	if($_POST['accion']=="loguearse")
	{
		if($_POST['nicklogin']=="" || $_POST['passlogin']=="")
		{
			echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Oops dejaste campos vacios!</h4>Asegurate de introducir los dos campos nick y contraseña</div>";
			//mostramos error
		}
		else
		{
			if($objcliente->estaRegistrado($nick))
			{
				if($objcliente->coincidenPasswordsByNick($nick, $password))
				{//Se lanzaran las sesiones del usuario y sesion
					$_SESSION['nick']=strip_tags($_POST['nicklogin']); //creamos una variable de sesion con el nick del usuario
					$_SESSION['login']="ok"; //creamos la variable de sesion login con el valor de ok
//					header("Location: indes.php"); //redirigimos al index
					echo "iraindex";
				}
				else
				{//si no coinciden las contraseñas
					echo "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Error en contraseña!</h4>La contraseña suministrada no es la correcta para accesar a la cuenta</div>";
				}
			}
			else
			{//si no hay un usuario registrado con el nick suministrado
				echo "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Error de Autenticacion!</h4>Usuario no registrado en el sistema. Nick invalido. <strong>Asegurate sean iguales</strong></div>";
				//mostramos mensaje de error
			}
		}
	}
	else if($_POST['accion']=="desloguearse")
	{
		session_destroy();
		//header("Location: LoginRegistro.php");
		echo "iraindex";
	}

?>