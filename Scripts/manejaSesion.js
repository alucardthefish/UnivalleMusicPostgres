function loguear()
			{
				var objAjax2 = new objetoAjax();
				
				var accion2 = "loguearse";
				var nick2 = document.getElementById("nicklogin").value;
				var password2 = document.getElementById("passlogin").value;
				
				objAjax2.open("POST", "../Controlador/LoginControlador.php", true);
				
				objAjax2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				
				objAjax2.send("accion="+accion2+"&nicklogin="+nick2+"&passlogin="+password2);
				
				objAjax2.onreadystatechange=function()
				{
					if(objAjax2.readyState==4)
					{
						var resp = objAjax2.responseText;
						if(resp == "iraindex")
						{
							//document.location.href="indes.php";
							window.location.replace("indes.php");
						}
						else
						{
							document.getElementById("mostrar").innerHTML = resp;
						}
					}
				}
				
			}

function desloguear()
			{
				var objex = new objetoAjax();
				var action = "desloguearse";
				
				objex.open("POST", "../Controlador/LoginControlador.php", true);
				objex.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objex.send("accion="+action);
				
				objex.onreadystatechange=function()
				{
					if(objex.readyState==4)
					{
						var rsp = objex.responseText;
						if(rsp == "iraindex")
						{
							window.location.replace("indes.php");
							window.location.reload(true);
						}
					}
				}				
			}
			