<?php  session_start();
	
	if(!isset($_SESSION['user']))
		header('location: ../index.php');
	
 	if	($_SESSION['rol'] == '1')
 		header('location: ../administrador');
	else if	($_SESSION['rol'] == '2')
		header('location: ../secretaria');
 	else if	($_SESSION['rol'] == '3')
		header('location: ../alumno');
	else if	($_SESSION['rol'] == '4')
		header('location: ../apoderado');

 ?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<meta name="viewport" content="width=device-width" />
	<script src="../js/jquery.min.js"></script>
	<script src="../js/rut.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/alumno.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500' rel='stylesheet' type='text/css'>	
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<title>Administración Preuniversitario Tarapacá</title>
</head>
<body>
	<div class="row">
		<div class="navbar navbar-default navbar-static-top header">
			<div class="navbar-header">
				<img src="../image/logo-secretaria.png" class="logo">
			</div>

			<p class="nvar-text pull-right sesion"><?php echo $_SESSION['user']; ?> <a href="../index.php" class="btn btn-warning btn-small">Cerrar</a></p>

			<nav class="collapse navbar-collapse">
				<ul class="nav nav-pills">
					<li><a href="#">Configuracion</a></li>
				</ul>
			</nav>
		</div>
		<div class="col-xs-12 listado">
				<h3>Noticias</h3>
				<div class="row">
						
				<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/noticias_controller.php");
					$noticias = listar_noticias();
					while($noticia = $noticias->fetch_assoc()){ ?>
						<div class="col-md-2 list-noticias">
							<h3><?php echo $noticia['Titulo']; ?></h3>
							<h4><?php echo $noticia['Fecha_creacion']; ?></h4>
							<a href="#" class="mostrar-noticia" data-value="noticia_<?php echo $noticia['id']; ?>"> Ver </a>
							<div class="noticia-entera" id="noticia_<?php echo $noticia['id']; ?>">
								<h3><?php echo $noticia['Titulo']; ?></h3>
								<p><?php echo $noticia['Contenido']; ?></p>
								<h5 class="pull-right"><?php echo $noticia['Fecha_creacion']; ?></h5>
							</div>
						</div>
					<?php } ?>
				</div>	
		</div>
	</div>
