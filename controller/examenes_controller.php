<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/examen_model.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/resultado_model.php");

	function listar_examenes($curso){
		$examenes = new Examen();
		return $examenes -> listar($curso);
	}

	if(isset($_POST['boton']))
		if($_POST['boton'] == 'listar')
		{
			$examenes = listar_examenes($_POST['curso']);
			if($examenes->num_rows != 0){
				while($examen = $examenes -> fetch_assoc()){ ?>
					<div  class="lista_examenes"  id="lista_examenes_<?php echo $examen['id']; ?>">
						<h3><?php echo $examen['titulo']; ?></h3>
						<p><?php echo $examen['fecha']; ?></p>
						<a href="#" class="ver"  data-value="<?php echo $examen['id']; ?>">ver</a>
						<a href="#" class="btn-eliminar-examen" data-value="<?php echo $examen['id'] ?>">Eliminar</a>
						<a href="#">Editar </a>
					</div>

				<?php } ?> 
				<script src="../js/load_resultados.js"></script> <?php
			}else{
				echo "No hay examenes en este curso";
			}
		}else if($_POST['boton']=='crear'){
			$examen = new Examen();
			$examen->ingresar($_POST);
		

		}else if($_POST['boton']=="eliminar"){
			$examen = new Examen();
			$examen->eliminar($_POST['examen']);

		}else if($_POST['boton']=="Alumnos"){
			$alumnos = new Resultado();
			$alumnos = $alumnos->lista_alumnos_x_examen($_POST['examen']);

			if($alumnos->num_rows != 0){ ?>
				<h3>Listado de alumnos </h3>
				<table class="table">
					<tr>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Rut</th>
						<th>Puntaje</th>
						<th></th>
					</tr>
				
			<?php while($alumno = $alumnos->fetch_assoc()){?> 
				 <tr>
				 	<td><?php echo $alumno['nombre']; ?></td>
				 	<td><?php echo $alumno['apellidos']; ?></td>
				 	<td><?php echo $alumno['rut']; ?></td>
				 	<td><input type="number" class="puntaje" id="<?php echo $alumno['rut']; ?>" data-examen="<?php echo $_POST['examen']; ?>" value="<?php echo $alumno['resultado']; ?>"></td>
				 	<td id="td_<?php echo $alumno['rut']; ?>">Resultados.</td>
				 </tr>
				<?php } echo "</table><script src='../js/load_lista.js'></script>";
			}else{echo "no se encuentran alumnos asociados al examen";}
		
		}else if($_POST['boton']=='resultado')
		{
			$resultado = new Resultado();
			$resultado->actualizar($_POST);
			echo "Actualizado";
		}
 ?>