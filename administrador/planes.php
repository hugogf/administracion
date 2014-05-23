<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/administrador/header.php"); ?>

<div class="row">
	<div class="col-md-3">
		<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/administrador/new_planes.php"); ?>
	</div>

	<div class="col-md-9">
		<h3>Planes de estudios creados</h3>
		<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php"); 
		$planes = listar_planes();
		while($plan = $planes->fetch_assoc()){?>
		<div class="col-xs-12 col-md-4">
			<div class="thumbnail">
				<div class="caption">
					<h3><?php echo $plan['nombre']; ?><br> <small>$<?php echo $plan['valor']; ?> Anual</small></h3>
					<p class="p"><?php echo $plan['descripcion']; ?></p>
				</div>
				<p class="link-thumb"><a href="../controller/planes_controller.php?delete=on&id=<?php echo $plan['id']; ?>" class="btn">Eliminar</a><a href="#" class="btn editar" data-valor="<?php echo $plan['id']; ?>">Editar</a></p>
			</div>
		</div>
		<div class="form-plan" title="Editar <?php echo $plan['nombre']; ?>" id="<?php echo $plan['id']; ?>">
			<form action="../controller/planes_controller.php" method="POST">
				<label for="">Nombre Plan</label>
				<input type="text" name="nombre" value="<?php echo $plan['nombre'] ?> ">
				<label for="">Valor Total</label>
				<input type="text" name="valor"value="<?php echo $plan['valor'] ?> ">
				<label for="">Inicio clases</label>
				<input type="text" name="fecha_inicio" class="fecha" value="<?php echo $plan['fecha_inicio'] ?> ">
				<label for="">Descripcion</label>
				<input type="text" name="descripcion" value="<?php echo $plan['descripcion'] ?> ">
				<label for="">Jornada</label>
				<input type="text" name="jornada"value="<?php echo $plan['jornada'] ?> ">
				<input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
				<input type="submit" name="boton" value="Editar">
			</form>
		</div>
		<?php } ?>
	</div>
</div>
	<script src="../js/administrador.js"></script>
</body>
</html>