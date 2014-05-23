$(function(){

		$(".menu-tabs").css("display", "none");
		

		$(".clic_curso").on('click',function(){

			var curso = $(this).attr('id');
			
			$('.contenido').load("../controller/profesor_controller.php",
				{
					boton: 'lista_curso', 
					curso: curso
				},

				function(){
					$(".materiales-tabs").css("display", "none");
					$(".materia-tabs").css("display", "none");
					$(".menu-tabs").fadeIn();
					console.log('Carga completa!');
				})
		})



		$(".alumnos-btn").on("click", function(){
			$(".materiales-tabs").fadeOut();
			$(".materia-tabs").fadeOut();
			$(".alumnos-tabs").fadeIn();
		})
		$(".materiales-btn").on("click", function(){
			$(".materia-tabs").fadeOut();
			$(".alumnos-tabs").fadeOut();
			$(".materiales-tabs").fadeIn();
		})
		$(".materia-btn").on("click", function(){
			$(".materiales-tabs").fadeOut();
			$(".alumnos-tabs").fadeOut();
			$(".materia-tabs").fadeIn();
		})



	})