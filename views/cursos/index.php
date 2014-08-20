<div class="row">
	<div class="col-md-3">
		<div class="row" style="background: none !important;">
	    
	    <h3>Formulario para nuevo curso</h3>
		
		<form action="" class="form" method="POST">
			<div class="input-group">
				<label class="input-group-addon input_new">Categoria:</label>
				<select class="form-control" name="categoria_id">
					<option></option>
					<?php foreach ($categorias as $categoria) { ?>
							<option value="<?php echo $categoria['id']; ?>">
								<?php echo $categoria['nombre']; ?>
							</option>
					<?php } ?>
				</select>
			</div>
			<div class="input-group">
				<label class="input-group-addon input_new">Profesor:</label>
				<select class="form-control" required="required" name="profesor_id">
					<option></option>
					<?php foreach($profesores as $profesor){ ?>
							<option value="<?php echo $profesor['rut']; ?>">
								<?php echo $profesor['nombre']." ".$profesor['apellidos']; ?>
							</option>
					<?php } ?>

				</select>
			</div>
			<div class="input-group">
				<label class="input-group-addon input_new">Inicio de Clases:</label>
				<input type="date" class="form-control fecha" required="required" name="inicio_clases">
			</div>
			<div class="input-group">
				<label class="input-group-addon input_new">Grupo:</label>
				<input type="text" class="form-control" name="grupo">
			</div>
			<div class="input-group">
				<label class="input-group-addon input_new">Plan academico</label>
				<select class="form-control" name="planes_id" >
					<option></option>
					<?php foreach($planes as $plan){ ?>
						<option value="<?php echo $plan['id']; ?>"> <?php echo $plan['nombre']; ?></option>
					<?php } ?>
				</select>
			</div>
			<input type="submit" class="btn btn-warning" value="Crear">
			<input type="hidden" name="accion" value="save">
		</form>
	</div>
	</div>

	<div class="col-xs-12 col-md-8">
		<h3>Listado de cursos creados</h3>
		<table class="table table-bordered">
			<thead>
				<th>ID</th>
				<th>Nombre</th>
				<th>Profesor</th>
				<th>Grupo</th>
				<th>Plan Académico</th>
				<th></th>
				<th></th>
			</thead>
			<?php foreach($cursos as $curso){
					$where['rut'] = $curso['profesor_id'];
					$profesor = $this->select('usuarios', $where)[0];?>
			<tr>
				<td><?php echo $curso['curso_id']; ?></td>
				<td><?php echo $curso['nombre']; ?></td>
				<td><?php echo $profesor['nombre']." ".$profesor['apellidos']; ?></td>
				<td><?php echo $curso['grupo']; ?></td>
				<td><?php echo $curso['planes_id']; ?></td>
				<td><?php link_to('cursos', 'edit', 'Editar', $curso['curso_id']); ?></td>
				<td><?php link_to('cursos', 'delete', 'Eliminar', $curso['curso_id']); ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>