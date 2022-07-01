
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- Own Css -->
      <link href="./styles/style.css" rel="stylesheet">
      <link href="./styles/normaliza.css" rel="stylesheet">
      


      <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

        <!-- Plantillas -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/product/">
    <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


        <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <!-- Custom styles for this template -->
        <link href="product.css" rel="stylesheet">
	
				<!-- Cargando ajax* -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	
	<!-- Cargando jquery* -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	

<!--	Scripts-->
	<script type="text/javascript" src="scripts/app2.js"></script>
	
    <!-- Titulo pagina -->
    <title>Dispositivo de monitoreo Ambiental</title>
</head>

<body>

<header class="site-header sticky-top py-1">
  <nav class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="py-2" href="#" aria-label="Product">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"></circle><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"></path></svg>
    </a>
    <a class="py-2 d-none d-md-inline-block" href="#">Guias</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Nosotros</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Catalogo de animales</a>
    <a class="py-2 d-none d-md-inline-block" href="ingresar.htm">Ingresar</a>
    <a class="py-2 d-none d-md-inline-block" href="registro.php">Registro</a>
  </nav>
</header>

	
	
	

<div class="form-ingresar text-center">
    <main class="form-signin w-100 m-auto">
	
		
	<?php
	if($_GET['ingresar'])
	{?>
		<div class="divIngresar"><p>INGRESA PARA PODER ACCEDER A LOS PERFILES</p></div>
	<?php
	}
	?>
		
		<?php
	if($_GET['salir'])
	{?>
		<div class="divIngresar"><p>Vuelve cuando quieras! Tu mascota necesita tu amor <3 </p></div>
	<?php
	}
	?>
		
	<?php
		if($_GET['registro'])
	{?>
		<div class="divIngresar"><p>Bienvenido a Animal Care ^^ Ingresa a tu cuenta para vincular tu primer dispositivo (:</p></div>
	<?php
	}
	?>
	
		
    <form id="form_ingresar">
        <img class="mb-4" src="/html/img/iguana2.jpeg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="email" name = "email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">© 2017–2022</p>
    </form>
    </main>


</div>

<?php
	include_once('footer.php');
?>