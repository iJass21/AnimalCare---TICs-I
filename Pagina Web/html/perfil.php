<?php
include_once('header.php');
include "../inc/dbinfo.inc"; 

$id_perfil = $_POST['id_perfil'];


$coneccion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$database = mysqli_select_db($coneccion, DB_DATABASE);

if ($coneccion->coneccion_error) {
    die("Error al conectar : " . $coneccion->connection_error);
}//} else { /*echo "Conectado a BDD MySQL. "; }

date_default_timezone_set('America/Santiago');



$qry = "SELECT id_animal, nombre FROM perfil_animal WHERE (id = '$id_perfil')";

if ($result = mysqli_query($coneccion, $qry)) {
	if(mysqli_num_rows($result) > 0)
	{
		$rows = mysqli_fetch_assoc($result);
		$id_animal = $rows['id_animal'];
		$nombre = $rows['nombre'];
		//print($rows['nombre']."\n");
	}
}

$qry2 = "SELECT * FROM animal WHERE (id = '$id_animal')";

$result2 = mysqli_query($coneccion, $qry2);
$especie = mysqli_fetch_assoc($result2);
$nombre_especie = $especie['nombre_especie'];


//$rows = mysqli_fetch_assoc($qry);
//$perfiles = mysqli_query($connection, $qry);
//print_r($perfiles);



