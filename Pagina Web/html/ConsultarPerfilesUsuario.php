<?php
include "../inc/dbinfo.inc"; 
?>
<?php
$coneccion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$database = mysqli_select_db($coneccion, DB_DATABASE);

if ($coneccion->coneccion_error) {
    die("Error al conectar : " . $coneccion->connection_error);
} else { echo "Conectado a BDD MySQL. "; }

$data = array('1' => 1);
if(!empty($_POST['email']) && !empty($_POST['contrasenia'])) {
	
	$email = $_POST['email'];
	$contrasenia = $_POST['contrasenia'];
	$sql = "SELECT * FROM perfil_animal WHERE rut_usuario in (SELECT rut FROM usuario WHERE email = '".$email."' AND contrasenia = '".$contrasenia."')"; 
	
	$perfiles = $coneccion->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[$row['id']] = array(
				'id' => $row['id'],
				'rut_cliente' => $row['rut_cliente'],
				'id_animal' => $row['id_animal'],
				'nombre' => $row['nombre']
			);
		}
	} else {
		echo "No se encontraron perfiles";
	}
}

$coneccion->close();

return json_encode($data);
?>