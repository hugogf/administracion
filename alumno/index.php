<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/alumno/header.php"); 
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/usuarios_controller.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/cursa_controller.php");
	  require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/datos_usuarios_controller.php");

	  $usuario = buscar_usuario($_SESSION['id']);
	  $datos = buscar_datos_usuario($_SESSION['id']);
	  $plan = buscar_plan($datos['plan_id']);
	  $cursos = listar_cursos($_SESSION['id']);

	//  var_dump($cursos); ?>
<div class="row">
	<div class="col-xs-12 col-md-3">
		<h4>Informaciòn general</h4>
		<p><?= $usuario['nombre']." ".$usuario['apellidos']; ?></p>
		<table>
			<tr>
				<th>Celular :</th>
				<td><?= $usuario['celular']; ?></td>
			</tr>
			<tr>
				<th>Direcciòn :</th>
				<td><?= $usuario['direccion']; ?></td>
			</tr>
			<tr>
				<th>%Asistencia :</th>
				<td>Por definir</td>
			</tr>
			<tr>
				<th>Plan Academico :</th>
				<td><?= $plan['nombre']; ?></td>
			</tr>
			<tr>
				<th>Jornada :</th>
				<td><?= $datos['jornada']; ?></td>
			</tr>
			<tr>
				<th>Estado financiero :</th>
				<td>Por definir</td>
			</tr>
		</table>
	</div>
	<div class="col-xs-12 col-md-7">
		<h4>Cursos</h4><br><br>
		<table width="100%">
			<tr>
				<th>Curso</th>
				<th>Profesor</th>
				<th></th>
			</tr>
			<?php foreach ($cursos as $curso) { ?>
				<tr>
					<td><?= $curso['nombre']; ?></td>
					<?php $profesor = buscar_usuario($curso['profesor_id']); ?>
					<td><?= $profesor['nombre']." ".$profesor['apellidos']; ?></td>
					<td><a href="curso.php?curso=<?= $curso['id']; ?>">Ingresar</a></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>		