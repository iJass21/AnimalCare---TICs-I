<?php
include "../inc/dbinfo.inc";

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$database = mysqli_select_db($connection, DB_DATABASE);

if(!empty($_POST['email']) && !empty($_POST['nombre']) && !empty($_POST['especie']) && !empty($_POST['id_dispositivo'])) {
	$email_usuario = $_POST['email'];
	$nombre = $_POST['nombre'];
	$especie = (int)$_POST['especie'];
	$id_dispositivo = (int)$_POST['id_dispositivo'];
	
	$sql = "SELECT * FROM perfil_animal WHERE id_dispositivo = ".$id_dispositivo;
	$result = mysqli_query($connection, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		header('Location: agregar_perfil.php');
		exit();
	}
	
	$sql = "INSERT INTO perfil_animal(email_usuario, nombre, id_animal, id_dispositivo) VALUES ('".$email_usuario."', '".$nombre."', ".$especie.", ".$id_dispositivo.")";
	
	if (mysqli_query($connection, $sql))
	{
		header('Location: seleccionar_perfil.php');
		exit();
	} else {
		header('Location: agregar_perfil.php');
		exit();
	}
}

header('Location: agregar_perfil.php');
exit();
?>