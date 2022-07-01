'use strict'

$(document).ready( function () {
    //console.log("Funcionando script");
    
    //   INGRESAR
	console.log("Ingresamos");
	var ultimox = 0;
	var ultimoy = 5;
    
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
					
				console.log(response);

				},
				error: () => {
					alert("Ha fallado la solicitud al servidor, por favor reintente en unos minutos");
					//$("#divIngresar").append("Datos incorrectos");
				},
				timeout: 10000//tiempo maximo para la peticion en ms
		
			}, "json");
			
		},2000);
	


});