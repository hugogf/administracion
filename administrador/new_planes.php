<div class="row" style="background: none !important;">

	<form action="../controller/planes_controller.php" method="POST" class="form">
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
			<input type="submit" name="boton" class="btn btn-warning" value="Crear">

	</form>
</div>
