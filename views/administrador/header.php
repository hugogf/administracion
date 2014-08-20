<div class="row">
	<div class="navbar navbar-default navbar-static-top header">
		
		<div class="navbar-header">
			<img src="image/logo_administrador.png" class="logo">
		</div>

		<p class="nvar-text pull-right sesion"><?php echo $_SESSION['user'] ?><a href="../" class="btn btn-warning btn-small">Cerrar</a></p>

		<nav class="collapse navbar-collapse">
			<ul class="nav nav-pills">
				<li><?php link_to('administrador', 'index', 'Inicio'); ?></li>
				<li><?php link_to('cursos', 'index', 'Cursos'); ?></li>
				<li><?php link_to('planes', 'index', 'Planes'); ?></li>
				<li><a href="#">Informes</a></li>
				<li><?php link_to('usuarios', 'index', 'Usuarios'); ?></li>
				<li><a href="configuracion.php">Configuracion</a></li>
			</ul>
		</nav>
	</div>
	<!-- <div class="col-xs-12 listado">
		<h3>Noticias</h3>

		<div class="row">
			<?php require_once("controller/noticias_controller.php");
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
					
	</div> -->
</div>