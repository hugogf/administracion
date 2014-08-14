<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/administrador/header.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php"); ?>
	<div class="row">
		<div class="pull-right">
			<a href="#" class="btn btn-warning btn-new">Crear Usuarios</a>
		</div>
	</div>
	<!-- Formulario para un nuevo usuario -->
	<div class="row div-new-usuario">
		<div class="col-xs-12 col-md-4 col-md-offset-4">
				<h3>Formulario para registro de nuevo usuario</h3>
					<form action="../controller/usuarios_controller.php" method="POST" id="new">
						<div class="input-group">
							<span class="input-group-addon">Rol(*):</span>
							<select class="form-control" required="required" name="rol_id" >
								<option></option>
								<option value="1">Administrador</option>
								<option value="2">Secretaria</option>
								<option value="5">Profesor</option>
							</select>
						</div>
						<div class="input-group">
							<span class="input-group-addon">Nombre(*):</span>
							<input type="text" class="form-control" required="required" name="nombre" >
						</div>
						<div class="input-group">
							<span class="input-group-addon">Apellidios(*):</span>
							<input type="text" class="form-control" required="required" name="apellidos">
						</div>
						<div class="input-group">
							<span class="input-group-addon">Rut(*):</span>
							<input type="text" class="form-control rut" required="required" name="rut" placeholder="ej: 17115248-8">
						</div>
						<div class="input-group">
							<span class="input-group-addon">Mail(*):</span>
							<input type="text" class="form-control" required="required" name="mail">
						</div>
						<div class="input-group">
							<span class="input-group-addon">Telefono(*):</span>
							<input type="text" class="form-control" required="required" name="telefono">
						</div>
						<div class="input-group">
							<span class="input-group-addon">Celular(*):</span>
							<input type="text" class="form-control" required="required" name="celular">
						</div>
						<input type="hidden" name="fecha" value="<?php echo date('Y-m-d'); ?>">
						<input type="hidden" name="direccion" value="Sin registro">
						<input type="submit" name="boton" value="Registrar" name="boton" class="btn btn-warning">
						<a href="#" id="cerrar-new" class="btn btn-default">Cerrar</a>
					</form>
				</div>
			</div>
			<!-- Fin del formulario -->
			<div class="row">
				<div class="col-md-2 col-xs-12">
					<h3>Roles</h3>
					<h4> 1 <small>Administrador</small></h4>
					<h4> 2 <small>Secretaria</small></h4>
					<h4> 3 <small>Alumno</small></h4>
					<h4> 4 <small>Apoderado</small></h4>
					<h4> 5 <small>Profesor</small></h4>
				</div>
				<div class="col-md-10 col-xs-12">
					
			<h3>Lista de usuarios registrados</h3>
			
			<!-- Listado de usuarios -->
			<table class="table">
				<tr>
					<th>Usuario</th>
					<th>Rol</th>
					<th>Fecha Ingreso</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
				<?php 
					$usuarios = listar_usuarios('All', '1', '1');
					$usuarios = json_decode($usuarios);
					$cant_usuarios = count($usuarios);

				for ($i=0; $i < $cant_usuarios ; $i++) { ?>
				<tr>
					<td><?php echo $usuarios[$i]->nombre; ?></td>
					<td><?php echo $usuarios[$i]->rol_id; ?></td>
					<td><?php echo $usuarios[$i]->fecha; ?></td>
					<td><a href="#" class="editar-usr" data-valor="<?php echo $usuarios[$i]->rut; ?>" data-rol="<?php echo $usuarios[$i]->rol_id; ?>">Editar</a></td>
					<td><a href="../controller/usuarios_controller.php?eliminar=on&rut=<?php echo $usuarios[$i]->rut;  ?>">Eliminar</a></td>
				</tr>
				
				<div class="form-plan form-edit-usr" title="<?php echo $usuarios[$i]->nombre.' '.$usuarios[$i]->apellidos.' ( '.$usuarios[$i]->rut. ' )'; ?>" id="<?php echo $usuarios[$i]->rut; ?>">
					<form action="../controller/usuarios_controller.php" method="POST">
						<div class="campo-form">
						<label>Rol:</label>
						<select required="required" name="rol" contenteditable="false">
							<option></option>
							<option value="1">Administrador</option>
							<option value="2">Secretaria</option>
							<option value="5">Profesor</option>
						</select>
						</div>
						<div class="campo-form">
							<label>Nombre:</label>
							<input type="text" name="nombre" value="<?php echo $usuarios[$i]->nombre; ?>">
						</div>
						<div class="campo-form">
							<label>Apellidos:</label>
							<input type="text" name="apellidos" value="<?php echo $usuarios[$i]->apellidos; ?>">
						</div>
						<div class="campo-form">
							<label>Rut:</label>
							<input type="text" name="rut" contenteditable="false" readonly="readonly" value="<?php echo $usuarios[$i]->rut; ?>">
						</div>
						<div class="campo-form">
							<label>Clave</label>
							<input type="text" disabled="disabled" name="clave1">
						</div>
						<div class="campo-form">
							<label>Repita Clave:</label>
							<input type="text" disabled="disabled" name="clave2">
						</div>
						<div class="campo-form">
							<label>Mail:</label>
							<input type="text" name="mail" value="<?php echo $usuarios[$i]->mail; ?>">
						</div>
						<div class="campo-form">
							<label>Telefono:</label>
							<input type="text" name="telefono" value="<?php echo $usuarios[$i]->telefono; ?>">
						</div>
						<div class="campo-form">
							<label>Celular:</label>
							<input type="text" name="celular" value="<?php echo $usuarios[$i]->celular; ?>">
						</div>
						<input type="submit" name="boton" value="Grabar">
					</form>
				</div>
				<?php } ?>
			</table>
		</div>
	</div>
<script src="../js/administrador.js"></script>