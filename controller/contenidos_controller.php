<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/contenido_model.php");

function listar_contenidos($curso){
	$contenidos = new contenido();
	return $contenidos->listar($curso);
}

if(isset($_POST['boton'])){
	if($_POST['boton'] == "Agregar Contenido"){
		$contenidos = new contenido();
		$contenidos->registrar($_POST); ?>

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
						
						<tr>
							<td><?php echo $contenido['fecha']; ?></td>
							<td><h4><?php echo $contenido['titulo']; ?></h4>
								<p><?php echo $contenido['descripcion']; ?></p>
							</td>
							<td><a href="#" class="btn-edit-contenido" data-value="<?php echo $contenido['id']; ?>">Editar</a></td>
							<td><a href="#">Eliminar</a></td>
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
					<?php } ?>
				</table>
			</div>
			<script src="../js/contenido.js"></script>
			<?php } else if($_POST['boton'] == 'Remover'){
				$contenido = new Contenido();
				$contenido->eliminar($_POST['contenido']);
				$file = $_POST['contenido'];
				echo "<script>console.log('".$file." rrr');</script>";
			} 
				
	}

 ?>