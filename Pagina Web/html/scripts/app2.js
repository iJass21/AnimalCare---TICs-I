'use strict'

$(document).ready( function () {
    //console.log("Funcionando script");
    
    //   INGRESAR
	
 	$("#form_ingresar").submit(function(login) {
        login.preventDefault();

        //console.log("se presiono ingresar");

        var usuario = {//El parametro "email" y "password" puede ser con o sin comillas, funciona igual
			"email": $('input[name="email"]').val(),
			"contrasenia": $('input[name="password"]').val()
		}

        console.log(usuario);

        $.ajax({
			type: 'POST',//Tipo de peticion
			dataType: 'json',// tipo de datos
			url: '../api.php/usuarios/ingresar',// URL de la llamada
			data: usuario,
			beforeSend: function(){//Esta propiedad hace algo antes de enviar, tambien es una funcion de callback
				console.log("Haciendo Login...");
			},
			success: function(response){//hace algo cuando la peticion fue exitosa, en este caso tiramos a consola lo que devuelve la API

				if(response){
					console.log("Login correcto, redireccionando");
					location.href=("seleccionar_perfil.php");
				}else{
					//$("#divIngresar").append("Datos incorrectos");
					//$("#divIngresar").addClass('divLogin');
					alert("Correo o contraseña incorrectos");
				}

				console.log(response);
				//console.log("ACCESO CORRECTO");

			},
			error: () => {
				alert("Ha ocurrido un error en la peticion AJAX");
				//location.href=("seleccionar_perfil.php");
				//$("#divIngresar").append("Datos incorrectos");
			},
			timeout: 10000//tiempo maximo para la peticion en ms
		
		});


    });
	
	//form_registrar
	
	
	 	$("#form_registrar").submit(function(login) {
        login.preventDefault();

        //console.log("se presiono ingresar");

        var new_user = {//El parametro "email" y "password" puede ser con o sin comillas, funciona igual
			"email": $('input[name="email"]').val(),
			"nombre":  $('input[name="nombre"]').val(),
			"password": $('input[name="password"]').val(),
			"password2": $('input[name="password2"]').val()
		}

        console.log(new_user);

        $.ajax({
			type: 'POST',//Tipo de peticion
			dataType: 'json',// tipo de datos
			url: '../api.php/usuarios/registrar',// URL de la llamada
			data: new_user,
			beforeSend: function(){//Esta propiedad hace algo antes de enviar, tambien es una funcion de callback
				console.log("Haciendo registro...");
			},
			success: function(response){//hace algo cuando la peticion fue exitosa, en este caso tiramos a consola lo que devuelve la API
				
				console.log(response);

				if(response){
					console.log("Registro Exitoso...");
					location.href=("ingresar.php?registro=true");
				}else{
					//$("#divIngresar").append("Datos incorrectos");
					//$("#divIngresar").addClass('divLogin');
					alert("Asegurese de completar bien los campos...");
				}

				
				//console.log("ACCESO CORRECTO");

			},
			error: () => {
				alert("Ha ocurrido un error en la peticion AJAX");
				//location.href=("seleccionar_perfil.php");
				//$("#divIngresar").append("Datos incorrectos");
			},
			timeout: 10000//tiempo maximo para la peticion en ms
		
		});


    });
	
	
	
	    //   LOGOUT
	
 	$("#btn_logout").click(function(login) {
        login.preventDefault();

        //console.log("se presiono ingresar");

        
        console.log("LOGOUT");

		
        $.ajax({
			type: 'POST',//Tipo de peticion
			dataType: 'json',// tipo de datos
			url: '../api.php/usuarios/logout',// URL de la llamada
			beforeSend: function(){//Esta propiedad hace algo antes de enviar, tambien es una funcion de callback
				console.log("Saliendo...");
			},
			success: function(response){//hace algo cuando la peticion fue exitosa, en este caso tiramos a consola lo que devuelve la API

				if(response){
					console.log("Sesion destruida");
					location.href=("ingresar.php?salir=true");
				}else{
					//$("#divIngresar").append("Datos incorrectos");
					//$("#divIngresar").addClass('divLogin');
					alert("ERROR!");
				}

				console.log(response);
				//console.log("ACCESO CORRECTO");

			},
			error: () => {
				alert("Ha ocurrido un error en la peticion AJAX");
				//location.href=("seleccionar_perfil.php");
				//$("#divIngresar").append("Datos incorrectos");
			},
			timeout: 10000//tiempo maximo para la peticion en ms
		
		});


    });
	
	
	

});// JavaScript Document