<?php

function conectar()
{
	//mysql_connect("mysql", "sergiop", "sergiop");// conectarse al servidor de bases de datos
	//mysql_select_db("sergiop");       // seectcionar la bases de datos
	pg_connect('host=pgsql port=5432 dbname=sergiop user= sergiop password= sergiop')
   or die('No pudo conectarse: ' . pg_last_error());
}

function desconectar()
{
	pg_close(); // desconectarse de la base de datos
}
?>