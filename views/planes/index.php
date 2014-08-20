<div class="row">
	<div class="col-md-3">
		<div class="row" style="background: none !important;">

			<form action="" method="POST" class="form">
					<h4>Crear plan</h4>
					<div class="input-group">
						<span class="input-group-addon input_new">Nombre del Plan:</span>
						<input type="text" class="form-control" required="required" name="nombre">
					</div>
					<div class="input-group">
						<span class="input-group-addon input_new">Valor Total:</span>
						<input type="text" class="form-control" required="required" name="valor">
					</div>
					<div class="input-group">
						<span class="input-group-addon input_new">Inicio de Clases:</span>
						<input type="text" class="form-control fecha" required="required" name="inicio_clases">
					</div>
					<div class="input-group">
						<span class="input-group-addon input_new">Descripción: </span>
						<input type="text" class="form-control" required="required" name="descripcion">
					</div>	
					<div class="input-group">
						<span class="input-group-addon input_new">Jornada: </span>
						<input type="text" class="form-control" required="required" name="jornada">
					</div>			
					<input type="submit" class="btn btn-warning" value="Crear">
					<input type="hidden" name="accion" value="save">

			</form>
		</div>

	</div>

	<div class="col-md-9">
		<h3>Planes de estudios creados</h3>

		<?php foreach($planes as $plan){ ?>
			<div class="col-xs-12 col-md-4">
				<div class="thumbnail">
					<div class="caption">
						<h3><?php echo $plan['nombre']; ?><br> <small>$<?php echo $plan['valor']; ?> Anual</small></h3>
						<p class="p"><?php echo $plan['descripcion']; ?></p>
					</div>
					<p class="link-thumb"><?php link_to('planes', 'delete', 'Eliminar', $plan['id'], 'btn') ?><a href="#" class="btn editar" data-valor="<?php echo $plan['id']; ?>">Editar</a></p>
				</div>
			</div>
			<div class="form-plan" title="Editar <?php echo $plan['nombre']; ?>" id="<?php echo $plan['id']; ?>">
				<form action="" method="POST">
					<label for="">Nombre Plan</label>
					<input type="text" name="nombre" value="<?php echo $plan['nombre'] ?> ">
					<label for="">Valor Total</label>
					<input type="text" name="valor"value="<?php echo $plan['valor'] ?> ">
					<label for="">Inicio clases</label>
					<input type="text" name="fecha_inicio" class="fecha" value="<?php echo $plan['fecha_inicio'] ?> ">
					<label for="">Descripcion</label>
					<input type="text" name="descripcion" value="<?php echo $plan['descripcion'] ?> ">
					<label for="">Jornada</label>
					<input type="text" name="jornada"value="<?php echo $plan['jornada'] ?> ">
					<input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
					<input type="hidden" name="accion" value="update">
					<input type="submit" value="Editar">
				</form>	
			</div>
		<?php } ?>
	</div>
</div>
