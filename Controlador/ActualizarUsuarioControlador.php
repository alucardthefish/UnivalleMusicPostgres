 <?php
$accion = $_POST["accion"];
$nick = "sergionick";
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordnew = $_POST['passwordnew'];
$passwordconfirm = $_POST['passwordconfirm'];
  
  if($_POST['accion']=="actualizarusuario")
  {
	if($_POST['nombre']=="" || $_POST['apellido']=="" || $_POST['email']=="" ||$_POST['password']=="" || $_POST['passwordnew']=="" || $_POST['passwordconfirm']=="")
	{
		echo "<div class='alert alert-info'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Campos vacios!</h4>Asegurate de rellenar todos los campos del formulario</div>";
		//mostramos error
	}
	else
	{
		if($_POST['passwordnew']!=$_POST['passwordconfirm'])
		{
			echo "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Error de contrasenas!</h4>Las contrasenas nos coinciden. <strong>Asegurate sean iguales</strong></div>";
			//mostramos mensaje de error
		}
		else
		{
			
				
				
				include_once("../Modelo/ClienteModelo.php");
				
				$objcliente = new ClienteModelo();
				$querymostrar = $objcliente-> getPasswordByNick($nick);
				
				while($row = mysql_fetch_array($querymostrar))
				{
				if($row['password']==$password)
				  {
				$objcliente->actualizarUsuario($nick,$row['email'],$email,$nombre,$apellido,$passwordnew);
				echo "<div class='alert alert-success'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Tu cuenta ha sido Actualizada!</h4>Compruebalo iniciando sesion logeandote con tu nick y constrasena</div>";
				  }
				  else{echo "<div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><h4 class='alert-heading'>Contrasena incorrecta!</h4>Por favor ingresa correctamente tu contrasena actual</div>";}
				
				}
				
				
				
				
			
		}
	}
  }

?>