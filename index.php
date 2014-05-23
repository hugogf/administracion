<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css">

	<script src="js/jquery.min.js"></script>
	<script src="js/rut.js"></script>
	<title>Document</title>
</head>
<body>
<div class="row">
	<div class="col-xs-12 login">
		<div class="contenido">
			<h4>Intranet PREUT</h4>
			<p>Bienvenido al portal interno del preuniversitario, actualmente se encuentra en mantención pero dentro de poco podras acceder a la intranet pensada en tí. En este portal podras ver:</p>
			<ul>
				<li>Tu rendimiento Academico</li>
				<li>Descargar Material de estudios</li>
				<li>Tus puntajes de ensayos</li>
				<li>Enviar mensajes entre profesores y compañeros</li>
				<li>y mas...</li>
			</ul>
		</div>
		<div class="formulario pull-right">
			<form action="controller/login_controller.php" method="POST">
			<div class="bloque-login">
				<label>Usuario:</label>
				<input type="text" class="rut" name="usuario" required="required">
			</div>
			<div class="bloque-login">	
				<label>Clave: </label>
				<input type="password" name="password" requeired="required">
			</div>
			<input type="submit" class="btn btn-default pull-right" value="Ingresar" name="boton">
			</form>
		<div class="msg">
				<?php 
					if(isset($_SESSION['msg'])){
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}
					session_destroy(); ?>
		</div>
		</div>
	</div>
</div>
</body>
</html>