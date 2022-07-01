<?php
include_once('header.php');
include "../inc/dbinfo.inc";

if (empty($_SESSION['email'])) {
	echo "Error";
	exit();
}

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE);
?>

<html>

<body>

<?php

$qry = "SELECT * FROM animal";
$especies = mysqli_query($connection, $qry);
?>

<div id="header-perfiles">
	<a> CREAR PERFIL <a>
</div>

<div class="agregar_perfil-form">
	<form action="/agregar_perfil_logica.php" method="post" class="btn-seleccionar-perfil">
		<input name="email" type="hidden" value="<?php echo $_SESSION['email']; ?>">
		
		<label for="nombre"> Nombre: </label><br>
		<input name="nombre" type="text">
		<label for="especie"> Especie: </label><br>
		<select name="especie">
			<?php
			while($especie = mysqli_fetch_row($especies)) {
			?>
			<option value="<?php echo $especie[0]; ?>"> <?php echo $especie[1]; ?></option>
			<?php
			}
			?>
		</select>
		<label for="id_dispositivo"> ID dispositivo: </label><br>
		<input name="id_dispositivo" type="text">
		
		<button type="submit" name="seleccionar" value="">Seleccionar</button>
	</form>
</div>
<?php

mysqli_free_result($especies);
mysqli_close($connection);
?>

</body>
</html>
