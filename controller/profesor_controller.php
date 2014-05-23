<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/profesor_model.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/profesor/files_controller.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/contenidos_controller.php");
	
	function listar_cursos($rut){
		$cursos = new Profesor();
		$cursos = $cursos->listar_cursos($rut);
		return $cursos;
	}

	
	if(isset($_POST['boton'])){
		if($_POST['boton']=="lista_curso"){

			$alumnos = new Profesor();
			$alumnos = $alumnos->alumnos_curso($_POST['curso']);
			?>	

			<div class="col-xs-12 alumnos-tabs">
			<h3>Lista de alumnos</h3>
			<table class="table">
				<tr>
					<th>Nombre del Alumno</th>
					<th>Rut del alumno</th>
				</tr> 
			<?php
			// var_dump($alumnos);
			if($alumnos)
			while($alumno = $alumnos->fetch_assoc()){ ?>
				<tr>
					<td><?php echo $alumno['nombre']." ". $alumno['apellidos']; ?></td>
					<td><?php echo $alumno['rut']; ?></td>
				</tr>
				<?php } ?> 
			</table>
			</div>
			<div class="col-xs-12 materiales-tabs">
				<h3>Material docente</h3>
				<form action="files_controller.php" class="form" method="post" enctype="multipart/form-data">
					<h3>Subir material</h3>
					<input type="file" name="userfile" required="required">
					<input type="hidden" name="curso" value="<?php echo $_POST['curso']; ?>">
					<input type="submit" class="btn btn-warning" value="Subir Archivo" name="boton">
				</form>
				<div class="lista_materiales">
					<?php 
						$materiales = listar_materiales($_POST['curso']);
						echo '<ul>';
						if($materiales)
						while($material = $materiales->fetch_assoc()){ ?>
							<li id="<?php echo $material['id']; ?>_contenido_fila">
								<a href="<?php echo $material['url']; ?>" target="_blank" class="files_link">
									<h4><?php echo $material['nombre']; ?></h4>
									<p>Creado: <?php echo $material['created_at']; ?></p>	
								</a>
								<p><a href="#" class="btn-eliminar-material" data-value="<?php echo $material['id']; ?>">Eliminar</a></p>	
							</li>
						<?php } echo '</ul>'; ?>
				</div>
			</div>
			<div class="col-xs-12 materia-tabs">
			<h3>Historial de contenido de clases</h3>
				<form action="#" class="form">
					<div class="campo-formulario">
						<label>Titulo</label>
						<input type="text" required="required" name="titulo-contenido">
					</div>
					<div class="campo-formulario">
						<label>Fecha</label>
						<input type="text" name="fecha-contenido" required="required" class="fecha">
					</div>
					<div class="campo-formulario">
						<label>Descripción</label>
						<textarea name="descripcion-contenido"></textarea>
					</div>
					<input type="hidden" name="curso-contenido" value="<?php echo $_POST['curso']; ?>">
					<input type="submit" name="boton" id="btn-add-contenido" value="Agregar contenido">
				</form>
				<div class="msg-contenido"></div>
				<div class="table-contenido">
					
				<table class="table">
				<tr>
					<th>Fecha</th>
					<th>Contenido</th>
					<th></th>
					<th></th>
				</tr>
				<?php $contenidos = listar_contenidos($_POST['curso']);
					if($contenidos)
					while($contenido = $contenidos->fetch_assoc()){ ?>
						
						<tr id="<?php echo $contenido['id']; ?>_tr">
							<td><?php echo $contenido['fecha']; ?></td>
							<td><h4><?php echo $contenido['titulo']; ?></h4>
								<p><?php echo $contenido['descripcion']; ?></p>
							</td>
							<td><a href="#" class="btn-edit-contenido" data-value="<?php echo $contenido['id']; ?>">Editar</a></td>
							<td><a href="#" class="eliminar-contenido" data-value="<?php echo $contenido['id']; ?>">Eliminar</a></td>
						</tr>
						<div class="edit-contenido" title=" Editar contenido <?php echo $contenido['fecha']; ?>" id="<?php echo $contenido['id']; ?>">
							<form action="#">
								<div class="campo-formulario">
									<label>Nombre</label>
									<input type="text" name="titulo-edit" value="<?php echo $contenido['titulo']; ?>">
								</div>
								<div class="campo-formulario">
									<label>Fecha</label>
									<input type="text" name="fecha-edit" class="fecha" value="<?php echo $contenido['fecha']; ?>">
								</div>
								<div class="campo-formulario">
									<label>Descripcion</label>
									<textarea name="descripcion-edit" value="<?php echo $contenido['descripcion']; ?>" cols="30" rows="10"></textarea>
								</div>
								<input type="hidden" name="id_contenido" value="<?php echo $contenido['id']; ?>">
								<input type="submit" name="btn" value="Editar">
							</form>
						</div>

					<?php }else{echo "<h1>No rigistra contenidos</h1>";} ?>
				</table>
			</div>
			<script src="../js/contenido.js"></script>
			</div>
				<?php
		}
	}	

 ?>