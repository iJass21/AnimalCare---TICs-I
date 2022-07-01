<?php
include_once('header.php');
include "../inc/dbinfo.inc";

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE);

//print("algo");
if(!isset($_SESSION['nombre']))
{
	header('Location: ingresar.php?ingresar=true'); 
}


?>

<html>

<body>

<div id="header-perfiles">
	<a> PERFILES <a>
</div>

<div class="perfiles">
<?php

$_SESSION['email'] = "jonathan.cuitino@mail.udp.cl";

$qry = "SELECT p.id, id_dispositivo, nombre, nombre_especie FROM perfil_animal as p JOIN animal ON p.id_animal = animal.id WHERE email_usuario = '".$_SESSION['email']."'";
$perfiles = mysqli_query($connection, $qry);

while($perfil = mysqli_fetch_row($perfiles)) {
	?>
	<div class="perfil">
		<div class="nombre">
			<h1> <?php echo $perfil[2]; ?> </h2>
		</div>
		<div class="datos">
			<h3> ID Dispositivo: <?php echo $perfil[1]; ?> </h1>
			<h3> Especie: <?php echo $perfil[3]; ?> </h2>
		</div>
		<div class="acciones">
			<form action="/perfil.php" method="post" class="seleccionar-perfil">
				<input name="id_perfil" type="hidden" value="<?php echo $perfil[0]; ?>">
				<button class="btn-seleccionar" type="submit" name="seleccionar" value="">Seleccionar</button>
			</form>
			
			<form action="/eliminar_perfil_logica.php" method="post" class="eliminar-perfil">
				<input name="id" type="hidden" value="<?php echo $perfil[0]; ?>">
				<button class="btn-eliminar" type="submit" name="eliminar" value="">Eliminar</button>
			</form>
		</div>
	</div>
<?php 
}
?>

	<div class="agregar-perfil perfil">
		<form action="/agregar_perfil.php" method="post" class="agregar-perfil">
			<input name="email" type="hidden" value="<?php echo $_SESSION['email']; ?>">
			<button class="btn-agregar" type="submit" name="agregar" value="">Agregar</button>
		</form>
	</div>

</div>

<?php

mysqli_free_result($perfiles);
mysqli_close($connection);
?>

</body>
</html>
