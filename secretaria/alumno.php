<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php"); 
    require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/datos_usuarios_controller.php"); 
    require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php"); ?>
	<?php
		
		$orden = false;
		$page = 0;

		if(isset($_GET['orden']))
			$orden = $_GET['orden'];
	
		if(isset($_GET['page']))
			$page = $_GET['page'];
		else
			$page = 0;
	?>
	<div class="row">
		<nav class="subnav pull-right">
			<ul class="nav nav-pills">
				<li><a href="new_alumno.php" class="btn btn-warning">Matricular Alumno</a></li>
				<li><a href="renuncias.php" class="btn btn-warning">Ver Renuncias</a></li>
				<li><a href="morosos.php" class="btn btn-warning">Ver Morosos</a></li>
			</ul>			
		</nav>
	</div>

	<div class="row">
			<div class="col-xs-3">
			<h2><small>Busqueda de Alumnos</small></h2>
				<form action="alumno.php" method="GET">
					<input type="hidden" name="busqueda" value="on">
					<table class="table" id="buscador">
						<tr>
							<td>Nombre:</td>
							<td><input type="text" class="form-control" name="nombre"></td>
						</tr>
						<tr>
							<td>Apellidos:</td>
							<td><input type="text" class="form-control" name="apellidos"></td>
						</tr>
						<tr>
							<td>Rut:</td>
							<td><input type="text" class="form-control" name="rut"></td>
						</tr>
						<tr>
							<td>Plan: </td>
							<td>
								<select class="form-control" name="plan">
								    <option></option>
									<?php $planes = listar_planes(); 
									while($plan = $planes->fetch_assoc()){ ?>
									<option value="<?php echo $plan['id'] ?>"><?php echo $plan['nombre']; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" class="btn" value="Buscar" name="buscar"></td>
						</tr>
					</table>
				</form>
			</div>
			<?php
				
				$result = listar_usuarios(3, $_GET, $orden);

				$result = json_decode($result);
				$registros = count($result); 
				$paginas = $registros/25;
			?>
			
			<div class="col-xs-9 pull-right">
				<h2><small>Lista de Alumnos</small></h2>
				<div class="segmentacion pull-right" style="margin: 20px;">
					<?php if($page == 0 ) {?>
						<a href="#" disabled class="btn btn-warning">Anterior</a>
					<?php } else {?>
						<a href="?page=<?php echo $page -1; ?>&orden=<?php echo $orden; ?>" class="btn btn-warning">Anterior</a>

					<?php }
						for ($i=0; $i < $paginas ; $i++) { ?> 
							<a href="?page=<?php echo $i; ?>&orden=<?php echo $orden; ?>" class="btn btn-default"><?php echo $i+1; ?></a>
					<?php } ?>
					<a href="?page=<?php echo $page + 1; ?>&orden=<?php echo $orden; ?>" class="btn btn-warning">Siguiente</a>
				</div>

				<table class="table table-hover" id="tabla-alumnos">
					<tr class="active">
						<th></th>
						<th><a href="?orden=nombres&page=<?php echo $page; ?>">Nombre</a></th>
						<th><a href="?orden=apellidos&page=<?php echo $page; ?>">Apellido</a></th>
						<th><a href="?orden=rut&page=<?php echo $page; ?>">Rut</rut></th>
						<th>Plan</th>
					</tr>
				
					<?php	
						for ($i=$page * 25; $i < ($page + 1) * 25 && $i < $registros; $i++) { ?>
						<tr>
							<td><a href="pago_alumno.php?rut=<?php echo $result[$i]->rut; ?>"/>Ver</a>
							/ <a href="editar_alumno.php?rut=<?php echo $result[$i]->rut; ?>"/>Editar</a></td>
							<td><?php echo $result[$i]->nombre;  ?></td>
							<td><?php echo $result[$i]->apellidos;  ?></td>
							<td><?php echo $result[$i]->rut;  ?></td>
							<td><?php echo $result[$i]->plan_id;  ?></td>
						</tr>
					<?php 
						}
					?>

				</table>
				<div class="segmentacion pull-right" style="margin: 20px;">
					<?php if($page == 0 ) {?>
						<a href="#" disabled class="btn btn-warning">Anterior</a>
					<?php } else {?>
						<a href="?page=<?php echo $page -1; ?>&orden=<?php echo $orden; ?>" class="btn btn-warning">Anterior</a>

					<?php }
						for ($i=0; $i < $paginas ; $i++) { ?> 
							<a href="?page=<?php echo $i; ?>&orden=<?php echo $orden; ?>" class="btn btn-default"><?php echo $i+1; ?></a>
					<?php } ?>
					<a href="?page=<?php echo $page + 1; ?>&orden=<?php echo $orden; ?>" class="btn btn-warning">Siguiente</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>