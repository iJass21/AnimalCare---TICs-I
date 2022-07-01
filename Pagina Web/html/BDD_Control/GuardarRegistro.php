<?php include "../../inc/dbinfo.inc"; ?>
<?php
$coneccion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$database = mysqli_select_db($coneccion, DB_DATABASE);

if ($coneccion->coneccion_error) {
    die("Error al conectar : " . $coneccion->connection_error);
} else { echo "Conectado a BDD MySQL. "; }

date_default_timezone_set('America/Santiago');

if(!empty($_POST['id_dispositivo']) && !empty($_POST['temp']) && !empty($_POST['luz']) && !empty($_POST['humedad'])){
	$sql = "SELECT id FROM perfil_animal WHERE id_dispositivo = ".$_POST['id_dispositivo'];
	
	if ($result = mysqli_query($coneccion, $sql)) {
		if(!(mysqli_num_rows($result) > 0)){
			return;
		}
		
		$rows = mysqli_fetch_assoc($result);
		
		$id_perfil = $rows['id'];
		$date = date('Y-m-d h:i:s', time());
		$temp = (int)$_POST['temp'];
		$luz = (int)$_POST['luz'];
		$humedad = (int)$_POST['humedad'];
		$uv = (int)$_POST['uv'];
		
		$sql = "INSERT INTO registro(id_perfil, fecha, temp, luz, humedad, uv) VALUES (".$id_perfil.",'".$date."', ".$temp.", ".$luz.", ".$humedad.", '".$uv."')"; 
		
		if ($coneccion->query($sql) === TRUE) {
			echo "Se insertaron los valores en la tabla.";
		} else {
			echo "Error : " . $sql . "<br>" . $coneccion->error;
		}
	}
	
}

$coneccion->close();

$data = array();
return json_encode($data);
?>