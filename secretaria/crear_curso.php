<?php 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/alumno_function_controller.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cursos_controller.php");
?>

<div class="agregar"></div>

<div class="row" id="crear-curso">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		<form action="#">
			<div class="campo-formulario">
				<span>Plan:</span>
				<select name="plan">
					<option></option>
					<?php $planes = listar_planes();
					while($plan = $planes->fetch_assoc()){ ?>
						<option value="<?php echo $plan['id']; ?>"><?php echo $plan['nombre']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="campo-formulario">
				<span>Curso:</span>
				<select name="curso">
					<option></option>
					<?php 
					$cursos = listar_cursos();
					while($curso = $cursos->fetch_assoc()){ ?>
						<option value="<?php echo $curso['id']; ?>"><?php echo $curso['nombre']." ( Grupo ".$curso['grupo']." )"; ?></option>	
					<?php } ?>
				</select>
			</div>
			<div class="campo-formulario">
				<span>Rut Alumno</span>
				<input type="text" name="alumno_agregar" placeholder="ejemplo: 171152488" class='rut'>
				<input type="submit" class="btn btn-warning" name="boton" value="Agregar" id="agregar_alumno">
			</div>
			<div class="msg-warning"></div>
		</form>
	</div>
	<div class="contenido col-md-8 col-xs-12 col-md-offset-2"></div>
</div>
<script src="js/crear_curso.js"></script>