<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/db_model.php");


	class CursosList extends db_model {
		function cursos_x_plan($plan){
			$query = "SELECT a1.*, a2.nombre nombre 
					  FROM (SELECT * FROM cursos WHERE habilitado = 1 AND planes_id=".$plan.") a1,categoria a2 
					  WHERE a1.categoria_id = a2.id";

			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}

		function alumnos_x_curso($curso){
			$query = "SELECT a1.*, a3.* FROM datos_usuarios a1, cursa a2, usuarios a3 
	    			  WHERE a1.usuario_id = a2.usuarios_id
	    			  AND a1.usuario_id = a3.rut
				      AND a2.cursos_id=".$curso."
				      AND a2.activo = 1";
			$this->connect();
			$this->result = $this->conn->query($query);
			$this->close();
			return $this->result;
		}
	}

if($_POST['boton']=="Cursos"){

	$cursos = new CursosList();
	$result = $cursos->cursos_x_plan($_POST['plan']); ?>

 	<option></option>

    <?php while($curso = $result->fetch_assoc()){ ?>
 		<option value="<?php echo $curso['id']; ?>"><?php echo $curso['nombre']." ( Grupo ".$curso['grupo']." )"; ?> </option>
	
    <?php }
}

else if ($_POST['boton']=="Alumnos"){

	$alumnos = new CursosList();
	$result = $alumnos->alumnos_x_curso($_POST['curso']);

?>  
	<table class="table">
		<tr>
			<th>Nombre</th>
			<th>Apellidos</th>
			<th>Rut</th>
			<th>Quitar</th>
		</tr>

<?php
if($alumnos)
	while($alumno = $result->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $alumno['nombre']; ?></td>
			<td><?php echo $alumno['apellidos']; ?></td>
			<td><?php echo $alumno['rut']; ?></td>
			<td><a href="#">Quitar</a></td>
		</tr>
	<?php }
} ?>
	</table>