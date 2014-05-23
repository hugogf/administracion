<?php  session_start();
	
	if(!isset($_SESSION['user']))
		header('location: ../index.php');
	
 	if	($_SESSION['rol'] == '1')
 		header('location: ../administrador');
 	else if	($_SESSION['rol'] == '3')
		header('location: ../alumno');
	else if	($_SESSION['rol'] == '4')
		header('location: ../apoderado');
	else if	($_SESSION['rol'] == '5')
		header('location: ../profesor');

 ?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="../css/estilos.css" />
	<link rel="stylesheet" href="../css/jquery-ui.min.css">
	<meta name="viewport" content="width=device-width" />
	<script src="../js/jquery.min.js"></script>
	<script src="../js/rut.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/alumno.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500' rel='stylesheet' type='text/css'>	
    <script src="../js/jquery-ui.min.js"></script>
      <script>
  $(function() {
    $(".fecha").datepicker();
  });
  $(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});
  </script>
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
					<li><a href="index.php">Administracion</a></li>
					<li><a href="alumno.php">Financiera</a></li>
 					<li><a href="noticias.php">Noticias</a></li>
					<li><a href="academico.php">Academico</a></li>
					<li><a href="#">Mensajes</a></li>
					<li><a href="configuracion.php">Configuracion</a></li>
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
	