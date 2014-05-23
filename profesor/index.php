<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/profesor/header.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/profesor_controller.php"); 
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/controller/planes_controller.php"); ?>
	<div class="row profesor-index">		
		<div class="col-md-3 col-xs-12 ">
			<?php $result = listar_cursos($_SESSION['id']);
				if($result)
				  while($curso = $result->fetch_assoc()){ 
					  $plan = buscar_plan($curso['planes_id']); ?>
					<a href="#" class="clic_curso" id="<?php echo $curso['curso_id']; ?>">
						<div class="menu" id="link_<?php echo $curso['curso_id']; ?>" data-value="<?php echo $curso['curso_id']; ?>">
						<div class="triangulo"></div>
							<h3><?php echo $curso['nombre']; ?> 
								<small style="color: black;font-size: 13px; margin: 10px 0;">
							 		(Grupo: <?php echo $curso['grupo']; ?> ) 
									(plan: <?php echo $plan['nombre']; ?>)
								</small>
							</h3>
						</div>
					</a>
				  	<?php } ?>
		</div>
		<div class="col-md-9 col-xs-12">
			<div class="menu-tabs pull-right">
				<a href="#" class="btn btn-warning alumnos-btn">Lista de alumnos</a>
				<a href="#" class="btn btn-warning materiales-btn">Material de apoyo</a>
				<a href="#" class="btn btn-warning materia-btn">Contenido en Clases</a>
			</div>
		</div>
		<div class="col-md-9 col-xs-12 contenido">
		</div>

	
	</div>
	<script>
	$('.menu').on("click", function(){
		var id = $(this).attr('data-value');
		
		$('.menu').css("background", "#50566F");
		$(".triangulo").css("border-left", "30px solid #50566F");
		$("#link_"+id).css("background", "#fdbd4b");
		$("#link_"+id+" .triangulo").css("border-left", "30px solid #fdbd4b");
		console.log("cambio de color");
	})
	</script>
	<script src="../js/profesor.js"></script>
</body>
</html> 