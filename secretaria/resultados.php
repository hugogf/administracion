<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/examenes_controller.php"); ?>

<div class="row resultados">
	<div class="col-md-3 col-xs-12 row">
		
		<h3>Crear prueba</h3>
		
		<form action="#">
			<div class="campo-formulario col-xs-12">
				<label>Nombre del examen</label>
				<input type="text" required name="nuevo_nombre_examen">
			</div>
			<div class="campo-formulario col-xs-12">
				<label>Fecha del Examen</label>
				<input type="date" required name="nuevo_fecha_examen" class="fecha">
			</div>
			<div class="campo-formulario col-xs-12">
				<label>Plan:</label>
				<select name="nuevo_plan_examen" required>
					<option></option>
					<?php $planes = listar_planes();
					while($plan = $planes->fetch_assoc()){ ?>
						<option value="<?php echo $plan['id']; ?>"><?php echo $plan['nombre']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="campo-formulario col-xs-12">
				<label>Curso</label>
				<select name="nuevo_curso_examen" required>
					<option></option>
				</select>
			</div>
			<div class="campo-formulario col-xs-12">
				<input type="submit" class="btn btn-warning" name="btn-examen" value="crear examen">
			</div>
		</form>
		<div class="contenido"></div>
		
		<h4>Lista de examenes</h4>
		<div class="lista-examenes"></div>
		
	</div>
	
	<div class="col-md-8">
		<h3>Ingreso de puntajes</h3>
		<form action="#" class="form">
			<div class="campo-formulario col-md-5">
				<label>Seleccione plan del curso:</label>
				<select name="plan">
					<option></option>
					<?php $planes = listar_planes();
					while($plan = $planes->fetch_assoc()){ ?>
						<option value="<?php echo $plan['id']; ?>"><?php echo $plan['nombre']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="campo-formulario col-md-6">
				<label>Seleccione curso:</label>
				<select name="curso">
					<option></option>
				</select>
			</div>
		</form>
		<div id="table" class="col-xs-12"></div>
	</div>

</div>


<script src="../js/resultados.js"></script>