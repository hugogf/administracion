<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php"); 
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/datos_usuarios_controller.php"); 
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php"); ?>
<div class="row">
		<nav class="subnav pull-right">
			<ul class="nav nav-pills">
				<li><a href="new_alumno.php" class="btn btn-warning">Matricular Alumno</a></li>
				<li><a href="morosos.php" class="btn btn-warning">Ver Morosos</a></li>
			</ul>			
		</nav>
</div>
<div class="row">
		<div class="col-xs-3">
		<h2><small>Busqueda de Alumnos</small></h2>
			<form action="alumno.php" method="POST">
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
					<td><input type="text" class="form-control rut" name="rut"></td>
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
		
		<div class="col-xs-9 pull-right">
			<h2><small>Lista de Alumnos</small></h2>
			<table class="table" id="tabla-alumnos">
				<tr class="active">
					<th></th>
					<th>Nombre</th>
					<th>Rut</th>
					<th>Plan</th>
				</tr>
				
				<?php
							
					$result = listar_usuarios("3");

					while($alumno = $result -> fetch_assoc())
					{
						$datos_alumno = buscar_datos_usuario($alumno['rut']); 
						$plan = buscar_plan($datos_alumno['plan_id']);  ?>
						<tr>
							<td><a href="<?php echo 'pago_alumno.php?rut='.$alumno['rut'] ?>"/>Ver</a></td>
							<td><?php echo $alumno['nombre']." ".$alumno['apellidos'];  ?></td>
							<td><?php echo $alumno['rut'];  ?></td>
							<td><?php echo $plan['nombre'];  ?></td>
						</tr>
				<?php }

				?>

			</table>
		</div>
	</div>
	</div>
</body>
</html>