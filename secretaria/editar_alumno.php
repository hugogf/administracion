<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cursa_controller.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/cursa_model.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/datos_usuarios_controller.php");
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cuenta_corriente_controller.php");

 if(isset($_GET['rut'])){
		$alumno = buscar_usuario($_GET['rut']);
		$datos_alumno = buscar_datos_usuario($_GET['rut']);
		$plan = buscar_plan($datos_alumno['plan_id']);
		$rut = $_GET['rut'];
		$cuenta = mostrar_cuotas($datos_alumno['id']);
		// var_dump($cuenta);
	} else {
		echo '<script> Window.location = "secretaria/" </script>';
	}
?>
sadsefdewd
<div class="row editar_alumno">
	<?php if ( isset($_GET['rut'])){ ?>
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
				</div>
				<div class="col-md-12 col1">
					
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
					<input type="submit" class="btn btn-warning" name="boton" value="Grabar">
				</div>
				<h3>Cuotas y pagos</h3>
				<table class="table table-hover">
					<tr>
						<th>Cuota</th>
						<th>Valor Neto</th>
						<th>Descuento</th>
						<th>Valor con Descuento</th>
						<th>Total cancelado</th>
						<th></th>
					</tr>
				<?php foreach ($cuenta as $cuota) { ?>
					
					<tr>
						<td><?php echo $cuota['numero_cuota']; ?></td>
						<td><?php echo $cuota['monto_total']; ?></td>
						<td><?php echo $cuota['descuento']; ?></td>
						<td><?php echo $cuota['monto_descuento']; ?></td>
						<td><?php echo $cuota['MONTO_CANCELADO']; ?></td>
						<td>Columna 6</td>
					</tr>
				<?php } ?>
					
				</table>
			</form>
			<?php } ?>
		</div>
</div>
<script src="../js/secretaria.js"></script>