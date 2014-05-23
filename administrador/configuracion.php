<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/administrador/header.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/categorias_controller.php");
 ?>

 <div class="row">

 <!-- Categorias de las clases, lenguaje etc... 
    listado, edicion, creacion y eliminacion -->
 	<div class="col-xs-12 col-md-4 col-md-offset-2">
 		<h3>Categorias de clases</h3>
 		<form action="../controller/categorias_controller.php" method="POST">
 			<div class="campo-formulario">
 				<span>Nombre:</span>
 				<input type="text" name="nombre">
 			</div>
 			<input type="submit" name='boton' value="Crear" class="btn btn-warning">
 		</form>
 		<table class="table">
 			<tr>
 				<th>Id</th>
 				<th>Nombre</th>
 				<th></th>
 			</tr>
 			<?php $categorias = listar_categorias(); 
 			while($categoria = $categorias->fetch_assoc()){?>
				<tr>
					<td><?php echo $categoria['id']; ?></td>
					<td><?php echo $categoria['nombre']; ?></td>
					<td><a href="#" class="btn-edit-categoria" data-value="<?php echo $categoria['id']; ?>"> Editar </a></td>
				</tr>
				<div class="categoria-form" id="categoria_<?php echo $categoria['id']; ?>">
			 		<form action="../controller/categorias_controller.php" method="POST">
			 			<div class="campo-formulario">
			 				<span>Nombre:</span>
			 				<input type="text" name="nombre" value="<?php echo $categoria['nombre']; ?>">
			 				<input type="hidden" name="id" value="<?php echo $categoria['id']; ?>" >
			 			</div>
			 			<input type="submit" name='boton' value="Grabar" class="btn btn-warning">
			 		</form>
				</div>
 			<?php } ?>
 		</table>
 	</div>
 	<div class="col-xs-12 col-md-4 col-md-offset-2">
		<?php require_once($_SERVER['DOCUMENT_ROOT']."/administracion/cambiar_clave.php"); ?>
	</div>
 </div>
 <script>
 	$(function(){
 		$(".categoria-form").css("display", "none");
 		$('.btn-edit-categoria').on("click", function(e){
 			e.preventDefault();
 			var id = $(this).attr('data-value');
 			$("#categoria_"+id).dialog({modal: true});
 		})
 	}) 
 </script>