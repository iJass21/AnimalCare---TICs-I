<?php
include "../inc/dbinfo.inc";

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$database = mysqli_select_db($connection, DB_DATABASE);

if(!empty($_POST['id'])) {
	$id = (int)$_POST['id'];
	
	$sql = "DELETE FROM perfil_animal WHERE id = ".$id;
	
	if (mysqli_query($connection, $sql))
	{
		header('Location: seleccionar_perfil.php');
		exit();
	}
}

header('Location: seleccionar_perfil.php');
exit();
?>