<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php"); ?>

<h3>Formulario para nuevo curso</h3>
<form action="../controller/cursos_controller.php" class="form" method="POST">
	<div class="campo-formulario">
		<label>Categoria:</label>
		<select name="categoria">
			<option></option>
			<?php $categorias = listar_categorias();
				while($categoria = $categorias -> fetch_assoc()){ ?>
					<option value="<?php echo $categoria['id']; ?>">
						<?php echo $categoria['nombre']; ?>
					</option>
			<?php } ?>
		</select>
	</div>
	<div class="campo-formulario">
		<label>Profesor:</label>
		<select required="required" name="profesor">
			<option></option>
			<?php $profesores = listar_profesores();
				 while($profesor = $profesores->fetch_assoc()){ ?>
					<option value="<?php echo $profesor['rut']; ?>">
						<?php echo $profesor['nombre']." ".$profesor['apellidos']; ?>
					</option>
			<?php } ?>

		</select>
	</div>
	<div class="campo-formulario">
		<label>Inicio de Clases:</label>
		<input type="date" class="form-control fecha" required="required" name="inicio_clases">
	</div>
	<div class="campo-formulario">
		<label>Grupo:</label>
		<input type="text" class="form-control" required="required" name="grupo">
	</div>
	<div class="campo-formulario">
		<label>Plan academico</label>
		<select name="plan" >
			<option></option>
			<?php $planes = listar_planes();
			while($plan = $planes->fetch_assoc()){ ?>
				<option value="<?php echo $plan['id']; ?>"> <?php echo $plan['nombre']; ?></option>
			<?php } ?>
		</select>
	</div>
	<input type="submit" name="boton" class="btn btn-warning" value="Crear">
</form>