if(!isset($_SESSION['nombre']))
{
	header('Location: ingresar.php?ingresar=true'); 
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!-- Cargando ajax* -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Cargando jquery* -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<html>

<body>


<div class="w3-container">

<div>
	
	<h2><?php echo $nombre .", ".$nombre_especie  ?></h2>
	
</div>

<h2>Medidas</h2>
	<div class = "width50">
		
	<div class="fila-perfil">
	<p> Luz: </p>
	
	<div id="LuzErrorMenor" style="display: none;"> La luz esta por debajo del rango de la especie, es recomendable aumentar la iluminación. </div>
	<div id="LuzErrorMayor" style="display: none;"> La luz esta por encima del rango de la especie, es recomendable disminuir la iluminación. </div>
	
	<canvas id="luzChart" style="width:100%;max-width:600px"></canvas>
	
	<script>
	var xValuesLuz = [];
	var yValuesLuz = [];

	new Chart("luzChart", {
	  type: "line",
	  data: {
		labels: xValuesLuz,
		datasets: [{
		  fill: false,
		  lineTension: 0,
		  backgroundColor: "rgba(0,255,0,0.1)",
		  borderColor: "rgba(0,255,0,0.1)",
		  data: yValuesLuz
		}]
	  },
	  options: {
		legend: {display: false},
		scales: {
			yAxes: [{ticks: {min: 0, max:400}}],
		},
		animation: {
			duration: 0
		}
	  }
	});

	</script>

	<p> Temperatura: </p>
	
	<div id="TempErrorMenor" style="display: none;"> La temperatura esta por debajo del rango de la especie, es recomendable aumentar la calefacción. </div>
	<div id="TempErrorMayor" style="display: none;"> La temperatura esta por encima del rango de la especie, es recomendable disminuir la temperatura. </div>
	
	<canvas id="tempChart" style="width:100%;max-width:600px"></canvas>

	<script>
	var xValuesTemp = [];
	var yValuesTemp = [];

	new Chart("tempChart", {
	  type: "line",
	  data: {
		labels: xValuesTemp,
		datasets: [{
		  fill: false,
		  lineTension: 0,
		  backgroundColor: "rgba(0,255,0,1.0)",
		  borderColor: "rgba(0,255,0,0.1)",
		  data: yValuesTemp
		}]
	  },
	  options: {
		legend: {display: false},
		scales: {
			yAxes: [{ticks: {min: 0, max:100}}],
		},
		animation: {
			duration: 0
		}
	  }
	});

	</script>

</div>
<div class="fila-perfil">
	<p> Humedad: </p>
	
	<div id="HumedadErrorMenor" style="display: none;"> La humedad esta por debajo del rango de la especie, es recomendable humedecer el ambiente. </div>
	<div id="HumedadErrorMayor" style="display: none;"> La humedad esta por encima del rango de la especie, es recomendable secar el ambiente. </div>
	
	<canvas id="humedadChart" style="width:100%;max-width:600px"></canvas>

	<script>
	var xValuesHumedad = [];
	var yValuesHumedad = [];

	new Chart("humedadChart", {
	  type: "line",
	  data: {
		labels: xValuesHumedad,
		datasets: [{
		  fill: false,
		  lineTension: 0,
		  backgroundColor: "rgba(0,255,0,0.1)",
		  borderColor: "rgba(0,255,0,0.1)",
		  data: yValuesHumedad
		}]
	  },
	  options: {
		legend: {display: false},
		scales: {
			yAxes: [{ticks: {min: 0, max:400}}],
		},
		animation: {
			duration: 0
		}
	  }
	});

	</script>

	<p> UV: </p>
	
	<div id="UvErrorMenor" style="display: none;"> La luz UV esta por debajo del rango de la especie, es recomendable exponer el ambiente al sol. </div>
	<div id="UvErrorMayor" style="display: none;"> La luz UV esta por encima del rango de la especie, es recomendable esconder el ambiente del sol. </div>
	
	<canvas id="uvChart" style="width:100%;max-width:600px"></canvas>

	<script>
	var xValuesUv = [];
	var yValuesUv = [];

	new Chart("uvChart", {
	  type: "line",
	  data: {
		labels: xValuesUv,
		datasets: [{
		  fill: false,
		  lineTension: 0,
		  backgroundColor: "rgba(0,255,0,0.1)",
		  borderColor: "rgba(0,255,0,0.1)",
		  data: yValuesUv
		}]
	  },
	  options: {
		legend: {display: false},
		scales: {
			yAxes: [{ticks: {min: 0, max:50}}],
		},
		animation: {
			duration: 0
		}
	  }
	});

</script>

</div>
	
	
	</div>
	
	
</div>

<script>
setInterval(function(){


			$.ajax({
				type: 'POST',//Tipo de peticion
				dataType: 'json',// tipo de datos
				url: '../api.php/animal/obtener_data',// URL de la llamada
				//data: usuario,
				beforeSend: function(){//Esta propiedad hace algo antes de enviar, tambien es una funcion de callback
					console.log("Obteniendo datos");
				},
				success: function(response){//hace algo cuando la peticion fue exitosa, en este caso tiramos a consola lo que devuelve la API

					/*if(response.login){
						console.log("Login correcto, redireccionando");
						location.href=("libros.html");
					}else{
						$("#data").append("Datos incorrectos");
					}*/
					
					actualizar(response)
				},
				error: () => {
					alert("Ha fallado la solicitud al servidor, por favor reintente en unos minutos");
					//$("#divIngresar").append("Datos incorrectos");
				},
				timeout: 10000//tiempo maximo para la peticion en ms
		
			}, "json");
			
		},2000);




  function actualizar(datos) {
	var xValuesLuz = [];
	var yValuesLuz = [];
	
	document.getElementById("LuzErrorMenor").style.display = "none";
	document.getElementById("LuzErrorMayor").style.display = "none";
	
	if (datos[0]['luz'] > <?php echo $especie['max_luz']; ?>) {
		document.getElementById("LuzErrorMayor").style.display = "block";
	}
	
	if (datos[0]['luz'] < <?php echo $especie['min_luz']; ?>) {
		document.getElementById("LuzErrorMenor").style.display = "block";
	}
	
	document.getElementById("TempErrorMenor").style.display = "none";
	document.getElementById("TempErrorMayor").style.display = "none";
	
	if (datos[0]['temp'] > <?php echo $especie['max_temp']; ?>) {
		document.getElementById("TempErrorMayor").style.display = "block";
	}
	
	if (datos[0]['temp'] < <?php echo $especie['min_temp']; ?>) {
		document.getElementById("TempErrorMenor").style.display = "block";
	}
	
	document.getElementById("HumedadErrorMenor").style.display = "none";
	document.getElementById("HumedadErrorMayor").style.display = "none";
	
	if (datos[0]['humedad'] > <?php echo $especie['max_humedad']; ?>) {
		document.getElementById("HumedadErrorMayor").style.display = "block";
	}
	
	if (datos[0]['humedad'] < <?php echo $especie['min_humedad']; ?>) {
		document.getElementById("HumedadErrorMenor").style.display = "block";
	}
	
	document.getElementById("UvErrorMenor").style.display = "none";
	document.getElementById("UvErrorMayor").style.display = "none";
	
	if (datos[0]['uv'] > <?php echo $especie['max_uv']; ?>) {
		document.getElementById("UvErrorMayor").style.display = "block";
	}
	
	if (datos[0]['uv'] < <?php echo $especie['min_uv']; ?>) {
		document.getElementById("UvErrorMenor").style.display = "block";
	}
	
	
	for(let i = 0; i < datos.length; i++) {
		xValuesLuz[datos.length - i - 1] = datos[i]['fecha'];
		yValuesLuz[datos.length - i - 1] = datos[i]['luz'];
	}
	
	new Chart("luzChart", {
	  type: "line",
	  data: {
		labels: xValuesLuz,
		datasets: [{
		  fill: false,
		  lineTension: 0,
		  backgroundColor: "rgba(0,255,0,1.0)",
		  borderColor: "rgba(0,255,0,0.1)",
		  data: yValuesLuz
		}]
	  },
	  options: {
		legend: {display: false},
		scales: {
		  yAxes: [{ticks: {min: Math.min(...yValuesLuz) - 3, max: Math.max(...yValuesLuz) + 3}}],
		},
		animation: {
			duration: 0
		}
	  }
	});
	
	
	var xValuesTemp = [];
	var yValuesTemp = [];
	
	for(let i = 0; i < datos.length; i++) {
		xValuesTemp[datos.length - i - 1] = datos[i]['fecha'];
		yValuesTemp[datos.length - i - 1] = datos[i]['temp'];
	}
	
	new Chart("tempChart", {
	  type: "line",
	  data: {
		labels: xValuesTemp,
		datasets: [{
		  fill: false,
		  lineTension: 0,
		  backgroundColor: "rgba(0,255,0,1.0)",
		  borderColor: "rgba(0,255,0,0.1)",
		  data: yValuesTemp
		}]
	  },
	  options: {
		legend: {display: false},
		scales: {
		  yAxes: [{ticks: {min: Math.min(...yValuesTemp) - 3, max: Math.max(...yValuesTemp) + 3}}],
		},
		animation: {
			duration: 0
		}
	  }
	});
	
	
	var xValuesHumedad = [];
	var yValuesHumedad = [];
	
	for(let i = 0; i < datos.length; i++) {
		xValuesHumedad[datos.length - i - 1] = datos[i]['fecha'];
		yValuesHumedad[datos.length - i - 1] = datos[i]['humedad'];
	}

	new Chart("humedadChart", {
	  type: "line",
	  data: {
		labels: xValuesHumedad,
		datasets: [{
		  fill: false,
		  lineTension: 0,
		  backgroundColor: "rgba(0,255,0,1.0)",
		  borderColor: "rgba(0,255,0,0.1)",
		  data: yValuesHumedad
		}]
	  },
	  options: {
		legend: {display: false},
		scales: {
			yAxes: [{ticks: {min: Math.min(...yValuesHumedad) - 3, max: Math.max(...yValuesHumedad) + 3}}],
		},
		animation: {
			duration: 0
		}
	  }
	});
	
	
	var xValuesUv = [];
	var yValuesUv = [];
	
	for(let i = 0; i < datos.length; i++) {
		xValuesUv[datos.length - i - 1] = datos[i]['fecha'];
		yValuesUv[datos.length - i - 1] = datos[i]['uv'];
	}

	new Chart("uvChart", {
	  type: "line",
	  data: {
		labels: xValuesUv,
		datasets: [{
		  fill: false,
		  lineTension: 0,
		  backgroundColor: "rgba(0,255,0,1.0)",
		  borderColor: "rgba(0,255,0,0.1)",
		  data: yValuesUv
		}]
	  },
	  options: {
		legend: {display: false},
		scales: {
			yAxes: [{ticks: {min: Math.min(...yValuesUv) - 3, max: Math.max(...yValuesUv) + 3}}],
		},
		animation: {
			duration: 0
		}
	  }
	});
  }

</script>
	
	<?php
		include_once('footer.php');
	?>
	

</html>