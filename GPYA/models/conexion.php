<?php
	//Variables parametros del PDO
	$cadena = "mysql:host=127.0.0.1; dbname=trabajoFinal";
	$usuario = "root";
	$clave = "";

	//Instanciar un nuevo objeto PDO
	$conexion = new PDO($cadena,$usuario,$clave);
?>