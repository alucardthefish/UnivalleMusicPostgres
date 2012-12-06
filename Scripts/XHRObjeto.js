function objetoAjax()
{
	var xmlhttp;

	if (window.XMLHttpRequest)
	{
		//El explorador implementa la interfaz de forma nativa , para aquellos navegadores que soportan java escrip
		xmlhttp = new XMLHttpRequest();
		return xmlhttp;
	}
	else if(window.ActiveXObject)
	{
		//El explorador permite crear objetos ActiveX
		try
		{
			xmlhttp = new ActiveXObject("MSXML2.XMLHTTP");  // para los navegadires que siguen el estandar
		}
		catch(e)
		{
			try
			{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");   // obejeto index par navegadores explorer
			}
			catch(E)
			{
				xmlhttp=false;
			}
		}
		
		return xmlhttp;
	}
	if(!xmlhttp)
	{
		alert("No ha sido posible crear una instancia de XMLHttpRequest");
	}
}