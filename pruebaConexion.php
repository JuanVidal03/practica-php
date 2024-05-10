<?php

	// valores para conectarse con la base de datos
	$db_name = 'php_test';
	$db_user = 'root';
	$db_password = '';
	$db_host = 'localhost';
	$url = 'mysql:host=' . $db_host . ';dbname=' . $db_name;

	// conexion con la base de datos, verificando la conexion con la base de datos
	try {
		$conexion = new PDO($url, $db_user, $db_password);
		$sql = $conexion->prepare("SELECT * FROM productos");
		$sql->execute();
		$productos = $sql->fetchAll();
		print_r(json_encode($productos));

	} catch (PDOException $error) {
		echo $error->getMessage();
	}

?>