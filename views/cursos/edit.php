<form action="" class="form" method="POST">
	<div class="campo-formulario">
		<label>Categoria:</label>
		<select name="categoria_id">
			<option></option>
			<?php foreach ($categorias as $categoria) { 

				if($curso['categoria_id']==$categoria['id'])
					echo '<option selected value="'.$categoria['id'].'">';
				else
					echo '<option value="'.$categoria['id'].'">';
					echo $categoria['nombre'];
					echo '</option>'; }?>
		</select>
	</div>
	<div class="campo-formulario">
		<label>Profesor:</label>
		<select required="required" name="profesor_id">
			<option></option>
			<?php foreach ($profesores as $profesor) { 

				if($curso['profesor_id']==$profesor['rut'])
					echo '<option selected value="'.$profesor['rut'].'">';
				else
					echo '<option value="'.$profesor['rut'].'">';
					echo $profesor['nombre']." ".$profesor['apellidos'];
					echo '</option>'; }?>
		</select>
	</div>

	<div class="campo-formulario">
		<label>Inicio de Clases:</label>
		<input type="date" class="form-control fecha" required="required" name="inicio_clases" value="<?php echo $curso['inicio_clases']; ?>">
	</div>
	<div class="campo-formulario">
		<label>Grupo:</label>
		<input type="text" class="form-control" name="grupo" value="<?php echo $curso['grupo']; ?>">
	</div>
	<div class="campo-formulario">
		<label>Plan academico</label>	
		<select name="planes_id" >
			<option></option>
			<?php foreach ($planes as $plan) { 

				if($curso['planes_id']==$plan['id'])
					echo '<option selected value="'.$plan['id'].'">';
				else
					echo '<option value="'.$plan['id'].'">';
					echo $plan['nombre'];
					echo '</option>'; }?>
		</select>
	</div>
	<input type="submit" class="btn btn-warning" value="Guardar Cambios">
	<input type="hidden" name="id" value="<?php echo $curso['id']; ?>">
	<input type="hidden" name="accion" value="update">
</form>