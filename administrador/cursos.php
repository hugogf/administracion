<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/administrador/header.php"); 
      require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cursos_controller.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/categorias_controller.php"); 
?>
	<div class="row">
		<div class="col-md-3 col-xs-12 div-new">
		    <?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/administrador/new_curso.php"); ?>
		</div>
		<div class="col-xs-12 col-md-8">
			<h3>Listado de cursos creados</h3>
			<table class="table">
				<tr>
					<th>Nombre</th>
					<th>Profesor</th>
					<th>Grupo</th>
					<th>Plan Académico</th>
					<th></th>
					<th></th>
				</tr>
				<?php $cursos = listar_cursos();
				if($cursos)
				 while($curso = $cursos->fetch_assoc()){ ?>
				<tr>
					<td><?php echo $curso['nombre']; ?></td>
					<td><?php echo $curso['nombre_profesor']." ".$curso['apellidos_profesor']; ?></td>
					<td><?php echo $curso['grupo']; ?></td>
					<td><?php echo $curso['plan']; ?></td>
					<td><a href="#" class="editar-cursos" data-categoria="<?php echo $curso['id_categoria'];?>" data-profesor="<?php echo $curso['id_profesor'];?>" data-plan="<?php echo $curso['id_plan'];?>" data-valor="<?php echo $curso['id']; ?>">Editar</a></td>
					<td><a href="../controller/cursos_controller.php?delet=on&id=<?php echo $curso['id']; ?>">Eliminar</a></td>
				</tr>
				<div class="form-plan" id="<?php echo $curso['id']; ?>" title="Editando <?php echo $curso['nombre']; ?> Grupo <?php echo $curso['grupo']; ?> del plan<?php echo $curso['plan']; ?>">
					<form action="../controller/cursos_controller.php" method="POST" class="form">
						<label for="">Categoria:</label>
						<select name="categoria_editar" disabled="disabled">
							<option></option>
							<?php $categorias = listar_categorias();
							while($categoria = $categorias -> fetch_assoc()){
								?><option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
							<?php	} ?>
						</select>
						<label for="">Profesor:</label>
						<select class="form-control" required="required" name="profesor_editar">
							<option></option>
							<?php $profesores = listar_profesores();
							var_dump($profesores);
							while($profesor = $profesores->fetch_assoc()){?>
									<option value="<?php echo $profesor['rut']; ?>">
										<?php echo $profesor['nombre']." ".$profesor['apellidos']; ?>
									</option>
							<?php } ?>
						</select>
						<label for="">Inicio Clases:</label>
						<input type="text" class="fecha" name="inicio_clases" value="<?php echo $curso['inicio_clases']; ?>">
						<label for="">Grupo:</label>
						<input type="text" name="grupo" value="<?php echo $curso['grupo']; ?>">
						<label for="">Plan academico:</label>
						<select name="plan_editar" disabled="disabled">
							<option></option>
							<?php $planes = listar_planes();
							while($plan = $planes->fetch_assoc()){ ?>
								<option value="<?php echo $plan['id']; ?>"> <?php echo $plan['nombre']; ?></option>
							<?php } ?>
						</select>
						<input type="hidden" name="id" value="<?php echo $curso['id']; ?>">
						<input type="submit" name="boton" value="Editar">
					</form>
				</div>
				<?php } ?>
			</table>
		</div>
	</div>

<script src="../js/administrador.js"></script>
</body>
</html>