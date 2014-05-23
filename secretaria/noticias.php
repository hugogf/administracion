<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/secretaria/header.php"); 
?>
<div class="dialog-noticia row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		
		<form action="../controller/noticias_controller.php" method="POST">
			<label>Titulo</label>
			<input type="text" name="titulo">
			<input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id']; ?>">
			<textarea name="contenido"></textarea>
			<input type="hidden" name="id_noticia">
			<input type="submit" name="boton" value="Crear Noticia" class="btn btn-warning">
			<a href="#" id="cerrar-crear"> Cerrar </a>
		</form>

	</div>
</div>
<div class="row" id="noticias-index" >
	
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		<a href="#" class="btn btn-warning" id="crear-noticia">Crear noticias</a>
		<table class="table table-hover">
			<tr>
				<th>Títutlo</th>
				<th>Fecha Creación</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
	<?php $noticias = listar_noticias();
		while($noticia = $noticias->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $noticia['Titulo']; ?></td>
				<td><?php echo $noticia['Fecha_creacion']; ?></td>
				<td><a href="#">Eliminar</a></td>
				<td><a href="#" class="btn-editar-noticia" data-value="<?php echo $noticia['id']; ?>" data-titulo="<?php echo $noticia['Titulo']; ?>" data-contenido="<?php echo $noticia['Contenido']; ?>">Editar</a></td>
			</tr>
		<?php } ?>
		</table>
	</div>	
</div>



<script src="../js/tinymce/tinymce.min.js"></script>
<script src="../js/secretaria.js"></script>
