<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php"); 

	  $alumnos = listar_morosos();

	  if($alumnos){ ?>
	  <h2>Lista de deudores del presente año</h2>
		<table class="table">
			<tr>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Rut</th>
				<th>Ver</th>
			</tr>
		  	<?php while($alumno = $alumnos->fetch_assoc()){?>
		  		<tr>
		  			<td>
			  			<?php echo $alumno['nombre']; ?>
		  			</td>
		  			<td>
			  			<?php echo $alumno['apellidos']; ?>
		  			</td>
		  			<td>
			  			<?php echo $alumno['rut']; ?>
		  			</td>
		  			<td>
			  			<a href="pago_alumno.php?rut=<?php echo $alumno['rut']; ?>">Ver</a>
		  			</td>
		  		</tr>
		  	<?php } }?> 
		</table>
