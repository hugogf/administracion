<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cursa_controller.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/cursa_model.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/datos_usuarios_controller.php");

	if(isset($_POST['rut']))
	{
		$alumno = buscar_usuario($_POST['rut']);
		$datos_alumno = buscar_datos_usuario($_POST['rut']);
		$plan = buscar_plan($datos_alumno['plan_id']);
		$rut = $_POST['rut'];
	}else if(isset($_GET['rut'])){
		$alumno = buscar_usuario($_GET['rut']);
		$datos_alumno = buscar_datos_usuario($_GET['rut']);
		$plan = buscar_plan($datos_alumno['plan_id']);
		$rut = $_GET['rut'];
	}
?>

<div class="row editar_alumno">
	<div class="col-md-8 col-md-offset-2 col-xs-12 busqueda">
	<h3>Busqueda de alumnos</h3>
		<form action="editar_alumno.php" class="form" method="POST">
			<div class="campo-formulario">
				<label>Rut del alumno:</label>
			<?php if(isset($_POST['rut'])){ ?>
				<input type="text" name="rut" value="<?php echo $_POST['rut']; ?>">
			<?php }else{ ?>
				<input type="text" name="rut">
			<?php } ?>
			</div>
			<input type="submit" class="btn btn-warning" name="boton" value="Buscar">
		</form>
	</div>
	<?php if (isset($_POST['rut']) || isset($_GET['rut'])){ ?>
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<form action="../controller/usuarios_controller.php" method="POST" class="formulario_editar_alumno">
				<input type="hidden" name="rut" value="<?php echo $rut; ?>">
				<div class="col-md-8 col1">
					<h3>Datos del alumno</h3>
					<div class="campo-formulario">
						<label>Nombre: </label>
						<input type="text" name="nombre" value="<?php echo $alumno['nombre']; ?>">
					</div>
					<div class="campo-formulario">
						<label>Apellidos: </label>
						<input type="text" name="apellidos" value="<?php echo $alumno['apellidos']; ?>">
					</div>
					<div class="campo-formulario">
						<label>Mail: </label>
						<input type="text" name="mail" value="<?php echo $alumno['mail']; ?>">
					</div>
					<div class="campo-formulario">
						<label>Telefono: </label>
						<input type="text" name="telefono" value="<?php echo $alumno['telefono']; ?>">
					</div>
					<div class="campo-formulario">
						<label>Celular: </label>
						<input type="text" name="celular" value="<?php echo $alumno['celular']; ?>">
					</div>
					<div class="campo-formulario">
						<label>Dirección: </label>
						<input type="text" name="direccion" value="<?php echo $alumno['direccion']; ?>">
					</div>
					<div class="campo-formulario">
						<label>Plan: </label>
						<input type="text" name="plan" disabled value="<?php echo $plan['nombre']; ?>">
					</div>
					<div class="campo-formulario">
						<label>Jornada: </label>
						<input type="text" name="jornada" value="<?php echo $datos_alumno['jornada']; ?>">
					</div>
					<input type="submit" class="btn btn-warning" name="boton" value="Grabar">
				</div>
				<div class="col-md-4 col2">
					<h3>Grupos</h3>
					<p>El usuario se encuentra registrado en los siguientes cursos:</p>
					<?php $cursos = listar_cursos($rut);
						  $cont = 0;
						  while($curso = $cursos->fetch_assoc()){ ?>
						  	<div class="campo-formulario">
								<label><?php echo $curso['nombre']; ?> </label>
								<select name="<?php $cont = $cont + 1;echo $cont; ?>" >
									<option></option>
									<?php $grupos = new Cursa();
										  $grupos = $grupos->listar_especifico($curso['categoria_id'], $datos_alumno['plan_id']);
										  while($grupo = $grupos->fetch_assoc()){ ?>
										  	<?php if($curso['grupo'] == $grupo['grupo']){  ?>
											<option value="<?php echo $grupo['id']; ?>" selected="selected"><?php echo $grupo['grupo'];  ?></option>
											<?php } else { ?>
											<option value="<?php echo $grupo['id']; ?>"><?php echo $grupo['grupo'];  ?></option>
										  <?php } }?>
								</select>
							</div>
					<?php } ?>
				</div>
			</form>
			<?php } ?>
		</div>
</div>
<script src="../js/secretaria.js"></script>